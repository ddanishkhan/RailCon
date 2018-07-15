<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {	//database connection	include('database_connection.php');
    
	//checking which button clicked
    if (isset($_POST['verify_it'])) {
	//$db=mysqli_connect('localhost','id5617200_railcon', 'lightbulb17' ,'id5617200_railcon');
	$var_id = $_POST['id'];
	$status_check = "SELECT verified FROM student WHERE id = '$var_id' LIMIT 1";
	$s_check = $db->query($status_check);
	$s_value = $row = $s_check->fetch_assoc();
	    if($s_value['verified'] == "0")
	    {
	    $sql_update_status = "UPDATE student SET verified = 1 WHERE id='$var_id' ";
	    $db->query($sql_update_status);
	
		if($_SESSION['dashboard']=="true"){header("Location: dashboard.php");}
		else{header("Location: admin.php");}
	    }
	    else{
		echo "<script>alert('Already Issued')</script>";
		}
	if($_SESSION['dashboard']=="true"){header("Location: dashboard.php");}
	else{header("Location: admin.php");}
	}
	
	elseif(isset($_POST['cancel_verify'])) {
		$var_id = $_POST['id'];
		
		$status_check = "SELECT verified FROM student WHERE id = '$var_id' LIMIT 1";
		$s_check = $db->query($status_check);
		$s_value = $row = $s_check->fetch_assoc();
	
		if($s_value['verified'] == "1")
		{
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