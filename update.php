<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'logs/LOGGER.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	//database connection
	include('database_connection.php');
    
    $var_id = $_POST['id'];
	$status_check = "SELECT verified, fullname, email FROM student WHERE id = '$var_id' LIMIT 1";
	$s_check = $db->query($status_check);
	$s_value = $row = $s_check->fetch_assoc();
	
	//checking which button clicked
    if (isset($_POST['verify_it'])) {
        logger::log("INFO", "VERIFY IT");
        if ($s_value['verified'] == "0") {

            $sql_update_status = "UPDATE student SET verified = 1 WHERE id='$var_id' ";
            logger::log("QUERY", $sql_update_status);
            $db->query($sql_update_status);

            $_SESSION['fullnameemail'] = $s_value['fullname'];
            $_SESSION['emailid'] = $s_value['email'];
            include ('PHPMailer/sendmail.php');

            logger::log("INFO", "Session Logged In [".$_SESSION['loggedin'] . "]|USER=[" .$_SESSION['user'] . "]" );
            if ($_SESSION['dashboard']) {
                logger::log("INFO", "Redirected to dashboard.php");
                header("Location: dashboard.php");
            } else {
                logger::log("INFO", "Redirected to admin.php");
                header("Location: admin.php");
            }
        } else {
            echo "<script>alert('Already Issued')</script>";
            if ($_SESSION['dashboard']) {
                header("Refresh:0.5, url:dashboard.php");
            } else {
                header("Refresh:0.5, url:admin.php");
            }
        }
    }

	elseif(isset($_POST['cancel_verify'])) {
	    logger::log("INFO", "CANCEL VERIFY");
		$s_check = $db->query($status_check);
		$s_value = $row = $s_check->fetch_assoc();

		$_SESSION['fullnameemail'] = $s_value['fullname'];
		$_SESSION['emailid'] = $s_value['email'];
		try {
		    include ('PHPMailer/senderrormail.php');
		}
		catch(Exception $e){
		    logger::log("Exception: During cancel_verify ", $e);
		}
		
		if($s_value['verified'] == "1"){
    		$sql_update_status = "UPDATE student SET verified = 0 WHERE id='$var_id' ";
    		logger::log("QUERY", $sql_update_status);
    		$db->query($sql_update_status);
		}
		//header to redirect previous page
		if($_SESSION['dashboard']){
		  header("Location: dashboard.php");
		}
		else{
    		echo "PRESS BACK BUTTON.";
    		header("Location: admin.php");
		}

	}
}
else{
	header("Location:login.php");
}

?>