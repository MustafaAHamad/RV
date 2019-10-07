<?php

	if(!$db) exit("Database is not defined. This file is not for direct access.");


	// Define "error handler"
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
		if(!isset($req['action'])) returnError("No action requested.");
		$action = $req['action'];


		// READ API REQUEST
		if(!isset($req['request_payload'])) returnError("No request payload provided.");
		$payload = $req['request_payload'];

		$response = array();


		switch($action){


			// REGISTER NEW USER
			case "signup" :
			

				$fields = array("firstName", "lastName", "email", "password");
				foreach($fields as $f){
					if(!isset($payload[$f]) || $payload[$f] == '') returnError("Missing field:" . $f);
					$payload[$f] = mysqli_real_escape_string($db, $payload[$f]);
				}


				// Extract it
				extract($payload);


				// Additional validation tests...

				// Check first and last name for invalid characters.
				if(!preg_match("/^[a-zA-Z ]*$/", $firstName) || !preg_match("/^[a-zA-Z ]*$/", $lastName)){
					returnError("ERROR: Illegal characters in first or last name");
				}

				// Check that email is valid.
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					echo $email . "\n\n";
					returnError("ERROR: Please provide a valid email");
				}

				// Check that email is not already in the system.
				$sql = "SELECT * FROM users WHERE userEmail = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);
				if($resultCheck){
					returnError("ERROR: That email is already taken");
				}


				// We're good to go!

				// hash the password
				$hashedpwd = md5($password);

				// insert the user into the database
				$sqlnewUser = "INSERT INTO users (userEmail,userFirst,userLast,userPassword) VALUES ('$email','$firstName','$lastName','$hashedpwd')";
				mysqli_query($db, $sqlnewUser);
				$newUserId =  mysqli_insert_id($db);


				// Verify that we were able to create the user successfully.
				if(!$newUserId) {
					$error = "Database error: unable to create user.";
					if($debugMode) $error .= "\n\n" . $sqlnewUser;
					returnError($error);
				}


				// Define our success object!
				$response = array(
					"status" => "Success!",
					"insert_id" => $newUserId
				);
			break;


			// LOGIN USER
			case "login" :

				// Check that request has all required fields
				$fields = array("email", "password");
				foreach($fields as $f){
					if(!isset($payload[$f]) || $payload[$f] == '') returnError("Missing field:" . $f);
					$payload[$f] = mysqli_real_escape_string($db, $payload[$f]);
				}

				extract($payload);

				$hashedpwd = md5($password);

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					returnError("ERROR: Invalid email.");
				}



				// LOOK UP USER
				$sql = "SELECT * FROM users WHERE userEmail = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);
				if(!$resultCheck){
					returnError("User not found.");
				}

				if($user = mysqli_fetch_assoc($result)){

					if($user['userPassword'] != $hashedpwd) returnError("ERROR: Incorrect password");

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


			// SEND EMAIL
			case "send_email" :
				
				// get the email
				if(!isset($payload['email'])) returnError("No email provided.");
				$email = mysqli_real_escape_string($db, $payload['email']);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) returnError("Email not valid.");


				echo "The email to look up is: " . $email;


				// get the user
				$sql = "SELECT * FROM users WHERE userEmail = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);
				if(!$resultCheck){
		       		returnError("User not found.");
				}


				print_r($result);

				// pick a token
				$str = "0123456789!#%&AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
				$strShuffle = str_shuffle($str);
				$newToken = substr($strShuffle, 0, 10);
				

				// update the user
				$db->query("UPDATE users SET userToken ='$newToken' WHERE userEmail = '$email'");


				// generate the reset URL
				define( "SITE_URL", "http://localhost/cmty/_baxter/_2017-2018/app-challenge/findajob/repo");
				$url = SITE_URL . "/resetpassword.php?t=" . $newToken; 
 				
				
				echo "\n\n\nSend the url: " . $url . " to " . $email;

				mail($email,'Password Request Key', 'Click here: ' . $url . ' to reset your password.');





			break;


			// DEFAULT
			default :
				returnError("Action not found.");
			break;

		}


		echo json_encode($response, JSON_PRETTY_PRINT);
		exit();
	}
