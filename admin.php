<?php
session_start();
$_SESSION['dashboard'] = False;

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include('database_connection.php');
	
	$check = "SELECT alertuser FROM members WHERE username = '".$_SESSION['user']."'";
	$result = $db->query($check);
	if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
			if ( $row['alertuser'] ){
			include 'notification.php' ;
			$sql_update_status = "UPDATE `members` SET `alertuser`=0 WHERE `username`='".$_SESSION['user']."' ";
			$db->query($sql_update_status);
			}
		}
	}
    
	$size = 15;
	if(isset($_GET['page'])){
		$start = $_GET['page']*$size;
		$_SESSION['adminpage'] = $_GET['page']; 
		$currpage = $_GET['page'];
	}
	elseif( isset($_SESSION['adminpage']) ){
		$start = $_SESSION['adminpage'] * $size;
		$currpage = $_SESSION['adminpage'];
	}
	else{
		$start=0;
		$currpage = 0;
	}
	
	$filter = "Not_Issued";
	
    if (isset($_POST['date_submit'])) {
        $dateofentry             = $_POST['date_filter'];
        $filter                  = "Dates";
        $_SESSION['actual_date'] = $dateofentry;
		$_SESSION['record_filter'] = $filter;
    } 
    elseif (isset($_POST['filter_submit'])) {
        $filter = $_POST['filter'];
    }
    elseif (isset($_SESSION['record_filter'])) {
        $filter = $_SESSION['record_filter'];
    }
    else {
        $_SESSION['filter'] = "Not_Issued";
    }	
	
	    if ($filter == "Issued") {
        $_SESSION['record_filter'] = 'Issued';
        //Set Query for Issued
        $sql_display               = "SELECT id, fullname,gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,verified,voucher,season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE verified=1
ORDER BY id
        LIMIT $start, $size";
		$sql_query_pages = "SELECT id FROM student WHERE verified=1";
    } //$filter == "Issued"
    elseif ($filter == "Not_Issued") {
        $_SESSION['record_filter'] = 'Not_Issued';
        // set Query for Not_Issued
        $sql_display               = "SELECT id, fullname,gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,verified,voucher,
        season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE verified=0 ORDER BY id
        LIMIT $start, $size";
		$sql_query_pages = "SELECT id FROM student WHERE verified=0";
    } //$filter == "Not_Issued"
        elseif ($filter == "Males") {
        $_SESSION['record_filter'] = 'Males';
        //set Query for Males non-issued
        $sql_display               = "SELECT id, fullname,gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,verified, voucher,
        season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE gender=0 AND verified=0 ORDER BY id
        LIMIT $start, $size";
		
		$sql_query_pages = "SELECT id FROM student WHERE gender=0 AND verified=0 ";
		
    } //$filter == "Males"
        elseif ($filter == "Females") {
        $_SESSION['record_filter'] = 'Females';
        //Set Query for Females Not-Issued
        $sql_display               = "SELECT id, fullname,gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,verified, DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,
        season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE gender=1 AND verified=0 ORDER BY id
        LIMIT $start, $size";
		
		$sql_query_pages = "SELECT id FROM student WHERE gender=1 AND verified=0 ";
		
    } //$filter == "Females"
        
    //raw text filter for dates
        elseif ($filter == "Dates") {
        $_SESSION['record_filter'] = "Dates";
        $dateofentry               = $_SESSION['actual_date'];
        //Set Query for Dates
        $sql_display               = "SELECT id, fullname, gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,verified, DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,
        season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE DATE_FORMAT(dateofentry, '%d/%m/%Y') = '$dateofentry' AND verified=0 ORDER BY id
        LIMIT $start, $size";
		
		$sql_query_pages = "SELECT id FROM student WHERE DATE_FORMAT(dateofentry, '%d/%m/%Y') = '$dateofentry' AND verified=0 ";
		
    } //$filter == "Dates"
	
	/*QUERY MAIN*/
	$result = $db->query($sql_display);

?>

<!DOCTYPE html>
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
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
			  <li class="breadcrumb-item active"></html><?php echo $_SESSION['record_filter']?></li>
            </ul>
          </div>
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
					<!--Pagination -->
					<?php require 'pagination.php' ?>
					<!--Pagination -->
                    </div>
					<?php
					require 'admin_table.php';
					?>
					<div class="card-header d-flex align-items-center">
					<!--Pagination -->
					<?php require 'pagination.php' ?>
					<!--Pagination -->
					</div>
                  </div>
				</div>
             </div>
          </section>
          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-12">
                  <p>MHSSCOE &copy; 2018</p>
                </div>
              </div>
            </div>
          </footer>
        </div>
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
} //Authentication
else {
    echo "<script> alert('Log In First'); </script>";
    header("Refresh:1; url=login.html");
}
?>		