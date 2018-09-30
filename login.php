<?php

session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE ){
	header("Location: dashboard.php");	
}
elseif(isset($_POST['submit']))
{
	include('database_connection.php');
	$user = $_POST['loginUsername'];
	$pass = md5($_POST['loginPassword']) ;

	$q = $db->prepare("SELECT id, username, password FROM members WHERE username=?") OR die('query preparation failed');
	$q->bind_param('s',$user);
	$q->execute();

	$q->bind_result($id,$dbuser,$dbpass);

	$q->fetch();

	if($dbuser == $user && $dbpass == $pass){
		$_SESSION['user'] = $dbuser;
		$_SESSION['loggedin'] = TRUE;
		header("Location: dashboard.php");
	}

	else{
		echo "<script> alert('Incorrect Login Credentials'); </script>";
		$_SESSION['loggedin'] = False;
		header("Refresh:1; url=login.html");
	}

	$q->free_result();
	$q->close();
	$db->close();
}
else{header('Location: login.html');}

?>