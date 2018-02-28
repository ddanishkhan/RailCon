<?php

//database connection
$connect=mysqli_connect('localhost','root', '' ,'railcon');
if(mysqli_connect_errno($connect))
		echo 'Failed to connect';


echo "<h2>Admin Panel</h2>";

$sql_display = "SELECT id, fullname, source, destination, passno, duration, verified, img_loc FROM student";
$result = $connect->query($sql_display);

echo "<a href='export_to_csv.php' > Download as csv </a>";


if ($result->num_rows > 0) {
	
	echo "<table border='1' width='100%'> <tr> <th>ID</th> <th>Name</th> <th>Source</th> <th>Destination</th> 
	<th>Passno</th> <th>Duration</th> <th>Status</th> <th>ID Card</th> <th>Issue</th> </tr>";
	
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
			echo '<form action="update.php" method="POST">
			<input type="hidden" name = "id" value = '.$idd .'>
			<input type = "submit" name= "verify_it" value="Issue"><br/>
			<input type = "submit" name= "cancel_verify" value="Cancel Issue">
			</form>';
		echo "</td></tr></tbody>";
         }
	echo "</table>";
} else {
    echo "<strong> 0 results </strong>";
}
$connect->close();

?>
<!DOCTYPE HTML>
<html>
	<head> 
		<title> Administrator Panel </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="TEIT-17-18 Students">
<style>


/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}



/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
	<head>

	
<//html>
