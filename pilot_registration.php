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
                <a class="nav-link" href="http://localhost/medical/">
                  Home
                </a>
              </li>
			  <?php if(!empty($_SESSION['id'])){ ?>
				  <li class="nav-item">
					<a class="nav-link" href="logout.php">
					  Logout
					</a>
				  </li>
				  <?php 
				  //for redirection to profile page from home page
					$destination = "user_profiel.php";
					$host = $_SERVER['HTTP_HOST'];
					$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');					
				  ?>
				  <li class="nav-item active">
					<a class="nav-link" href="http://<?php echo $host.''.$uri.'/'.$destination;?>">
					  <?php echo 'Hello '.$_SESSION['name']; ?>
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
	  
	  </header>
    <!-- Header Area wrapper End -->
	
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
	  
	<!-- Pilot Registration form starts -->
	<div id="hero-area" class="hero-area-bg">
        <div class="container">
		<div class="pilot_reg" data-keyboard="false">
		  <div class="modal-dialog signupForm" role="document">
			<form name="mySignUpform" method="post" action="" onsubmit="return validatesignUpform()">
			<div class="modal-content">
			  <div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">Pilot Sign Up</h4>
				<button onclick="window.location.href='/HuskyAirLines/registrations.php'" type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>			  		  
			  <div class="modal-body mx-3">
			  <div class="section_a">
			  <?php 
			  if(isset($_POST['pilotSignup'])){
				//print_r($_POST);
			}
			//die;
			  ?>
				<!-- name field -->
				<div class="md-form mb-5">
				  <i class="lni-user"></i>
				  <input name="name" placeholder="Enter Name" value="<?php if(isset($_POST['pilotSignup'])){ echo $name;}?>" type="text" id="orangeForm-name" class="form-control validate" onkeydown="getSignUpValue(event)">
				  <label data-error="wrong" data-success="right" for="orangeForm-name">Name</label>
				  <span class="require">*</span>
				  <span class="error_msg" id="name_err"><?php if(isset($_POST['pilotSignup'])){echo $nameErr;}?></span>
				</div>
				<!-- email field -->
				<div class="md-form mb-5">
				  <i class="lni-envelope"></i>
				  <input name="email" placeholder="Enter Email" value="<?php if(isset($_POST['pilotSignup'])){ echo $email;}?>" type="text" id="orangeForm-email" class="form-control" onkeydown="getSignUpValue(event)">
				  <label data-error="wrong" data-success="right" for="orangeForm-email">Email</label>
				  <span class="require">*</span>
				  <span class="error_msg" id="email_signerror"><?php if(isset($_POST['pilotSignup'])){echo $emailErr;}?></span>
				</div>
				<!-- password field -->
				<div class="md-form mb-4">
				  <i class="lni-lock"></i>
				  <input name="password" placeholder="Enter Password" type="password" id="orangeForm-pass" class="form-control validate" onkeydown="getSignUpValue(event)">
				  <label data-error="wrong" data-success="right" for="orangeForm-pass">Password</label>
				  <span class="require">*</span>
				  <span class="error_msg" id="sigpaswd_err"><?php if(isset($_POST['pilotSignup'])){echo $passwordErr;}?></span>
				</div>
				
				</div>
				
				<div class="section_b">
				<!-- experience field -->
				<div class="md-form mb-4">
				  <i class="lni-calendar"></i>
				  <input type="text" value="<?php if(isset($_POST['pilotSignup'])){ echo $experience;}?>" name="experience" placeholder="Enter Number of Years" class="form-control validate">
				  <label data-error="wrong" data-success="right" for="orangeForm-exp">Experience</label>
				  <span class="require">*</span>
				  <span class="error_msg" id="exp_err"><?php if(isset($_POST['pilotSignup'])){echo $experienceErr;}?></span>				  
				</div>
				<!-- gender field -->
				<div class="md-form mb-4">
				  <div class="gender_radio">
					<input class="form-check-input" type="radio" checked="checked" name="inlineRadioOptions" id="radio1" value="M" <?php if (isset($_POST["pilotSignup"]) && ($_POST["inlineRadioOptions"] == 'M')) {echo 'checked="checked"';}?>>
					<label>Male</label>
				  </div>
                  <div class="gender_radio">				  
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio2" value="F" <?php if (isset($_POST["pilotSignup"]) && ($_POST["inlineRadioOptions"] == 'F')) {echo 'checked="checked"';}?>>
					<label>Female</label>
				   </div>
				   <div class="gender_radio">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio3" value="O" <?php if (isset($_POST["pilotSignup"]) && ($_POST["inlineRadioOptions"] == 'O')) {echo 'checked="checked"';}?>>
					<label>Other</label>
				  </div>
				  <label class="for_genders" data-error="wrong" data-success="right" for="orangeForm-gender">Gender</label>
				  <span class="require">*</span>
				  <span class="error_msg" id="siggendr_err"><?php if(isset($_POST['pilotSignup'])){echo $genderErr;}?></span>
				</div>
				<!-- contact field -->
				<div class="md-form mb-4">
				  <i class="lni-phone"></i>
				  <input type="text" placeholder="Enter Contact Number" value="<?php if(isset($_POST['pilotSignup'])){ echo $contact;}?>" name="contact" id="orangeForm-contact" class="form-control validate" maxlength="10" onkeydown="getSignUpValue(event)">
				  <label data-error="wrong" data-success="right" for="orangeForm-pass">Contact Number</label>
				  <span class="require">*</span>
				  <span class="error_msg" id="sigcontac_err"><?php if(isset($_POST['pilotSignup'])){echo $contactErr;}?></span>
				</div>
				</div>		
			  
			  <!-- address field-->
			  <div class="section_c">
				  <div class="md-form mb-8">
				  <i class="lni lni-home"></i>
					<textarea id="address" placeholder="Enter Address" value="<?php if(isset($_POST['pilotSignup'])){ echo $addres;}?>" name="addres" rows="1" cols="109"></textarea>
					<label data-error="wrong" data-success="right" for="orangeForm-adres">Address</label>
					<span class="require">*</span>
				    <span class="error_msg" id="sigadres_err"><?php if(isset($_POST['pilotSignup'])){echo $adresErr;}?></span>
				  </div>
			  </div>
			
			</div>
			  <!-- signup & cancel buttons -->
			  <div class="modal-footer d-flex justify-content-center">
				<input type="submit" value="Sign Up" class="btn btn-deep-orange custom_btn">
				<input type="hidden" name="pilotSignup">
			  </div>
			</div>
			</form>
		  </div>
		</div>
	  <!-- Sign Up form ends -->
		</div>
	</div>
	
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
                <li><a href="#">Hospitality</a></li>
                <li><a href="#">Emergency Care</a></li>
                <li><a href="#">Chamber Service</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <h3 class="footer-titel">Departments</h3>
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
    <script src="assets/js/jquery-3.1.1.min.js"></script>
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