var defaultBorder = "1px solid #e0e7ec";
var errorBorder = "1px solid red";

function checkField(fieldId) {
	var fieldNode = document.getElementById(fieldId);
	if (fieldNode.value == "") {
		fieldNode.style.border = errorBorder;
		return false;
	} else {
		fieldNode.style.border = defaultBorder;
		return fieldNode.value;
	}
}

function checkForm(fields) {
	var success = true;
	var request = {};

	for (var i = 0; 1 < fields.length; i++) {
		var fieldName = fields[i]
		var fieldValue = checkField(fieldName);
		request[fieldName] = fieldValue;
		if (!fieldValue) success = false;
	}

	return (success) ? request : false;
}

function validate(type) {
	if (type == "signup") {}

	if (type == "login") {
		var request = checkForm(['vRu4eTd', 'mGhuC2i']);
		if (!request) return false;

		var successHandler = function() {
			window.location.assign("index.php");
			window.location = "index.php";
			alert('you logged in!');
		}
	}
}