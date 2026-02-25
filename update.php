<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
error_reporting(E_ERROR | E_PARSE);
include 'logs/LOGGER.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //database connection
    require_once __DIR__ . '/database_connection.php';

    $var_id = (int) $_POST['id'];

    $stmt = $db->prepare("SELECT verified, fullname, email FROM student WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $var_id);
    $stmt->execute();
    $s_value = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    //checking which button clicked
    if (isset($_POST['verify_it'])) {
        logger::log("INFO", "VERIFY IT");
        if ($s_value['verified'] == "0") {

            $stmt_upd = $db->prepare("UPDATE student SET verified = 1 WHERE id = ?");
            $stmt_upd->bind_param("i", $var_id);
            $stmt_upd->execute();
            $stmt_upd->close();

            $_SESSION['fullnameemail'] = $s_value['fullname'];
            $_SESSION['emailid']       = $s_value['email'];
            include ('PHPMailer/sendmail.php');

            logger::log("INFO", "Session Logged In [".$_SESSION['loggedin'] . "]|USER=[" .$_SESSION['user'] . "]" );
            if ($_SESSION['dashboard']) {
                logger::log("INFO", "Redirected to dashboard.php");
                header("Location: dashboard.php");
            } else {
                logger::log("INFO", "Redirected to admin.php");
                header("Location: admin.php");
            }
        } else {
            echo "<script>alert('Already Issued')</script>";
            if ($_SESSION['dashboard']) {
                header("Refresh:0.5, url:dashboard.php");
            } else {
                header("Refresh:0.5, url:admin.php");
            }
        }
    }

    elseif (isset($_POST['cancel_verify'])) {
        logger::log("INFO", "CANCEL VERIFY");

        $_SESSION['fullnameemail'] = $s_value['fullname'];
        $_SESSION['emailid']       = $s_value['email'];
        try {
            include ('PHPMailer/senderrormail.php');
        } catch (Exception $e) {
            logger::log("Exception: During cancel_verify ", $e);
        }

        if ($s_value['verified'] == "1") {
            $stmt_upd = $db->prepare("UPDATE student SET verified = 0 WHERE id = ?");
            $stmt_upd->bind_param("i", $var_id);
            $stmt_upd->execute();
            $stmt_upd->close();
        }

        if ($_SESSION['dashboard']) {
            header("Location: dashboard.php");
        } else {
            echo "PRESS BACK BUTTON.";
            header("Location: admin.php");
        }
    }
} else {
    header("Location: login.php");
}
?>
