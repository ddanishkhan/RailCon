<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	// database connection
	include ('database_connection.php');
	
	
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='author' content='TEIT-17-18 Students'>
    <title>RailCon Admin Panel</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link rel='stylesheet' type='text/css' href='modal.css'>
	<style>
	
	</style>
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="search.php" name="search_s" method="GET">
              <input type="search" name="query" placeholder="Who are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="#" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>RailCon </span><strong>Dashboard</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>Railway Concession</strong></div></a>
                
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
			  
                <!--Download as Excel File-->
				<li class="nav-link"><a href="export_to_csv.php"><i class="fa fa-file-text"></i><span class="d-none d-sm-inline">Download  
				</span></a></li>
				
				<!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>

                <!-- Logout    -->
                <li class="nav-item"><a href="logout.php" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content align-items-stretch"> 

        <div class="content-inner" style="width:100%">
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin_filter.php">Filter</a></li>
              <li class="breadcrumb-item active">Search</li>
            </ul>
          </div>
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <!--<h3 class="h4">Compact Table</h3>-->
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">   
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Gender</th>
                              <th>Age</th>
							  <th>Source</th>
							  <th>Destination</th>
							  <th>Passno</th>
							  <th>Class</th> 
							  <th>Duration</th> 
							  <th>DateOfEntry</th> 
							  <th>Status</th> 
							  <th>ID Card</th> 
							  <th>Issue</th> 
							  <th>Remarks</th> 
                            </tr>
                          </thead>
						  <tbody>
							
</html>

<?php
	$query = $_GET['query'];

	// gets value sent over search form
	$min_length = 3;

	// you can set minimum length of the query if you want
	if (strlen($query) >= $min_length) { 
	
	// if query length is more or equal minimum length then
		$query = htmlspecialchars($query);

	// changes characters used in html to their equivalents, for example: < to &gt;
		$query = mysqli_real_escape_string($db, $query);

	// makes sure nobody uses SQL injection
		$raw_results = mysqli_query($db, "SELECT id, fullname, gender,DOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,season,classof, duration, verified,img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date, remark FROM student
WHERE (`fullname` LIKE '%" . $query . "%') OR (`email` LIKE '%" . $query . "%') LIMIT 10") or die(mysqli_error());

		if(!mysqli_num_rows($raw_results) > 0){
			echo "No Records Found";
		}
		else {

		while ($row = mysqli_fetch_array($raw_results)) {

				echo "<tr><th scope='row'>". $idd=$row['id'] ;
		echo '</th><td>';
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
				echo "<img id='" . $idd . "' src = 'MyUploadImages/" . $MyPhoto . "'  height='100'/>
<!-- The Modal -->
<!-- Be very careful editing this -->
<div id='myModal" . $idd . "' class='modal'>
<span class='close" . $idd . "' 
style='position: absolute;
top: 15px;
right: 35px;
color: #f1f1f1;
font-size: 40px;
font-weight: bold;
transition: 0.3s;'
>&times;</span>
<img class='modal-content' id='img1" . $idd . "'>
</div>
<script>

// Get the modal
var modal = document.getElementById('myModal" . $idd . "');

// Get the image and insert it inside the modal
var img = document.getElementById('" . $idd . "');
var modalImg = document.getElementById('img1" . $idd . "');
img.onclick = function(){
modal.style.display = 'block';
modalImg.src = this.src;
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName('close" . $idd . "')[0];
// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
modal.style.display = 'none';
}
</script>
";
				echo "</td><td>";
				echo '
<form action="update.php" method="POST">
<input type="hidden" name = "id" value = ' . $idd . '>
<input type = "submit" name= "verify_it" value="Issue"><br/>
<input type = "submit" name= "cancel_verify" value="Not Issue">
</form>';
				echo "</td><td>";
				echo $row['remark'];
				echo "</td></tr>";
			} //end while			
		}
		
?>
						 
<html>						  
                            <tr>
                              <th scope="row">-</th>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
							  <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
							  <td>---</td>
                              <td>---</td>
                              <td>---</td>
							  <td>---</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
               
              </div>
            </div>
          </section>
          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>MHSSCOE &copy; 2018</p>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>

<?php	
	}
	else { // if query length is less than minimum
		echo "<script>alert('Minimum Length is 3')</script>";
	}
} //Authentication
else {
	echo "<script> alert('Log In First'); </script>";
	header("Refresh:1; url=index.php");
}

?>