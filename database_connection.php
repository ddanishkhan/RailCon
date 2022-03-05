<?php
    $db = new mysqli("localhost","root","","railcon");
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    
    function OpenDatabaseConnection()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "railcon";
        
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        
        return $conn;
    }
    
    function CloseDatabaseCon($conn)
    {
        $conn -> close();
    }
    
?>