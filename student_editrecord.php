<?php
if(isset($_POST['student_editrecord'])){
	include('database_connection.php');
	mysqli_report(MYSQLI_REPORT_ALL);
	
	$idd = $_POST['id'];
	$fullname= $_POST['name'];
	$gender = $_POST['gender'];
	$semester    = $_POST['semester'];
	$email   = trim($_POST['email'], " \t\n\r");
	$contact = $_POST['contact']; 
	$address = $_POST['address'];
	$pincode = $_POST['pincode'];
	$source  = $_POST['source'];
	$destination = $_POST['destination'];
	$passno  = $_POST['passno'];
     $pass_end  = $_POST['pass_end'];
     $voucher  = $_POST['voucher'];
     $season  = $_POST['season'];	
	$classof = $_POST['classof'];
	$duration = $_POST['duration'];
	$branch  =  $_POST['branch'];
	$year    = $_POST['year'];
	$DOB	= $_POST['dob'];
	$edit = 0;
	
	//echo $idd,$fullname,$gender,$email,$semester,$address,$contact,$pincode,$source,$destination,$classof,$duration,$branch,$year,$DOB;
	
	$q = $db->prepare("UPDATE student SET fullname=?, gender=?, semester=?, email=?, DOB=?, contact=?, address=?, pincode=?, source=?, destination=?, passno=?, pass_end=?, voucher=?, season=?, classof=?, duration=?, branch=?, year=?, edit=?  WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("sisssisissssssssssii",$fullname,$gender,$semester,$email,$DOB,$contact,$address,$pincode,$source,$destination,$passno,$pass_end,$voucher,$season,$classof,$duration,$branch,$year,$edit,$idd);
	if($q->execute()){
		header("Refresh:1; url=index.html");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 	
}
?>