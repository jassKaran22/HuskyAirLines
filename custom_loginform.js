/* CUSTOM JAVASCRIPT For LOGIN FORM*/

//when all fields empty, validation errors and classes
function allemptyfilds(){
	document.getElementById("email_err").innerHTML = "Email is required";
	document.getElementById("defaultForm-email").className += ' err_highlyt';
	document.getElementById("pass_err").innerHTML = "Password is required"; 
	document.getElementById("defaultForm-pass").className += ' err_highlyt';				
	document.getElementById("defaultForm-email").focus(); 
}
	
//when email is empty
function emailEmptyField(){
	document.getElementById("email_err").innerHTML = "Email is required";
	document.getElementById("defaultForm-email").className += ' err_highlyt';
	document.getElementById("defaultForm-email").focus(); 
	document.getElementById("pass_err").innerHTML = ""; 
	document.getElementById("defaultForm-pass").classList.remove('err_highlyt');
}
	
//when password is empty
function pswdEmptyField(){
	document.getElementById("pass_err").innerHTML = "Password is required"; 
	document.getElementById("defaultForm-pass").className += ' err_highlyt';
	document.getElementById("defaultForm-pass").focus(); 
	document.getElementById("email_err").innerHTML = "";
	document.getElementById("defaultForm-email").classList.remove('err_highlyt');
}
	
//on submit the loginform by clicking on submit button
function validateloginform() {
	// Storing Field Values In Variables
	var email = document.getElementById("defaultForm-email").value; //email field value
	var password = document.getElementById("defaultForm-pass").value; //password field value 
	
	// Regular Expression For Email
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			
	// Conditions
	if (email != '' && password != '') { //if fields have values
		if (email.match(mailformat)) {
			return true;
		} else {
			document.getElementById("email_err").innerHTML = "Enter a valid email address";
			document.getElementById("defaultForm-email").className += ' err_highlyt';
			document.getElementById("defaultForm-email").focus();
			return false;
		}
	} else if (email == '' && password != ''){ //if email is blank but pasword has value
		emailEmptyField();
		return false;  
	} else if (email != '' && password == ''){ //if password is blank but email has value
		pswdEmptyField();
		return false;  
	} else{  // if fields are empty
		allemptyfilds();
		return false;  	
	}
}

//call on key down (when user start writing to focussed field then it will clear the validation errors from respective field)
function getValue(evtobj) {
	var target = evtobj.target || evtobj.srcElement;
	var targetId = target.id;
	if(targetId == 'defaultForm-email'){
		document.getElementById("email_err").innerHTML = "";
		document.getElementById("defaultForm-email").classList.remove('err_highlyt');			
	}else if(targetId == 'defaultForm-pass'){
		document.getElementById("pass_err").innerHTML = "";
		document.getElementById("defaultForm-pass").classList.remove('err_highlyt');
	}
	return false;    
}

//call on key up (when user clear focussed field data using backspace key or delete key)
function getErasedValue(evtobj) {
	var target = evtobj.target || evtobj.srcElement;
	var targetId = target.id;
	if(document.getElementById(targetId).value ==""){
		validateloginform();
		return false;
	}
	return false;			
}	