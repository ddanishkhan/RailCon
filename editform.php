<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/redirect.php';

if (isset($_POST['edit_form'])) {
    validate_csrf_token($_POST['csrf_token'] ?? '');

    require_once __DIR__ . '/database_connection.php';
    mysqli_report(MYSQLI_REPORT_ALL);
    $idd = (int) $_POST['id'];
    $bool = 1;

    $sql_query = $db->prepare("SELECT verified, edit FROM student WHERE id = ?");
    $sql_query->bind_param('i', $idd);
    $sql_query->execute();
    $sql_query->bind_result($verified, $edit);
    $sql_query->fetch();
    $sql_query->free_result();

    if ($verified == 0) {
        if ($edit == 0) {
            $q = $db->prepare("UPDATE student SET edit = ? WHERE id = ?") OR die("Query preparation failed");
            $q->bind_param("ii", $bool, $idd);
            $q->execute();
            $_SESSION['flash'] = 'Edit permission granted successfully.';
        } else {
            $_SESSION['flash'] = 'Edit permission already granted.';
        }
    } else {
        $_SESSION['flash'] = 'Record already issued — edit permission cannot be granted.';
    }

    redirect_to_panel();
}
?>
