<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();

if (!isset($_GET['student'])) {
    echo "No Student Selected";
    exit;
}

require_once __DIR__ . '/database_connection.php';
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='author' content='Danish Ayub Khan'>
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
<?php
	$sql_display = "SELECT id, fullname, gender,semester,email,contact,address,pincode,year,branch, Remark, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination,classof, duration, verified,img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
	FROM student WHERE id='$_GET[student]' LIMIT 1";
	$result = $db->query($sql_display);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
	
?>
	<div class="page-content align-items-stretch"> 
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin_filter.php">Filter</a></li>
              <li class="breadcrumb-item active"> Complete Details </li>
            </ul>
          </div>
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
				  <div class="card-body">
                      <div class="table-responsive">   
                        <table class="table table-striped table-sm">
                          <tbody>
                            <tr>
                              <th>#</th>
							  <td><?php echo $row['id'] ?></td>
							</tr>
							<tr>
                              <th>Name</th>
							  <td><?php echo $row['fullname'] ?></td>
							</tr>
							<tr>
                              <th>Gender</th>
							  <td><?php if( $row['gender']=='1' )
							  {echo "Female";}else {echo "Male";} ?></td>
							</tr>
							<tr>
							  <th>Sem</th>
							  <td><?php echo $row['semester'] ?></td>
							</tr>
							<tr> 
							  <th>Branch</th>
							  <td><?php echo $row['branch'] ?></td>
							</tr>
							 <tr>
							  <th>Email</th>
							  <td><?php echo $row['email'] ?></td>
							 </tr>
							 <tr>
							  <th>Contact</th>
							  <td><?php echo $row['contact'] ?></td>
							 </tr>
							 <tr>
                              <th>DOB/Age</th>
							  <td><?php echo $row['dateOB'] ?></td>
							 </tr>
							 <tr>
							  <th>Source</th>
							  <td><?php echo $row['source'] ?></td>
							 </tr>
							 <tr>
							  <th>Destination</th>
							  <td><?php echo $row['destination'] ?></td>
							 </tr>
							 <tr>
							  <th>Address</th>
							  <td><?php echo $row['address'] ?></td>
							 </tr>
							 <tr>
							  <th>Pincode</th>
							  <td><?php echo $row['pincode'] ?></td>
							 </tr>
							 <tr>
							  <th>Class</th>
							  <td><?php echo $row['classof'] ?></td>
							 </tr>
							 <tr> 
							  <th>Duration</th>
							  <td><?php echo $row['duration'] ?></td>
							 </tr>
							 <tr> 
							  <th>DateOfEntry</th>
							  <td><?php echo $row['date'] ?></td>
							 </tr>
							 <tr> 
							  <th>Status</th>
							  <td><?php if($row['verified']=="1" )
							  {echo "Issued";}else{echo "Not Issued";} ?></td>
						    </tr>
							<tr> 
							  <th>Remarks</th>
							  <td><?php echo $row['Remark'] ?></td>
							</tr>
							</tbody>
							</table>
						</div>
                    </div>
                  </div>
              </div>
            </div>
		</div>
        </section>
	</div>
	</div>
	<footer class="main-footer" style='position:relative'>
	<div class="container-fluid">
	  <div class="row">
		<div class="col-sm-6">
		  <p> <a href="http://mhssce.ac.in">MHSSCOE &copy; 2018 -<?php echo $year=date("Y"); ?></a> </p>
		</div>
		<div class="col-sm-6 text-right">
		  <p>Developed by <a href="http://www.linkedin.com/in/danishayubkhan">Danish A. Khan </a>& <a href="https://www.linkedin.com/in/husain-amreliwala-121b5312b/">Husain Amrelivala</a></p>
		</div>
	  </div>
	</div>
	</footer>
	</body>
<?php
		}
	}
	else{
		echo "<div class='card card-body'>No Such Record Exists";
	}
	}//else end
?>
