<?php
	
	if (!$database) {
		exit('SERVER | Error has occured due to the database not being defined, this file is not for direct access.');
	};

	function errorHandler($message) {
		$response = array(
			'status' => 'Error',
			'message' => $message,
		);

		echo json_encode($response, JSON_PRETTY_PRINT);
		exit();
	};

	$request = json_decode(file_get_contents('php://input'), true);

	if ($request) {
		# CONFIRM ACTION
		if (!isset($request['action'])) errorHandler('SERVER | Error due to no action was requested.');

		$action = $request['action'];

		# CONFIRM PAYLOAD
		if (!isset($request['payload'])) errorHandler('SERVER | Error due to no payload was requested.');

		$payload = $request['payload'];

		# RESPONSE ARRAY
		$response = array();

		switch ($action) {
			case 'signup':
				# FIELDS
				$fields = array('username', 'email', 'password');

				# VALIDATE EMPTY FIELDS
				foreach ($fields as $field) {
					if (!isset($payload[$field]) || $payload[$field] == '') {
						errorHandler('SERVER | Missing field ' . $field . '.');
					};
				};

				# EXTRACT
				extract($payload);

				# VALIDATE EMAIL
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					errorHandler('SERVER | Email requested is invalid.');
				};

				# LEGAL USERNAME CHARACTERS
				if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
					errorHandler('SERVER | Illegal username characters.');
				};

				# CHECK EMAIL AVAILABLITY
				$sqlEmail = "SELECT * FROM users WHERE email = '$email'";
				$resultEmail = mysqli_query($database, $sqlEmail);
				$resultEmailCheck = mysqli_num_rows($resultEmail);
				if ($resultEmailCheck) {
					errorHandler('SEVRER | The email provided is already taken.');
				};

				# CHECK USERNAME AVAILABLITY
				$sqlUsername = "SELECT * FROM users WHERE username = '$username'";
				$resultUsername = mysqli_query($database, $sqlUsername);
				$resultUsernameCheck = mysqli_num_rows($resultUsername);
				if ($resultUsernameCheck) {
					errorHandler('SEVRER | The username provided is already taken.');
				};

				# HASH PASSWORD
				$hashedpassword = md5($password);

				# CREATE USER
				$sql = "INSERT INTO users (email, username, password, icon) VALUES ('$email', '$username', '$hashedpassword', 1)";
				mysqli_query($database, $sql);
				$newUserId = mysqli_insert_id($database);

				if (!$newUserId) {
					$error = 'SERVER | Unable to create user.';
					if ($debugMode) $error .= "\n\n" . $sqlnewUser;
					errorHandler($error);
				};

				$sql = "SELECT * FROM users WHERE email = '$email'";
				$result = mysqli_query($database, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($user = mysqli_fetch_assoc($result)){
					$_SESSION['user'] = $user;
					$response = array(
						"status" => "Success!",
						"insert_id" => $newUserId,
					);
				};
				break;
			case 'login':
				# FIELDS
				$fields = array('email', 'password');

				# VALIDATE EMPTY FIELDS
				foreach ($fields as $field) {
					if (!isset($payload[$field]) || $payload[$field] == '') {
						errorHandler('SERVER | Missing field ' . $field);
					};
				};

				# EXTRACT
				extract($payload);

				# VALIDATE EMAIL
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					errorHandler('SERVER | Email requested is invalid.');
				};

				# CHECK EMAIL AVAILABLITY
				$sqlEmail = "SELECT * FROM users WHERE email = '$email'";
				$resultEmail = mysqli_query($database, $sqlEmail);
				$resultEmailCheck = mysqli_num_rows($resultEmail);
				if (!$resultEmailCheck) {
					errorHandler('SEVRER | The email provided is not valid.');
				};

				# HASH PASSWORD
				$hashedpassword = md5($password);

				# LOGIN
				if ($user = mysqli_fetch_assoc($resultEmail)) {
					if ($user['password'] != $hashedpassword) errorHandler('SERVER | The password provided was incorrect.');
					$_SESSION['user'] = $user;
					$response = array(
						"status" => "Success!",
						"message" => "Your session has been set on the server.",
						"user" => $user
					);
				};
				break;
			case 'logout':
				# DESTROY SESSION
				session_start();
				session_unset();
				session_destroy();

				$response['status'] = "Sucess!";
				break;
			case 'reset password':
				# VALIDATE EMAIL FIELD
				if (!isset($payload['email']) || $payload['email'] == '') {
					errorHandler('SERVER | Missing field email.');
				};

				$email = mysqli_real_escape_string($database, $payload['email']);

				# GRAB USER BY EMAIL
				$sqlEmail = "SELECT * FROM users WHERE email = '$email'";
				$resultEmail = mysqli_query($database, $sqlEmail);
				$resultEmailCheck = mysqli_num_rows($resultEmail);
				if (!$resultEmailCheck) {
					errorHandler('SEVRER | The email provided is not valid.');
				};

				# GENERATE TOKEN
				$string = "0123456789!#%&AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
				$shuffle = str_shuffle($str);
				$token = substr($shuffle, 0, 10);

				# QUERY TOKEN
				$database -> query("UPDATE users SET token ='$token' WHERE email = '$email");

				define( "SITE_URL", "http://localhost/RV/repo");
				$url = SITE_URL . "/resetpassword.php?t=" . $token;

				# MAIL TO EMAIL
				mail($email, 'Password Reset Request Key', 'Click here ' . $url . ' to reset your password.');

				break;
			case 'update profile picture':
				if ($user) {
					$id = $user['id'];
					
				};
				break;
			default:
				errorHandler('SERVER | Error due to action not found.');
				break;
		};
		echo json_encode($response, JSON_PRETTY_PRINT);
		exit();
	};
?>