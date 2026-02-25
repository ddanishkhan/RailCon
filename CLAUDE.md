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
| `members` | Admin accounts (password stored as MD5) |
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

### Logging

```php
LOGGER::log("INFO", "message");                        // → logs/logs.log
LOGGER::logWithPath("ERROR", "message", $LOGPATH);    // → custom path
```

`PHPMailer/sendmail.php` and `senderrormail.php` use `$LOGPATH = '../logs/logs.log'` (one level up since they live in `PHPMailer/`).

### Image Uploads

Uploaded files are named `{timestamp}id.{ext}` and stored in `MyUploadImages/`. When a record is archived or deleted, the corresponding image file is deleted from the filesystem. JPEG with EXIF is required — the EXIF check is used as part of file type validation.
