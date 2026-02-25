<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remark'])) {
        require_once __DIR__ . '/database_connection.php';

        $remark  = $_POST['remark'];
        $var_id  = (int) $_POST['id'];

        $stmt = $db->prepare("UPDATE student SET Remark = ? WHERE id = ?");
        $stmt->bind_param("si", $remark, $var_id);

        if ($stmt->execute()) {
            if ($_SESSION['dashboard'] == "true") { header("Refresh:0.5 ,url=dashboard.php"); }
            else { header("Refresh:0.5 ,url=admin.php"); }
            echo '<script>alert("Remark Successful!");</script>';
        } else {
            if ($_SESSION['dashboard'] == "true") { header("Refresh:0.5 ,url=dashboard.php"); }
            else { header("Refresh:0.5 ,url=admin.php"); }
            echo '<script>alert("Error in Remark!");</script>';
        }
        $stmt->close();
    }
} else {
    header("Location: index.php");
}
?>
