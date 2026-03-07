<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';
require_once __DIR__ . '/includes/csrf.php';

if (isset($_POST['edit'])) {
    $idd = (int) $_POST['id'];

    $sql_query = $db->prepare("SELECT fullname, gender, email, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno, DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end, voucher, season, classof, duration, verified, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE id=?") OR die('query preparation failed');
    $sql_query->bind_param('i', $idd);
    $sql_query->execute();
    $sql_query->bind_result($fullname, $gender, $email, $dob, $dateOB, $source, $destination, $passno, $pass_end, $voucher, $season, $classof, $duration, $verified, $date_entry);
    $sql_query->fetch();

    if ($verified == 0) {
?>
<?php $page_title = 'Railcon Dashboard'; ?>
<!DOCTYPE html>
<html>
  <head>
    <?php require __DIR__ . '/includes/head.php'; ?>
    <link rel='stylesheet' type='text/css' href='modal.css'>
  </head>
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
              <li class="breadcrumb-item"><a href="admin.php">Records</a></li>
              <li class="breadcrumb-item active">Edit Record</li>
            </ul>
          </div>
          <div class="card-body" style="background:white;">
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Class</th>
                    <th>Duration</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><?= htmlspecialchars($idd) ?></th>
                    <td>
                      <div class="mb-2"><?= htmlspecialchars($fullname) ?></div>
                      <form action="edit_record.php" method="POST">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= $idd ?>">
                        <input type="text" name="fullname" class="form-control form-control-sm mb-1" placeholder="New name">
                        <button type="submit" class="btn btn-primary" name="edit_fullname">Save Name</button>
                      </form>
                    </td>
                    <td>
                      <div class="mb-2"><?= $gender == '1' ? 'Female' : 'Male' ?></div>
                      <form action="edit_record.php" method="POST">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= $idd ?>">
                        <select name="gender" class="form-control form-control-sm mb-1">
                          <option value="0">Male</option>
                          <option value="1">Female</option>
                        </select>
                        <button type="submit" class="btn btn-primary" name="edit_gender">Save Gender</button>
                      </form>
                    </td>
                    <td>
                      <div class="mb-2"><?= htmlspecialchars($dateOB) ?></div>
                      <form action="edit_record.php" method="POST">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= $idd ?>">
                        <input type="date" name="DOB" class="form-control form-control-sm mb-1">
                        <button type="submit" class="btn btn-primary" name="edit_DOB">Save DOB</button>
                      </form>
                    </td>
                    <td>
                      <div class="mb-2"><?= htmlspecialchars($email) ?></div>
                      <form action="edit_record.php" method="POST">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= $idd ?>">
                        <input type="email" name="email" class="form-control form-control-sm mb-1">
                        <button type="submit" class="btn btn-primary" name="edit_email">Save Email</button>
                      </form>
                    </td>
                    <td>
                      <div class="mb-2"><?= htmlspecialchars($source) ?></div>
                      <form action="edit_record.php" method="POST">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= $idd ?>">
                        <input type="text" name="source" class="form-control form-control-sm mb-1">
                        <button type="submit" class="btn btn-primary" name="edit_source">Save Source</button>
                      </form>
                    </td>
                    <td>
                      <div class="mb-2"><?= htmlspecialchars($destination) ?></div>
                      <form action="edit_record.php" method="POST">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= $idd ?>">
                        <select name="destination" class="form-control form-control-sm mb-1">
                          <option>Byculla Station</option>
                          <option>Dockyard Road</option>
                          <option>Sandhurst Road Station</option>
                          <option>Mumbai Central</option>
                        </select>
                        <button type="submit" class="btn btn-primary" name="edit_destination">Save Destination</button>
                      </form>
                    </td>
                    <td>
                      <div class="mb-2"><?= htmlspecialchars($classof) ?></div>
                      <form action="edit_record.php" method="POST">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= $idd ?>">
                        <select name="classof" class="form-control form-control-sm mb-1">
                          <option>First Class</option>
                          <option>Second Class</option>
                        </select>
                        <button type="submit" class="btn btn-primary" name="edit_classof">Save Class</button>
                      </form>
                    </td>
                    <td>
                      <div class="mb-2"><?= htmlspecialchars($duration) ?></div>
                      <form action="edit_record.php" method="POST">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= $idd ?>">
                        <select name="duration" class="form-control form-control-sm mb-1">
                          <option>Monthly</option>
                          <option>Quarterly</option>
                        </select>
                        <button type="submit" class="btn btn-primary" name="edit_duration">Save Duration</button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Page Footer-->
      <?php require __DIR__ . '/includes/footer.php'; ?>
    </div>
    <?php require __DIR__ . '/includes/scripts.php'; ?>
  </body>
</html>
<?php
    } else {
        $_SESSION['flash'] = 'Record already issued — cannot be edited.';
        header("Location: dashboard.php");
        exit;
    }
}
?>
