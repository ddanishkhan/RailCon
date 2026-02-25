<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';

	
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
		$sql_display = "SELECT id, fullname, gender,DOB,DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno,DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,voucher,season,classof, duration, verified,img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date, remark FROM student
WHERE (`fullname` LIKE '%" . $query . "%') OR (`email` LIKE '%" . $query . "%') LIMIT 10" ;

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
                    <?php
					require_once 'admin_table.php';
					?>
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
	}
	else { // if query length is less than minimum
		echo "<script>alert('Minimum Length is 3')</script>";
	}
?>
