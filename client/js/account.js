var defaultBorder = '#e0e7ec';
var errorBorder = 'var(--error-color)';

function checkField(fieldId){
	var fieldNode = document.getElementById(fieldId);
	
	if (fieldNode.value == '') {
		fieldNode.classList.add('ivRmJ82');
		return false;
	} else {
		fieldNode.classList.remove('ivRmJ82');
		return fieldNode.value;
	};
}

function checkForm(query, fields){
	var success = true;
	var request = {};

	for(var i = 0; i < fields.length; i++){
		var slot = query[i];
		var fieldName = fields[i];
		var fieldValue = checkField(fieldName);
		request[slot] = fieldValue;
		if(!fieldValue) success = false;
	}
	return (success) ? request : false;
}

function validateLogIn() {
	var request = checkForm(['email', 'password'], ['vRu4eTd', 'mGhuC2i']);
	if (!request) return false;

	var successHandler = function() {
		window.location.assign("home");
		window.location = "home";
	}

	submitDataToServer("login", request, successHandler);
	return false;
}

function validateSignUp() {
	var request = checkForm(['username', 'email', 'password'], ['uIrc50C', 'hF8uwEi', 'uR8cKm7']);
	if (!request) return false;

	if (request.password.length < 6) {
		document.getElementById('uR8cKm7').classList.add('ivRmJ82');
		return false;
	} else {
		document.getElementById('uR8cKm7').classList.remove('ivRmJ82');
	}

	var successHandler = function(){
		window.location.assign("index.php");
		window.location = "index.php";
	}

	submitDataToServer("signup", request, successHandler);
	return false;
}

function submitDataToServer(action, apiPayLoad, successHandler) {
	var apiRequest = {
		action : action,
		request_payload: apiPayLoad,
	};

	$.ajax({
		url: '',
		type: 'POST',
		contentType:'application/json',
		data: JSON.stringify(apiRequest),
		dataType:'json',

		success: function(data) {
			console.log(data);
			if (data.status == "Error") {
				alert('uh ohh!');
			}

			if (data.status == "Success!") {
				successHandler(data);
			}
		},

		error: function(xhr, ajaxOptions, thrownError) {
			if (xhr.status == 200) {
		    	alert(ajaxOptions);
			}
			else {
		    	alert(xhr.status);
		    	alert(thrownError);
			}
		},
	});
}