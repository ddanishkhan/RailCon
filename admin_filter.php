<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';
unset($_SESSION['adminpage']);
?>
<!DOCTYPE HTML>
<html>
        <head>
	        <title>Admin Panel</title>
	    </head>
		<link rel='stylesheet' type='text/css' href='indadmstu.css' />
		<style>
		li.a_align, a.button{
		list-style-type: none;
		text-decoration: none;
		}
		</style>
	<body>
	<ul class='form-style-1'>	
	<h1>Admin Panel</h1>
	<fieldset>

	<form action='search.php' name='search_s' method='GET'>
		<li>
		<label>Search the Records</label>
		<input type='text' name='query' /><br/>
		<input type='submit' value='Search' />
		</li>
	</form>

	<form action='change_number.php' name='changenum' method='POST'>
	<!--
	<li>
		<label>Change Start Number</label>
		<input type='number' name='startnum' /><br/>
		<input type='submit' name='startnumbutton' value='Change Start' />
	</li>
	-->
	<li>
		<label>Change End Number</label>
		<input type='number' name='endnum' /><br/>
		<input type='submit' name='endnumbutton' value='Change End' />
	</li>
	
	<li class='a_align'><a href='dashboard.php' class='button' > View All Records</a></li>			
	
	</form>
	
	</ul>			
	</fieldset>
	
	</body>
</html>
