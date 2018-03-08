<!DOCTYPE HTML>
<html>
	<head> 
		<title> Administrator Panel </title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="author" content="TEIT-17-18 Students"/>
	<link rel="stylesheet" type="text/css" href="styletable.css">
	</head>
	
	<body>
	<h1 style='width:100%; text-align:center; font-variant:small-caps;'>Admin Panel</h1>
	<ul>
	<li><a href='export_to_csv.php' > Download as Excel File</a></li>
	<li><a href='http://localhost/Railcon/admin.html'>Filter Records</a></li>
	<form action="search.php" name="search_s" method="GET">
		<li style='float:right; padding: 14px 16px;'>
		<input type="text" name="query" /> </li>
		<li style='float:right;'> <input id="nav_search" type="submit" value="Search"> </li>
	</form>
	</ul>
	</body>
</html>

<?php
session_start();
$_SESSION['dashboard']="true";

//database connection
$connect=mysqli_connect('localhost','root', '' ,'railcon');
if(mysqli_connect_errno($connect))
		echo 'Failed to connect';

$sql_display = "SELECT id, fullname, gender, source, destination, passno, duration, verified,img_loc FROM student";
$result = $connect->query($sql_display);

if ($result->num_rows > 0) {
	
	echo "<table id='table-top' border='1' width='100%' > <tr> <th>ID</th> <th>Name</th> <th>Gender</th> <th>Source</th> <th>Destination</th> 
	<th>Passno</th> <th>Duration</th> <th>Status</th> <th>ID Card</th> <th>Issue</th> <th>Remarks</th> 
	</tr>";
	
     while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $idd=$row['id'] ;
		echo '</td><td>';
			echo $row['fullname'];
		echo "</td><td>";
			if( $row['gender']=='1' )
				echo "Female";
			else
				echo "Male";		
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
			<input type = "submit" name= "cancel_verify" value="Not Issue">
			</form>';
		echo "</td><td>";
		echo "
		<form id='Remarks' method='POST' action='update_remark.php'>
		<input type='text' name='remark' placeholder='Enter Remarks' style='width:90%'/>
		<input type='hidden' name = 'id' value = ".$idd."></input>
		<input type='submit' name='update_remark' value='Remark'/>
		</form>";
		echo "</td></tr></tbody>";
         }
	echo "</table>";
	}else {
    echo "<strong> 0 results </strong>";
	}
	$connect->close();
?>
