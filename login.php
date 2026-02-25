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

	// Verify password — supports both bcrypt (new) and MD5 (legacy).
	// On first login with an MD5 hash, it auto-upgrades to bcrypt in the DB.
	$passwordValid = false;
	if (password_verify($plainPassword, $dbpass)) {
		$passwordValid = true;
	} elseif ($dbpass === md5($plainPassword)) {
		// MD5 hash found — upgrade to bcrypt transparently
		$newHash = password_hash($plainPassword, PASSWORD_DEFAULT);
		$upg = $db->prepare("UPDATE members SET password = ? WHERE username = ?");
		$upg->bind_param("ss", $newHash, $user);
		$upg->execute();
		$upg->close();
		$passwordValid = true;
	}

	if ($dbuser == $user && $passwordValid) {
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