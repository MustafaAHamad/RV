<?php
	if(!$db) exit("SERVER | Error the database is not defined, this file is not for direct access.");

	// ERROR HANDLER
	function returnError($message){
		$response = array(
			"status" => "Error",
			"message" => $message
		);
		echo json_encode($response, JSON_PRETTY_PRINT);
		exit();
	}

	// READ INPUT
	$req = json_decode(file_get_contents('php://input'), true);

	if($req){
		// READ ACTION
		if(!isset($req['action'])) returnError("ERROR: No action requested.");
		$action = $req['action'];

		// READ API REQUEST
		if(!isset($req['request_payload'])) returnError("ERROR: No request payload provided.");
		$payload = $req['request_payload'];

		$response = array();

		switch($action){
			// SIGN UP
			case "signup" :

				$fields = array("name", "username", "email", "password");
				foreach($fields as $field){
					if(!isset($payload[$field]) || $payload[$field] == '') returnError("ERROR: Missing field:" . $field);
					$payload[$field] = mysqli_real_escape_string($db, $payload[$field]);
				}

				// EXTRACTION
				extract($payload);

				// VALIDATE EMAIL
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					echo $email . "\n\n";
					returnError("ERROR: Please provide a valid email");
				}

				// VALIDATE EMAIL IS NOT IN SYSTEM
				$sql = "SELECT * FROM users WHERE userEmail = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);
				if($resultCheck){
					returnError("ERROR: That email is already taken");
				}

				// VALIDATE INVALID CHARACTERS
				if(!preg_match("/^[a-zA-Z ]*$/", $name) || !preg_match("/^[a-zA-Z ]*$/", $username)){
					returnError("ERROR: Illegal characters");
				}

				// HASH PASSWORD
				$hashedpwd = md5($password);

				// COMPLETE REST LATER
			break;

			// LOGOUT
			case "logout" :
				session_unset();
				session_destroy();

				$response['status'] = "Success!";
			break;

			// DEFAULT
			default :
				returnError("Action not found.");
			break;
		}
		echo json_encode($response, JSON_PRETTY_PRINT);
		exit();
	}
?>