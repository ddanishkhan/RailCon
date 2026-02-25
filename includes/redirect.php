<?php
/**
 * Redirect helpers — replaces the mix of header("Location:...") and
 * header("Refresh:1; url=...") spread across files.
 *
 * redirect()        → immediate Location redirect (default)
 * redirect($url, false) → 1-second delayed Refresh redirect
 */
function redirect(string $url, bool $immediate = true): void {
    if ($immediate) {
        header("Location: $url");
    } else {
        header("Refresh:1; url=$url");
    }
    exit;
}

/**
 * Redirect to admin.php or dashboard.php based on session flag.
 */
function redirect_to_panel(bool $immediate = true): void {
    $target = !empty($_SESSION['dashboard']) ? 'dashboard.php' : 'admin.php';
    redirect($target, $immediate);
}
