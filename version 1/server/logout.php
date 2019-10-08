<?php

	if(isset($_POST['logout'])) {

		// DATABASE
		include('database.php');

		// DESTROY SESSION
		session_start();
		session_unset();
		session_destroy();

		// REDIRECT TO HOME
		header("Location: ../los.html");
		exit();
	}else{
		header("Location: ../los.html");
		exit();
	};
?>