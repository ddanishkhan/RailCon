<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	include('database_connection.php');
	$_SESSION['dashboard'] = true;
	
	$size = 15;
	
	if(isset($_GET['page'])){
		$start = $_GET['page']*$size;
		$_SESSION['dashpage'] = $_GET['page'];
		$currpage = $_GET['page'];
	}
	elseif( isset($_SESSION['dashpage']) ){
		$start = $_SESSION['dashpage'] * $size;
		$currpage = $_SESSION['dashpage'];
	}
	else{
		$start=0;
		$currpage = 0;
	}

	$sql_display = "SELECT id, fullname, gender,DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,season,classof, duration, verified,img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
	FROM student LIMIT $start, $size";
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
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center" style="overflow:auto;">
	
<!--Pagination -->
<nav aria-label="...">
<ul class="pagination">				
</html>
<?php
	//page number
    $sql_query_pages     = "SELECT id FROM student";
    $result_pages        = $db->query($sql_query_pages);
    $total_records_pages = $result_pages->num_rows;
    $pages         = intval($total_records_pages / $size);

    for ($i = 0; $i < $currpage; $i++) {
		echo "<li class='page-item'>";
		echo "<a class='page-link' href='dashboard.php?page=".$i."'> $i </a>";
		echo "</li>";
		}
	echo "<li class='page-item active'>";
	echo "<a class='page-link' href='dashboard.php?page=".$i."'> $i </a>";
	echo "</li>";
	$i++;	
    for (; $i <= $pages; $i++) {
		echo "<li class='page-item'>";
		echo "<a class='page-link' href='dashboard.php?page=".$i."'> $i </a>";
		echo "</li>";
		}
?>

<html>				
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">   
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Gender</th>
                              <th>DOB/Age</th>
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
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

        echo "<tr><th scope='row'>". $idd=$row['id'] ;
		echo '</th><td>';
			
			echo "<a href='complete_data.php?student=".$idd."'>";
			echo $row['fullname'];
			echo "</a>";
		echo "</td><td>";
			if( $row['gender']=='1' )
				echo "Female";
			else
				echo "Male";	
		echo "</td><td>";
				$diff = date_diff(date_create(), date_create($row['DOB']) );
				echo $row['dateOB'];
				echo "<br>";
				echo "--- <br>";
				echo $diff->format("%Y Y %M M");
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

		<form action='delete.php' method='POST' onsubmit="return confirm('Are you sure you want to Delete?');" >

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
	}//end if
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
                  <p> <a href="http://www.mhssce.ac.in" target="_blank">MHSSCOE &copy; 2018 </a> </p>
                </div>
                <div class="col-sm-6 text-right">
				  <p>Developed by <a target="_blank" href="https://www.linkedin.com/in/danishayubkhan">Danish A. Khan </a> & <a target="_blank" href="https://www.linkedin.com/in/husain-amreliwala-121b5312b/">Husain Amrelivala</a></p>
                  
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
else{
	header("Refresh:1; url=login.html");
	echo "<script> alert('Log In First'); </script>";
}
?>