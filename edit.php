<?php

include('database_connection.php');
if(isset($_POST['edit'])){
	$idd = $_POST['id'];
	
	$sql_query = $db->prepare( "SELECT fullname, gender, email, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,season,classof, duration, verified, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
	FROM student WHERE id=?") OR die('query preparation failed');
	
	$sql_query->bind_param('i',$idd);
	$sql_query->execute();
	
	$sql_query->bind_result($fullname, $gender, $email, $dob, $dateOB, $source, $destination, $passno, $pass_end, $voucher, $season, $classof ,$duration, $verified, $date_entry );
	$sql_query->fetch();
	
	if($verified == 0)
	{?>
<!DOCTYPE HTML>
<html>
    <head>
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
    <title>Railcon Dashboard</title>
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
              <li class="breadcrumb-item active">Dashboard - All Entries  </li>
            </ul>
          </div>
   
        <div class="card-body" style="background:white;">
            <div class="table-responsive">   
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>DOB</th>
							<th>Email</th>
							<th>Source</th>
							<th>Destination</th>
							<th>Class</th> 
							<th>Duration</th> 
                            </tr>
                    </thead>
						  <tbody>
</html>
<?php
	  echo "<tr><th scope='row'>". $idd ;
		echo '</th><td>';
			echo $fullname;
			echo "</br>";
			echo "</br>";
			echo "<form action='edit_record.php' method='POST'>
			        <input type='hidden' name='id' value=".$idd.">
			        <input type='text' name='fullname' placeholder='Enter name'></br>
					</br>
					<input type='submit'  class='bg-blue' name='edit_fullname' value='Edit' style='margin-top:6.5%;'>
				  </form>";
		echo "</td><td>";
			if( $gender =='1' )
				echo "Female";
			else
				echo "Male";
            echo "</br>";
			echo "</br>";
			echo "<form action='edit_record.php' method='POST'>
			        <input type='hidden' name='id' value=".$idd.">
			            <select name='gender' style='height:2em;'>
			                <option value=0>Male</option>
				            <option value=1>Female</option>
			            </select>
					</br>
					<input type='submit'  class='bg-blue' name='edit_gender' value='Edit' style='margin-top:27%;'>
				  </form>";			
		echo "</td><td>";
		    echo $dateOB;
			 echo "</br>";
			 echo "</br>";
			 echo "<form action='edit_record.php' method='POST'>
			        <input type='hidden' name='id' value=".$idd.">
			        <input type='date' name='DOB'></br>
					</br>
					<input type='submit'  class='bg-blue' name='edit_DOB' value='Edit' style='margin-top:7.5%;'>
				  </form>";
		echo "</td><td>";
			echo $email;
			echo "</br>";
			echo "</br>";
			echo "<form action='edit_record.php' method='POST'>
			        <input type='hidden' name='id' value=".$idd.">
			        <input type='email' name='email' style='width:12em;'></br>
					</br>
					<input type='submit'  class='bg-blue' name='edit_email' value='Edit' style='margin-top:6.3%;'>
				  </form>";
		echo "</td><td>";
			echo $source;
			echo "</br>";
			echo "</br>";
			echo "<form action='edit_record.php' method='POST'>
			        <input type='hidden' name='id' value=".$idd.">
			        <input type='text' name='source'></br>
					</br>
					<input type='submit'  class='bg-blue' name='edit_source' value='Edit' style='margin-top:6.5%;'>
				  </form>";
		echo "</td><td>";
			echo $destination;
			echo "</br>";
			echo "</br>";
			echo "<form action='edit_record.php' method='POST'>
			        <input type='hidden' name='id' value=".$idd.">
			            <select name='destination' style='height:2em;'>
			                <option>Byculla Station</option>
				            <option>Dockyard Road</option>
				            <option>Sandhurst Road</option>
				            <option>Mumbai Central</option>
			            </select></br>
					</br>
					<input type='submit'  class='bg-blue' name='edit_destination' value='Edit'>
				  </form>";
		echo "</td><td>";
			echo $classof;
			echo "</br>";
			echo "</br>";
			echo "<form action='edit_record.php' method='POST'>
			        <input type='hidden' name='id' value=".$idd.">
			            <select name='classof' style='height:2em;'>
			                <option>First Class</option>
				            <option>Second Class</option>
			            </select></br>
					</br>
					<input type='submit'  class='bg-blue' name='edit_classof' value='Edit'>
				  </form>";
		echo "</td><td>";
			echo $duration;
			echo "</br>";
			echo "</br>";
			echo "<form action='edit_record.php' method='POST'>
			        <input type='hidden' name='id' value=".$idd.">
			            <select name='duration' style='height:2em;'>
			                <option>Monthly</option>
				            <option>Quaterly</option>
			            </select></br>
					</br>
					<input type='submit'  class='bg-blue' name='edit_duration' value='Edit'>
				  </form>";
		echo "</td></tr>;
			  </tbody>
			  </table>";	
	}
	else{
		header("Refresh:1; url=dashboard.php");
	    echo "<script> alert('Record Already Issued, cannot be edited'); </script>";
	}
}
?>
<html>
    </div>
	    </div>
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