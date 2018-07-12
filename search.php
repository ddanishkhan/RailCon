<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	
echo '<!DOCTYPE HTML>
<html>
<head><title>Searching the database</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="TEIT-17-18 Students">
		
	<link rel="stylesheet" type="text/css" href="styletable.css">
</head>

<body>
<h1 style="width:100%; text-align:center; font-variant:small-caps;">Search Results</h1>
<ul>
<li><a href="admin_filter.php" > Search Another</a></li>
<li><a href="admin.html">
Filter Records</a></li>
</ul>
</body>
</html>';
	
	$db = mysqli_connect("localhost", "id5617200_railcon", "lightbulb17", "id5617200_railcon") or die(mysqli_error());
//	mysqli_select_db("id5617200_railcon") or die(mysqli_error() ) ;

	$query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($db, $query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($db, "SELECT id, fullname, source, destination, passno, duration, verified, img_loc, remark FROM student
            WHERE (`fullname` LIKE '%".$query."%') OR (`email` LIKE '%".$query."%')") or die(mysqli_error());
             
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
	
	echo "<table border='1' width='100%'> <tr> <th>ID</th> <th>Name</th> <th>Source</th> <th>Destination</th> 
	<th>Passno</th> <th>Duration</th> <th>Status</th> <th>ID Card</th> <th>Issue</th> <th>Remarks</th> </tr>";
			
		while($row = mysqli_fetch_array($raw_results)){
            // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
            
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
			<input type = "submit" name= "cancel_verify" value="Not Issue">
			</form>';
		echo "</td><td>";
		echo $row['remark'];
		echo "</td></tr></tbody>";
    }//end while
	echo "</table>";
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
    }
    else{ // if query length is less than minimum
        echo "<script>alert('Minimum Length is 3')</script>";
		header("Refresh:0 ; url=admin.php");
    }
}//Authentication
else{
	echo "<script> alert('Log In First'); </script>";
	header("Refresh:1; url=index.html");
}
?>