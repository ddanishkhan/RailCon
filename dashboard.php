<?php

/*SQL Query
CREATE TABLE `student` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `fullname` varchar(30) NOT NULL,
 `gender` tinyint(1) NOT NULL,
 `semester` tinyint(2) unsigned NOT NULL,
 `email` varchar(30) NOT NULL,
 `DOB` date NOT NULL,
 `contact` bigint(15) unsigned NOT NULL,
 `aadhar` bigint(15) unsigned NOT NULL,
 `address` varchar(50) NOT NULL,
 `pincode` mediumint(6) unsigned NOT NULL,
 `source` varchar(20) NOT NULL,
 `destination` varchar(20) NOT NULL,
 `passno` varchar(20) NOT NULL,
 `classof` varchar(20) NOT NULL,
 `duration` varchar(20) NOT NULL,
 `branch` varchar(20) NOT NULL,
 `year` varchar(20) NOT NULL,
 `img_loc` varchar(50) NOT NULL,
 `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `dateofentry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `Remark` varchar(50) NOT NULL DEFAULT 'No Remarks',
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
*/

session_start();
$_SESSION['dashboard']="true";

//database connection
$connect=mysqli_connect('localhost','root', '' ,'railcon');
if(mysqli_connect_errno($connect))
		echo 'Failed to connect';

echo "<h2 style='width:100%; text-align:center; font-variant:small-caps;'>Admin Panel</h2>";

$sql_display = "SELECT id, fullname, gender, source, destination, passno, duration, verified,img_loc FROM student";
$result = $connect->query($sql_display);

echo "
	<ul>
	<li><a href='export_to_csv.php' > Download as Excel File</a></li>
	<li><a href='http://localhost/Railcon/admin.html' onclick ='dash_change();'>
Filter Records</a></li>
	</ul>
";

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

<!DOCTYPE HTML>
<html>
	<head> 
		<title> Administrator Panel </title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="author" content="TEIT-17-18 Students"/>
	
	<link rel="stylesheet" type="text/css" href="styletable.css">

	</head>
</html>
