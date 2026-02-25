<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';
unset($_SESSION['adminpage']);
unset($_SESSION['dashpage']);

// Current end number
$stmt = $db->prepare("SELECT end_entry FROM admin_controls WHERE id_control = 115617 LIMIT 1");
$stmt->execute();
$end_entry = (int) $stmt->get_result()->fetch_assoc()['end_entry'];
$stmt->close();

// Latest submission ID and total record count
$stmt2 = $db->prepare("SELECT MAX(id) AS current_id, COUNT(*) AS total FROM student");
$stmt2->execute();
$row2          = $stmt2->get_result()->fetch_assoc();
$current_id    = (int) ($row2['current_id'] ?? 0);
$total_records = (int) ($row2['total'] ?? 0);
$stmt2->close();

$slots_remaining = max(0, $end_entry - $current_id);
$form_open = $current_id < $end_entry;
$updated   = isset($_GET['updated']);
?>
<?php $page_title = 'Admin Panel'; ?>
<!DOCTYPE html>
<html>
  <head><?php require __DIR__ . '/includes/head.php'; ?></head>
  <body>
    <div class="page">
      <?php require __DIR__ . '/includes/navbar_admin.php'; ?>
      <div class="page-content align-items-stretch">
        <div class="content-inner" style="width:100%">
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item active">Admin Panel</li>
            </ul>
          </div>

          <section class="forms">
            <div class="container-fluid">

              <?php if ($updated): ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                End number updated successfully.
              </div>
              <?php endif; ?>

              <!-- Status cards -->
              <div class="row mb-4">
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-center">
                    <div class="card-body py-4">
                      <p class="text-muted mb-1" style="font-size:.8rem;text-transform:uppercase;letter-spacing:.05em;">Latest Submission No.</p>
                      <h2 class="mb-0 font-weight-bold"><?= $current_id ?></h2>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-center">
                    <div class="card-body py-4">
                      <p class="text-muted mb-1" style="font-size:.8rem;text-transform:uppercase;letter-spacing:.05em;">Form Closes At</p>
                      <h2 class="mb-0 font-weight-bold"><?= $end_entry ?></h2>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-center">
                    <div class="card-body py-4">
                      <p class="text-muted mb-1" style="font-size:.8rem;text-transform:uppercase;letter-spacing:.05em;">Slots Remaining</p>
                      <h2 class="mb-0 font-weight-bold <?= $slots_remaining <= 5 ? 'text-danger' : ($slots_remaining <= 20 ? 'text-warning' : '') ?>">
                        <?= $slots_remaining ?>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-center">
                    <div class="card-body py-4">
                      <p class="text-muted mb-1" style="font-size:.8rem;text-transform:uppercase;letter-spacing:.05em;">Form Status</p>
                      <?php if ($form_open): ?>
                        <span class="badge badge-success" style="font-size:1rem;padding:.5em .9em;">OPEN</span>
                      <?php else: ?>
                        <span class="badge badge-danger" style="font-size:1rem;padding:.5em .9em;">CLOSED</span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Update end number -->
                <div class="col-lg-5 mb-4">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4 mb-0">Update Form Close Number</h3>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">
                        The form closes automatically once the latest submission number reaches this value.
                        Currently set to <strong><?= $end_entry ?></strong>.
                      </p>
                      <form action="change_number.php" method="POST">
                        <div class="form-group">
                          <label for="endnum">New End Number</label>
                          <input type="number" id="endnum" name="endnum" class="form-control"
                                 placeholder="e.g. <?= $end_entry + 50 ?>"
                                 min="1" required />
                          <small class="form-text text-muted">Latest submission is #<?= $current_id ?>. Set higher than this to open the form.</small>
                        </div>
                        <input type="hidden" name="startnum" value="">
                        <button type="submit" name="endnumbutton" class="btn btn-primary">
                          <i class="fa fa-save"></i> Update
                        </button>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Quick links -->
                <div class="col-lg-7 mb-4">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4 mb-0">Quick Links</h3>
                    </div>
                    <div class="card-body p-0">
                      <div class="list-group list-group-flush">
                        <a href="admin.php?clear=1" class="list-group-item list-group-item-action">
                          <i class="fa fa-table fa-fw mr-2 text-primary"></i>
                          View All Records
                          <span class="badge badge-secondary float-right"><?= $total_records ?> total</span>
                        </a>
                        <a href="admin.php" class="list-group-item list-group-item-action">
                          <i class="fa fa-filter fa-fw mr-2 text-primary"></i>
                          Filter &amp; Issue Passes
                        </a>
                        <a href="export_to_csv.php" class="list-group-item list-group-item-action">
                          <i class="fa fa-file-excel-o fa-fw mr-2 text-success"></i>
                          Download Records (XLS)
                        </a>
                        <a href="search.php" class="list-group-item list-group-item-action">
                          <i class="fa fa-search fa-fw mr-2 text-primary"></i>
                          Search Records
                        </a>
                        <a href="logout.php" class="list-group-item list-group-item-action text-danger">
                          <i class="fa fa-sign-out fa-fw mr-2"></i>
                          Logout
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </section>
          <?php require __DIR__ . '/includes/footer.php'; ?>
        </div>
      </div>
    </div>
    <?php require __DIR__ . '/includes/scripts.php'; ?>
  </body>
</html>
