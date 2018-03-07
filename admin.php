<?php
session_start();

	
    $db = new mysqli("localhost","root","","railcon");

	if($db->connect_errno){
		die('Database connection failed.');
	}
	
	$filter = "Not_Issued";
	
	if( isset($_POST['filter_submit']) ){
		$filter = $_POST['filter'];
	}	
	elseif(isset($_SESSION['record_filter']))
	{
		$filter = $_SESSION['record_filter'];
	}
	else{
		$_SESSION['filter'] = "Not_Issued";
	}
	
	echo "	<ul> <li><a href='http://localhost/Railcon/dashboard.php'>All Records</a></li>";
	echo "<li> <a href='http://localhost/Railcon/admin.html'>Filter Out Records</a></li>";
	echo " <li> <br/><a>Now Displaying: ".$filter. "</a></li></ul>";
	
	
	//echo $filter;
	if($filter == "Issued")
	{
		$_SESSION['record_filter'] = 'Issued';
		//echo $_SESSION['record_filter'] ;
		
		$sql_display = "SELECT id, fullname, source, destination, passno, classof, duration, img_loc FROM student WHERE verified=1";
        $result = $db->query($sql_display);
		if ($result->num_rows > 0) {
	
	echo "<table border='1' width='100%'> <tr> <th>ID</th> <th>Name</th> <th>Source</th> <th>Destination</th> 
	<th>Passno</th> <th>Classof</th> <th>Duration</th> <th>ID Card</th> </tr>";
	
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
			echo $row['classof'];
		echo "</td><td>";
			echo $row['duration'];
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
						
		echo "</td>";
		echo "</tr></tbody>";
         }
	echo "</table>";
	}
  }
  
  if($filter == "Not_Issued")
	{
		$_SESSION['record_filter'] = 'Not_Issued';
		$sql_display = "SELECT id, fullname, source, destination, passno, classof, duration, img_loc FROM student WHERE verified=0";
        $result = $db->query($sql_display);
		if ($result->num_rows > 0) {
	
	echo "<table border='1' width='100%'> <tr> <th>ID</th> <th>Name</th> <th>Source</th> <th>Destination</th> 
	<th>Passno</th> <th>classof</th> <th>Duration</th> <th>ID Card</th> <th>Issue</th> </tr>";
	
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
			echo $row['classof'];
		echo "</td><td>";
			echo $row['duration'];
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
	}
  }
?>

<!DOCTYPE HTML>
<html>
	<head> 
		<title> Administrator Panel </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="TEIT-17-18 Students">

		<link rel="stylesheet" type="text/css" href="styletable.css">
		
	<head>
<//html>
