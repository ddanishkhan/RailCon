<?php
session_start();

if(isset($_POST['delete']) && $_SESSION['loggedin'] == true ){
	require 'database_connection.php' ;
	mysqli_report(MYSQLI_REPORT_ALL);
	$idd = $_POST['id'];
	
	$sql_query = $db->prepare( "SELECT `id`, `fullname`, `gender`, `semester`, `email`, `DOB`, `contact`, `aadhar`, `address`, `pincode`, `source`, `destination`, `passno`, `pass_end`, `voucher`, `season`, `classof`, `duration`, `branch`, `year`, `img_loc`, `verified`, `dateofentry`, `datetodelete`, `Remark` FROM `student` WHERE id=?") OR die('query preparation failed1');
	$sql_query->bind_param('i',$idd);
	$sql_query->execute() OR die('query execution failed');
	
	$sql_query->bind_result($id, $fullname, $gender, $sem, $email, $DOB, $contact, $aadhar, $address, $pincode, $source, $destination, $passno, $pass_end, $voucher, $season, $classof ,$duration, $branch, $year, $img_loc, $verified, $dateofentry, $datetodelete, $Remark );
    $sql_query->fetch();
	$sql_query->free_result();
	
	$sql_query1 = $db->prepare("INSERT INTO oldstudent(oldid,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode, source,destination,passno,pass_end,voucher,season,classof,duration,branch,year,img_loc,verified,dateofentry,datetodelete,Remark) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") OR die('query preparation failed');

	$sql_query1->bind_param("isiissiisisssssisssssssss",$idd, $fullname, $gender, $sem, $email, $DOB, $contact, $aadhar, $address, $pincode, $source, $destination, $passno, $pass_end, $voucher, $season, $classof, $duration, $branch, $year, $img_loc, $verified, $dateofentry, $datetodelete, $Remark);
	$sql_query1->execute() OR die('query execution failed');
	
	echo "OK Moved to oldstudent";
	
	$sql_query3 = $db->prepare("DELETE FROM student WHERE id=? LIMIT 1") OR die('query preparation failed');
	$sql_query3->bind_param("i",$idd);
	$sql_query3->execute() OR die('query execution failed');
	
	if($db->errno)
	{
		die(mysql_error());
	}
	elseif ($_SESSION['dashboard'] == true) {
		header("Location: dashboard.php");
	}
	else {
		header("Location: admin.php");
	}
	
}
else{
	echo "Error";
}
?>