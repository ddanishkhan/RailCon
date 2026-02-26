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
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
		  <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="studentsearch.php" name="search_s" method="POST">
              <input type="search" name="email_id" placeholder="Enter Email ID to check status...." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand -->
			<a href="index" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Railway </span><strong> Concession</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>Concession Form</strong></div></a>
              </div>
		  <!-- Navbar Menu
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

			<!-- Search
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>

              </ul>
		  -->
            </div>
          </div>
        </nav>
      </header>

      <div class="page-content d-flex align-items-stretch">
        <div class="content-inner">
          <!-- Forms Section-->
          <section class="forms">
            <div class="container-fluid">
			<div onclick="location.href='studentsearch';"  class="card bg-info btn text-white">
				<div class="card-body text-center">
					To check your Form. Click Here!
				</div>
			</div>

<?php
  include_once 'constants/departments.php';
	require 'database_connection.php';
	$sql_display = "SELECT MAX(id) AS id FROM student";
	$result = $db->query($sql_display);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$student_id = $row['id'];
		}
	}

	$sql_display1 = "SELECT end_entry FROM admin_controls WHERE id_control = '115617' LIMIT 1";
	$result1 = $db->query($sql_display1);
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$admin_end_id = $row['end_entry'];
		}
	}

	if($student_id >= $admin_end_id){
?>

<div class="card">
<div class="card-body">
	<div class="form-group row">
		<h1>Railway Concession Form On Hold Until Further Notice</h1>
	</div>
	<div class="form-group row">
		<p>This happens because the Railway Pass Book issued from the Railway Authority gets finished.</p>
		<p>Please keep checking this page for submitting the form</p>
	</div>

		<div>If you have already submit the form you can check its status
			<a href="studentsearch" >here</a>
		</div>
</div>
</div>

<?php
	}
	else{

?>

              <div class="row">
                <!-- Form Elements -->
                <div class="col-lg-12">

                <p class="mb-2">
                  <a class="btn btn-sm btn-outline-secondary" data-toggle="collapse" href="#videoGuide" role="button">
                    Watch Video Guide
                  </a>
                </p>
                <div class="collapse mb-3" id="videoGuide">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xfNbu190YBA" allowfullscreen></iframe>
                  </div>
                </div>

                  <div class="card" id="noticeBoard">
                    <img src="img/mhsccoe.jpg" alt="MHSSCOE Logo" align="middle" style="pointer-events: none; display:block; margin:0 auto;max-width:948px; width:100%; ">
				  <img src="img/RailconNotice.jpeg" alt="MHSSCOE Notice" align="middle" style="pointer-events: none; display:block; margin:0 auto;max-width:948px; width:100%; ">
			  </div>

                  <div class="card">
                    <div class="card-body">

                      <form action="profile.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Full Name</label>
                          <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Last First Middle Name" required autofocus/>
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
                          <label class="col-md-3 col-form-label">Email ID</label>
                          <div class="col-md-9">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Date of Birth</label>
                          <div class="col-md-9">
                            <input type="date" name="dob" class="form-control" required/>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Contact No.</label>
                          <div class="col-md-9">
                            <input type="number" name="contact" placeholder="Enter Your Contact No." maxlength="10" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Address</label>
                          <div class="col-md-9">
                            <textarea name="address" class="form-control" placeholder="Enter Your Postal Address" required></textarea>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">PIN Code</label>
                          <div class="col-md-9">
                            <input type="number" name="pincode" maxlength="6" placeholder="Enter Pincode" class="form-control" required />
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Source Station</label>
                          <div class="col-md-9">
                            <input type="text" name="source" maxlength="30" placeholder="Enter Source Station" class="form-control" required />
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Destination Station</label>
                          <div class="col-md-9 select">
                            <select name="destination" class="form-control">
                              <option>Byculla Station</option>
                              <option>Sandhurst Road Station</option>
                              <option>Dockyard Road</option>
                              <option>Mumbai Central</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Previous Season/PassNo:<br/><small class="text-primary">(MANDATORY)</small></label>
                          <div class="col-md-9">
                            <input type="text" name="passno" class="form-control" id="passno" placeholder="Enter NO if New Pass" required />
                          </div>
                        </div>

                        <img src="img/Railway Pass.jpg" class="img-fluid mb-2" alt="Railway Pass Reference">

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Old Pass Expiry <br> <small class="text-primary">(MANDATORY)</small></label>
                          <div class="col-md-9">
                            <input id="pass_end" type="date" name="pass_end" class="form-control"/>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Old Voucher No:<br><small class="text-primary">(MANDATORY)</small></label>
                          <div class="col-md-9">
                            <input type='text' name='voucher' placeholder='Enter Vch No.(Bottom Right)' class="form-control"/>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">ReEnter Previous Season/PassNo:<br><small class="text-primary">(MANDATORY)</small></label>
                          <div class="col-md-9">
                            <input type='number' maxlength='4' name='season' placeholder='Enter Season Ticket No.(Top Right)' class="form-control" />
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
                              <input class="form-check-input" type="radio" name="duration" id="duration-monthly" value="Monthly" checked required>
                              <label class="form-check-label" for="duration-monthly">Monthly</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="duration" id="duration-quarterly" value="Quarterly" required>
                              <label class="form-check-label" for="duration-quarterly">Quarterly</label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Branch of Academics</label>
                          <div class="col-md-9 select">
                            <select name="branch" class="form-control" required>
                              <option>Automobile</option>
                              <option>Civil</option>
                              <option>Computer Engineering</option>
                              <option>Computer Science</option>
                              <option><?php echo CSE_AI_ML ?></option>
                              <option>Electronics</option>
                              <option>Electronics & Telecommunications</option>
                              <option>Information Technology</option>
                              <option>Mechanical</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Academic Year</label>
                          <div class="col-md-9">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="year" id="year-fe" value="F.E" checked required>
                              <label class="form-check-label" for="year-fe">First Year</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="year" id="year-se" value="S.E" required>
                              <label class="form-check-label" for="year-se">Second Year</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="year" id="year-te" value="T.E" required>
                              <label class="form-check-label" for="year-te">Third Year</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="year" id="year-be" value="B.E" required>
                              <label class="form-check-label" for="year-be">Bachelor Year</label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label class="col-md-3 col-form-label">Semester</label>
                          <div class="col-md-9 select">
                            <select name="semester" class="form-control" required>
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

                        <div class="form-group row mb-2">
                          <label for="fileInput" class="col-md-3 col-form-label">Upload <strong>I-Kit</strong> Image with <strong>Address Visible</strong></label><br>
                          <small>
                          <br>*MAX SIZE 1 MB
                          <br>*Minimum Resolution: 100x100
                          <br>*only JPEG/JPG Allowed
                          <br>*Reference image below
                          </small>
                          <div class="col-md-9">
                            <input id="fileInput" type="file" name="UploadImage" class="form-control-file" onchange="readURL(this);" required>
                            <p id="error1" style="display:none; color:#FF0000;">
                            Invalid Image Format! Image Format Must Be JPG, JPEG.
                            </p>
                            <p id="error2" style="display:none; color:#FF0000;">
                            Maximum File Size Limit is 1MB.
                            </p>
                          </div>
                        </div>

                        <img id="blah" src="img/card.jpg" width="90%" alt="ID Reference" />

                        <div class="form-group row mb-2">
                          <div class="col-sm-4 offset-sm-3">
                            <button type="submit" class="btn btn-primary" name="submit" id="submit_form" value="Submit Form">Submit Form</button>
                          </div>
                        </div>
                      </form>
                    </div>
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
	<script>
	$('button[type="submit"]').prop("disabled", true);
	var a=0;
	/*binds to onchange event of your input field*/
	$('#fileInput').bind('change', function() {
	if ($('button:submit').attr('disabled',false)){
		$('button:submit').attr('disabled',true);
		}
	var ext = $('#fileInput').val().split('.').pop().toLowerCase();
	if ($.inArray(ext, ['jpg','jpeg']) == -1){
		$('#error1').slideDown("slow");
		$('#error2').slideUp("slow");
		a=0;
		}else{
		var picsize = (this.files[0].size);
		if (picsize > 1000000){
		$('#error2').slideDown("slow");
		a=0;
		}else{
		a=1;
		$('#error2').slideUp("slow");
		}
		$('#error1').slideUp("slow");
		if (a==1){
			$('button:submit').attr('disabled',false);
			}
		}
	});
	</script>
<script>
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(250);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

   document.getElementById('pass_end').valueAsDate = new Date();

</script>
	<?php
	} //*//end else
	?>

  </body>
</html>
