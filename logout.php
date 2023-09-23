<?php
require_once('config.php');
require_once 'main/controller_register/functionRegister.php';

$currentDate = date('Y-m-d H:i');
	session_start();
	isOnline($conn,$currentDate,$_SESSION["id"]);
	session_unset();
	session_destroy();
	header("location: index.php?msg=logout_success");



?>