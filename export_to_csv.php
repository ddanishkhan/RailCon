<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';

$filename = "RailwayConcession.csv";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv; charset=utf-8");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");

$out = fopen('php://output', 'w');

$result = mysqli_query($db, 'SELECT id,fullname,semester,email,DOB,contact,aadhar,address,pincode,
    source,destination,passno,classof,duration,branch,year FROM student ORDER BY id ASC');

$header_written = false;
while ($row = mysqli_fetch_assoc($result)) {
    if (!$header_written) {
        fputcsv($out, array_keys($row), ',', '"', '\\');
        $header_written = true;
    }
    fputcsv($out, array_values($row), ',', '"', '\\');
}

fclose($out);
?>
