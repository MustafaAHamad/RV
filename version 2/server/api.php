<?php
	
	if (!$db) {
		exit('SERVER | Error has occured due to the database not being defined, this file is not for direct access.');
	};

	function errorHandler($message) {
		$response = array(
			'status' => 'error',
			'message' => $message,
		);

		echo json_encode($response, JSON_PRETTY_PRINT);
		exit();
	};

	$request = json_decode(file_get_contents('php://input'), true);

	if ($request) {
		if (!isset($request['action'])) errorHandler('SERVER | Error due to no action was requested.');
		
		$action = $request['action'];

		if (!isset($request['request_payload'])) errorHandler('SERVER | Error due to no payload was requested.');

		$payload = $request['request_payload'];

		$response = array();

		switch ($action) {
			case 'signup':
				$fields = array('username', 'email', 'password');
				foreach ($fields as $field) {
					if (!isset($payload[$field]) || $payload[$field] == '') {
						errorHandler('SERVER | Missing field ' . $field);
					};
					$payload[$field] = mysqli_real_escape_string($db, $payload[$field]);
				};

				extract($payload);

				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo $email . '\n\n';
					errorHandler('SERVER | Email requested is invalid');
				};

				if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
					errorHandler('SERVER | Illegal username characters');
				};

				$sqlEmail = "SELECT * FROM user WHERE email = '$email'";
				$resultEmail = mysqli_query($db, $sqlEmail);
				$resultEmailCheck = mysqli_num_rows($resultEmail);
				if ($resultEmailCheck) {
					errorHandler('SEVRER | The email provided is already taken.');
				};

				$sqlUsername = "SELECT * FROM user WHERE username = '$username'";
				$resultUsername = mysqli_query($db, $sqlUsername);
				$resultUsernameCheck = mysqli_num_rows($resultUsername);
				if ($resultUsernameCheck) {
					errorHandler('SEVRER | The username provided is already taken.');
				};

				$hashedpwd = md5($password);

				$sql = "INSERT INTO user (email, username, password, icon) VALUES ('$email', '$username', '$hashedpwd', 1)";
				mysqli_query($db, $sql);
				$newUserId = mysqli_insert_id($db);

				if (!$newUserId) {
					$error = 'SERVER | Unable to create user.';
					if ($debugMode) $error .= "\n\n" . $sqlnewUser;
					errorHandler($error);
				};

				$sql = "SELECT * FROM user WHERE email = '$email'";
				$result = mysqli_query($db, $sql);
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
				$fields = array("email", "password");
				foreach ($fields as $field) {
					if (!isset($payload[$field]) || $payload[$field] == '') {
						errorHandler('SERVER | Missing field ' . $field);
					};
					$payload[$field] = mysqli_real_escape_string($db, $payload[$field]);
				};

				extract($payload);

				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo $email . "\n\n";
					errorHandler('SERVER | Email requested is invalid');
				};

				$sql = "SELECT * FROM user WHERE email = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);
				if (!$resultCheck) {
					errorHandler('SERVER | The email provided was not valid.');
				};

				$hashedpwd = md5($password);

				if ($user = mysqli_fetch_assoc($result)) {
					if ($user['password'] != $hashedpwd) errorHandler('SERVER | The password provided was incorrect.');
					$_SESSION['user'] = $user;
					$response = array(
						"status" => "Success!",
						"message" => "Your session has been set on the server.",
						"user" => $user
					);
				};
			break;

			case 'logout':
				session_unset();
				session_destroy();
				$response['status'] = "Sucess!";
			break;

			case 'update icon':
				$id = $user['id'];

				$file = $_FILES['file'];

				$fileName = $file['name'];
				$fileTmpName = $file['tmp_name'];
				$fileSize = $file['size'];
				$fileError = $file['error'];
				$fileType = $file['type'];

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
						};
					};
				};
			break;
			
			default:
				errorHandler('SERVER | Error due to action not found.');
			break;
		}
		echo json_encode($response, JSON_PRETTY_PRINT);
		exit();
	};
?>