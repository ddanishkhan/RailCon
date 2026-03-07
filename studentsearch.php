<?php
session_start();
require_once __DIR__ . '/includes/csrf.php';

if (isset($_POST['action_override'])) {
    validate_csrf_token($_POST['csrf_token'] ?? '');
    $_SESSION['override_email_check'] = true;
    unset($_SESSION['allow_override']);
    header('location:index.php');
    die();
}

if (((isset($_POST['email_id']) || isset($_SESSION['studentemail'])) && isset($_SESSION['SearchRequest']))
    || isset($_SESSION['allow_override'])) {
    if (isset($_SESSION['SearchRequest'])) {
        unset($_SESSION['SearchRequest']);
    }
?>

<?php $page_title = 'RailCon Form Status'; ?>
<!DOCTYPE html>
<html>
  <head>
    <?php require __DIR__ . '/includes/head.php'; ?>
    <link rel='stylesheet' type='text/css' href='modal.css'>
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="studentsearch.php" name="search_s" method="GET">
              <input type="search" name="query" placeholder="Who are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <a href="#" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Railway Concession </span><strong>Search</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>Railway Concession</strong></div>
                </a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
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
              <li class="breadcrumb-item"><a href="index.php">Form</a></li>
              <li class="breadcrumb-item active">Search</li>
            </ul>
          </div>
          <section class="tables">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <strong>
                        <?php if (isset($_SESSION['studenterror'])) { echo htmlspecialchars($_SESSION['studenterror']); } ?>
                      </strong>
                    </div>
                    <div class="card-body">
                      <?php if (isset($_SESSION['allow_override'])): unset($_SESSION['allow_override']); ?>
                      <form method="POST" action="studentsearch.php" class="mb-3">
                        <?= csrf_input() ?>
                        <input type="hidden" name="action_override" value="1">
                        <button type="submit" class="btn btn-warning btn-lg">Proceed Anyway</button>
                      </form>
                      <?php endif; ?>
                      <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Source</th>
                              <th>Destination</th>
                              <th>Class</th>
                              <th>Duration</th>
                              <th>DateOfEntry</th>
                              <th class="table-danger">Status</th>
                              <th>ID Card</th>
                              <th class="table-info">Remarks</th>
                            </tr>
                          </thead>
                          <tbody>
<?php

    /* database connection */
    require_once __DIR__ . '/database_connection.php';
    $min_length = 3;

    $raw_query = isset($_POST['email_id']) ? $_POST['email_id'] : $_SESSION['studentemail'];

    if (strlen($raw_query) >= $min_length) {
        $search = '%' . $raw_query . '%';
        $stmt = $db->prepare(
            "SELECT id, fullname, source, destination, passno, classof, duration, verified, img_loc,
             DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date, remark, edit
             FROM student WHERE email LIKE ? LIMIT 3"
        );
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $raw_results = $stmt->get_result();
        $stmt->close();

        if ($raw_results->num_rows === 0) {
            echo '<tr><td colspan="10" class="text-center py-3 text-muted">No Records Found</td></tr>';
        } else {
            while ($row = $raw_results->fetch_assoc()) {
                $idd = $row['id'];
                echo '<tr>';
                echo '<th scope="row">' . $idd . '</th>';
                echo '<td>' . htmlspecialchars($row['fullname']) . '</td>';
                echo '<td>' . htmlspecialchars($row['source']) . '</td>';
                echo '<td>' . htmlspecialchars($row['destination']) . '</td>';
                echo '<td>' . htmlspecialchars($row['classof']) . '</td>';
                echo '<td>' . htmlspecialchars($row['duration']) . '</td>';
                echo '<td>' . htmlspecialchars($row['date']) . '</td>';
                echo '<td class="table-danger">';
                echo $row['verified'] == '1' ? '<span class="badge badge-success">Issued</span>' : '<span class="badge badge-secondary">Not Issued</span>';
                echo '</td>';
                echo '<td>';
                $imgSrc = htmlspecialchars($row['img_loc'], ENT_QUOTES);
                echo '<img src="MyUploadImages/' . $imgSrc . '" height="100"
                    style="cursor:pointer" data-toggle="modal" data-target="#imgModal"
                    data-src="MyUploadImages/' . $imgSrc . '"
                    data-name="' . htmlspecialchars($row['fullname'], ENT_QUOTES) . '"
                    alt="ID Card">';
                echo '</td>';
                echo '<td class="table-info">' . htmlspecialchars($row['remark']) . '</td>';
                if ($row['edit'] == 1) {
                    echo '<td>';
                    echo '<form action="student_edit.php" method="POST">';
                    echo '<input type="hidden" name="id" value="' . $idd . '">';
                    echo '<button type="submit" class="btn btn-primary btn-sm" name="student_edit">Edit form</button>';
                    echo '</form>';
                    echo '</td>';
                }
                echo '</tr>';
            }
        }

    } else {
        echo '<tr><td colspan="10" class="text-center py-3 text-muted"><script>alert(\'Minimum Length is 3\')</script></td></tr>';
    }
?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- Image preview modal (single instance) -->
          <div id="imgModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" style="max-width:90%;">
              <div class="modal-content">
                <div class="modal-header py-2">
                  <h5 class="modal-title">
                    <i class="fa fa-picture-o mr-2"></i>ID Card &mdash;
                    <span id="imgModalName" class="font-weight-bold"></span>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center py-4" style="background:#f1f3f5;min-height:200px">
                  <img class="showimage" src="" style="max-width:100%;max-height:70vh;" alt="ID Card">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Page Footer-->
          <?php require __DIR__ . '/includes/footer.php'; ?>
        </div>
      </div>
    </div>
    <?php require __DIR__ . '/includes/scripts.php'; ?>
    <script>
      $(function () {
        $('img[data-target="#imgModal"]').on('click', function () {
          $('.showimage').attr('src', $(this).data('src'));
          $('#imgModalName').text($(this).data('name') || '');
        });
        $('#imgModal').on('hidden.bs.modal', function () {
          $('.showimage').attr('src', '');
        });
      });
    </script>
  </body>
</html>

<?php
    } // end if allow_override / SearchRequest
    else {
        echo "Enter Email ID";
        $_SESSION['SearchRequest'] = true;
        unset($_SESSION['studenterror']);
        unset($_SESSION['studentemail']);
        ?>
<!DOCTYPE html>
<html>
  <head><?php require __DIR__ . '/includes/head.php'; ?></head>
  <body>
    <div class="page">
      <div class="page-content d-flex align-items-stretch">
        <div class="content-inner" style="width:100%">
          <div class="container-fluid mt-4">
            <form action="studentsearch.php" method="POST" class="form-inline">
              <div class="form-group">
                <label for="email_search" class="sr-only">Email Address</label>
                <input id="email_search" type="email" name="email_id"
                  placeholder="Enter Email Address" class="mr-3 form-control" required>
              </div>
              <div class="form-group">
                <button type="submit" name="submit_email" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require __DIR__ . '/includes/scripts.php'; ?>
  </body>
</html>
<?php
    }
?>
