<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/redirect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remark'])) {
        validate_csrf_token($_POST['csrf_token'] ?? '');

        require_once __DIR__ . '/database_connection.php';

        $remark  = $_POST['remark'];
        $var_id  = (int) $_POST['id'];

        $stmt = $db->prepare("UPDATE student SET Remark = ? WHERE id = ?");
        $stmt->bind_param("si", $remark, $var_id);
        $stmt->execute();
        $stmt->close();

        redirect_to_panel();
    }
} else {
    header("Location: index.php");
}
?>
