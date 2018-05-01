<?php
session_start();
if(isset($_POST['submit']))
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	
	$db = new mysqli("localhost","root","","railcon");
	if($db->connect_errno)
	{
		die('Database connection failed.');
	}
	$q = $db->prepare("SELECT id, username, password FROM members WHERE username=?") OR die('query preparation failed');
	$q->bind_param('s',$user);
	$q->execute();
	$q->bind_result($id,$dbuser,$dbpass);
	$q->fetch();
	
	if($dbuser == $user && $dbpass == $pass)
	{
		$_SESSION['user'] = $dbuser;
		$_SESSION['loggedin'] = TRUE;
		 echo "<h2>Loading, Please Wait</h2>";
		header("Refresh:2; url=dashboard.php");
	   
	}
	else
	{
	echo "<script> alert('Incorrect Login Credentials'); </script> </h2>";
	$_SESSION['loggedin'] = False;
	header("Refresh:1; url=index.html");
	}
$q->free_result();
$q->close();
$db->close();

}
?>
