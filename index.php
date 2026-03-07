<?php $page_title = 'MHSSCE - Railway Concession Form for Degree Students'; ?>
<!DOCTYPE html>
<html>
  <head>
    <?php require __DIR__ . '/includes/head.php'; ?>
    <meta http-equiv="expires" content="0">
    <meta name="description" content="Railway Concession Form for Saboo Siddik College Of Engineering Students Degree">
  </head>
  <body>
    <div class="page">
      <header class="header">
        <nav class="navbar">
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="studentsearch.php" name="search_s" method="POST">
              <input type="search" name="email_id" placeholder="Enter Email ID to check status...." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header">
                <a href="index" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Railway </span><strong> Concession</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>Concession Form</strong></div>
                </a>
              </div>
            </div>
          </div>
        </nav>
      </header>

      <div class="page-content d-flex align-items-stretch">
        <div class="content-inner">
          <section class="forms">
            <div class="container-fluid">
              <div onclick="location.href='studentsearch';" class="card bg-info btn text-white">
                <div class="card-body text-center">To check your Form. Click Here!</div>
              </div>

<?php
  include_once 'constants/departments.php';
  include_once 'constants/admin_controls.php';
  require 'database_connection.php';

  $result     = $db->query("SELECT MAX(id) AS id FROM student");
  $student_id = $result->fetch_assoc()['id'] ?? 0;

  $stmt_ctrl    = $db->prepare("SELECT end_entry FROM admin_controls WHERE id_control = ? LIMIT 1");
  $stmt_ctrl->bind_param("i", ADMIN_CONTROL_ID);
  $stmt_ctrl->execute();
  $admin_end_id = $stmt_ctrl->get_result()->fetch_assoc()['end_entry'] ?? 0;
  $stmt_ctrl->close();

  if ($student_id >= $admin_end_id):
?>

              <div class="card">
                <div class="card-body">
                  <h1>Railway Concession Form On Hold Until Further Notice</h1>
                  <p>This happens because the Railway Pass Book issued from the Railway Authority gets finished.</p>
                  <p>Please keep checking this page for submitting the form</p>
                  <div>If you have already submitted the form you can check its status <a href="studentsearch">here</a></div>
                </div>
              </div>

<?php else: ?>

              <div class="row">
                <div class="col-lg-12">

                  <!-- Video guide (lazy iframe) -->
                  <p class="mb-2">
                    <a class="btn btn-sm btn-outline-secondary" data-toggle="collapse" href="#videoGuide" role="button">
                      Watch Video Guide
                    </a>
                  </p>
                  <div class="collapse mb-3" id="videoGuide">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe id="videoFrame" class="embed-responsive-item" data-src="https://www.youtube.com/embed/xfNbu190YBA" allowfullscreen></iframe>
                    </div>
                  </div>

                  <!-- Progress bar -->
                  <div class="progress mb-2" style="height:6px">
                    <div id="form-progress" class="progress-bar" style="width:20%"></div>
                  </div>
                  <p id="step-label" class="text-muted small mb-3">Step 1 of 5</p>

                  <div class="card">
                    <div class="card-body">
                      <form id="wizard-form" action="profile.php" method="POST" enctype="multipart/form-data">

                        <!-- ═══ STEP 1: Email ═══ -->
                        <div class="form-step" id="step-1">
                          <h5 class="mb-3">Enter your email to get started</h5>
                          <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="email">Email ID</label>
                            <div class="col-md-9">
                              <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                            </div>
                          </div>
                          <div id="email-status-card" class="d-none mb-3"></div>
                          <div id="email-error" class="alert alert-danger d-none"></div>
                          <div class="mt-3">
                            <button type="button" id="btn-check-email" class="btn btn-primary">Continue</button>
                          </div>
                        </div>

                        <!-- ═══ STEP 2: Personal Details ═══ -->
                        <div class="form-step d-none" id="step-2">
                          <!-- Notice board images: lazy, inside step-2 so below the fold on load -->
                          <div class="card mb-3" id="noticeBoard">
                            <img src="img/mhsccoe.jpg" loading="lazy" alt="MHSSCOE Logo" style="pointer-events:none;display:block;margin:0 auto;max-width:948px;width:100%">
                            <img src="img/RailconNotice.jpeg" loading="lazy" alt="MHSSCOE Notice" style="pointer-events:none;display:block;margin:0 auto;max-width:948px;width:100%">
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="name">Full Name</label>
                            <div class="col-md-9">
                              <input type="text" name="name" class="form-control" id="name" placeholder="Last First Middle Name" required>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label">Gender</label>
                            <div class="col-md-9">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender-male" value="0" checked>
                                <label class="form-check-label" for="gender-male">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender-female" value="1">
                                <label class="form-check-label" for="gender-female">Female</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="dob">Date of Birth</label>
                            <div class="col-md-9">
                              <input type="date" name="dob" id="dob" class="form-control" required>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="contact">Contact No.</label>
                            <div class="col-md-9">
                              <input type="number" name="contact" id="contact" placeholder="Enter Your Contact No." maxlength="10" class="form-control" required>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="address">Address</label>
                            <div class="col-md-9">
                              <textarea name="address" id="address" class="form-control" placeholder="Enter Your Postal Address" required></textarea>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="pincode">PIN Code</label>
                            <div class="col-md-9">
                              <input type="number" name="pincode" id="pincode" maxlength="6" placeholder="Enter Pincode" class="form-control" required>
                            </div>
                          </div>

                          <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary btn-back" data-target="1">Back</button>
                            <button type="button" class="btn btn-primary btn-next" data-target="3">Next</button>
                          </div>
                        </div>

                        <!-- ═══ STEP 3: Academic Details ═══ -->
                        <div class="form-step d-none" id="step-3">
                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="branch">Branch of Academics</label>
                            <div class="col-md-9">
                              <select name="branch" id="branch" class="form-control" required>
                                <option>Automobile</option>
                                <option>Civil</option>
                                <option>Computer Engineering</option>
                                <option>Computer Science</option>
                                <option><?php echo CSE_AI_ML ?></option>
                                <option>Electronics</option>
                                <option>Electronics &amp; Telecommunications</option>
                                <option>Information Technology</option>
                                <option>Mechanical</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label">Academic Year</label>
                            <div class="col-md-9">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="year" id="year-fe" value="F.E" checked>
                                <label class="form-check-label" for="year-fe">First Year</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="year" id="year-se" value="S.E">
                                <label class="form-check-label" for="year-se">Second Year</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="year" id="year-te" value="T.E">
                                <label class="form-check-label" for="year-te">Third Year</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="year" id="year-be" value="B.E">
                                <label class="form-check-label" for="year-be">Bachelor Year</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="semester">Semester</label>
                            <div class="col-md-9">
                              <select name="semester" id="semester" class="form-control" required>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                              </select>
                            </div>
                          </div>

                          <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary btn-back" data-target="2">Back</button>
                            <button type="button" class="btn btn-primary btn-next" data-target="4">Next</button>
                          </div>
                        </div>

                        <!-- ═══ STEP 4: Travel & Pass ═══ -->
                        <div class="form-step d-none" id="step-4">
                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="source">Source Station</label>
                            <div class="col-md-9">
                              <input type="text" name="source" id="source" maxlength="30" placeholder="Enter Source Station" class="form-control" required>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label" for="destination">Destination Station</label>
                            <div class="col-md-9">
                              <select name="destination" id="destination" class="form-control">
                                <option>Byculla Station</option>
                                <option>Sandhurst Road Station</option>
                                <option>Dockyard Road</option>
                                <option>Mumbai Central</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label">Class of Travel</label>
                            <div class="col-md-9">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="classof" id="class-first" value="First" checked>
                                <label class="form-check-label" for="class-first">First Class</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="classof" id="class-second" value="Second">
                                <label class="form-check-label" for="class-second">Second Class</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row mb-2">
                            <label class="col-md-3 col-form-label">Duration of Pass</label>
                            <div class="col-md-9">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="duration" id="duration-monthly" value="Monthly" checked>
                                <label class="form-check-label" for="duration-monthly">Monthly</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="duration" id="duration-quarterly" value="Quarterly">
                                <label class="form-check-label" for="duration-quarterly">Quarterly</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Do you have a previous pass?</label>
                            <div class="col-md-9">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="has_prev_pass" id="prev-yes" value="yes" checked>
                                <label class="form-check-label" for="prev-yes">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="has_prev_pass" id="prev-no" value="no">
                                <label class="form-check-label" for="prev-no">No — this is my first pass</label>
                              </div>
                            </div>
                          </div>

                          <!-- Old pass card: visible when YES (default) -->
                          <div id="old-pass-card" class="card border-warning mb-3">
                            <div class="card-header bg-warning text-dark font-weight-bold">
                              Fill in details from your previous Railway Pass (refer to image below)
                            </div>
                            <div class="card-body">
                              <img id="railway-pass-img" data-src="img/Railway Pass.jpg" class="img-fluid mb-3" alt="Railway Pass Reference">

                              <div class="form-group row mb-2">
                                <label class="col-md-3 col-form-label">Previous Season/Pass No.<br><small class="text-primary">(MANDATORY)</small></label>
                                <div class="col-md-9">
                                  <input type="text" name="passno" id="passno-input" class="form-control" placeholder="Enter your pass number">
                                </div>
                              </div>

                              <div class="form-group row mb-2">
                                <label class="col-md-3 col-form-label">Old Pass Expiry<br><small class="text-primary">(MANDATORY)</small></label>
                                <div class="col-md-9">
                                  <input type="date" name="pass_end" id="pass-end-input" class="form-control">
                                </div>
                              </div>

                              <div class="form-group row mb-2">
                                <label class="col-md-3 col-form-label">Old Voucher No.<br><small class="text-primary">(MANDATORY)</small></label>
                                <div class="col-md-9">
                                  <input type="text" name="voucher" class="form-control" placeholder="Enter Vch No. (Bottom Right)">
                                </div>
                              </div>

                              <div class="form-group row mb-2">
                                <label class="col-md-3 col-form-label">Re-enter Season/Pass No.<br><small class="text-primary">(MANDATORY)</small></label>
                                <div class="col-md-9">
                                  <input type="number" maxlength="4" name="season" class="form-control" placeholder="Enter Season Ticket No. (Top Right)">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary btn-back" data-target="3">Back</button>
                            <button type="button" class="btn btn-primary btn-next" data-target="5">Next</button>
                          </div>
                        </div>

                        <!-- ═══ STEP 5: Photo Upload ═══ -->
                        <div class="form-step d-none" id="step-5">
                          <div class="alert alert-info mb-3">
                            <strong>I-Kit Photo Upload</strong><br>
                            Upload your I-Kit image with your <strong>address clearly visible</strong>.
                            <ul class="mb-0 mt-1">
                              <li>MAX SIZE: 1 MB</li>
                              <li>Minimum Resolution: 100×100</li>
                              <li>Only JPEG / JPG allowed</li>
                              <li>Reference image shown below</li>
                            </ul>
                          </div>

                          <div class="form-group row mb-2">
                            <label for="fileInput" class="col-md-3 col-form-label">Upload <strong>I-Kit</strong> Image</label>
                            <div class="col-md-9">
                              <input id="fileInput" type="file" name="UploadImage" class="form-control-file" onchange="readURL(this);" required>
                              <p id="error1" class="text-danger mt-1" style="display:none">Invalid Image Format! Image Format Must Be JPG, JPEG.</p>
                              <p id="error2" class="text-danger mt-1" style="display:none">Maximum File Size Limit is 1MB.</p>
                            </div>
                          </div>

                          <img id="blah" data-src="img/card.jpg" style="max-width:90%;display:block;margin-bottom:1rem" alt="ID Reference">

                          <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary btn-back" data-target="4">Back</button>
                            <button type="submit" class="btn btn-success btn-lg" name="submit" id="submit_form" value="Submit Form" disabled>Submit Form</button>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>

                </div>
              </div>

<?php endif; ?>

            </div>
          </section>
          <?php require __DIR__ . '/includes/footer.php'; ?>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          document.getElementById('blah').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    </script>

    <script>
    $(function () {
      var currentStep = 1;
      var progressWidths = { 1: 20, 2: 40, 3: 60, 4: 80, 5: 100 };

      function esc(s) {
        return $('<div>').text(s || '').html();
      }

      function showStep(n) {
        $('.form-step').addClass('d-none');
        $('#step-' + n).removeClass('d-none');
        currentStep = n;
        $('#form-progress').css('width', progressWidths[n] + '%');
        $('#step-label').text('Step ' + n + ' of 5');

        // Lazy-load step-4 railway pass image
        if (n === 4) {
          var rp = document.getElementById('railway-pass-img');
          if (rp && !rp.getAttribute('src')) {
            rp.setAttribute('src', rp.getAttribute('data-src'));
          }
        }

        // Lazy-load step-5 card.jpg reference
        if (n === 5) {
          var blah = document.getElementById('blah');
          if (blah && !blah.getAttribute('src')) {
            blah.setAttribute('src', blah.getAttribute('data-src'));
          }
        }
      }

      function validateCurrentStep() {
        var step = document.getElementById('step-' + currentStep);
        var inputs = step.querySelectorAll('input[required], select[required], textarea[required]');
        for (var i = 0; i < inputs.length; i++) {
          if (!inputs[i].reportValidity()) return false;
        }
        return true;
      }

      // ── Email check (Step 1) ──────────────────────────────────────────────
      $('#btn-check-email').on('click', function () {
        var emailInput = document.getElementById('email');
        if (!emailInput.reportValidity()) return;

        var $btn = $(this).prop('disabled', true).text('Checking...');
        $('#email-status-card').addClass('d-none');
        $('#email-error').addClass('d-none');

        $.post('check_email.php', { email: emailInput.value }, function (data) {
          $btn.prop('disabled', false).text('Continue');

          if (data.status === 'new') {
            showStep(2);
            return;
          }

          // Existing application — show inline card
          var badge = data.verified
            ? '<span class="badge badge-success">Issued</span>'
            : '<span class="badge badge-warning text-dark">Pending</span>';

          var html = '<div class="card border-info">'
            + '<div class="card-header bg-info text-white font-weight-bold">Existing Application Found</div>'
            + '<div class="card-body">'
            + '<h6 class="card-title mb-2">' + esc(data.name) + '</h6>'
            + '<p class="mb-1"><strong>Route:</strong> ' + esc(data.source) + ' &rarr; ' + esc(data.destination) + '</p>'
            + '<p class="mb-1"><strong>Class:</strong> ' + esc(data.classof) + ' &nbsp;&nbsp; <strong>Duration:</strong> ' + esc(data.duration) + '</p>'
            + '<p class="mb-1"><strong>Status:</strong> ' + badge + '</p>'
            + '<p class="mb-1"><strong>Submitted:</strong> ' + esc(data.dateofentry) + '</p>';

          if (data.remark) {
            html += '<p class="mb-1"><strong>Remark:</strong> ' + esc(data.remark) + '</p>';
          }

          html += '</div>'
            + '<div class="card-footer d-flex" style="gap:.5rem">'
            + '<a href="studentsearch" class="btn btn-outline-secondary">Check Status</a>'
            + '<button type="button" id="btn-create-new" class="btn btn-primary">Create New Application</button>'
            + '</div>'
            + '</div>';

          $('#email-status-card').html(html).removeClass('d-none');

        }, 'json').fail(function () {
          $btn.prop('disabled', false).text('Continue');
          $('#email-error').text('Unable to verify email. Please try again.').removeClass('d-none');
        });
      });

      // "Create New Application" from the status card
      $(document).on('click', '#btn-create-new', function () {
        $('#email-status-card').addClass('d-none');
        showStep(2);
      });

      // ── Next / Back ───────────────────────────────────────────────────────
      $('.btn-next').on('click', function () {
        if (validateCurrentStep()) {
          showStep(parseInt($(this).data('target')));
        }
      });

      $('.btn-back').on('click', function () {
        showStep(parseInt($(this).data('target')));
      });

      // ── Previous pass toggle (Step 4) ─────────────────────────────────────
      $('input[name="has_prev_pass"]').on('change', function () {
        if ($(this).val() === 'no') {
          $('#old-pass-card').hide();
          $('#passno-input').val('NO');
          $('#pass-end-input, [name="voucher"], [name="season"]').val('');
        } else {
          $('#old-pass-card').show();
          if ($('#passno-input').val() === 'NO') {
            $('#passno-input').val('');
          }
        }
      });

      // ── File validation (Step 5) ──────────────────────────────────────────
      $('#fileInput').on('change', function () {
        $('#error1, #error2').hide();
        $('#submit_form').prop('disabled', true);

        var ext = this.value.split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg']) === -1) {
          $('#error1').show();
          return;
        }
        if (this.files[0].size > 1000000) {
          $('#error2').show();
          return;
        }
        $('#submit_form').prop('disabled', false);
      });

      // ── YouTube lazy load ─────────────────────────────────────────────────
      $('#videoGuide').on('show.bs.collapse', function () {
        var frame = document.getElementById('videoFrame');
        if (frame && !frame.getAttribute('src')) {
          frame.setAttribute('src', frame.getAttribute('data-src'));
        }
      });

      // ── Default pass expiry to today ──────────────────────────────────────
      document.getElementById('pass-end-input').valueAsDate = new Date();
    });
    </script>

  </body>
</html>
