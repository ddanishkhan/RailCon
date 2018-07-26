<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Enrollment Number</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <div class="page-content d-flex align-items-stretch"> 

        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Concession Form Number</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span>Enrollment<br>Number</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong>
					</html>
					<?php
					session_start();
					if (!isset($_SESSION['enroll_id'])){
						echo '<a href="http://railcon.epizy.com/studentsearch.html"> Form Status</a>';
					}
					else{
					echo '#'.$_SESSION['enroll_id'];
					 unset($_SESSION['enroll_id']);
					}
					?>
					<html>
					</strong></div>
                  </div>
                </div>
              </div>
            </div>
          </section>
		  <section class="projects no-padding-top">
            <div class="container-fluid">
              <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                      <div class="text">
                        <h3 class="h4">Please Note Down this Enrollment Number</h3>
						<small>You need to show this number in the office to get your concession</small>
                      </div>
                    </div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i>Office closed from 1:00 PM to 2:00 PM</div>
                    <div class="comments"></div>
                  </div>
                </div>
              </div>
			  
			  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                      <div class="text">
                        <h3 class="h4">Check Status of you form at <a href="http://railcon.epizy.com/studentsearch.html"> Form Status</a></h3>
						<small>Alternatively you will recieve a mail</small>
                      </div>
                    </div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i>Keep checking Remark on <a href="http://railcon.epizy.com/studentsearch.html">Form Status</a> in case there are any isuues</div>
                    <div class="comments"></div>
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
                  <p>MHSSCOE &copy; 2018</p>
                </div>
                <div class="col-sm-6 text-right">
                  <p>Powered by <a href="https://psychocodes.in" class="external">PsychoCodes</a></p>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
  </body>
</html>