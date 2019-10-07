<?php

	if(isset($_POST['register'])) {
		include_once('jobquery_db.php');

		// locals
		$error;
		$first = mysqli_real_escape_string($db, $_POST["signup_firstName"]);
		$last = mysqli_real_escape_string($db, $_POST["signup_lastName"]);
		$email = mysqli_real_escape_string($db, $_POST["signup_email"]);
		$pwd = mysqli_real_escape_string($db, $_POST["signup_password"]);

		// errors handeler
		if(!preg_match("/^[a-zA-Z ]*$/", $first) || !preg_match("/^[a-zA-Z ]*$/", $last)){
			header("Location: ../login.php?signup=failed%invalid%information");
			exit();
		}else{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			header("Location: ../login.php?signup=failed%invalid%email");
			exit();
		}else{
			$sql = "SELECT * FROM users WHERE userEmail = '$email'";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);

		if($resultCheck){
        	header("Location: ../login.php?signup=failed%email%taken");
			exit();
		}else{
			// hash the password
			$hashedpwd = md5($pwd);

			// insert the user into the database
			$sqlnewUser = "INSERT INTO users (userEmail,userFirst,userLast,userPassword) VALUES ('$email','$first','$last','$hashedpwd')";

			mysqli_query($db, $sqlnewUser);
				
			header("Location: ../login.php?signup=complete%");
			exit();
			}
		}
	}
	}else{
		header("Location: ../login.php");
		exit();
	}
?>