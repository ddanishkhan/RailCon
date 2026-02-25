<?php
require_once __DIR__ . '/config.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

function OpenDatabaseConnection()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME)
        or die("Connect failed: %s\n" . $conn->error);
    return $conn;
}

function CloseDatabaseCon($conn)
{
    $conn->close();
}
