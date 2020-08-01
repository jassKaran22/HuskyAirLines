 <?php require_once('connection.php'); ?>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Husky Air Lines</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
    <!-- Date Picker Style -->
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css"/>
	<!-- Icon -->
    <link rel="stylesheet" href="assets/fonts/line-icons.css">
	<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.css">    
    <!-- Animate -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- Responsive Style -->
    <link rel="stylesheet" href="assets/css/responsive.css">
	
	<script src="assets/js/jquery-3.1.1.min.js"></script>
		
  </head>
  <body>
    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a href="http://localhost/HuskyAirLines/" class="navbar-brand"><img src="assets/img/air_logo.png" alt="">
			<span><b>HUSKY AIRLINES</b></span>
		  </a>       
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni-menu"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
              <li class="nav-item active">
                <a class="nav-link" href="http://localhost/HuskyAirLines/">
                  Home
                </a>
              </li>
			  <?php if(!empty($_SESSION['pilotid'])){ ?>
				  <li class="nav-item">
					<a class="nav-link" href="logout.php">
					  Logout
					</a>
				  </li>
				  <?php 
				  //for redirection to profile page from home page
					$destination = "plane_registration.php";
					$host = $_SERVER['HTTP_HOST'];
					$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');					
				  ?>
				  <li class="nav-item active">
					<a class="nav-link" href="http://<?php echo $host.''.$uri.'/'.$destination;?>">
					  <?php echo 'Hello '.$_SESSION['pilot_name']; ?>
					</a>                
				  </li>	
			  <?php }else{ ?>
				  <li class="nav-item">
					<a class="nav-link" data-toggle="modal" data-target="#myForm" href="">
					  Login
					</a>
				  </li>
			  <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Navbar End -->
	  
	  <!-- Login form starts -->				  
		 <div class="modal login fade" id="myForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog" role="document">
		  <form name="myform" method="post" action="" onsubmit="return validateloginform()">
			<div class="modal-content">
			  <div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">Sign In</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body mx-3">
				<h3 class="error_msg_login"><?php if(isset($_POST['Login'])){echo $validating;}?></h3>
				<!-- email field -->
				<div class="md-form mb-5">
				  <i class="lni-envelope"></i>
				  <input name="email" placeholder="Enter Email" value="<?php if(isset($_POST['Login'])){echo $useremail;}?>" type="text" id="defaultForm-email" class="form-control" onkeydown="getValue(event)" onkeyup="getErasedValue(event)">
				  <label data-error="wrong" data-success="right" for="defaultForm-email">Your Email</label>
				  <span class="require">*</span>
				  <span id="email_err" class="error_msg"><?php if(isset($_POST['Login'])){echo $emailErr;}?></span>
				</div>
				<!-- password field -->
				<div class="md-form mb-4">
				  <i class="lni-lock"></i>
				  <input name="password" placeholder="Enter Password" type="password" id="defaultForm-pass" class="form-control" onkeydown="getValue(event)" onkeydown="getValue(event)" onkeyup="getErasedValue(event)">
				  <label data-error="wrong" data-success="right" for="defaultForm-pass">Your Password</label>
				  <span class="require">*</span>
				  <span id="pass_err" class="error_msg"><?php if(isset($_POST['Login'])){echo $passworderr;}?></span>
				</div>
				<!-- category field -->
				<div class="md-form mb-4">
					<select class="cat_login" name="categories" id="categor">
					  <option value="select">Select Category</option>
					  <option value="pilot">Pilot</option>
					  <option value="passenger">Passenger</option>
					</select>
				  <label for="categories" data-error="wrong" data-success="right" for="defaultForm-pass">Select Category</label>
				  <span class="require">*</span>
				  <span id="pass_err" class="error_msg"><?php if(isset($_POST['Login'])){echo $passworderr;}?></span>
				</div>

			  </div>
			  <!-- submit login button -->
			  <div class="modal-footer d-flex justify-content-center">
				<input name="Login" type="submit" id="login_btn" value="login" class="btn btn-default custom_btn">
				<input type="hidden" value="login">
			  </div>
			</div>
			</form>
		  </div>
		</div>
	  <!-- Login form ends -->
	  	  
      <!-- Hero Area Start -->
      <div id="hero-area" class="hero-area-bg">
        <div class="container">      
          <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
              <div class="contents">				
                <h2 class="head-title">Health Care From Husky</h2>
				<span class="subhead">For whole family</span>
                <p class="headingp">In health care sector, service excellence is the facility of the hospital as healthcare service provider to consistently.</p>               
              </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
              <div class="intro-img">
                <div class="button_registration">
					<button onclick="window.location.href='/HuskyAirLines/registrations.php'">START REGISTRATION >></button>
				</div>
              </div>            
            </div>
          </div> 
        </div> 
      </div>
      <!-- Hero Area End -->

    </header>
    <!-- Header Area wrapper End -->
	
	<!-- About Section start -->
    <div class="about-area section-padding bg-gray">
      <div class="container">
        <div class="row">
		<!-- images of the section -->
          <div class="col-lg-6 col-md-12 col-xs-12 wow fadeInRight" data-wow-delay="0.3s">
            <div id="piechart"></div>
          </div>
		  <!-- content of the section -->
		  <div class="col-lg-6 col-md-12 col-xs-12 info">
            <div class="about-wrapper wow fadeInLeft" data-wow-delay="0.3s">
              <div>
                <div class="site-heading">
                  <h2 class="section-title">Welcome to Husky Services</h2>
				  <div class="shape wow fadeInDown" data-wow-delay="0.3s"></div>
                </div>
                <div class="content">
					<h3>For Your Good Health</h3>
                  <p>
                    Check out the graphical representation of how we serve all of our patients and workers to improve the facilities for needed ones. We care about your health.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- About Section End -->
	<?php
	//get all values inserted onto the website for graphical representation
	$res = get_all_count();
	
	
	$pilots = count(get_pilot_records());
	$planes = count(get_aircraft_records());
	$flights = count(get_flight_records());
	$hospitals = count(get_hospital_records());
	$doctors = count(get_doctors_record());
	$passengers = count(get_passenger_records());
	$travelling = count(get_travel_history());
	?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		// Load google charts
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable([
		  ['Pilots', ''],
		  ['Aircrafts', 4],
		  ['Flights', 4],
		  ['Hospitals', 3],
		  ['Doctors', 9],
		  ['Passengers', 12],
		  ['Travelling Ratio', 10]
		]);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		  chart.draw(data, options);
		}
	</script>
	<!-- All Departments Graphics Chart Ends -->
	
	<!-- All Departments Section Start -->
    <section id="features" class="section-padding">
      <div class="container">
        <div class="section-header text-center">          
          <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">All Reports</h2>
          <div class="shape wow fadeInDown" data-wow-delay="0.3s"></div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="content-left">
              <div class="box-item wow fadeInLeft" data-wow-delay="0.3s">
                <div class="text">
                  <a target="_blank" href="/HuskyAirLines/pilotReports.php"><h4>Pilot Reports</h4>
                  <p>Click to get all pilot records</p></a>
                </div>
              </div>
              <div class="box-item wow fadeInLeft" data-wow-delay="0.6s">
                <div class="text">
                  <h4><a target="_blank" href="/HuskyAirLines/planeReports.php">Air Craft Reports</a></h4>
                  <p>Click to get all air craft records</p>
                </div>
              </div>
              <div class="box-item wow fadeInLeft" data-wow-delay="0.9s">
                <div class="text">
                  <h4><a target="_blank" href="/HuskyAirLines/hospitalReports.php">Hospital & Doctor Reports</a></h4>
                  <p>Click to get all hospital and doctors records</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="show-box wow fadeInUp" data-wow-delay="0.3s">
              <img src="assets/img/center.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="content-right">
              <div class="box-item wow fadeInRight" data-wow-delay="0.3s">
                <div class="text">
                  <h4><a target="_blank" href="/HuskyAirLines/passengerReports.php">Passenger Reports</a></h4>
                  <p>Click to get all passenger records</p>
                </div>
              </div>
              <div class="box-item wow fadeInRight" data-wow-delay="0.6s">
                <div class="text">
                  <h4><a target="_blank" href="/HuskyAirLines/flightReports.php">Flight Reports</a></h4>
                  <p>Click to get all flight records</p>
                </div>
              </div>
              <div class="box-item wow fadeInRight" data-wow-delay="0.9s">
                <div class="text">
                  <h4><a target="_blank" href="/HuskyAirLines/travelReports.php">Travel History</a></h4>
                  <p>Click to get all travelling records</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Departments Section End -->   

    <!-- Footer Section Start -->
    <footer id="footer" class="footer-area section-padding">
      <div class="container">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="footer-logo"><a class="nav-link" href="http://localhost/HuskyAirLines/"><img src="assets/img/air_logo.png" alt="">
				<span><b>HUSKY AIRLINES</b></span></a></h3>
                <div class="textwidget">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <h3 class="footer-titel">Services</h3>
              <ul class="footer-link">
                <li><a href="#">Emergency Flights</a></li>
                <li><a href="#">Organs Transplantation</a></li>
                <li><a href="#">Experienced Doctors</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <h3 class="footer-titel">Reports</h3>
              <ul class="footer-link">
                <li><a target="_blank" href="/HuskyAirLines/pilotReports.php">Pilots</a></li>
                <li><a target="_blank" href="/HuskyAirLines/planeReports.php">Air Crafts</a></li>
                <li><a target="_blank" href="/HuskyAirLines/hospitalReports.php">Hospitals & Doctors</a></li>
                <li><a target="_blank" href="/HuskyAirLines/passengerReports.php">Passengers</a></li>
                <li><a target="_blank" href="/HuskyAirLines/flightReports.php">Flights</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <h3 class="footer-titel">Contact</h3>
              <ul class="address">
                <li>
                  <a href="#"><i class="lni-map-marker"></i> 105 Madison Avenue - <br> Third Floor New York, NY 10016</a>
                </li>
                <li>
                  <a href="#"><i class="lni-phone-handset"></i> P: +84 846 250 592</a>
                </li>
                <li>
                  <a href="#"><i class="lni-envelope"></i> E: contact@cloud.com</a>
                </li>
              </ul>
            </div>
          </div>
        </div>  
      </div> 
      <div id="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="copyright-content">
                <p>Copyright ©2020 Cloud Computing Third Semester</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>   
    </footer> 
    <!-- Footer Section End -->

    <!-- Go to Top Link -->
    <a href="#" class="back-to-top">
    	<i class="lni-arrow-up"></i>
    </a>
    
    <!-- Preloader -->
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/jquery.nav.js"></script>
    <script src="assets/js/scrolling-nav.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>  
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-validator.min.js"></script>
    <script src="assets/js/contact-form-script.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.min.js"></script>
	
	<!-- custom script for login popup validations -->
	<script src="custom_loginform.js"></script>
	
	<!-- custom script for signup popup validations -->
	<script src="custom_signupform.js"></script>
    
		<!--* Cutom Script *-->
		<script type="text/javascript">
		jQuery(document).ready(function(){			
			//open login form after validation error check on server side
			<?php if($_SESSION['validationErr'] == 'yes'){?>
				$( "#myForm" ).modal('show');
				return false;			
			<?php }
			//open registration form after validation error check on server side
			if($_SESSION['validationSignupErr'] == 'yes'){ ?>
				$( "#modalRegisterForm" ).modal('show');
				return false;
		<?php } ?>
		});		
		</script>
  </body>
</html>