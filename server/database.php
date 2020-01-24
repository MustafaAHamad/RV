<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	# GLOBAL VARIABLES
	global $debugMode, $database, $user;

	$debugMode = true;
	$database = new mysqli('localhost', 'root', 'root', 'socialmediaapptest');

	session_start();

	$user = false;

	if(isset($_SESSION['user'])) $user = $_SESSION['user'];

	# API
	include('api.php');

	# FUNCTIONS

?>