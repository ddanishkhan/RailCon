<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	//database connection
	include('database_connection.php');
    
	//checking which button clicked
    if (isset($_POST['verify_it'])) {

	$var_id = $_POST['id'];
	$status_check = "SELECT verified, fullname, email FROM student WHERE id = '$var_id' LIMIT 1";
	$s_check = $db->query($status_check);
	$s_value = $row = $s_check->fetch_assoc();

	if($s_value['verified'] == "0"){
		$sql_update_status = "UPDATE student SET verified = 1 WHERE id='$var_id' ";
	    $db->query($sql_update_status);

		$_SESSION['fullnameemail'] = $s_value['fullname'];
		$_SESSION['emailid'] = $s_value['email'];
		
		include ('PHPMailer/sendmail.php');
		
		if($_SESSION['dashboard']=="true"){header("Location: dashboard.php");}
		else{header("Location: admin.php");}
	}
	else{
		echo "<script>alert('Already Issued')</script>";
		if($_SESSION['dashboard']=="true"){header("Refresh:1, url:dashboard.php");}
		else{header("Refresh:1, url:admin.php");}
		}
	}

	elseif(isset($_POST['cancel_verify'])) {

		include ('PHPMailer/senderrormail.php');
	
		
		$var_id = $_POST['id'];
		$status_check = "SELECT verified FROM student WHERE id = '$var_id' LIMIT 1";
		$s_check = $db->query($status_check);
		$s_value = $row = $s_check->fetch_assoc();
	
		if($s_value['verified'] == "1"){
		$sql_update_status = "UPDATE student SET verified = 0 WHERE id='$var_id' ";
		$db->query($sql_update_status);
		}

		//header to redirect previous page

		if($_SESSION['dashboard']=="true"){header("Location: dashboard.php");}
		else{header("Location: admin.php");}

	}
}// requested Method call

else{
	header("Location:login.html");
}

?>