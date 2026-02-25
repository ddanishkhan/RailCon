<?php
/**
 * Ensures the current request comes from a logged-in admin.
 * Call require_login() at the top of every admin-only page.
 */
function require_login(string $redirect = 'login.html'): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: $redirect");
        exit;
    }
}
