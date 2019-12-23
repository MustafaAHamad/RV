
function updateProfilePicture() {
	var request = document.getElementById('ciFp0r7');
	const file = request.files[0];
	const fileType = file['type'];
	const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
	if (!validImageTypes.includes(fileType)) {
		alert('invalid image');
	} else {

		var successHandler = function() {
			window.location.assign("index.php");
			window.location = "index.php";
		}

		submitDataToServer("update icon", file, successHandler);
	}
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