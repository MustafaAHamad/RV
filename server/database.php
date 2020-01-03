<?php

	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	// DATABASE
	global $db, $debugMode;

	$debugMode = true;

	// LOCAL DATABASE
	$db = new mysqli("localhost", "root", "root", "socialmediaapptest");

	// CHECK LOGIN STATUS
	global $user;
	session_start();

	$user = false;
	if(isset($_SESSION['user'])) $user = $_SESSION['user'];

	// API
	include('api.php');

	/////////////////////////////////////////////////////////////////////////////

	// DATA HANDLER
	function get_user_from_username($username) {
		$sqlUsername = "SELECT * FROM users WHERE username = '$username'";

		return array (
			"usr" => $sqlUsername,
		);
	};

	function hashtag_converter($tag) {
		$regex = "/#+([0-9a-zA-Z0-9_]+)/";
		$str = preg_replace($regex, '<a class="cFiR2y7" href="server/hashtag.php?tag=$0">$0</a>', $tag);
		return($str);
	};
?>