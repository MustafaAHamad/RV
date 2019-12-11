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
?>