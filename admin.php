<?php
session_start();
$_SESSION['dashboard'] = false;
include 'logs/LOGGER.php';
logger::log("INFO", "|Session Logged In =".$_SESSION['loggedin'] . "|USER=" .$_SESSION['user'] );

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    require 'database_connection.php';	
	
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

	/*start 1stFeb2020*/
	
	$sql_display = "SELECT id, fullname, gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,season,classof, duration, verified,img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
	FROM student";
	
	if(isset($_POST['status'])){
		
		if($_POST['status']=='I'){
			$sql_display.=" WHERE verified=1 ";
		}
		else if($_POST['status']=='NI'){
			$sql_display.=" WHERE verified=0 ";
		}
		else{
			$sql_display.=" WHERE verified IN (0, 1) ";
		}
		
	}
	if(isset($_POST['gender']) && $_POST['gender']!='def'){
		if($_POST['gender']=='M'){
			$sql_display .= ' AND gender=0 ';
		}
		else{
			$sql_display .= ' AND gender=1 ';	
		}
	}
	if(isset($_POST['dept']) && $_POST['dept']!='def'){
		if($_POST['dept']=='A'){
			$sql_display .= 'AND branch = "Automobile" ';
		}else if($_POST['dept']=='IT'){
			$sql_display .= 'AND branch = "Information Technology" ';
		}else if($_POST['dept']=='CS'){
			$sql_display .= 'AND branch = "Computer Science" ';
		}else if($_POST['dept']=='CSE'){
		    $sql_display .= 'AND branch = "Computer Engineering" ';
		}else if($_POST['dept']=='C'){
			$sql_display .= 'AND branch = "Civil" ';
		}else if($_POST['dept']=='M'){
			$sql_display .= 'AND branch = "Mechanical" ';
		}else if($_POST['dept']=='EXTC'){
			$sql_display .= 'AND branch = "Electronics & Telecommunications" ';
		}else if($_POST['dept']=='EX'){
			$sql_display .= 'AND branch = "Electronics" ';
		}
		
	}
	
	if(isset($_POST['train_dest']) && $_POST['train_dest']!='def'){
		if( $_POST['train_dest'] =='B' ){
			$sql_display .= 'AND destination = "Byculla Station" ';
		} else if( $_POST['train_dest'] =='S' ){
			$sql_display .= 'AND destination = "Sandhurst Road Station" ';
		} else if( $_POST['train_dest'] =='D' ){
			$sql_display .= 'AND destination = "Dockyard Road" ';
		} else if( $_POST['train_dest'] =='M' ){
			$sql_display .= 'AND destination = "Mumbai Central" ';
		} 
	}
	
	//train class
	if(isset($_POST['train_class']) && $_POST['train_class']!='def'){
		if($_POST['train_class']=='F'){
			$sql_display .= ' AND classof = "First" ';
		}
		else if($_POST['train_class']=='S'){
			$sql_display .= ' AND classof = "Second" ';
		}
	}
	//Where clause for duration
	if(isset($_POST['duration']) && $_POST['duration']!='def'){
		if($_POST['duration']=='Q'){
			$sql_display .= ' AND duration = "Quarterly" ';
		}
		else if($_POST['duration']=='M'){
			$sql_display .= ' AND duration = "Monthly" ';
		}
	}
	//Where clause for given date
	if(isset($_POST['date_filter']) && $_POST['date_filter']!='def'){
		$date_filter = $_POST['date_filter'];
		$sql_display .= " AND DATE_FORMAT(dateofentry, '%d/%m/%Y') = '$date_filter'";
	}
	
	/*store the query from search bar into session for further session use*/
	if( isset($_POST['filter_submit']) ){
		$_SESSION['query'] = $sql_display;
	}
	/* Check if query is stored in Session for pagination if yes assign that as query*/
	if(isset($_SESSION['query'])){
		$sql_display = $_SESSION['query'];
	}
	
	$sql_query_pages = $sql_display; /*QUERY for pagination*/
	
	$sql_display .= " ORDER BY id LIMIT $start, $size";	
	/** End 1stFeb2020**/

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
			  <!--<li class="breadcrumb-item active"></html><?php //echo $_SESSION['record_filter']?></li>-->
            </ul>
          </div>
          <section class="tables">   
            <div class="container-fluid">
			<!--Filter Bar-->				  
			<?php require 'filter_bar.php' ?>
			<!--Filter Bar End-->
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
                  <p>MHSSCOE &copy; 2018-20</p>
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
    logger::log("INFO", "Redirecting to Login");
	echo "Redirecting to Login.";
	header("location:login.php");
}
?>		