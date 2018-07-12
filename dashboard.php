<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	
echo "
<!DOCTYPE HTML>
<html>
	<head> 
		<title> Administrator Panel </title>
		<meta name='viewport' content='width=device-width, initial-scale=1'/>
		<meta name='author' content='TEIT-17-18 Students'/>
	<link rel='stylesheet' type='text/css' href='styletable.css'>
	</head>
	
	<body style='width:100%;'>
	<h1 style='width:100%; text-align:center; font-variant:small-caps;'>Admin Panel</h1>
	<ul>
	<li><a href='export_to_csv.php'  > Download as Excel File</a></li>
	<li><a href='admin_filter.php'>Filter Records</a></li>
	<form action='search.php' name='search_s' method='GET'>
		<li style='float:right; padding: 14px 16px;'>
		<input type='text' name='query' /> </li>
		<li style='float:right;'> <input id='nav_search' type='submit' value='Search'> </li>
	</form>
	</ul>
	</body>
</html>";
	
	//echo $_SESSION['loggedin'];
$_SESSION['dashboard'] = true;

/*//$ipaddress = $_SERVER['REMOTE_ADDR']; //ip address*/

$size = 10;

if(isset($_GET['page'])){
	$start = $_GET['page']*$size;
	}
else{
	$start=0;
	//$_SESSION['page']=1;
	}

//database connection
$connect=mysqli_connect("localhost","id5617200_railcon","lightbulb17","id5617200_railcon");
if(mysqli_connect_errno($connect))
		echo 'Failed to connect';

$sql_display = "SELECT id, fullname, gender,DOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,season,classof, duration, verified,img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
FROM student LIMIT $start, $size";
$result = $connect->query($sql_display);

if ($result->num_rows > 0) {
	
	echo "<table class='table-top' border='1' width='100%' > <tr> <th>ID</th> <th>Name</th> <th>Gender</th> <th>Age</th> <th>Source</th> <th>Destination</th> 
	<th>Passno</th> <th>Class</th> <th>Duration</th> <th>DateOfEntry</th> <th>Status</th> <th>ID Card</th> <th>Issue</th> <th>Remarks</th>  
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
				$diff = date_diff(date_create(), date_create($row['DOB']) );
				echo $diff->format("%Y Yrs <br/> %M Mnth");
			
		echo "</td><td>";
			echo $row['source'];
		echo "</td><td>";
			echo $row['destination'];
		echo "</td><td>";
			echo $row['passno']."<br/>";
			echo $row['pass_end']."<br/>";
			echo $row['voucher']."<br/>";
			echo $row['season']."<br/>";
			
		echo "</td><td>";
			echo $row['classof'];
		echo "</td><td>";
			echo $row['duration'];
		echo "</td><td>";
		    echo $row['date'];
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
		<input type='submit' name='update_remark' value='Remark' style='width:80%;'/>
		</form>";
		echo "</td></tr></tbody>";
         }
	echo "</table>";
	
	}else {
    echo "<strong> 0 results </strong>";
	}

	$sql_query = "SELECT id FROM student";
	$result = $connect->query($sql_query);
	
	$total_records = $result->num_rows;
	
	$pages = intval($total_records / $size);

	echo "<br/><ul style='background-color:powderblue; border-radius:8px;'>";
	for ($i=0; $i <= $pages; $i++){
	echo "<li> <a href='dashboard.php?page=".$i."'> $i </a>";
	}
	$connect->close();
}//authentication
else{
    header("Refresh:1; url=login.html");
	echo "<script> alert('Log In First'); </script>";
}
?>