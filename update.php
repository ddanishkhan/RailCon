<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //something posted
    
	//checking which button clicked
    if (isset($_POST['verify_it'])) {
	$connect=mysqli_connect('localhost','root', '' ,'railcon');

	$var_id = $_POST['id'];
	
	$status_check = "SELECT verified FROM student WHERE id = '$var_id' LIMIT 1";
	$s_check = $connect->query($status_check);
	$s_value = $row = $s_check->fetch_assoc();
	
	if($s_value['verified'] == "0")
	{
	$sql_update_status = "UPDATE student SET verified = 1 WHERE id='$var_id' ";
	$connect->query($sql_update_status);
	
	$sql_display = "SELECT id, fullname, email, verified FROM student WHERE id='$var_id' " ;
	$result = $connect->query($sql_display);

	$row = $result->fetch_assoc();
	
	echo "<table border='1' width='100%'> <tr> <th>ID</th> <th>Name</th> <th>Email</th> <th>Status</th>
	</tr>";
	echo "<tbody><tr><td>". $var_id ;
		echo "</td><td>";
			echo $row['fullname'];
		echo "</td><td>";
			echo $row['email'];
		echo "</td><td>";
			if($row['verified']=="1" )
				echo "Issued";
			else
				echo "Not Issued";
		echo "</td></tr></tbody></table>";
	
	echo "<h2 align='center'><a href = 'http://localhost/Railcon/admin.php'> Go Back </a></h2>";
	
	}
	else{
		echo "Already Issued";
		}
	}
	
	elseif(isset($_POST['cancel_verify'])) {
		$connect=mysqli_connect('localhost','root', '' ,'railcon');
		$var_id = $_POST['id'];
		
		$status_check = "SELECT verified FROM student WHERE id = '$var_id' LIMIT 1";
		$s_check = $connect->query($status_check);
		$s_value = $row = $s_check->fetch_assoc();
	
		if($s_value['verified'] == "1")
		{
		$sql_update_status = "UPDATE student SET verified = 0 WHERE id='$var_id' ";
		$connect->query($sql_update_status);
		}
		
		//header to redirect previous page
		header("Location: http://localhost/railcon/admin.php");
	}
	
}// requested Method call
?>