<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
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
	FROM student ORDER BY 'id' LIMIT $start, $size
	";
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
              <li class="breadcrumb-item"><a href="admin_filter.php">Filter</a></li>
              <li class="breadcrumb-item active">Dashboard - All Entries  </li>
            </ul>
          </div>
          <section class="tables">   
            <div class="container-fluid">
			<!--Filter Bar -->
			<?php require 'filter_bar.php' ?>
			<!--Filter Bar End-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
					
                    <div class="card-header d-flex align-items-center" style="overflow:auto;">
					<!--Pagination -->
					<?php 
					$sql_query_pages     = "SELECT id FROM student";
					require 'pagination.php' 
					?>
					<!--Pagination -->
                    </div>
					<?php require 'admin_table.php' ?>
					<div class="card-header d-flex align-items-center" style="overflow:auto;">
					<!--Pagination -->
					<?php
					require 'pagination.php' 
					?>
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
    <?php require __DIR__ . '/includes/scripts.php'; ?>
  </body>
</html>

<?php
?>