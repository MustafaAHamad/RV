<?php
	
	// START SESSION
	session_start();

	if(isset($_POST['login'])) {

		// DATABSE
		include('database.php');

		// LOCALS
		$email = mysqli_real_escape_string($db, $_POST["login_email"]);
		$pwd = mysqli_real_escape_string($db, $_POST["login_password"]);

		// HASH THE PASSWORD
		$hashedpwd = md5($pwd);

		// VALIDATION
		if(empty($email) || empty($pwd)){
			header("Location: ../los.html?login=empty");
			exit();
		}else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../los.html?login=failed%invalidemail");
				exit();
			}
		}
	}else{
		header("Location: ../index.html");
		exit();
	}
?>