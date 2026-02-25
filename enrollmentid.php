<?php $page_title = 'Enrollment Number'; ?>
<!DOCTYPE html>
<html>
  <head><?php require __DIR__ . '/includes/head.php'; ?></head>
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
                    <div class="title"><span>Read<br>Instruction Carefully</span>
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
						<small>Alternatively you will recieve a Mail when concession is prepared</small>
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
          <?php require __DIR__ . '/includes/footer.php'; ?>
        </div>
      </div>
    </div>
  </body>
</html>