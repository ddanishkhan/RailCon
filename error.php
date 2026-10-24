<!DOCTYPE html>
<html lang="en">
<head>
<?php $page_title = 'Railway Concession'; include 'includes/head.php'; ?>
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
<?php include 'includes/scripts.php'; ?>
</body>
</html>