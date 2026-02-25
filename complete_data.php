<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();

if (!isset($_GET['student'])) {
    echo "No Student Selected";
    exit;
}

require_once __DIR__ . '/database_connection.php';

$student_id = (int) $_GET['student'];
$stmt = $db->prepare("SELECT id, fullname, gender, semester, email, contact, address, pincode, year, branch, Remark, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, classof, duration, verified, img_loc, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>
<?php $page_title = 'RailCon Admin Panel'; ?>
<!DOCTYPE html>
<html>
  <head><?php require __DIR__ . '/includes/head.php'; ?></head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <?php require __DIR__ . '/includes/navbar_admin.php'; ?>
<?php if ($result->num_rows > 0):
    $row = $result->fetch_assoc(); ?>
  <div class="page-content align-items-stretch">
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin_filter.php">Filter</a></li>
        <li class="breadcrumb-item active">Complete Details</li>
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
                      <tr><th>#</th><td><?= htmlspecialchars($row['id']) ?></td></tr>
                      <tr><th>Name</th><td><?= htmlspecialchars($row['fullname']) ?></td></tr>
                      <tr><th>Gender</th><td><?= $row['gender'] == '1' ? 'Female' : 'Male' ?></td></tr>
                      <tr><th>Sem</th><td><?= htmlspecialchars($row['semester']) ?></td></tr>
                      <tr><th>Branch</th><td><?= htmlspecialchars($row['branch']) ?></td></tr>
                      <tr><th>Email</th><td><?= htmlspecialchars($row['email']) ?></td></tr>
                      <tr><th>Contact</th><td><?= htmlspecialchars($row['contact']) ?></td></tr>
                      <tr><th>DOB/Age</th><td><?= htmlspecialchars($row['dateOB']) ?></td></tr>
                      <tr><th>Source</th><td><?= htmlspecialchars($row['source']) ?></td></tr>
                      <tr><th>Destination</th><td><?= htmlspecialchars($row['destination']) ?></td></tr>
                      <tr><th>Address</th><td><?= htmlspecialchars($row['address']) ?></td></tr>
                      <tr><th>Pincode</th><td><?= htmlspecialchars($row['pincode']) ?></td></tr>
                      <tr><th>Class</th><td><?= htmlspecialchars($row['classof']) ?></td></tr>
                      <tr><th>Duration</th><td><?= htmlspecialchars($row['duration']) ?></td></tr>
                      <tr><th>DateOfEntry</th><td><?= htmlspecialchars($row['date']) ?></td></tr>
                      <tr><th>Status</th><td><?= $row['verified'] == '1' ? 'Issued' : 'Not Issued' ?></td></tr>
                      <tr><th>Remarks</th><td><?= htmlspecialchars($row['Remark']) ?></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Page Footer-->
    <?php require __DIR__ . '/includes/footer.php'; ?>
  </div>
<?php else: ?>
  <div class="page-content align-items-stretch">
    <div class="container-fluid">
      <div class="card card-body">No Such Record Exists</div>
    </div>
  </div>
<?php endif; ?>
    </div>
    <?php require __DIR__ . '/includes/scripts.php'; ?>
  </body>
</html>
