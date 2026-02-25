<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin_filter.php");
    exit;
}

if (isset($_POST['endnumbutton']) && isset($_POST['endnum']) && $_POST['endnum'] !== '') {
    $endnum = (int) $_POST['endnum'];
    $stmt = $db->prepare("UPDATE admin_controls SET end_entry = ? WHERE id_control = 115617");
    $stmt->bind_param("i", $endnum);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_filter.php?updated=1");
    exit;
}

if (isset($_POST['startnumbutton']) && isset($_POST['startnum']) && $_POST['startnum'] !== '') {
    $startnum = (int) $_POST['startnum'];
    $stmt = $db->prepare("UPDATE admin_controls SET start_entry = ? WHERE id_control = 115617");
    $stmt->bind_param("i", $startnum);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_filter.php?updated=1");
    exit;
}

header("Location: admin_filter.php");
exit;
