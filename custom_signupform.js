/* CUSTOM JAVASCRIPT For SIGNUP FORM*/

jQuery(document).ready(function(){ //loads when document get started
	//date picker for date of birth field
	$('#date').datepicker({
		autoclose: true
	});
});

/* =================  Signup Validation Starts ================= */

//when all fields empty, validation errors and classes
function allemptySignfilds(){
	document.getElementById("name_err").innerHTML = "Name is required";
	document.getElementById("orangeForm-name").className += ' err_highlyt';
	document.getElementById("email_signerror").innerHTML = "Email is required";
	document.getElementById("orangeForm-email").className += ' err_highlyt';
	document.getElementById("sigpaswd_err").innerHTML = "Password is required"; 
	document.getElementById("orangeForm-pass").className += ' err_highlyt';
	document.getElementById("sigcontac_err").innerHTML = "Contact is required"; 
	document.getElementById("orangeForm-contact").className += ' err_highlyt';
}
	
//when name is empty
function nameEmptyField(){
	document.getElementById("name_err").innerHTML = "Name is required";
	document.getElementById("orangeForm-name").className += ' err_highlyt';
	document.getElementById("orangeForm-name").focus(); 
	document.getElementById("email_signerror").innerHTML = "";
	document.getElementById("defaultForm-email").classList.remove('err_highlyt');
	document.getElementById("sigpaswd_err").innerHTML = ""; 
	document.getElementById("orangeForm-pass").classList.remove('err_highlyt');
	document.getElementById("sigcontac_err").innerHTML = ""; 
	document.getElementById("orangeForm-contact").classList.remove('err_highlyt');
}

//when email is empty
function emailSignEmptyField(){
	document.getElementById("email_signerror").innerHTML = "Email is required";
	document.getElementById("orangeForm-email").className += ' err_highlyt';
	document.getElementById("orangeForm-email").focus();
	document.getElementById("name_err").innerHTML = "";
	document.getElementById("orangeForm-name").classList.remove('err_highlyt');
	document.getElementById("sigpaswd_err").innerHTML = ""; 
	document.getElementById("orangeForm-pass").classList.remove('err_highlyt');
	document.getElementById("sigcontac_err").innerHTML = ""; 
	document.getElementById("orangeForm-contact").classList.remove('err_highlyt');
}
	
//when password is empty
function pswdSignEmptyField(){
	document.getElementById("sigpaswd_err").innerHTML = "Password is required"; 
	document.getElementById("orangeForm-pass").className += ' err_highlyt';
	document.getElementById("orangeForm-pass").focus();
	document.getElementById("name_err").innerHTML = "";
	document.getElementById("orangeForm-name").classList.remove('err_highlyt');
	document.getElementById("email_err").innerHTML = "";
	document.getElementById("defaultForm-email").classList.remove('err_highlyt');
	document.getElementById("sigcontac_err").innerHTML = ""; 
	document.getElementById("orangeForm-contact").classList.remove('err_highlyt');
}

//when contact is empty
function contactEmptyField(){
	document.getElementById("sigcontac_err").innerHTML = "Contact is required"; 
	document.getElementById("orangeForm-contact").className += ' err_highlyt';
	document.getElementById("orangeForm-contact").focus(); 
	document.getElementById("name_err").innerHTML = "";
	document.getElementById("orangeForm-name").classList.remove('err_highlyt');
	document.getElementById("email_err").innerHTML = "";
	document.getElementById("defaultForm-email").classList.remove('err_highlyt');
	document.getElementById("sigpaswd_err").innerHTML = ""; 
	document.getElementById("orangeForm-pass").classList.remove('err_highlyt');
}
	
//on submit the loginform by clicking on submit button
function validatesignUpform() {
	// Storing Field Values In Variables
	var name = document.getElementById("orangeForm-name").value; //get name field value
	var email = document.getElementById("orangeForm-email").value; //get email field value
	var password = document.getElementById("orangeForm-pass").value; //get password field value  
	var checkRadio = document.querySelector( 'input[name="inlineRadioOptions"]:checked');
	var gender = checkRadio.value; // get gender field value
	var contact = document.getElementById("orangeForm-contact").value; //get contact field value
	
	// Regular Expression For Name (only alphabets allowed)
	var nameformat = /^[A-Za-z]+$/;
	
	// Regular Expression For Email
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	
	// Regular Expression For Contact (only numbers allowed)
	var contactformat = /^\d{10}$/;
				
	//conditions
	if (name != '' && email != '' && password != '' && gender != '' && contact != '') { 
		//if all fields have values
		if (email.match(mailformat)) { // if mail format correct
			
			if (name.match(nameformat)) { // if name contain characters only
				
				if (contact.match(contactformat)) { // if contact contain numbers only			
					return true;
				} else { // if concat not contain numbers only
					document.getElementById("sigcontac_err").innerHTML = "Only numbers allowed"; 
					document.getElementById("orangeForm-contact").className += ' err_highlyt';
					document.getElementById("orangeForm-contact").focus();
					return false;
				}	
			}else{
				document.getElementById("name_err").innerHTML = "Characters are allowed";
				document.getElementById("orangeForm-name").className += ' err_highlyt';
				document.getElementById("orangeForm-name").focus(); 
				return false;	
			}			
		}else{
			document.getElementById("email_signerror").innerHTML = "Enter a valid email address";
			document.getElementById("orangeForm-email").className += ' err_highlyt';
			document.getElementById("orangeForm-email").focus();
			return false;
		}	
	}else if(name == '' && email == '' && password == '' && gender != '' && contact == ''){
		//if all fields have values except gender
		allemptySignfilds();
		return false;
	}else if(name == ''){
		//if all fields have values except name
		nameEmptyField();
		return false;
	}else if(email == ''){
		//if all fields have values except email
		emailSignEmptyField();		
		return false;
	}else if(password == ''){
		//if all fields have values except password
		pswdSignEmptyField();
		return false;
	}else if(contact == ''){
		//if all fields have values except contact
		contactEmptyField();
		return false;
	}	
}

//call on key down (when user start writing to focuseed field the it will clear the validation errors from respective field)
function getSignUpValue(evtobj) {
	var target = evtobj.target || evtobj.srcElement;
	var targetId = target.id;
		
	if(targetId == 'orangeForm-name'){
		document.getElementById("name_err").innerHTML = "";
		document.getElementById("orangeForm-name").classList.remove('err_highlyt');	
	}else if(targetId == 'orangeForm-email'){
		document.getElementById("email_signerror").innerHTML = "";
		document.getElementById("orangeForm-email").classList.remove('err_highlyt');
	}else if(targetId == 'orangeForm-pass'){
		document.getElementById("sigpaswd_err").innerHTML = "";
		document.getElementById("orangeForm-pass").classList.remove('err_highlyt');
	}else if(targetId == 'orangeForm-contact'){
		document.getElementById("sigcontac_err").innerHTML = "";
		document.getElementById("orangeForm-contact").classList.remove('err_highlyt');
	}
	return false;    
}