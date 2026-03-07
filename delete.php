<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/redirect.php';
require_once __DIR__ . '/includes/helpers.php';

if (isset($_POST['delete'])) {
    validate_csrf_token($_POST['csrf_token'] ?? '');

    require_once __DIR__ . '/database_connection.php';
    $idd = (int) $_POST['id'];

    if (!archiveStudentById($idd, $db)) {
        die('Archive failed');
    }

    redirect_to_panel();
} else {
    echo "Error";
}
?>
