<?php
    $db = new mysqli("localhost","root","","railcon");
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
?>