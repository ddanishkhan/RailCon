<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	if (isset($_POST['remark'])){
	
	if( $connect=mysqli_connect('localhost','root', '' ,'railcon') ){
		
	$remark = $_POST['remark'];	
	$var_id	= $_POST['id'];
		
	$sql_update_status = "UPDATE student 
	SET Remark = '$remark' 
	WHERE id='$var_id' ";
	if( $connect->query($sql_update_status) )
	{
		echo '<script>
		alert("Remark Successful!");
		</script>';
		header("Refresh:1; url=dashboard.php");
	
	}
	else{
		echo '<script>
		alert("Error in Remark!");
		</script>';
		header("Refresh:1 ; url=dashboard.php");
	}
	}
	else{
		echo "Error";
		}
	
	}//connect if
	
	
} //POST

?>