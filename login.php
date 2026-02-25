<?php

session_start(); 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE ){
	header("Location: admin.php");
}
if(isset($_POST['submit']))
{
	require_once __DIR__ . '/database_connection.php';
	$user = $_POST['loginUsername'];
	$plainPassword = $_POST['loginPassword'];

	$q = $db->prepare("SELECT id, username, password FROM members WHERE username=?") OR die('query preparation failed');
	$q->bind_param('s', $user);
	$q->execute();
	$q->bind_result($id, $dbuser, $dbpass);
	$q->fetch();
	$q->free_result();
	$q->close();

	// password_verify() requires bcrypt hash in DB.
	// Run tools/generate_hash.php once to get your hash, then:
	// UPDATE members SET password = '<hash>' WHERE username = '<user>';
	if ($dbuser == $user && password_verify($plainPassword, $dbpass)) {
		$_SESSION['user'] = $dbuser;
		$_SESSION['loggedin'] = TRUE;
		
		/*Checking if form is closed for student*/
		$q2 = $db->prepare("SELECT MAX(id) FROM student") OR die($db->error);
		$q2->execute();
		$q2->bind_result($student_id);
		$q2->fetch();

		$q2->free_result();
		
		$q3 = $db->prepare("SELECT end_entry FROM admin_controls WHERE id_control = '115617' LIMIT 1") OR die($db->error);
		$q3->execute();
		$q3->bind_result($admin_end_id);
		$q3->fetch();
		
		if($student_id >= $admin_end_id){
			$_SESSION['endnumber'] = $student_id;
			include 'notificationFormClosed.php' ;
		}		
		/*Checking if form is closed for student*/
		else{	
			header("Location:admin.php");
			}
	$q2->close();
	$q3->close();
	}
	else{
		echo "<script> alert('Incorrect Login Credentials'); </script>";
		$_SESSION['loggedin'] = False;
		header("Refresh:1; url=login.html");
	}
	$db->close();
}
else{
	header('Location: login.html');
	}

?>