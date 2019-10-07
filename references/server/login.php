<?php

	session_start();

	if(isset($_POST['login'])) {
		include('jobquery_db.php');

		// locals
		$email = mysqli_real_escape_string($db, $_POST["login_email"]);
		$pwd = mysqli_real_escape_string($db, $_POST["login_password"]);

		$hashedpwd = md5($pwd);

		// errors handeler
		if(empty($email) || empty($pwd)){
			header("Location: ../login.php?login=empty");
			exit();
		}else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			header("Location: ../login.php?login=failed%invalidemail");
			exit();
		}else{
			$sql = "SELECT * FROM users WHERE userEmail = '$email' AND userPassword = '$hashedpwd'";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);

		if(!$resultCheck){
			header("Location: ../login.php?login=failed%invalid%information");
			exit();
		}else{
		if($row = mysqli_fetch_assoc($result)){
			$_SESSION['u_Id'] = $row['userId'];
			$_SESSION['u_Email'] = $row['userEmail'];
			$_SESSION['u_First'] = $row['userFirst'];
			$_SESSION['u_Last'] = $row['userLast'];

			header("Location: ..?login=success%" . $row['userId']);
			exit();
						}
				 	}
				}
			}
	}else{
		header("Location: ../login.php");
		exit();
	}
?>