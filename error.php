<!DOCTYPE html>
<html lang="en">
<head>
<title>Railway Concession</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>Error Alert!</h2>

		<div class="alert alert-danger alert-dismissible fade show">
			<strong>Error: </strong> 
	<?php
        session_start();
        echo $_SESSION['studenterror'];
        echo "<br> <a href=\"javascript:history.go(-1)\">Go Back</a>";
    ?>	  
  </div>
	</div>
</body>
</html>