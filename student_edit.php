<?php
session_start();
require_once __DIR__ . '/database_connection.php';
require_once __DIR__ . '/includes/csrf.php';

if (!isset($_POST['student_edit'])) {
    header("Location: index.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL);
$idd = (int) $_POST['id'];
$sql_query = $db->prepare(
    "SELECT fullname, gender, semester, email, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB,
     contact, address, pincode, source, destination, passno,
     DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end, voucher, season, classof, duration,
     branch, year, verified, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date, img_loc
     FROM student WHERE id=?"
) or die('query preparation failed');
$sql_query->bind_param('i', $idd);
$sql_query->execute();
$sql_query->bind_result($fullname, $gender, $semester, $email, $DOB, $dateOB, $contact,
    $address, $pincode, $source, $destination, $passno, $pass_end, $voucher, $season,
    $classof, $duration, $branch, $year, $verified, $date_entry, $oldimg);
if (!$sql_query->fetch()) {
    die('Record not found.');
}
?>
<?php $page_title = 'Edit Your Form'; ?>
<!DOCTYPE html>
<html>
  <head><?php require __DIR__ . '/includes/head.php'; ?></head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form action="studentsearch.php" id="searchForm" method="post" name="search_s">
              <input class="form-control" name="email_id"
                placeholder="Check status by Email ID..." type="search">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header">
                <a class="navbar-brand d-none d-sm-inline-block" href="index.php">
                  <div class="brand-text d-none d-lg-inline-block">
                    <span>Railway</span> <strong>Concession</strong>
                  </div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none">
                    <strong>Concession Form</strong>
                  </div>
                </a>
              </div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <li class="nav-item d-flex align-items-center">
                  <a href="#" id="search"><i class="icon-search"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <div class="page-content d-flex align-items-stretch">
        <div class="content-inner">
          <section class="forms">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <img align="middle" alt="MHSSCOE Logo" src="img/mhsccoe.jpg"
                      style="pointer-events:none;display:block;margin:0 auto;max-width:948px;width:100%;">
                    <div class="card-body">
                      <form action="student_editrecord.php" class="form-horizontal"
                        enctype="multipart/form-data" method="post">
                        <?= csrf_input() ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($idd) ?>">

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Full Name</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="name" type="text"
                              value="<?= htmlspecialchars($fullname) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Gender</label>
                          <div class="col-sm-9">
                            <div class="i-checks">
                              <input <?= $gender == '0' ? 'checked' : '' ?>
                                class="radio-template" id="edit_gender_male" name="gender"
                                type="radio" value="0">
                              <label for="edit_gender_male">Male</label>
                            </div>
                            <div class="i-checks">
                              <input <?= $gender == '1' ? 'checked' : '' ?>
                                class="radio-template" id="edit_gender_female" name="gender"
                                type="radio" value="1">
                              <label for="edit_gender_female">Female</label>
                            </div>
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">Email ID</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="email" type="email"
                              value="<?= htmlspecialchars($email) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">Date of Birth</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="dob" type="date"
                              value="<?= htmlspecialchars($DOB) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">Contact No.</label>
                          <div class="col-sm-9">
                            <input class="form-control" maxlength="10" name="contact"
                              type="number" value="<?= htmlspecialchars($contact) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">Address</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="address"
                              placeholder="Edit Address"><?= htmlspecialchars($address) ?></textarea>
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">PIN Code</label>
                          <div class="col-sm-9">
                            <input class="form-control" maxlength="6" name="pincode"
                              type="number" value="<?= htmlspecialchars($pincode) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">Source Station</label>
                          <div class="col-sm-9">
                            <input class="form-control" maxlength="30" name="source"
                              type="text" value="<?= htmlspecialchars($source) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Destination Station</label>
                          <div class="col-sm-9 select">
                            <select class="form-control" name="destination">
                              <option value="Byculla Station"
                                <?= $destination === 'Byculla Station' ? 'selected' : '' ?>>
                                Byculla Station</option>
                              <option value="Sandhurst Road Station"
                                <?= $destination === 'Sandhurst Road Station' ? 'selected' : '' ?>>
                                Sandhurst Road Station</option>
                              <option value="Dockyard Road"
                                <?= $destination === 'Dockyard Road' ? 'selected' : '' ?>>
                                Dockyard Road</option>
                              <option value="Mumbai Central"
                                <?= $destination === 'Mumbai Central' ? 'selected' : '' ?>>
                                Mumbai Central</option>
                            </select>
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Previous PassNo:
                            <small class="text-primary">If Exists</small></label>
                          <div class="col-sm-9">
                            <input class="form-control" name="passno" type="text"
                              placeholder="<?= htmlspecialchars($passno) ?>"
                              value="<?= htmlspecialchars($passno) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <img src="img/Railway%20Pass.jpg" alt="Railway Pass Reference"
                          style="width:90%;display:block;margin:0 auto;">
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">Old Pass Expiry
                            <small class="text-primary">If Exists</small></label>
                          <div class="col-sm-9">
                            <input class="form-control" name="pass_end" type="date"
                              value="<?= htmlspecialchars($pass_end) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">Old Voucher No:
                            <small class="text-primary">If Exists</small></label>
                          <div class="col-sm-9">
                            <input class="form-control" name="voucher" type="text"
                              value="<?= htmlspecialchars($voucher) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="row">
                          <label class="col-sm-3 form-control-label">Old Season Ticket no.
                            <small class="text-primary">If Exists</small></label>
                          <div class="col-sm-9">
                            <input class="form-control" maxlength="4" name="season"
                              type="number" value="<?= htmlspecialchars($season) ?>">
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Class of travel</label>
                          <div class="col-sm-9">
                            <div class="i-checks">
                              <input <?= $classof === 'First' ? 'checked' : '' ?>
                                class="radio-template" id="edit_classof_first" name="classof"
                                type="radio" value="First">
                              <label for="edit_classof_first">First Class</label>
                            </div>
                            <div class="i-checks">
                              <input <?= $classof === 'Second' ? 'checked' : '' ?>
                                class="radio-template" id="edit_classof_second" name="classof"
                                type="radio" value="Second">
                              <label for="edit_classof_second">Second Class</label>
                            </div>
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Duration of Pass</label>
                          <div class="col-sm-9">
                            <div class="i-checks">
                              <input <?= $duration === 'Monthly' ? 'checked' : '' ?>
                                class="radio-template" id="edit_duration_monthly" name="duration"
                                type="radio" value="Monthly">
                              <label for="edit_duration_monthly">Monthly</label>
                            </div>
                            <div class="i-checks">
                              <input <?= $duration === 'Quarterly' ? 'checked' : '' ?>
                                class="radio-template" id="edit_duration_quarterly" name="duration"
                                type="radio" value="Quarterly">
                              <label for="edit_duration_quarterly">Quarterly</label>
                            </div>
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Branch of Academics</label>
                          <div class="col-sm-9 select">
                            <select class="form-control" name="branch">
                              <?php
                              $branches = [
                                  'Automobile',
                                  'Civil',
                                  'Computer Engineering',
                                  'Computer Science',
                                  'Computer Science & Engineering - AI & ML',
                                  'Electronics',
                                  'Electronics & Telecommunications',
                                  'Information Technology',
                                  'Mechanical',
                              ];
                              foreach ($branches as $b):
                              ?>
                              <option value="<?= htmlspecialchars($b) ?>"
                                <?= $branch === $b ? 'selected' : '' ?>>
                                <?= htmlspecialchars($b) ?>
                              </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Academic Year</label>
                          <div class="col-sm-9">
                            <div class="i-checks">
                              <input id="edit_year_fe" type="radio"
                                <?= $year === 'F.E' ? 'checked' : '' ?>
                                value="F.E" name="year" class="radio-template" required>
                              <label for="edit_year_fe">First Year</label>
                            </div>
                            <div class="i-checks">
                              <input id="edit_year_se" type="radio"
                                <?= $year === 'S.E' ? 'checked' : '' ?>
                                value="S.E" name="year" class="radio-template" required>
                              <label for="edit_year_se">Second Year</label>
                            </div>
                            <div class="i-checks">
                              <input id="edit_year_te" type="radio"
                                <?= $year === 'T.E' ? 'checked' : '' ?>
                                value="T.E" name="year" class="radio-template" required>
                              <label for="edit_year_te">Third Year</label>
                            </div>
                            <div class="i-checks">
                              <input id="edit_year_be" type="radio"
                                <?= $year === 'B.E' ? 'checked' : '' ?>
                                value="B.E" name="year" class="radio-template" required>
                              <label for="edit_year_be">Bachelor Year</label>
                            </div>
                          </div>
                        </div>
                        <div class="line"></div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Semester</label>
                          <div class="col-sm-9 select">
                            <select class="form-control" name="semester">
                              <?php for ($s = 1; $s <= 8; $s++): ?>
                              <option value="<?= $s ?>" <?= $semester == $s ? 'selected' : '' ?>>
                                <?= $s ?>
                              </option>
                              <?php endfor; ?>
                            </select>
                          </div>
                        </div>
                        <div class="line"></div>

                        <p class="text-muted">Only upload if the previous image was wrong — otherwise leave empty.</p>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="fileInput">
                            Upload <strong>I-Kit Image with <strong>Address Visible</strong></strong><br>
                            <small>*MAX SIZE 1 MB<br>*Minimum Resolution: 100x100<br>*Only JPEG/JPG Allowed</small>
                          </label>
                          <div class="col-sm-9">
                            <input class="form-control-file" id="fileInput" name="UploadImage"
                              onchange="readURL(this);" type="file" />
                            <p id="error1" style="display:none;color:#FF0000;">
                              Invalid Image Format! Must be JPG or JPEG.</p>
                            <p id="error2" style="display:none;color:#FF0000;">
                              Maximum File Size Limit is 1MB.</p>
                          </div>
                        </div>

                        <img alt="ID Card Reference" id="blah" src="img/card.jpg" style="width:90%;display:block;margin:0 auto;">

                        <div class="form-group row mt-3">
                          <div class="col-sm-4 offset-sm-3">
                            <button class="btn btn-primary" id="submit_form"
                              name="student_editrecord" type="submit">Edit Record</button>
                          </div>
                        </div>
                      </form>
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
    <script>
      // File validation — enabled only when a file is chosen
      $('button[type="submit"]').prop('disabled', true);

      $('#fileInput').on('change', function () {
        var ext = this.value.split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg']) === -1) {
          $('#error1').slideDown('slow');
          $('#error2').slideUp('slow');
          $('button[type="submit"]').prop('disabled', true);
          return;
        }
        if (this.files[0].size > 1000000) {
          $('#error2').slideDown('slow');
          $('#error1').slideUp('slow');
          $('button[type="submit"]').prop('disabled', true);
          return;
        }
        $('#error1').slideUp('slow');
        $('#error2').slideUp('slow');
        $('button[type="submit"]').prop('disabled', false);
      });

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#blah').attr('src', e.target.result).width(250);
          };
          reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
  </body>
</html>
