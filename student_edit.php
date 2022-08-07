<?php
if (isset($_POST['student_edit'])) {
    include ('database_connection.php');
    mysqli_report(MYSQLI_REPORT_ALL);
    $idd = $_POST['id'];
    $sql_query = $db->prepare("SELECT fullname, gender, semester, email, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, contact, address, pincode, source, destination, passno, DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end, voucher, season, classof, duration, branch, year, verified, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date, img_loc     FROM student WHERE id=?") or die('query preparation failed');
    $sql_query->bind_param('i', $idd);
    $sql_query->execute();
    $sql_query->bind_result($fullname, $gender, $semester, $email, $DOB, $dateOB, $contact, $address, $pincode, $source, $destination, $passno, $pass_end, $voucher, $season, $classof, $duration, $branch, $year, $verified, $date_entry, $oldimg);
    $sql_query->fetch();
    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<title>Student Form Edit Panel</title>
<meta content="" name="description">
<meta content="width=device-width, initial-scale=1, shrink-to-fit=no"
	name="viewport">
<meta content='Danish Khan' name='author'>
<meta content="all,follow" name="robots">
<!-- Bootstrap CSS-->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome CSS-->
<link href="vendor/font-awesome/css/font-awesome.min.css"
	rel="stylesheet">
<!-- Fontastic Custom icon font-->
<link href="css/fontastic.css" rel="stylesheet">
<!-- Google fonts - Poppins -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700"
	rel="stylesheet">
<!-- theme stylesheet-->
<link href="css/style.default.css" id="theme-stylesheet"
	rel="stylesheet">
<!-- Custom stylesheet - for your changes-->
<link href="css/custom.css" rel="stylesheet">
<!-- Favicon-->
<link href="img/favicon.ico" rel="shortcut icon">
<!-- Tweaks for older IEs-->
<!--[if lt IE 9]>        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
					<form action="studentsearch.php" id="searchForm" method="post"
						name="search_s">
						<input class="form-control" name="email_id"
							placeholder="Check Status of your form by Email ID...."
							type="search">
					</form>
				</div>
				<div class="container-fluid">
					<div
						class="navbar-holder d-flex align-items-center justify-content-between">
						<!-- Navbar Header-->
						<div class="navbar-header">
							<!-- Navbar Brand -->
							<a class="navbar-brand d-none d-sm-inline-block"
								href="index.html">
								<div class="brand-text d-none d-lg-inline-block">
									<span>Railway</span> <strong>Concession</strong>
								</div>
								<div class="brand-text d-none d-sm-inline-block d-lg-none">
									<strong>Concession Form</strong>
								</div>
							</a>
						</div>
						<!-- Navbar Menu -->
						<ul
							class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
							<!-- Search-->
							<li class="nav-item d-flex align-items-center"><a href="#"
								id="search"><i class="icon-search"></i></a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class="page-content d-flex align-items-stretch">
			<div class="content-inner">
				<!-- Forms Section-->
				<section class="forms">
					<div class="container-fluid">
						<div class="row">
							<!-- Form Elements -->
							<div class="col-lg-12">
								<div class="card">
									<img align="middle" alt="MHSSCOE Logo" src="img/mhsccoe.jpg"
										style="pointer-events: none; display: block; margin: 0 auto; max-width: 948px; width: 100%;">
									<div class="card-body">
										<form action="student_editrecord.php" class="form-horizontal"
											enctype="multipart/form-data" method="post">
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Full Name</label>
												<div class="col-sm-9">
													<input class="form-control" id="name" name="name"
														type="text" value="<?php echo $fullname?>"> <input
														class="form-control" id="id" name="id" type="hidden"
														value="<?php echo $idd?>">
												</div>
											</div>
											<div class="line"></div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Gender</label>
												<div class="col-sm-9">
													<div class="i-checks">
														<input <?php if($gender=='0'){ echo "checked"; } ?>
															class="radio-template" id="radioCustom1" name="gender"
															type="radio" value="0"> <label for="radioCustom1">Male</label>
													</div>
													<div class="i-checks">
														<input <?php if($gender=='1'){ echo "checked"; } ?>
															class="radio-template" id="radioCustom2" name="gender"
															type="radio" value="1"> <label for="radioCustom2">Female</label>
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="row">
												<label class="col-sm-3 form-control-label">Email ID</label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input class="input-material" id="register-email"
															name="email" type="email" value="<?php echo $email?>"> <label
															class="label-material" for="register-email">Email</label>
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="row">
												<label class="col-sm-3 form-control-label">Date of Birth</label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input name="dob" type="date" value="<?php echo $DOB;?>">
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="row">
												<label class="col-sm-3 form-control-label">Contact No.</label>
												<div class="col-sm-9">
													<input class="form-control" maxlength="10" name="contact"
														type="number" value="<?php echo $contact?>">
												</div>
											</div>
											<div class="line"></div>
											<label class="col-sm-3 form-control-label">Address</label>
											<div class="col-sm-9">
												<textarea class="form-control" name="address"
													placeholder="Edit Address"><?php echo $address?></textarea>
											</div>
											<div class="line"></div>
											<div class="row">
												<label class="col-sm-3 form-control-label">PIN Code</label>
												<div class="col-sm-9">
													<input class="form-control" maxlength="6" name="pincode"
														type="number" value="<?php echo $pincode?>">
												</div>
											</div>
											<div class="line"></div>
											<div class="row">
												<label class="col-sm-3 form-control-label">Source Station</label>
												<div class="col-sm-9">
													<input class="form-control" maxlength="30" name="source"
														type="text" value="<?php echo $source?>">
												</div>
											</div>
											<div class="line"></div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Destination
													Station</label>
												<div class="col-sm-9 select">
													<select class="form-control" name="destination">
														<option
															<?php if($destination=='Byculla Station'){ echo "selected"; } ?>>
															Byculla Station</option>
														<option
															<?php if($destination=='Sandhurst Road Stati'){ echo "selected"; } ?>>
															Sandhurst Road Station</option>
														<option
															<?php if($destination=='Dockyard Road'){ echo "selected"; } ?>>
															Dockyard Road</option>
														<option
															<?php if($destination=='Mumbai Central'){ echo "selected"; } ?>>
															Mumbai Central</option>
													</select>
												</div>
											</div>
											<div class="line"></div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Previous PassNo:<br>
													<small class="text-primary">If Exists</small></label>
												<div class="col-sm-9">
													<input class="form-control" id="passno" name="passno"
														placeholder="<?php echo $passno?>" type="text">
												</div>
											</div>
											<div class="line"></div>
											<img height="300px" src="img/Railway%20Pass.jpg" width="90%">
											<div class="line"></div>
											<div class="row">
												<label class="col-sm-3 form-control-label">Old Pass Expiry<br>
													<small class="text-primary">If Exists</small></label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input name="pass_end" type="date"
															value="<?php echo $pass_end?>">
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="row">
												<label class="col-sm-3 form-control-label">Old Voucher No:<br>
													<small class="text-primary">If Exists</small></label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input class="form-control" name='voucher'
															placeholder='<?php echo $voucher?>' type='text'
															value="<?php echo $voucher?>">
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="row">
												<label class="col-sm-3 form-control-label">Old Season Ticket
													no.<br> <small class="text-primary">If Exists</small>
												</label>
												<div class="col-sm-9">
													<div class="form-group-material">
														<input class="form-control" maxlength='4' name='season'
															placeholder='<?php echo $season?>' type='number'
															value="<?php echo $season?>">
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Class of travel</label>
												<div class="col-sm-9">
													<div class="i-checks">
														<input <?php if($classof=='First'){ echo "checked"; } ?>
															class="radio-template" id="radioCustom1" name="classof"
															type="radio" value="First"> <label for="radioCustom1">First
															Class</label>
													</div>
													<div class="i-checks">
														<input <?php if($classof=='Second'){ echo "checked"; } ?>
															class="radio-template" id="radioCustom2" name="classof"
															type="radio" value="Second"> <label for="radioCustom2">Second
															Class</label>
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Duration of Pass</label>
												<div class="col-sm-9">
													<div class="i-checks">
														<input checked class="radio-template" id="radioCustom1"
															name="duration" type="radio"
															value="<?php echo $duration?>"> <label for="radioCustom1">Monthly</label>
													</div>
													<div class="i-checks">
														<input class="radio-template" id="radioCustom2"
															name="duration" type="radio"
															value="<?php echo $duration?>"> <label for="radioCustom2">Quarterly</label>
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Branch of
													Academics</label>
												<div class="col-sm-9 select">
													<select class="form-control" name="branch">
														<option selected>															<?php echo $branch?>														</option>
														<option>Automobile</option>
														<option>Civil</option>
														<option>Computer Science</option>
														<option>Computer Science & Engineering - AI & ML</option>
														<option>Electronics Engineering</option>
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
														<input id="radioCustom1" type="radio"
															<?php if($year=='F.E'){ echo 'checked'; }?> value="F.E"
															name="year" class="radio-template" required> <label
															for="radioCustom1">First Year</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio"
															<?php if($year=='S.E'){ echo 'checked'; }?> value="S.E"
															name="year" class="radio-template" required> <label
															for="radioCustom2">Second Year</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio"
															<?php if($year=='T.E'){ echo 'checked'; }?> value="T.E"
															name="year" class="radio-template" required> <label
															for="radioCustom3">Third Year</label>
													</div>
													<div class="i-checks">
														<input id="radioCustom2" type="radio" value="B.E"
															<?php if($year=='B.E'){ echo 'checked'; }?> name="year"
															class="radio-template" required> <label
															for="radioCustom4">Bachelor Year</label>
													</div>
												</div>
											</div>
											<div class="line"></div>
											<div class="form-group row">
												<label class="col-sm-3 form-control-label">Semester</label>
												<div class="col-sm-9 select">
													<select class="form-control" name="semester">
														<option selected>															<?php echo $semester?>														</option>
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
											ONLY UPLOAD IF PREVOIUS IMAGE WAS WRONG ELSE LEAVE EMPTY
											<div class="form-group row">
												<label class="col-sm-3 form-control-label" for="fileInput">Upload
													<strong><strong>I-Kit</strong> Image with <strong><strong>Address
																Visible</strong></strong><br> <small><br> *MAX SIZE 1 MB<br>
															*Minimum Resolution: 100x100<br> *only JPEG/JPG Allowed<br>
															*Reference image below</small></strong>
												</label>
												<div class="col-sm-9">
													<input class="form-control-file" id="fileInput"
														name="UploadImage" onchange="readURL(this);" type="file" />
													<p id="error1" style="display: none; color: #FF0000;">Invalid
														Image Format! Image Format Must Be JPG, JPEG.</p>
													<p id="error2" style="display: none; color: #FF0000;">Maximum
														File Size Limit is 1MB.</p>
												</div>
											</div>
											<img alt="ID Reference" id="blah" src="img/card.jpg"
												width="90%">
											<div class="form-group row">
												<div class="col-sm-4 offset-sm-3">
													<input class="btn btn-primary" id="submit_form"
														name="student_editrecord" type="submit"
														value="Edit Record">
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
									<a href="mhssce.ac.in">MHSSCOE &copy; 2018</a>
								</p>
							</div>
							<div class="col-sm-6 text-right">
								<p>
									Developed by <a href="www.linkedin.com/in/danishayubkhan">Danish
										A. Khan</a> & <a
										href="https://www.linkedin.com/in/husain-amreliwala-121b5312b/">Husain
										Amrelivala</a>
								</p>
								<!--<p>Powered <a href="http://psychocodes.in" class="external">Psychocodes.in</a></p>-->
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div>
	<!-- JavaScript files-->
	<script src="vendor/jquery/jquery.min.js">	</script>
	<script src="vendor/popper.js/umd/popper.min.js">	</script>
	<script src="vendor/bootstrap/js/bootstrap.min.js">	</script>
	<script src="vendor/jquery.cookie/jquery.cookie.js">	</script>
	<script src="vendor/chart.js/Chart.min.js">	</script>
	<script src="vendor/jquery-validation/jquery.validate.min.js">	</script>
	<script>		$('button[type="submit"]').prop("disabled", true);		var a = 0;		//binds to onchange event of your input field		$('#fileInput').bind('change', function() {			if ($('button:submit').attr('disabled', false)) {				$('button:submit').attr('disabled', true);			}			var ext = $('#fileInput').val().split('.').pop().toLowerCase();			if ($.inArray(ext, ['jpg', 'jpeg']) == -1) {				$('#error1').slideDown("slow");				$('#error2').slideUp("slow");				a = 0;			} else {				var picsize = (this.files[0].size);				if (picsize > 1000000) {					$('#error2').slideDown("slow");					a = 0;				} else {					a = 1;					$('#error2').slideUp("slow");				}				$('#error1').slideUp("slow");				if (a == 1) {					$('button:submit').attr('disabled', false);				}			}		});				 function readURL(input) {        if (input.files && input.files[0]) {            var reader = new FileReader();            reader.onload = function (e) {                $('#blah')                    .attr('src', e.target.result)                    .width(250);            };            reader.readAsDataURL(input.files[0]);        }    }	</script>
	<!-- Main File-->
	<script src="js/front.js">	</script><?php }else{	echo "No data recrived";}?></body>
</html>