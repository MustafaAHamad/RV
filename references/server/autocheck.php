<?php

	if(isset($_POST) & !empty($_POST)) {
		include('jobquery_db.php');

		// locals
		$email = mysqli_real_escape_string($db, $_POST["signup_email"]);

		// search for email(s)
		$sql = "SELECT * FROM users WHERE userEmail = '$email'";
		$result = mysqli_query($db, $sql);
		$resultCheck = mysqli_num_rows($result);

		if(!$resultCheck){
			echo '<b>email is taken!</b>';
		}else{
			echo '<b>email is available!</b>';
		};
	};
?>