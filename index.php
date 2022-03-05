<!DOCTYPE html>
<html lang="en">
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async
	src="https://www.googletagmanager.com/gtag/js?id=UA-127558734-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127558734-1');
</script>
<title>MHSSCE - Railway Concession Form for Degree Students</title>
<meta charset="utf-8">
<meta http-equiv="expires" content="0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description"
	content="Railway Concession Form for Saboo Siddik College Of Engineering Students Degree">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name='author' content='Danish Ayub Khan'>
<meta name="robots" content="all,follow">
<!-- Bootstrap CSS-->
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome CSS-->
<link rel="stylesheet"
	href="vendor/font-awesome/css/font-awesome.min.css">
<!-- Fontastic Custom icon font-->
<link rel="stylesheet" href="css/fontastic.css">
<!-- Google fonts - Poppins -->
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
<!-- theme stylesheet-->
<link rel="stylesheet" href="css/style.default.css"
	id="theme-stylesheet">
<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="css/custom.css">
<!-- Favicon-->
<link rel="shortcut icon" href="img/favicon.ico">
<!-- Tweaks for older IEs-->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
	<div class="page">
		<!-- Main Navbar-->
		<header class="header">
			<nav class="navbar">
				<!-- Search Box-->
				<div class="search-box">
					<button class="dismiss">
						<i class="icon-close"></i>
					</button>
					<form id="searchForm" action="studentsearch" name="search_s"
						method="POST">
						<input type="search" name="email_id"
							placeholder="Enter Email ID to check status...."
							class="form-control">
					</form>
				</div>
				<div class="container-fluid">
					<div
						class="navbar-holder d-flex align-items-center justify-content-between">
						<!-- Navbar Header-->
						<div class="navbar-header">
							<!-- Navbar Brand -->
							<a href="index" class="navbar-brand d-none d-sm-inline-block">
								<div class="brand-text d-none d-lg-inline-block">
									<span>Railway </span><strong> Concession</strong>
								</div>
								<div class="brand-text d-none d-sm-inline-block d-lg-none">
									<strong>Concession Form</strong>
								</div>
							</a>
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
						<div class="line"></div>
						<div onclick="location.href='studentsearch';"
							class="card bg-info btn text-white">
							<div class="card-body text-center">To check your Form. Click Here!</div>
						</div>
						<div class="line row"></div>
				
<?php
require 'database_connection.php';
$sql_display = "SELECT MAX(id) AS id FROM student";
$result = $db->query($sql_display);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $student_id = $row['id'];
    }
}

$sql_display1 = "SELECT end_entry FROM admin_controls WHERE id_control = '115617' LIMIT 1";
$result1 = $db->query($sql_display1);
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $admin_end_id = $row['end_entry'];
    }
}

if ($student_id >= $admin_end_id) {
    ?>

<div class="card">
							<div class="card-body">
								<div class="form-group row">
									<h1>Railway Concession Form On Hold Until Further Notice</h1>
								</div>
								<div class="form-group row">
									<p>This happens because the Railway Pass Book issued from the
										Railway Authority gets finished.</p>
									<p>Please keep checking this page for submitting the form</p>
								</div>

								<div>
									If you have already submit the form you can check its status <a
										href="studentsearch">here</a>
								</div>
							</div>
						</div>

<?php
} else {

    ?>
				
              <div class="row">
							<!-- Form Elements -->
							<div class="col-lg-12">
								<iframe style="text-align: center;" width="100%"
									src="https://www.youtube.com/embed/xfNbu190YBA" frameborder="0"
									allow="autoplay; encrypted-media" allowfullscreen>
									<a href="https://www.youtube.com/embed/xfNbu190YBA">Guide to
										Railcon</a>
								</iframe>

								<div class="card" id="noticeBoard">

									<img src="img/mhsccoe.jpg" alt="MHSSCOE Logo" align="middle"
										style="pointer-events: none; display: block; margin: 0 auto; max-width: 948px; width: 100%;">
									<img src="img/RailconNotice.jpeg" alt="MHSSCOE Notice"
										align="middle"
										style="pointer-events: none; display: block; margin: 0 auto; max-width: 948px; width: 100%;">
								</div>

								<div class="card">

									<img src="img/mhsccoe.jpg" alt="MHSSCOE Logo" align="middle"
										style="pointer-events: none; display: block; margin: 0 auto; width: 100%;">
									<div class="card-body">

										<form action="profile.php" method="POST"
											enctype="multipart/form-data" class="form-horizontal">
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Full Name</label>
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control"
														id="name" placeholder="Last First Middle Name" required
														autofocus />
													</li>
												</div>
											</div>

											<div class="line"></div>

											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Gender</label>
												<div class="col-sm-9">
													<div class="i-checks">
														<input id="radioCustom1" type="radio" checked="" value="0"
															name="gender" class="radio-template"> <label
															for="radioCustom1">Male</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio" value="1"
															name="gender" class="radio-template"> <label
															for="radioCustom2">Female</label>
													</div>
												</div>
											</div>

											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">Email ID</label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input id="register-email" type="email" name="email"
															required class="input-material"> <label
															for="register-email" class="label-material">Email Address
														</label>
													</div>
												</div>
											</div>
											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">Date of Birth </label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input type="date" name="dob" required />
													</div>
												</div>
											</div>
											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">Contact No.</label>
												<div class="col-sm-9">
													<input type="number" name="contact"
														placeholder="Enter Your Contact No." maxlength="10"
														class="form-control" required>
												</div>
											</div>

											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">Address</label>
												<div class="col-sm-9">
													<textarea name="address" class="form-control"
													placeholder="Enter Your Postal Address" required></textarea>
												</div>
											</div>

											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">PIN Code</label>
												<div class="col-sm-9">
													<input type="number" name="pincode" maxlength="6"
														placeholder="Enter Pincode" class="form-control" required />
												</div>
											</div>

											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">Source Station</label>
												<div class="col-sm-9">
													<input type="text" name="source" maxlength="30"
														placeholder="Enter Source Station" class="form-control"
														required />
												</div>
											</div>

											<div class="line"></div>

											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Destination
													Station</label>
												<div class="col-sm-9 select">
													<select name="destination" class="form-control">
														<option>Byculla Station</option>
														<option>Sandhurst Road Station</option>
														<option>Dockyard Road</option>
														<option>Mumbai Central</option>
													</select>
												</div>
											</div>

											<div class="line"></div>

											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Previous
													Season/PassNo:<br /> <small class="text-primary">(MANDATORY)</small>
												</label>
												<div class="col-sm-9">
													<input type="text" name="passno" class="form-control"
														id="passno" placeholder="Enter NO if New Pass" required />
													</li>
												</div>
											</div>

											<div class="line"></div>

											<img src="img/Railway Pass.jpg" width=90% height="300px">

											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">Old Pass Expiry <br>
													<small class="text-primary">(MANDATORY)</small></label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input type="date" name="pass_end" />
													</div>
												</div>
											</div>

											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">Old Voucher No:<br>
													<small class="text-primary">(MANDATORY)</small>
												</label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input type='text' name='voucher'
															placeholder='Enter Vch No.(Bottom Right)'
															class="form-control" />
													</div>
												</div>
											</div>

											<div class="line"></div>

											<div class="row">
												<label class="col-sm-3 form-control-label">ReEnter Previous
													Season/PassNo:<br> <small class="text-primary">(MANDATORY)</small>
												</label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input type='number' maxlength='4' name='season'
															placeholder='Enter Season Ticket No.(Top Right)'
															class="form-control" />
													</div>
												</div>
											</div>

											<div class="line"></div>

											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Class of Travel</label>
												<div class="col-sm-9">
													<div class="i-checks">
														<input id="radioCustom1" type="radio" checked=""
															value="First" name="classof" class="radio-template"> <label
															for="radioCustom1">First Class</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio" value="Second"
															name="classof" class="radio-template"> <label
															for="radioCustom2">Second Class</label>
													</div>
												</div>
											</div>

											<div class="line"></div>

											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Duration of Pass</label>
												<div class="col-sm-9">
													<div class="i-checks">
														<input id="radioCustom1" type="radio" checked=""
															value="Monthly" name="duration" class="radio-template"
															required> <label for="radioCustom1">Monthly</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio" value="Quarterly"
															name="duration" class="radio-template" required> <label
															for="radioCustom2">Quarterly</label>
													</div>
												</div>
											</div>

											<div class="line"></div>

											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Branch of
													Academics</label>
												<div class="col-sm-9 select">
													<select name="branch" class="form-control" required>
														<option>Automobile</option>
														<option>Civil</option>
														<option>Computer Science</option>
														<option>Electronics</option>
														<option>Electronics & Telecommunications</option>
														<option>Information Technology</option>
														<option>Mechanical</option>
													</select>
												</div>
											</div>

											<div class="line"></div>

											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Academic Year</label>
												<div class="col-sm-9">
													<div class="i-checks">
														<input id="radioCustom1" type="radio" checked=""
															value="F.E" name="year" class="radio-template" required>
														<label for="radioCustom1">First Year</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio" value="S.E"
															name="year" class="radio-template" required> <label
															for="radioCustom2">Second Year</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio" value="T.E"
															name="year" class="radio-template" required> <label
															for="radioCustom3">Third Year</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio" value="B.E"
															name="year" class="radio-template" required> <label
															for="radioCustom4">Bachelor Year</label>
													</div>
												</div>
											</div>

											<div class="line"></div>

											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Semester</label>
												<div class="col-sm-9 select">
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

											<div class="line"></div>

											<div class="form-group row">
												<label for="fileInput" class="col-sm-3 form-control-label">Upload
													<strong><strong>I-Kit</strong> Image with <strong><strong>Address
																Visible</strong>
												
												</label><br> <small> <br>*MAX SIZE 1 MB <br>*Minimum
													Resolution: 100x100 <br>*only JPEG/JPG Allowed <br>*Reference
													image below
												</small>

												<div class="col-sm-9">
													<input id="fileInput" type="file" name="UploadImage"
														class="form-control-file" onchange="readURL(this);"
														required>
													<p id="error1" style="display: none; color: #FF0000;">
														Invalid Image Format! Image Format Must Be JPG, JPEG.</p>
													<p id="error2" style="display: none; color: #FF0000;">
														Maximum File Size Limit is 1MB.</p>
												</div>
											</div>

											<img id="blah" src="img/card.jpg" width="90%"
												alt="ID Reference" />

											<div class="line"></div>

											<div class="form-group row">
												<div class="col-sm-4 offset-sm-3">
													<button type="submit" class="btn btn-primary" name="submit"
														id="submit_form" value="Submit Form">Submit Form</button>
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
				<footer class="main-footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<p>
									<a href="http://www.mhssce.ac.in" target="_blank">MHSSCOE
										&copy; 2018 </a>
								</p>
							</div>
							<div class="col-sm-6 text-right">
								<p>
									Developed by <a target="_blank"
										href="https://www.linkedin.com/in/danishayubkhan">Danish Khan</a> & <a target="_blank"
										href="https://www.linkedin.com/in/husain-amreliwala-121b5312b/">Husain Amrelivala</a>
								</p>

							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div>
	<!-- JavaScript files-->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/popper.js/umd/popper.min.js"> </script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
	<script src="vendor/chart.js/Chart.min.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
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
</script>
	<!-- Main File-->
	<script src="js/front.js"></script>
	<?php
} // *//end else
?>
											
  </body>
</html>