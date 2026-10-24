# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

RailCon is a PHP web application for managing railway concession pass applications for engineering college students (MHSSCOE). Students submit forms; admins verify and issue passes; emails are sent on status changes.

## Admin User Profile

The primary admin user is an older person with **vision difficulties and carpal tunnel syndrome**. Keep this in mind for all UI decisions on admin-facing pages:

- **Large, well-spaced click targets** — buttons should be easy to hit without precise mouse movement; avoid small or tightly packed controls
- **High contrast and readable text** — prefer clear labels over icons alone; don't rely solely on colour to convey meaning
- **Minimal repetitive actions** — features like Bulk Issue exist specifically to reduce the number of clicks/keystrokes required
- **Familiar, consistent labels** — don't rename buttons users already know (e.g. "Bulk Issue" not "Issue Selected"); muscle memory matters
- **No hover-only interactions** — actions must be reachable without sustained hover or precise cursor positioning

## Local Development

No build step. PHP files are served directly.

- **Local DB**: `localhost / root / (empty) / railcon` (MariaDB)
- **Web root**: Serve the repo root via Apache or PHP's built-in server
- **Apache config**: See `Apache_Configuration/` for rewrite rules
- **Logs**: Written to `logs/logs.log`
- **Uploaded images**: Stored in `MyUploadImages/` (gitignored)

## Configuration

`config.php` is **gitignored** and must exist before the app works. Copy `config.example.php` to `config.php` and fill in values. It defines PHP constants used everywhere:

```
DB_HOST, DB_USER, DB_PASS, DB_NAME
SMTP_HOST, SMTP_USERNAME, SMTP_PASSWORD, SMTP_PORT, SMTP_FROM, SMTP_FROM_NAME
```

## Deployment

Pushing to `master` triggers `.github/workflows/deploy.yml`, which FTPs changed files to InfinityFree (`htdocs/`). `config.php` is excluded from the deploy — it must be manually FTP'd to the server once and then lives there permanently.

FTP credentials are stored as GitHub Secrets: `FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`.

## Architecture

### Include Hierarchy

Most pages follow this pattern:
```
page.php
  ├─ require 'database_connection.php'   → require_once config.php → $db (mysqli object)
  ├─ include 'logs/LOGGER.php'           → LOGGER::log() / LOGGER::logWithPath()
  └─ include_once 'constants/departments.php'
```

Email files are included inline (not called via HTTP):
```
update.php → include 'PHPMailer/sendmail.php'   (on issue)
           → include 'PHPMailer/senderrormail.php'  (on reject)
```

`admin.php` assembles the dashboard by including `filter_bar.php`, `admin_table.php`, and `pagination.php`.

### Database Tables

| Table | Purpose |
|---|---|
| `student` | Active pass applications |
| `oldstudent` | Archived (expired) records — same schema |
| `members` | Admin accounts (bcrypt; legacy MD5 hashes upgraded on login in `login.php`) |
| `admin_controls` | Single-row table; `end_entry` controls whether form accepts new submissions |

Key columns on `student`: `verified` (0/1 issued), `edit` (0/1 allow re-edit), `datetodelete` (auto-archive date), `img_loc` (filename in `MyUploadImages/`).

### Core Request Flows

**Student submits form**: `index.php` → POST → `profile.php`
- Validates age (<25), JPEG image (EXIF required, <1MB, ≥100×100px), email uniqueness
- If email exists, calls `checkIfPassExpiredForExistingEmail()` — if pass expired, runs a transaction to move the old record to `oldstudent` and delete the old image, then allows new submission
- Sets `datetodelete` = 28 days (monthly) or 87–88 days (quarterly) from submission
- Redirects to `enrollmentid.php` with the new record ID

**Admin issues a pass**: `admin.php` → `update.php` (POST)
- Sets `verified = 1`, puts email in `$_SESSION['emailid']`, then `include`s `PHPMailer/sendmail.php` inline
- `senderrormail.php` is used the same way for rejections

**Admin filtering**: `filter_bar.php` POSTs to `admin.php`, which builds a WHERE clause and stores it in `$_SESSION['query']`. Pagination reads the cached query from session.

**Form open/close**: `change_number.php` updates `admin_controls.end_entry`. On login, `login.php` compares the latest student ID against `end_entry` to decide whether to show `notificationFormClosed.php`.

### Shared Includes (`includes/`)

- `csrf.php`: `csrf_input()` in every POST form, `validate_csrf_token($_POST['csrf_token'] ?? '')` at the top of every POST handler
- `auth.php`: `require_login()` at the top of admin-only pages
- `helpers.php`: `archiveStudentById()`, `deleteImage()`, `checkIfPassExpiredForExistingEmail()`
- `head.php` / `scripts.php` / `footer.php`: shared layout (GA4 lives in `head.php`)

### Tests

```bash
php tests/run_all.php   # runs tests/test_*.php (csrf, helpers, admin_controls)
```

### Dependencies

No Composer or npm, so there is no lockfile or `update` command. Every bump is a manual file replace or URL edit. Production host (InfinityFree) runs PHP 8.4; check with `phpver.php` (public, prints the PHP version).

**Version-bump map** (versions as of Oct 2026; re-grep `src=`/`href=` before editing, since pages drift):

| Library | Version | Where it lives | Referenced from |
|---|---|---|---|
| PHPMailer | 7.1.1 | `PHPMailer/src/{PHPMailer,SMTP,Exception}.php` (copied, no Composer) | `PHPMailer/sendmail.php`, `senderrormail.php` |
| Bootstrap | 4.6.2 (CDN, main layout) | CSS in `includes/head.php`; JS bundle only in `includes/bootstrap_js.php` (pulled in by `scripts.php`, `index.php`, `studentsearch.php`) | |
| Bootstrap | 4.6.2 (local) | `vendor/bootstrap/` | `login.html` |
| jQuery | 3.7.1 (local) | `vendor/jquery/` | `includes/head.php`, `login.html`, `notification.php`, `notificationFormClosed.php` |
| Popper | 1.16.1 (local) | `vendor/popper.js/` | `login.html` (the main layout gets Popper via the Bootstrap bundle) |
| Chart.js | 2.9.4 | `vendor/chart.js/` | `includes/scripts.php`, `login.html` |
| jquery-validation | 1.22.1 | `vendor/jquery-validation/` | `includes/scripts.php`, `login.html` |
| jquery.cookie | 1.4.1 | `vendor/jquery.cookie/` | `includes/scripts.php`, `login.html` |
| Font Awesome | local | `vendor/font-awesome/` | `includes/head.php`, `login.html` |
| SweetAlert | 2.1.2 (unpkg, pinned) | | `notification.php`, `notificationFormClosed.php` |

**Gotchas**
- Stay on the current major lines: Bootstrap 4.6.x (5 drops jQuery), jQuery 3.x (4 is a breaking release), Popper 1.x, Chart.js 2.x (3+ has a new API). Vendored files are copied from the npm tarballs (`dist/`), keeping the same file names.
- `login.html` is static, uses theme `style.sea.css` and local `vendor/` libs, and keeps its own library tags. It can't be renamed to `login.php` (that is the POST handler), so bump it by hand.
- Prefer one shared include (`includes/head.php` / `scripts.php`) per library. `login.html` and `notification*.php` carry their own tags and must be bumped separately.
- Dead refs to clean up: `oss.maxcdn.com` html5shiv/respond (`includes/head.php`, `login.html`, `page-error-*.html`; IE9-only) and `http://fonts.googleapis.com` in `icons-reference/`. `page-error-*.html` point at `css/lib/` and `js/lib/` paths that look unmaintained; verify before relying on them.
- No test covers the UI. After a bump, load `index.php`, `login.html`, `admin.php` and an error page and check the browser console. After a PHPMailer bump, issue and reject a test pass to confirm mail still sends.

### Logging

```php
LOGGER::log("INFO", "message");                        // → logs/logs.log
LOGGER::logWithPath("ERROR", "message", $LOGPATH);    // → custom path
```

`PHPMailer/sendmail.php` and `senderrormail.php` use `$LOGPATH = '../logs/logs.log'` (one level up since they live in `PHPMailer/`).

### Image Uploads

Uploaded files are named `{timestamp}id.{ext}` and stored in `MyUploadImages/`. When a record is archived or deleted, the corresponding image file is deleted from the filesystem. JPEG with EXIF is required — the EXIF check is used as part of file type validation.
