<?php
	
	// START SESSION
	session_start();

	if(isset($_POST['login'])){

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
			}else{
				$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$hashedpwd'";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);

				if(!$resultCheck){
					header("Location: ../los.html?login=failed%invalid%information");
					exit();
				}else{
					if($row = mysqli_fetch_assoc($result)){
						$_SESSION['u_Id'] = $row['id'];
						$_SESSION['u_Email'] = $row['email'];
						$_SESSION['u_Username'] = $row['username'];
						$_SESSION['u_name'] = $row['name'];

						header("Location: ..?login=success%" . $row['userId']);
						exit();
					}
				}
			}
		}
	}else{
		header("Location: ../index.html");
		exit();
	}
?>