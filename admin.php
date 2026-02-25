<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();

if (isset($_GET['clear'])) {
	unset($_SESSION['query']);
	unset($_SESSION['adminpage']);
	header("Location: admin.php");
	exit;
}

include 'logs/LOGGER.php';
include_once 'constants/departments.php';

logger::log("INFO", "|Session Logged In =".$_SESSION['loggedin'] . "|USER=" .$_SESSION['user'] );

require_once __DIR__ . '/database_connection.php';
	
	$stmt_alert = $db->prepare("SELECT alertuser FROM members WHERE username = ?");
	$stmt_alert->bind_param("s", $_SESSION['user']);
	$stmt_alert->execute();
	$result = $stmt_alert->get_result();
	$stmt_alert->close();
	if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
			if ($row['alertuser']) {
				include 'notification.php';
				$stmt_reset = $db->prepare("UPDATE members SET alertuser = 0 WHERE username = ?");
				$stmt_reset->bind_param("s", $_SESSION['user']);
				$stmt_reset->execute();
				$stmt_reset->close();
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
		}else if($_POST['dept']=='CSEAIML'){
		    $sql_display .= 'AND branch = "'. CSE_AI_ML .'"';
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
	//Where clause for given date — validate strict dd/mm/yyyy format before interpolating
	if(isset($_POST['date_filter']) && $_POST['date_filter']!='def'){
		$date_filter = $_POST['date_filter'];
		if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_filter)) {
			$sql_display .= " AND DATE_FORMAT(dateofentry, '%d/%m/%Y') = '" . $db->real_escape_string($date_filter) . "'";
		}
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

	$count_result    = $db->query($sql_query_pages);
	$total_filtered  = $count_result ? $count_result->num_rows : 0;
	if ($count_result) $count_result->free();

	$sql_display .= " ORDER BY id LIMIT $start, $size";
	/** End 1stFeb2020**/

	/*QUERY MAIN*/
	$result = $db->query($sql_display);

?>

<?php $page_title = 'RailCon Admin Panel'; ?>
<!DOCTYPE html>
<html>
  <head><?php require __DIR__ . '/includes/head.php'; ?></head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <?php require __DIR__ . '/includes/navbar_admin.php'; ?>
      <div class="page-content align-items-stretch"> 

        <div class="content-inner" style="width:100%">
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin_filter.php">Admin Panel</a></li>
              <li class="breadcrumb-item active">Records</li>
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
          <?php require __DIR__ . '/includes/footer.php'; ?>
        </div>
      </div>
    </div>
    </div>
    <?php require __DIR__ . '/includes/scripts.php'; ?>
  </body>
</html>
<?php
?>		