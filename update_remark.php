<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['remark'])){
	if( include('database_connection.php') ){
	$remark = $_POST['remark'];	
	$var_id	= $_POST['id'];
		
	$sql_update_status = "UPDATE student SET Remark = '$remark' WHERE id='$var_id' ";
	if( $db->query($sql_update_status) )
	{		
	    if($_SESSION['dashboard']=="true"){header("Refresh:0.5 ,url=dashboard.php");}
		else{header("Refresh:0.5 ,url=admin.php");}
		echo '<script>
		alert("Remark Successful!");
		</script>';
	}
	else{
		if($_SESSION['dashboard']=="true"){header("Refresh:0.5 ,url=dashboard.php");}
		else{header("Refresh:0.5 ,url=admin.php");}
		echo '<script>
		alert("Error in Remark!");
		</script>';
	    }
	}
	else{	echo "Error";   }
	}//connect if
} //POST
else{header("Location: index.html");}
?>