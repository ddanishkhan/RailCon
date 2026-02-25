<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';

$raw_query = $_GET['query'] ?? '';
$min_length = 3;
$result = null;
$too_short = false;

if (strlen($raw_query) >= $min_length) {
    $search = '%' . $raw_query . '%';
    $stmt = $db->prepare(
        "SELECT id, fullname, gender, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB,
         source, destination, passno, DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end,
         voucher, season, classof, duration, verified, img_loc,
         DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date, remark
         FROM student WHERE (fullname LIKE ?) OR (email LIKE ?) LIMIT 10"
    );
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} else {
    $too_short = true;
}
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
                      <?php if ($too_short): ?>
                        <div class="alert alert-warning mb-0">Minimum search length is 3 characters.</div>
                      <?php endif; ?>
                    </div>
                    <?php if ($result): require_once 'admin_table.php'; endif; ?>
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
