<?php

	if(isset($_POST['forgotpassword'])){
		include_once('jobquery_db.php');

		// locals
		$email = mysqli_real_escape_string($db, $_POST["reset_email"]);

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			header("Location: ../login.php?email=failed%invalid%email");
			exit();
		}else{
			$sql = "SELECT * FROM users WHERE userEmail = '$email'";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);

		if(!$resultCheck){
       		header("Location: ../resetpassword.php?reset=failed%invalid%information");
			exit();
		}else{
			$str = "0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
			$strShuffle = str_shuffle($str);
			$newToken = substr($strShuffle, 0, 10);
			$url = "/'$newToken'";

			//email($mail,"Reset Password","To reset your password, click here or visit:'$url'")

			$db->query("UPDATE users SET userToken ='$newToken' WHERE userEmail = '$email'");

			// mail($email,'Password Request Key', 'The following email has requested for a password change. Your request key is: "$newToken",test@gmail.com');
			// $to = $email;
			// $subject = 'Job Query Request Key';
			// $message = '
			// <html>
			// 	<head>
			// 		<title>Request Key</title>
			// 	</head>
			// 	<body>
			// 		<p>A reset password key was requested for this email!</a><br>
			// 		<b>Your request key is: "$newToken"</b><br>
			// 		<b>If this was not you we advice you to ignore this message</b>
			// 	</body>
			// </html>
			// '
			// $headers[] = 'MIME-Version: 1.0';
			// $headers[] = 'Content-type: text/html; charset=iso-8859-1';
			// $headers[] = 'To: <"$email">';
			// $headers[] = 'From: Job Query <jobquery@gmail.com>';
			// mail($to, $subject, $message, implode("\r\n", $headers));

			header("Location: ../resetpassword.php?");
			exit();
		}
	}
	}else{
		header("Location: ../login.php");
		exit();
	};
?>