<?php
	if(isset($_POST['register'])){

		// DATABASE
		include_once('database.php');

		// LOCALS
		$error;
		$name = mysqli_real_escape_string($db, $_POST["signup_firstName"]);
		$username = mysqli_real_escape_string($db, $_POST["signup_lastName"]);
		$email = mysqli_real_escape_string($db, $_POST["signup_email"]);
		$pwd = mysqli_real_escape_string($db, $_POST["signup_password"]);

		// VALIDATION
		if(!preg_match("/^[a-zA-Z ]*$/", $name) || !preg_match("/^[a-zA-Z ]*$/", $username)){
			header("Location: ../los.html?signup=failed%invalid%information");
			exit();
		}else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../los.html?signup=failed%invalid%email");
				exit();
			}else{
				$sql = "SELECT * FROM user WHERE email = '$email'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck){
		        	header("Location: ../login.php?signup=failed%email%taken");
					exit();
				}else{

					// HASH THE PASSWORD
					$hashedpwd = md5($pwd);

					$sqlnewUser = "INSERT INTO user (email, username, name, password) VALUES
					('$email', '$username', '$name', '$hashedpwd')";

					mysqli_query($db, $sqlnewUser);
						
					header("Location: ../login.php?signup=complete%");
					exit();
				}
			}
		}
	}else{
		header("Location: ../los.html");
		exit();
	}
?>