<?php
include('database_connection.php');
mysqli_report(MYSQLI_REPORT_ALL);

if(isset($_POST['edit_fullname'])){
	
	$idd = $_POST['id'];
	$fullname = $_POST['fullname'];
	$q = $db->prepare("UPDATE student SET fullname = ? WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("si",$fullname,$idd);
	if($q->execute()){
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 
}

if(isset($_POST['edit_gender'])){
	
	$idd = $_POST['id'];
	$gender = $_POST['gender'];
	$q = $db->prepare("UPDATE student SET gender = ? WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("ii",$gender,$idd);
	if($q->execute()){
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 
}

if(isset($_POST['edit_DOB'])){
	
	$idd = $_POST['id'];
	$DOB	= $_POST['DOB'];
	$q = $db->prepare("UPDATE student SET DOB = ? WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("si",$DOB,$idd);
	if($q->execute()){
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 
}	

if(isset($_POST['edit_email'])){
	
	$idd = $_POST['id'];
	$email   = trim($_POST['email'], " \t\n\r");
	$q = $db->prepare("UPDATE student SET email = ? WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("si",$email,$idd);
	if($q->execute()){
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 
}	

if(isset($_POST['edit_source'])){
	
	$idd = $_POST['id'];
	$source  = $_POST['source'];
	$q = $db->prepare("UPDATE student SET source = ? WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("si",$source,$idd);
	if($q->execute()){
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 
}

if(isset($_POST['edit_destination'])){
	
	$idd = $_POST['id'];
	$destination = $_POST['destination'];
	$q = $db->prepare("UPDATE student SET destination = ? WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("si",$destination,$idd);
	if($q->execute()){
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 
}

if(isset($_POST['edit_classof'])){
	
	$idd = $_POST['id'];
	$classof = $_POST['classof'];
	$q = $db->prepare("UPDATE student SET classof = ? WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("si",$classof,$idd);
	if($q->execute()){
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 
}

if(isset($_POST['edit_duration'])){
	
	$idd = $_POST['id'];
	$duration = $_POST['duration'];
	$q = $db->prepare("UPDATE student SET duration = ? WHERE id= ?") OR die("Query preparation failed");
	$q->bind_param("si",$duration,$idd);
	if($q->execute()){
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Edited Successfully'); </script>";
	} 
}
?>