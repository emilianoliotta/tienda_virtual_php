<?php
	include_once("user_class.php");
	session_start();
	if (User::existsSession()){
		User::logout($_POST['email']);
	}
	else {
		header("Location:index.php");
	}
?>