<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['remark'])){
	if( $connect=mysqli_connect('localhost','id5617200_railcon', 'lightbulb17' ,'id5617200_railcon') ){

	$remark = $_POST['remark'];	
	$var_id	= $_POST['id'];
		
	$sql_update_status = "UPDATE student SET Remark = '$remark' WHERE id='$var_id' ";
	if( $connect->query($sql_update_status) )
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