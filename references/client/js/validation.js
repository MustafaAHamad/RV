// Locals
var passwordLimit = 6;
var normalBorder = "1px solid #b8bbbb";
var errorBorder = "1px solid red";
var errorBackground = "#ffeded";
var normalBackground = "none";
var selectedError;
var selectedForum = "none";
var signupbtn = document.getElementById("signup_formOption");
	signupform = document.getElementById("signup_form");
var loginbtn = document.getElementById("login_formOption");
	loginform = document.getElementById("login_form");
var resetpwdbtn = document.getElementById("resetpwdbtn");

	var resetform = document.getElementById("requestResetEmail_form");

// Function
	function changeTab(type){
		if(type == "signup_view"){
			signupbtn.classList.add("active");	
			loginbtn.classList.remove("active");

			loginform.setAttribute("hidden","true");
			resetform.setAttribute("hidden","true");
			signup_form.removeAttribute("hidden");
		};
		if(type == "login_view"){
			loginbtn.classList.add("active");	
			signupbtn.classList.remove("active");

			signupform.setAttribute("hidden","true");
			resetform.setAttribute("hidden","true");
			loginform.removeAttribute("hidden");
		};
		if(type == "reset_view"){
			signupform.setAttribute("hidden","true");
			loginform.setAttribute("hidden","true");
			resetform.removeAttribute("hidden");
		};
	};


	function checkField(fieldId){
		var fieldNode = document.getElementById(fieldId);
		
		if(fieldNode.value == ""){
			fieldNode.style.background = errorBackground;
			return false;
		}else{
			fieldNode.style.background = normalBackground;
			return fieldNode.value;
		};
	}


	function checkForm(fields, formName){
		var goAhead = true;
		var req = {};

		for(var i=0; i < fields.length; i++){
			var fieldName = fields[i];

			var fieldValue = checkField(formName + '_' + fieldName + 'Input');
			
			req[fieldName] = fieldValue;
			
			if(!fieldValue) goAhead = false;
		}


		return (goAhead) ? req : false;
	}




	function validate(type){



		// VALIDATE SIGNUP FORM
		if(type == "signup"){
		
			var fields = ['firstName', 'lastName', 'email', 'password', 'confirmPassword'];
			var request = checkForm(fields, 'signup');

			if(!request) return false;


			if(request.password  != request.confirmPassword) {
				document.getElementById("signup_confirmPasswordInput").style.background = errorBackground;
				return false;
			}
			else {
				document.getElementById("signup_confirmPasswordInput").style.background = normalBackground;
			}

			var successHandler = function(){
				$('#error_container').html('');
				$('#signup_form').hide();
				$('#success_container').html("Welcome to JobQuery.org!");	
			}

		};


		// VALIDATE LOGIN
		if(type == "login"){

			var request = checkForm(['email', 'password'], 'login');
			if(!request) return false;

			var successHandler = function(response){
<<<<<<< HEAD
				window.location.assign("index-desktop.php");
=======
				
				window.location = "index-desktop.php";
>>>>>>> f41cea04ed5477bf33e2da9c5cd8b04defb21a5f
			}

		};


		// VALIDATE RESET EMAIL
		if(type == "requestResetEmail"){
			var request = checkForm(['email'], 'requestResetEmail');
			if(!request) return false;
		};


		// VALIDATE RESET PASSWORD
		if(type == "resetPassword"){
	
			var request = checkForm(["code","email","newPassword","passwordConfirmation"], 'reset');
			if(!request) return false;

			if(request.password != request.retypePassword){
				document.getElementById("reset_passwordConfirmationInput").style.background = errorBackground;
				return false;
			}else{
				document.getElementById("reset_passwordConfirmationInput").style.background = normalBackground;
			};
		};


		// ALL GOOD!!!

		var action = type;


		console.log("This is what we want to send to the server:");

		console.log(request);

		console.log(action);


		submitDataToServer(action, request, successHandler)

		return false;
	};


	function submitDataToServer(action, apiPayload, successHandler){
		var apiRequest = {
			action : action,
			request_payload: apiPayload
		};

		$.ajax({
			url: '',
			type: 'POST',
			contentType:'application/json',
			data: JSON.stringify(apiRequest),
			dataType:'json',

			success: function(data){
				//On ajax success do this
				console.log(data);

				if(data.status == "Error"){
					$('#error_container').html(data.message);
				}

				if(data.status == "Success!"){
					successHandler(data);
				}

			},

			error: function(xhr, ajaxOptions, thrownError) {
				//On error do this
				if (xhr.status == 200) {
			    	alert(ajaxOptions);
				}
				else {
			    	alert(xhr.status);
			    	alert(thrownError);
				}
			}
		});
	}



