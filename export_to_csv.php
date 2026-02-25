<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';

$filename = "RailwayConcession.xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

$user_query = mysqli_query($db, 'SELECT id,fullname,semester,email,DOB,contact,aadhar,address,pincode,
    source,destination,passno,classof,duration,branch,year FROM student');

$flag = false;
while ($row = mysqli_fetch_assoc($user_query)) {
    if (!$flag) {
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}
?>
