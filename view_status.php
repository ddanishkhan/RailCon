<?php
require_once __DIR__ . '/database_connection.php';

$email = trim($_GET['email'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('location:index.php');
    die();
}

$_SESSION['studentemail']  = $email;
$_SESSION['SearchRequest'] = true;

header('location:studentsearch.php');
die();
