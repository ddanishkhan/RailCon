<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //something posted

	//checking which button clicked
    if (isset($_POST['email_id'])) {
	$connect=mysqli_connect('localhost','root', '' ,'railcon');
	
	$email_search = $_POST['email_id'];
	
	$sql_display = "SELECT id, fullname, source, destination, passno, duration, verified, img_loc, remark FROM student WHERE email='$email_search' LIMIT 1 ";
	//$status_check = "SELECT * FROM student WHERE email = '$email_id' LIMIT 1";
	$result = $connect->query($sql_display);
	
	if ($result->num_rows > 0) {
	
	echo "<table border='1' width='100%'> <tr> <th>ID</th> <th>Name</th> <th>Source</th> <th>Destination</th> 
	<th>Passno</th> <th>Duration</th> <th>Status</th> <th>ID Card</th> <th>Remarks</th> </tr>";
	
     while($row = $result->fetch_assoc()) {
        echo "<tbody><tr><td>". $idd=$row['id'] ;
		echo '</td><td>';
			echo $row['fullname'];
		echo "</td><td>";
			echo $row['source'];
		echo "</td><td>";
			echo $row['destination'];
		echo "</td><td>";
			echo $row['passno'];
		echo "</td><td>";
			echo $row['duration'];
		echo "</td><td>";
			if($row['verified']=="1" )
				echo "Issued";
			else
				echo "Not Issued";
		echo "</td><td>";
			$MyPhoto = $row['img_loc'];
			echo "<img id='".$idd."' src = 'MyUploadImages/".$MyPhoto."'  height='100'/>
	<!-- The Modal -->
	<!-- Be very careful editing this -->
	<div id='myModal".$idd."' class='modal'>
	<span class='close".$idd."' 
	style='position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;'
	>&times;</span>
	<img class='modal-content' id='img1".$idd."'>
	</div>

	<script>
	// Get the modal
	var modal = document.getElementById('myModal".$idd."');
	
	// Get the image and insert it inside the modal
	var img = document.getElementById('".$idd."');
	var modalImg = document.getElementById('img1".$idd."');
	img.onclick = function(){
		modal.style.display = 'block';
		modalImg.src = this.src;
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName('close".$idd."')[0];
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() { 
		modal.style.display = 'none';
	}
	</script>
			";
						
		echo "</td><td>";
		echo $row['remark'];
		echo "</td></tr></tbody>";
         }
	echo "</table>";

		}
	}
	else{
		echo "No Record Exists";
	}
	
} //end of if POST

?>
<!DOCTYPE HTML>
<html>
	<head> 
		<title> Administrator Panel </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="TEIT-17-18 Students">
		
	<link rel="stylesheet" type="text/css" href="styletable.css">
	
	</head>
</html>