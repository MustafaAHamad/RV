<?php
	
	if(isset($_POST["updatepassword"])){

		// DATABASE
		include_once('database.php');

		// LOCALS
		$email = mysqli_real_escape_string($db, $_POST["reset_email"]);
		$token = mysqli_real_escape_string($db, $_POST["reset_code"]);
		$pwd = mysqli_real_escape_string($db, $_POST["reset_password"]);

		$sql = "SELECT * FROM user WHERE email = '$email' AND token = '$token'";
		$result = mysqli_query($db, $sql);
		$resultCheck = mysqli_num_rows($result);

		// VALIDATION
		if($token == ""){
			header("Location: ../resetpassword.html?update=failed%invalid&token");
			exit();
		}else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../resetpassword.html?update=failed%invalid%email&'$email'");
				exit();
		}else{
			if(!$resultCheck){
	        	header("Location: ../resetpassword.html?update=failed%invalid&information");
				exit();
		}else{
			// HASH THE PASSWORD
			$hashedpwd = md5($pwd);

			// UPDATE DATABASE
			$db->query("UPDATE user SET password = '$hashedpwd' WHERE email = '$email'");
			$db->query("UPDATE user SET token ='' WHERE email = '$email'");

			// REDIRECT TO LOGIN
			header("Location: ../los.html?update=password");
			exit();
		}
	}else{
		header("Location: ../index.html?");
		exit();
	}
?>