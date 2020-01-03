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

				$fields = array('username', 'email', 'password');
				foreach ($fields as $field) {
					if (!isset($payload[$field]) || $payload[$field] == '') {
						returnError("ERROR: Missing field: " . $field);
					}
					$payload[$field] = mysqli_real_escape_string($db, $payload[$field]);
				}

				// EXTRACTION
				extract($payload);

				// VALIDATE EMAIL
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo $email . "\n\n";
					returnError("ERROR: Please provide a valid email");
				}

				// VALIDATE EMAIL IS NOT IN SYSTEM
				$sql = "SELECT * FROM user WHERE email = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);
				if($resultCheck){
					returnError("ERROR: That email is already taken");
				}

				// VALIDATE INVALID CHARACTERS
				if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
					returnError("ERROR: Illegal characters");
				}

				// HASH PASSWORD
				$hashedpwd = md5($password);

				$sqlnewUser = "INSERT INTO user (email, username, password, icon) VALUES ('$email','$username','$hashedpwd', 1)";
				mysqli_query($db, $sqlnewUser);
				$newUserId =  mysqli_insert_id($db);

				if(!$newUserId) {
					$error = "Database error: unable to create user.";
					if($debugMode) $error .= "\n\n" . $sqlnewUser;
					returnError($error);
				};

				$sql = "SELECT * FROM user WHERE email = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($user = mysqli_fetch_assoc($result)){

				$_SESSION['user'] = $sqlnewUser;
					$response = array(
						"status" => "Success!",
						"insert_id" => $newUserId,
					);
				}
			break;

			// LOGIN
			case "login":
				$fields = array("email", "password");
				foreach ($fields as $field) {
					if (!isset($payload[$field]) || $payload[$field] == '') {
						returnError("ERROR: Missing field: " . $field);
					}
					$payload[$field] = mysqli_real_escape_string($db, $payload[$field]);
				}

				extract($payload);

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					returnError("ERROR: Invalid email.");
				}

				$sql = "SELECT * FROM user WHERE email = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);
				if(!$resultCheck){
					returnError("User not found.");
				}

				$hashedpwd = md5($password);

				if($user = mysqli_fetch_assoc($result)){
					if($user['password'] != $hashedpwd) returnError("ERROR: Incorrect password");
					$_SESSION['user'] = $user;
					$response = array(
						"status" => "Success!",
						"message" => "Your session has been set on the server.",
						"user" => $user
					);
				}
			break;

			// LOGOUT
			case "logout" :
				session_unset();
				session_destroy();

				$response['status'] = "Success!";
			break;

			case "profile picture":
				$id = $user['id'];
				$file = $_FILES['file']['name'];
				$fileTmpName = $_FILES['file']['tmp_name'];
				$fileSize = $_FILES['file']['size'];
				$fileError = $_FILES['file']['error'];
				$fileType = $_FILES['file']['type'];

				$fileExt = explode('.', $fileName);
				$fileActualExt = strtolower(end($fileExt));

				$format = array('jpg', 'jpeg', 'png', 'pdf');

				if (in_array($fileActualExt, $format)) {
					if ($fileError === 0) {
						if ($fileSize < 1000000) {
							$fileNameNew = 'profile'.$id. '.'.$fileActualExt;
							$fileDestination = 'client/img/icon/'.$fileNameNew;
							move_uploaded_file($fileNameNew, $fileDestination);
							$sql = "UPDATE user SET icon = 0 WHERE id = '$id'";
							$result = mysqli_query($db, $sql);
							header("Location: account.php?uploadsuccess");
						}
					}
				}
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