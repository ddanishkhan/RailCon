<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['endnum']) || isset($_POST['startnum'])) {
	
	if( include('database_connection.php') ){
		
	$startnum = $_POST['startnum'];
	$endnum = $_POST['endnum'];	
		
	if( isset($_POST['endnumbutton']) && $_POST['endnum']!=NULL){
		
	$sql_update_status = "UPDATE `admin_controls` SET `end_entry` = '$endnum' WHERE `id_control` = 115617;" ;
	}
	elseif( isset($_POST['startnumbutton']) && $_POST['startnum']!=NULL){
	$sql_update_status = "UPDATE `admin_controls` SET `start_entry` = '$startnum' WHERE `id_control` = 115617;";
	}
	else{
	echo "Error";
	}
	
	if( $db->query($sql_update_status) ){		
		header("Location: admin_filter.php");	
	}
	else{
		echo $db->error;
	}
	
	}
	else{	echo "Error in database connection";   }

} //POST
else{
	header("Location: login.php");
	}
?>