<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include('database_connection.php');
    
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
	if(isset($_GET['entries']) && $_GET['entries'] == 'all' ){
		$_SESSION['dashboard'] = true;
	}
	else{
		$_SESSION['dashboard'] = false;		
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
	
	/***************************FILTERS QUERY**********************************************/
	if(isset($_SESSION['dashboard'])){
		$_SESSION['record_filter'] = 'All Entries';
		$sql_display = "SELECT id, fullname, gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,season,classof, duration, verified,img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
		FROM student LIMIT $start, $size";

	$sql_query_pages = "SELECT id FROM student";
	}
	elseif ($filter == "Issued") {
        $_SESSION['record_filter'] = 'Issued';
        //Set Query for Issued
        $sql_display               = "SELECT id, fullname,gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,verified,voucher,season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE verified=1
        LIMIT $start, $size";
		$sql_query_pages = "SELECT id FROM student WHERE verified=1";
    } //$filter == "Issued"
    
	elseif ($filter == "Not_Issued") {
        $_SESSION['record_filter'] = 'Not_Issued';
        // set Query for Not_Issued
        $sql_display               = "SELECT id, fullname,gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,verified,voucher,
        season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE verified=0
        LIMIT $start, $size";
		$sql_query_pages = "SELECT id FROM student WHERE verified=0";
    } //$filter == "Not_Issued"
    
	elseif ($filter == "Males") {
        $_SESSION['record_filter'] = 'Males';
        //set Query for Males non-issued
        $sql_display               = "SELECT id, fullname,gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,verified, voucher,
        season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE gender=0 AND verified=0 
        LIMIT $start, $size";
		
		$sql_query_pages = "SELECT id FROM student WHERE gender=0 AND verified=0 ";
		
    } //$filter == "Males"
    
	elseif ($filter == "Females") {
        $_SESSION['record_filter'] = 'Females';
        //Set Query for Females Not-Issued
        $sql_display               = "SELECT id, fullname,gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,verified, DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,
        season, classof, duration, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
        FROM student WHERE gender=1 AND verified=0 
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
        FROM student WHERE DATE_FORMAT(dateofentry, '%d/%m/%Y') = '$dateofentry' AND verified=0 
        LIMIT $start, $size";
		
		$sql_query_pages = "SELECT id FROM student WHERE DATE_FORMAT(dateofentry, '%d/%m/%Y') = '$dateofentry' AND verified=0 ";
		
    } //$filter == "Dates"
/***************************FILTERS QUERY END***************************/
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
              <li class="breadcrumb-item"><a href="admin.php?entries=all">Dashboard</a>
			  <li class="breadcrumb-item active"></html><?php echo $_SESSION['record_filter']?><html> </li>
            </ul>
          </div>
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
<!--Pagination -->
<nav aria-label="...">
<ul class="pagination">
</html>

<?php
	//page number
    /*$sql_query_pages     = "SELECT id FROM student";*/
    $result_pages        = $db->query($sql_query_pages);
    $total_records_pages = $result_pages->num_rows;
    $pages         = intval($total_records_pages / $size);

    for ($i = 0; $i < $currpage; $i++) {
		echo "<li class='page-item'>";
		echo "<a class='page-link' href='?page=".$i."'> $i </a>";
		echo "</li>";
		}
		
		echo "<li class='page-item active'>";
		echo "<a class='page-link' href='?page=".$i."'> $i </a>";
		echo "</li>";
	$i++;
		
    for (; $i <= $pages; $i++) {
		echo "<li class='page-item'>";
		echo "<a class='page-link' href='?page=".$i."'> $i </a>";
		echo "</li>";
		}	
?>
<html>
  </ul>
</nav>
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

    $result = $db->query($sql_display);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
			
            echo "<tr><th scope='row'>" . $idd = $row['id'];
            echo '</th><td>';
			echo "<a href='complete_data.php?student=".$idd."'>";
			echo $row['fullname'];
			echo "</a>";
            echo "</td><td>";
            if ($row['gender'] == '1')
                echo "Female";
            else
                echo "Male";
            echo "</td><td>";
			
			$diff = date_diff(date_create(), date_create($row['DOB']) );
			echo $row['dateOB'];
			echo "<br/>";
			echo "--- <br>";
			echo $diff->format("%Y Y %M M");
			
            echo "</td><td>";
            echo $row['source'];
            echo "</td><td>";
            echo $row['destination'];
            echo "</td><td>";
            echo $row['passno'] . "<br/>";
            echo $row['pass_end'] . "<br/>";
            echo $row['voucher'] . "<br/>";
            echo $row['season'] . "<br/>";
            echo "</td><td>";
            echo $row['classof'];
            echo "</td><td>";
            echo $row['duration'];
            echo "</td><td>";
            echo $row['date'];
            echo "</td><td>";
            if ($row['verified'] == "1")
                echo "Issued";
            else
                echo "Not Issued";
            echo "</td><td>";
            $MyPhoto = $row['img_loc'];
            			$MyPhoto = $row['img_loc'];
			
			echo "<img id='".$idd."' src = 'MyUploadImages/".$MyPhoto."' data-toggle='modal' data-target='#myModal' height='100'/>";
		
?>
	<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style = "max-width:90%; max-height:90%">
        <div class="modal-content">
            <div class="modal-body ">
                <img class="showimage img-responsive" src="" style = "max-width:90%"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
			
<script src="http://code.jquery.com/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('img').on('click', function () {
        var image = $(this).attr('src');
        //alert(image);
        $('#myModal').on('show.bs.modal', function () {
            $(".showimage").attr("src", image);
        });
    });
});
	
</script>

<?php
            echo "</td><td>";
            $_SESSION['dashboard'] = False;
			
			echo "<form action='update.php' method='POST'>
			<input type='hidden' name = 'id' value = ".$idd .">
			<input type = 'submit' class='bg-green' name= 'verify_it' value='Issue'><br/>
			<input type = 'submit' class='bg-red' name= 'cancel_verify' value='Not Issue'><br/>
			</form></br>
			
			<form action='edit.php' method='POST'>
			<input type='hidden' name = 'id' value = ".$idd .">
			<input type = 'submit' class='bg-blue' name= 'edit' value ='Edit Record'></br>
			</form>
			";
		?>

		<form action='delete.php' method='POST' onsubmit="return confirm('Are you sure you want to submit?');" >

		<?php
		echo "<input type='hidden' name = 'id' value = ".$idd .">
			<input type = 'submit' class='bg-red' name= 'delete' value ='Delete Record'>
			</form>	";
			
		echo "</td><td>";
		echo "
		<form id='Remarks' method='POST' action='update_remark.php'>
		<input type='text' name='remark' placeholder='Enter Remarks' style='width:90%'/>
		<input type='hidden' name = 'id' value = ".$idd."></input>
		<input type='submit' class='bg-blue' name='update_remark' value='Remark' style='width:80%;'/>
		</form>";
		echo "</td></tr>";
        }
    } //$result->num_rows > 0
	else {
    echo "<strong style='font-size:2em'>No Records</strong>";
    }
?>
<html>						  
                            <tr>
                              <th scope="row">-</th>
                              <td>-</td>
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
} //Authentication
else {
    echo "<script> alert('Log In First'); </script>";
    header("Refresh:1; url=login.html");
}
?>