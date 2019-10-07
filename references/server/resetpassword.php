<?php

	if(isset($_POST["updatepassword"])){
		include_once('jobquery_db.php');

		$email = mysqli_real_escape_string($db, $_POST["reset_email"]);
		$token = mysqli_real_escape_string($db, $_POST["reset_code"]);
		$pwd = mysqli_real_escape_string($db, $_POST["reset_password"]);

		$sql = "SELECT * FROM users WHERE userEmail = '$email' AND userToken = '$token'";
		$result = mysqli_query($db, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($token == ""){
			header("Location: ../resetpassword.php?update=failed%invalid&token");
			exit();
		}else{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			header("Location: ../resetpassword.php?update=failed%invalid%email&'$email'");
			exit();
		}else{
		if(!$resultCheck){
        	header("Location: ../resetpassword.php?update=failed%invalid&information");
			exit();
		}else{
			// hash the password
			$hashedpwd = md5($pwd);

			// update data
			$db->query("UPDATE users SET userPassword = '$hashedpwd' WHERE userEmail = '$email'");

			$db->query("UPDATE users SET userToken ='' WHERE userEmail = '$email'");

			header("Location: ../login.php?update=password");
			exit();
			}
		}
	}
	}else{
		header("Location: ../resetpassword.php?");
		exit();
	};
?>