<?php
if(isset($_POST['student_edit'])){
	include('database_connection.php');
	mysqli_report(MYSQLI_REPORT_ALL);
	$idd = $_POST['id'];
	
	$sql_query = $db->prepare( "SELECT fullname, gender, semester, email, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, contact, address, pincode, source, destination, passno, DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end, voucher, season, classof, duration, branch, year, verified, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date 
	FROM student WHERE id=?") OR die('query preparation failed');
	
	$sql_query->bind_param('i',$idd);
	$sql_query->execute();
	
	$sql_query->bind_result($fullname, $gender, $semester, $email, $DOB, $dateOB, $contact, $address, $pincode, $source, $destination, $passno, $pass_end, $voucher, $season, $classof ,$duration, $branch, $year, $verified, $date_entry );
	$sql_query->fetch();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Form Edit Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name='author' content='Husain Amreliwala'>
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
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
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="studentsearch.php" name="search_s" method="POST">
              <input type="search" name="email_id" placeholder="Check Status of your form by Email ID...." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand -->
				<a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Railway </span><strong> Concession</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>Concession Form</strong></div></a>
              </div>
			  <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
				
				<!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>

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
                    
                      <img src="img/mhsccoe.jpg" alt="MHSSCOE Logo" align="middle" style="pointer-events: none; display:block; margin:0 auto;max-width:948px; width:100%; ">
                    
                    <div class="card-body">
                      <form action="student_editrecord.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Full Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $fullname?>"/></li>
							<input type="hidden" name="id" class="form-control" id="id" value="<?php echo $idd?>"/>
                          </div>
                        </div>
						
						<div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Gender</label>
                          <div class="col-sm-9">
                            <div class="i-checks">
                              <input id="radioCustom1" type="radio"  checked="" value="0" name="gender" class="radio-template">
                              <label for="radioCustom1">Male</label>
                            </div>
                            <div class="i-checks">
                              <input id="radioCustom2" type="radio" value="1" name="gender" class="radio-template">
                              <label for="radioCustom2">Female</label>
                            </div>
                          </div>
                        </div>
						
                        <div class="line"> </div>
                        
						<div class="row">
                          <label class="col-sm-3 form-control-label">Email ID</label>
                          <div class="col-sm-9">
                            <div class="form-group-material">
                              <input id="register-email" type="email" name="email" value="<?php echo $email?>" class="input-material">
                              <label for="register-email" class="label-material"><?php echo $email?></label>
                            </div>
						  </div>
						</div>
						<div class="line"></div>
						
						<div class="row">
                          <label class="col-sm-3 form-control-label">Date of Birth </label>
                          <div class="col-sm-9">
                            <div class="form-group-material">
                              <input type="date" name="dob" value="<?php echo $DOB?>"/>
                            </div>
						  </div>
						</div>
						<div class="line"></div>						
						
                        <div class="row">
                          <label class="col-sm-3 form-control-label">Contact No.</label>
                          <div class="col-sm-9">
                            <input type="number" name="contact" maxlength="10" class="form-control" value="<?php echo $contact?>">
                          </div>
                        </div>
                        
						<div class="line"></div>
						
                          <label class="col-sm-3 form-control-label">Address</label>
                          <div class="col-sm-9">
                            <textarea name="address" class="form-control" placeholder="<?php echo $address?>"  value="<?php echo $address?>" ></textarea>
                          </div>
						  
						<div class="line"></div>						
						
                        <div class="row">
                          <label class="col-sm-3 form-control-label">PIN Code</label>
                          <div class="col-sm-9">
                            <input type="number" name="pincode" maxlength="6" value="<?php echo $pincode?>" class="form-control" />
                          </div>
                        </div>
						
						<div class="line"></div>						
						
                        <div class="row">
                          <label class="col-sm-3 form-control-label">Source Station</label>
                          <div class="col-sm-9">
                            <input type="text" name="source" maxlength="30" value="<?php echo $source?>" class="form-control"/>
                          </div>
                        </div>
						
						<div class="line"></div>
                        
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Destination Station</label>
                          <div class="col-sm-9 select">
                            <select name="destination" class="form-control" value="<?php echo $destination?>">
                              <option>Byculla Station</option>
                              <option>Sandhurst Road Station</option>
                              <option>Dockyard Road</option>
                              <option>Mumbai Central</option>
                            </select>
                          </div>
						 </div>
						
						<div class="line"></div>
						
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Previous PassNo:<br/><small class="text-primary">If Exists</small></label>
                          <div class="col-sm-9">
                            <input type="text" name="passno" class="form-control" id="passno" placeholder="<?php echo $passno?>" /></li>
                          </div>
                        </div>
						
						<div class="line"></div>
						
						<img src="img/Railway Pass.jpeg" width=90% height="300px">
						
						<div class="line"></div>
						
						<div class="row">
                          <label class="col-sm-3 form-control-label">Old Pass Expiry <br> <small class="text-primary">If Exists</small></label>
                          <div class="col-sm-9">
                            <div class="form-group-material">
                              <input type="date" name="pass_end" value="<?php echo $pass_end?>" />
                            </div>
						  </div>
						</div>
						
						<div class="line"></div>
						
						<div class="row">
                          <label class="col-sm-3 form-control-label">Old Voucher No:<br><small class="text-primary">If Exists</small> </label>
                          <div class="col-sm-9">
                            <div class="form-group-material">
                              <input type='text' name='voucher' placeholder='<?php echo $voucher?>' value="<?php echo $voucher?>" class="form-control"/>
                            </div>
						  </div>
						</div>
						
						<div class="line"></div>
						
						<div class="row">
                          <label class="col-sm-3 form-control-label">Old Season Ticket no. <br><small class="text-primary">If Exists</small></label>
                          <div class="col-sm-9">
                            <div class="form-group-material">
                              <input type='number' maxlength='4' name='season' placeholder='<?php echo $season?>' value="<?php echo $season?>" class="form-control" />
                            </div>
						  </div>
						</div>						
						
						<div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Class of travel</label>
                          <div class="col-sm-9">
                            <div class="i-checks">
                              <input id="radioCustom1" type="radio"  checked="" value="<?php echo $classof?>" name="classof" class="radio-template">
                              <label for="radioCustom1">First Class</label>
                            </div>
                            <div class="i-checks">
                              <input id="radioCustom2" type="radio" value="<?php echo $classof?>" name="classof" class="radio-template">
                              <label for="radioCustom2">Second Class</label>
                            </div>
                          </div>
                        </div>
						
						<div class="line"></div>
						
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Duration of Pass</label>
                          <div class="col-sm-9">
                            <div class="i-checks">
                              <input id="radioCustom1" type="radio"  checked="" value="<?php echo $duration?>" name="duration" class="radio-template">
                              <label for="radioCustom1">Monthly</label>
                            </div>
                            <div class="i-checks">
                              <input id="radioCustom2" type="radio" value="<?php echo $duration?>" name="duration" class="radio-template">
                              <label for="radioCustom2">Quarterly</label>
                            </div>
                          </div>
                        </div>
						
						<div class="line"></div>
                        
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Branch of Academics</label>
                          <div class="col-sm-9 select">
                            <select name="branch" class="form-control" value="<?php echo $branch?>">
                              <option>Automobile</option>
                              <option>Civil</option>
                              <option>Computer Science</option>
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
                              <input id="radioCustom1" type="radio"  checked="" value="<?php echo $year?>" name="year" class="radio-template">
                              <label for="radioCustom1">First Year</label>
                            </div>
                            <div class="i-checks">
                              <input id="radioCustom2" type="radio" value="<?php echo $year?>" name="year" class="radio-template">
                              <label for="radioCustom2">Second Year</label>
                            </div>
							<div class="i-checks">
                              <input id="radioCustom2" type="radio" value="<?php echo $year?>" name="year" class="radio-template">
                              <label for="radioCustom3">Third Year</label>
                            </div>
							<div class="i-checks">
                              <input id="radioCustom2" type="radio" value="<?php echo $year?>" name="year" class="radio-template">
                              <label for="radioCustom4">Bachelor Year</label>
                            </div>
                          </div>
                        </div>
						
						<div class="line"></div>
                        
						<div class="form-group row">
                          <label class="col-sm-3 form-control-label">Semester</label>
                          <div class="col-sm-9 select">
                            <select name="semester" class="form-control" value="<?php echo $semester?>">
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
                          <div class="col-sm-4 offset-sm-3">
                            <input type="submit" class="btn btn-primary" name="student_editrecord" id="submit_form" value="Edit Record"/>
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
                  <p> <a href="mhssce.ac.in">MHSSCOE &copy; 2018 </a> </p>
                </div>
                <div class="col-sm-6 text-right">
				  <p>Developed by <a href="www.linkedin.com/in/danishayubkhan">Danish A. Khan </a>& <a href="https://www.linkedin.com/in/husain-amreliwala-121b5312b/">Husain Amrelivala</a></p>
                  <!--<p>Powered <a href="http://psychocodes.in" class="external">Psychocodes.in</a></p>-->

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
//binds to onchange event of your input field
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
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>