<!DOCTYPE HTML>
<html>
	<head> 
		<title> Administrator Panel </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="TEIT-17-18 Students">
		<link rel="stylesheet" type="text/css" href="styletable.css">
	</head>
	<body>
	
	<h2 style='width:100%; text-align:center; font-variant:small-caps;'>Admin Panel</h2>
	
	</body>
</html>
<?php
session_start();

	
    $db = new mysqli("localhost","root","","railcon");

	if($db->connect_errno){die('Database connection failed.');}
	
	$filter = "Not_Issued";
	
		//changes made for date
	if( isset($_POST['date_submit']) )
	{
	    $dateofentry = $_POST['date_filter'];
		$filter = "Dates";
		//echo $dateofentry;

        $_SESSION['actual_date'] = $dateofentry;		
	}
	elseif( isset($_POST['filter_submit']) ){
		$filter = $_POST['filter'];
	}	
	elseif( isset($_SESSION['record_filter']) )
	{
		$filter = $_SESSION['record_filter'];
	}
	else{
		$_SESSION['filter'] = "Not_Issued";
	}
	//changes made for date
	
	echo "<ul> <li><a href='http://localhost/Railcon/dashboard.php'>All Records</a></li>";
	echo "<li> <a href='http://localhost/Railcon/admin_filter.php'>Filter Records</a></li>";
	echo "<li> <a style='background-color:#8B0000;'>Displaying: ".$filter. " Forms </a></li>
	<form action='search.php' name='search_s' method='GET'>
		<li style='float:right; padding: 14px 16px;'>
		<input type='text' name='query'/></li>
		<li style='float:right'><input id='nav_search' type='submit' value='Search'></li>
	</form>
	</ul>";
	
	//echo $filter;
	if($filter == "Issued")
	{
		$_SESSION['record_filter'] = 'Issued';
		//Set Query for Issued
		$sql_display = "SELECT id, fullname, source, destination, passno,pass_end,voucher,verified,season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE verified=1";
	}
	elseif($filter == "Not_Issued")
	{
		$_SESSION['record_filter'] = 'Not_Issued';
		
		// set Query for Not_Issued
		$sql_display = "SELECT id, fullname,gender, source, destination, passno,pass_end,verified,voucher,season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE verified=0";
	}
	elseif($filter == "Males")
	{
		$_SESSION['record_filter'] = 'Males';
		
		//set Query for Males non-issued
		$sql_display = "SELECT id, fullname, source, destination, passno,pass_end,verified, voucher,season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE gender=0 AND verified=0";
	}
	elseif($filter == "Females")
	{
		$_SESSION['record_filter'] = 'Females';
		
		//Set Query for Females Not-Issued
		$sql_display = "SELECT id, fullname, source, destination, passno,verified, pass_end,voucher,season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE gender=1 AND verified=0";
	}
	//raw text filter for dates
	elseif($filter == "Dates")
	{
        $_SESSION['record_filter'] = "Dates";	    
		$dateofentry = $_SESSION['actual_date'];
		//Set Query for Dates
		$sql_display = "SELECT id, fullname, source, destination, passno,verified, pass_end,voucher,season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE DATE_FORMAT(dateofentry, '%d/%m/%Y') = '$dateofentry' AND verified=0";
	}
	
	
    $result = $db->query($sql_display);
	if ($result->num_rows > 0) {
		echo "<table border='1' width='100%'> <tr> <th>ID</th> <th>Name</th> <th>Source</th> <th>Destination</th> 
	 <th>Passno</th> <th>Classof</th> <th>Duration</th> <th>Date Of Entry</th> <th>ID Card</th> <th>Status</th> <th>Issue</th><th>Remark</th></tr>";
	
     while($row = $result->fetch_assoc()) {
        echo "<tbody><tr><td>". $idd=$row['id'] ;
		echo '</td><td>';
			echo $row['fullname'];
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
			$MyPhoto = $row['img_loc'];
			echo "<img id='".$idd."' src = 'MyUploadImages/".$MyPhoto."'  height='100px' width='130px'/>
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
			if($row['verified']=="1" )
				echo "Issued";
			else
				echo "Not Issued";
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
		}//end of fetching the rows
	echo "</table>";
	}
	else{
		echo "<strong style='font-size:2em'>No Records</strong>";
	}
	
?>