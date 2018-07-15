<?php
 session_start();
 unset($_SESSION['loggedin']);
 unset($_SESSION['user']);
 
 if(session_destroy())
 {
  header("Location: login.html");
 }
?>