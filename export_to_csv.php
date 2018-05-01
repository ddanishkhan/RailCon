<?php
// Connection 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
$conn=mysql_connect('localhost','root','');
//database name
$db=mysql_select_db('railcon',$conn);

$filename = "RailwayConcession.xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$user_query = mysql_query('select id,fullname,semester,email,DOB,contact,aadhar,address,pincode,
	source,destination,passno,classof,duration,branch,year from student');
// Write data to file
$flag = false;
while ($row = mysql_fetch_assoc($user_query)) {
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}
}//Authentication
else{
	echo "<script> alert('Log In First'); </script>";
	header("Refresh:1; url=index.html");
}

?>
