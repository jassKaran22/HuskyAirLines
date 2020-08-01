<?php 
/* seting up database connection include functions for actions like login and signup */

//create session to store form values of logged in user for profile page
session_start();
$_SESSION['validationErr'] = 'no';
$_SESSION['validationSignupErr'] = 'no';
$_SESSION['validationIssue'] = 'no';

/* create database connection */
function db () {
	$conn = mysqli_connect ("localhost", "root", "", "huskyairlines");
	return $conn;
}

//code for login 
if(isset($_POST['Login'])== 'login'){//print_r($_POST);die;
	$useremail = $password = $emailErr = $passworderr = $category = $categoryerr = $validating = "";
	$conn = db ();
	
	/* Client Side Validations */
	
	//email empty validation
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$useremail=$_POST['email'];
		if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Enter valid email format";
		}
	}
	
	//password empty validation
	if (empty($_POST['password'])) {
		$passworderr = "Password is required";
	} else {
		$password=$_POST['password'];
	}
	
	//category empty validation
	if (empty($_POST['categories'])) {
		$categoryerr = "Category is required";
	} else {
		$category=$_POST['categories'];
	}
	
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
	
	if(!empty($useremail) && !empty($password) && !empty($category)){//if fields are not empty
		if($category == 'pilot'){ //if pilot is getting logged in
			$ret= mysqli_query($conn,"SELECT * FROM pilot_info WHERE email='$useremail' and password='$password'");
			$num=mysqli_fetch_array($ret);
			if($num>0){
				$_SESSION['pilotid'] = $num['pilot_id'];
				$_SESSION['pilot_name'] = $num['Name'];
			}
		}else{  //if passenger is getting logged in
			$ret= mysqli_query($conn,"SELECT * FROM passenger_info WHERE email='$useremail' and password='$password'");
			$num=mysqli_fetch_array($ret);
			if($num>0){
				$_SESSION['passengerid'] = $num['passenger_id'];
				$_SESSION['passenger_name'] = $num['passenger_name'];
			}
		}
	
		if($num>0){//if fields data matched
			//$destination = "user_profiel.php";
			$_SESSION['validationErr'] = 'no';
			header("location:http://$host$uri");
			exit();
		}else{ //if fields data unmatched
			$_SESSION['validationErr'] = 'yes';
			$validating = "Invalid Username or Password!";
		}	
	}else{	 //if fields are empty
		$_SESSION['validationErr'] = 'yes';
	}	
	
}else if(isset($_POST['pilotSignup'])){ //Code for Pilots Registration
	$name = $email = $password = $experience = $gender = $contact = $addres = "";
	$nameErr = $emailErr = $passwordErr = $experienceErr = $genderErr = $contactErr = $adresErr = "";
	$conn = db ();
	
	/* Client Side Validations */
	
	//name empty and alphabets only validation
	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	} else {
		$name = $_POST["name"];
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Only letters and white spaces allowed";
		}
	}
	
	//email empty validation
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
	}
	
	//password empty validation
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} else {
		$password = $_POST['password'];
	}
		
	//experience empty check
	if(empty($_POST['experience'])){
		$experienceErr = "Experience is required";
	}else{
		$experience = $_POST['experience'];		
	}
	
	//gender empty validation
	if (empty($_POST["inlineRadioOptions"])) {
		$genderErr = "Gender is required";
	} else {
		$gender = $_POST['inlineRadioOptions'];
	}
	
	//contact empty and numbers only validation
	if (empty($_POST["contact"])) {
		$contactErr = "Contact Number is required";
	} else {
		$contact = $_POST['contact'];		
		if (!preg_match('/^([0-9]+)$/', ($_POST['contact']))) {
			$contactErr = "Only numbers allowed";
		}
	}
	
	//address empty validation
	if (empty($_POST["addres"])) {
		$adresErr = "Address is required";
	} else {
		$addres = $_POST['addres'];	
	}
	
	if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["experience"]) && !empty($_POST["inlineRadioOptions"]) && !empty($_POST["contact"]) && !empty($_POST["addres"])){ // if fields are not empty
		$msg = mysqli_query($conn,"insert into pilot_info(Name,Email,Password,Gender,Experience,Contact_num,Address) values('$name','$email','$password','$gender','$experience','$contact','$addres')");
		if($msg == 1){ // if fields are inserted
			$_SESSION['validationSignupErr'] = 'no';
			$to_email = $email;
			$subject = 'Registeration Sucessful!!';
			$body = 'Hello '.$name.', thank you for registering with us!';
			$headers = "From: sender's email";
			 
			if (mail($to_email, $subject, $body, $headers)) {
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
				header("location:http://$host$uri/");
				exit();
			} else {
				echo "Email sending failed...";
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
				header("location:http://$host$uri/");
				exit();
			}		
		}
	}else{ // if fields are empty	
		$_SESSION['validationSignupErr'] = 'yes';
	}		
}else if(isset($_POST['craftsignup'])){ //Code for plane registeration
	$name = $engnnum = $fuelcap = $guesCapacity = $lavatories = $cruiseSpeed = "";
	$nameErr = $enginnumErr = $fueleffciErr = $guesCapErr = $lavatoriesErr = $cruispeedErr = "";
	$conn = db ();
	
	//get user_id of curret logged in user
	if (!empty($_POST["logged_in_user"]) ) {
		$userid = $_POST["logged_in_user"];		
	}
	
	//plane name
	if (empty($_POST["name"])) {
		$nameErr = "Plane Name is required";
	} else {
		$name = $_POST['name'];
	}
	
	//plane name
	if (empty($_POST["engin_num"])) {
		$enginnumErr = "Engine Number is required";
	} else {
		$engnnum = $_POST['engin_num'];
	}
	
	//plane fuel efficiency
	if (empty($_POST["fuel_eff"])) {
		$fueleffciErr ='Fuel Efficiency is required';
	} else {
		$fuelcap=$_POST['fuel_eff'];		
	}
	
	//plane guest capacity
	if (empty($_POST["capacity"])) {
		$guesCapErr ='Guest Capacity is required';
	} else {
		$guesCapacity=$_POST['capacity'];		
	}
	
	//plane lavatories
	if (empty($_POST["lav"])) {
		$lavatoriesErr ='Number of Lavatories required';
	} else {
		$lavatories=$_POST['lav'];		
	}
	
	//plane cruise speed
	if (empty($_POST["cruiseSpeed"])) {
		$cruispeedErr ='Cruise Speed is required';
	} else {
		$cruiseSpeed=$_POST['cruiseSpeed'];		
	}
	
	if(!empty($_POST["logged_in_user"]) && !empty($_POST["name"]) && !empty($_POST["engin_num"]) && !empty($_POST["fuel_eff"]) && !empty($_POST["capacity"]) && !empty($_POST["lav"]) && !empty($_POST["cruiseSpeed"])){
		//if all fileds are not empty
		$msg = mysqli_query($conn,"insert into plane_info(pilot_id,plane_name,plane_engNum,plane_fuelcapacity,plane_guestcapacity,plane_lavatories,plane_cruisespeed) values('$userid','$name','$engnnum','$fuelcap','$guesCapacity','$lavatories','$cruiseSpeed')");
		if($msg == 1){ //if all fileds data inserted
			$destination = "planeReports.php";
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$destination");
			exit();
		}
	}else{ //if all fileds are empty
		$_SESSION['validationIssue'] = 'yes';	
	}	
}else if(isset($_POST['passengerSignup'])){ //Code for Passenger Registration 
	$name = $email = $password = $dateOfBirth = $gender = $contact = $addres = "";
	$nameErr = $emailErr = $passwordErr = $genderErr = $contactErr = $adresErr = "";
	$conn = db ();
	
	/* Client Side Validations */
	
	//name empty and alphabets only validation
	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	} else {
		$name = $_POST["name"];
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Only letters and white spaces allowed";
		}
	}
	
	//email empty validation
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
	}
	
	//password empty validation
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} else {
		$password = $_POST['password'];
	}
	
	//gender empty validation
	if (empty($_POST["inlineRadioOptions"])) {
		$genderErr = "Gender is required";
	} else {
		$gender = $_POST['inlineRadioOptions'];
	}
	
	//contact empty and numbers only validation
	if (empty($_POST["contact"])) {
		$contactErr = "Contact Number is required";
	} else {
		$contact = $_POST['contact'];		
		if (!preg_match('/^([0-9]+)$/', ($_POST['contact']))) {
			$contactErr = "Only numbers allowed";
		}
	}
	
	//address empty validation
	if (empty($_POST["addres"])) {
		$adresErr = "Address is required";
	} else {
		$addres = $_POST['addres'];	
	}
	
	if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["date"]) && !empty($_POST["inlineRadioOptions"]) && !empty($_POST["contact"]) && !empty($_POST["addres"])){ // if fields are not empty
		$msg = mysqli_query($conn,"insert into passenger_info(passenger_name,passenger_email,passenger_password,passenger_dob,passenger_gender,passenger_contact,passenger_address) values('$name','$email','$password','$dateOfBirth','$gender','$contact','$addres')");
		if($msg == 1){ // if fields are inserted
			$_SESSION['validationSignupErr'] = 'no';
			$to_email = $email;
			$subject = 'Registeration Sucessful!!';
			$body = 'Hello '.$name.', thank you for registering with us!';
			$headers = "From: sender's email";
			 
			if (mail($to_email, $subject, $body, $headers)) {
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
				header("location:http://$host$uri/");
				exit();
			} else {
				echo "Email sending failed...";
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
				header("location:http://$host$uri/");
				exit();
			}		
		}
	}else{ // if fields are empty	
		$_SESSION['validationSignupErr'] = 'yes';
	}		
}else if(isset($_POST['bookingflight'])){ //Code for Flight Registration 
print_r($_POST);die;
	$name = $all_flights = $date = $source = $destinatoin = $pasengers = "";
	$nameErr = $PrefErr = $dateErr = $sourceErr = $destinationErr = $pasengersErr = "";
	$conn = db ();
	
	/* Client Side Validations */
	
	//name empty and alphabets only validation
	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	} else {
		$name = $_POST["name"];
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Only letters and white spaces allowed";
		}
	}
		
	//password empty validation
	if (empty($_POST["password"])) {
		$flightNumErr = "Flight Number is required";
	} else {
		$flightNum = $_POST['password'];
	}
	
	//gender empty validation
	if (empty($_POST["inlineRadioOptions"])) {
		$genderErr = "Gender is required";
	} else {
		$gender = $_POST['inlineRadioOptions'];
	}
	
	//contact empty and numbers only validation
	if (empty($_POST["contact"])) {
		$contactErr = "Contact Number is required";
	} else {
		$contact = $_POST['contact'];		
		if (!preg_match('/^([0-9]+)$/', ($_POST['contact']))) {
			$contactErr = "Only numbers allowed";
		}
	}
	
	//address empty validation
	if (empty($_POST["addres"])) {
		$adresErr = "Address is required";
	} else {
		$addres = $_POST['addres'];	
	}
	
	if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["date"]) && !empty($_POST["inlineRadioOptions"]) && !empty($_POST["contact"]) && !empty($_POST["addres"])){ // if fields are not empty
		$msg = mysqli_query($conn,"insert into flight_info(flight_name,flight_num,flight_date,flight_source,flight_destination,flight_capacity) values('$name','$flightNum','$date','$source','$destination','$pasengers')");
		if($msg == 1){ // if fields are inserted
			$_SESSION['validationSignupErr'] = 'no';
			$to_email = $email;
			$subject = 'Booking Sucessful!!';
			$body = 'Hello '.$name.', thank you for booking with us!';
			$headers = "From: sender's email";
			 
			if (mail($to_email, $subject, $body, $headers)) {
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
				header("location:http://$host$uri/");
				exit();
			} else {
				echo "Email sending failed...";
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
				header("location:http://$host$uri/");
				exit();
			}		
		}
	}else{ // if fields are empty	
		$_SESSION['validationSignupErr'] = 'yes';
	}		
}

/* Get all flight names */
function get_all_flights(){
	$conn = db ();
	$sql = "SELECT flight_name FROM flight_info";
	$result = mysqli_query ($conn,$sql);
	if ($result->num_rows > 0) {
		echo '<option value="Default" selected>Select Flight</option>';
		while($row = $result->fetch_assoc()) {
			//print_r($row);
			if(isset($_POST["all_flights"])){		
				if($row["flight_name"] == $_POST["all_flights"]){
					$selected = 'selected';
				}else{
					$selected = '';
				}
			}else{
				$selected = '';
			}
			echo '<option value="'.$row["flight_name"].'"'. $selected.'>'.$row["flight_name"].'</option><br/>';
		}
	} else {
		echo "0 results";
	}
}

/* Get all flight sources */
function get_all_sources(){
	$conn = db ();
	$sql = "SELECT distinct flight_source FROM flight_info";
	$result = mysqli_query ($conn,$sql);
	if ($result->num_rows > 0) {
		echo '<option value="Default" selected>Select Source</option>';
		while($row = $result->fetch_assoc()) {
			if(isset($_POST["all_sources"])){		
				if($row["flight_source"] == $_POST["all_sources"]){
					$selected = 'selected';
				}else{
					$selected = '';
				}
			}else{
				$selected = '';
			}
			echo '<option value="'.$row["flight_source"].'"'.$selected.'>'.$row["flight_source"].'</option><br>';
		}
	} else {
		echo "0 results";
	}
}

/* Get all flight destinations */
function get_all_destinations(){
	$conn = db ();
	$sql = "SELECT distinct flight_destination FROM flight_info";
	$result = mysqli_query ($conn,$sql);
	if ($result->num_rows > 0) {
		echo '<option value="Default" selected>Select Destination</option>';
		while($row = $result->fetch_assoc()) {
			if(isset($_POST["all_destinations"])){		
				if($row["flight_destination"] == $_POST["all_destinations"]){
					$selected = 'selected';
				}else{
					$selected = '';
				}
			}else{
				$selected = '';
			}
			echo '<option value="'.$row["flight_destination"].'"'.$selected.'>'.$row["flight_destination"].'</option><br>';
		}
	} else {
		echo "0 results";
	}
}

/* Get record count enrolled onto the website for graphical representation */
function get_all_count(){
	$conn = db ();
	$sql_pilot = "SELECT count(*) FROM pilot_info";
	$pilots_count = mysqli_query ($conn,$sql_pilot);
	
	$resultset = array();
	$result = mysqli_fetch_assoc($pilots_count);
	$resultset['pilots'] = $result;
	
	$sql_planes = "SELECT count(*) FROM plane_info";
	$planes_count = mysqli_query ($conn,$sql_planes);
	$result1 = mysqli_fetch_assoc($planes_count);
	//print_r($result1);exit;
	//$resultset['planes'] .= $result1;
	
	
	
	//print_r($resultset);die;
	
	// while($rows = mysqli_fetch_assoc($result)) {
		// $resultset[] = $rows;		
	// }
	return $pilots_count;
}

/* Get all pilot records */
function get_pilot_records(){
	$conn = db ();
	$sql = "SELECT * FROM pilot_info";
	$result = mysqli_query ($conn,$sql);
	
	$resultset = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$resultset[] = $rows;		
	}
	return $resultset;
}

/* Get all aircraft records */
function get_aircraft_records(){
	$conn = db ();
	$sql = "SELECT pi.Name, pl.* FROM plane_info pl left join pilot_info pi on pl.pilot_id = pi.pilot_id";
	$result = mysqli_query ($conn,$sql);
	
	$resultset = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$resultset[] = $rows;		
	}
	return $resultset;
}

/* Get all hospital records */
function get_hospital_records(){
	$conn = db ();
	$sql = "SELECT * FROM hospital_info";
	$result = mysqli_query ($conn,$sql);

	$resultset = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$resultset[] = $rows;		
	}
	return $resultset;
}

/* Get all doctors record */
function get_doctors_record(){
	$conn = db ();
	$sql = "SELECT d.*, h.hos_name FROM doctor_info d left join hospital_info h on d.doc_hospital_id=h.hos_id";
	$result = mysqli_query ($conn,$sql);

	$resultset = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$resultset[] = $rows;		
	}
	return $resultset;
}

/* Get all passengers records */
function get_passenger_records(){
	$conn = db ();
	$sql = "SELECT * FROM passenger_info";
	$result = mysqli_query ($conn,$sql);

	$resultset = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$resultset[] = $rows;		
	}
	return $resultset;
}

/* Get all flight records */
function get_flight_records(){
	$conn = db ();
	$sql = "SELECT * FROM flight_info";
	$result = mysqli_query ($conn,$sql);

	$resultset = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$resultset[] = $rows;		
	}
	return $resultset;
}

/* Get all travel history */
function get_travel_history(){
	$conn = db ();
	$sql = "SELECT f.flight_name, f.flight_num,
			h.hos_name, 
			pi.passenger_name, 
			t.travel_date 
			FROM travel_history t 
			left join passenger_info pi 
			ON t.pasenger_id = pi.passenger_id 
			left join hospital_info h 
			ON t.hos_id = h.hos_id
			left join flight_info f 
			ON t.flight_id = f.flight_id";
	$result = mysqli_query ($conn,$sql);

	$resultset = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$resultset[] = $rows;		
	}
	return $resultset;
}
?>