<?php
if(isset($_POST['edit_form'])){
	include('database_connection.php');
	mysqli_report(MYSQLI_REPORT_ALL);
	$idd = $_POST['id'];
	$bool = 1;
	
	$sql_query = $db->prepare("SELECT verified,edit FROM student WHERE id=?");
	
	$sql_query->bind_param('i',$idd);
	$sql_query->execute();
	
	$sql_query->bind_result($verified,$edit);
	$sql_query->fetch();
	$sql_query->free_result();
	
	if($verified == 0){
		if($edit == 0){
			$q = $db->prepare("UPDATE student SET edit=? WHERE id= ?") OR die("Query preparation failed");
			$q->bind_param("ii",$bool,$idd);
		
			if($q->execute()){
			header("Refresh:1; url=dashboard.php");
			echo "<script> alert('Record Edit Permission Granted Successfully'); </script>";
			}
		}
		else{
			header("Refresh:1; url=dashboard.php");
			echo "<script> alert('Record Edit Permission Granted Already'); </script>";
		}
	}
	else{
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Already Issue, Edit Permission Cannot be granted!'); </script>";
	}
}	
?>