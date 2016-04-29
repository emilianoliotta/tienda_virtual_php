<?php
	session_start();
	if (isset($_SESSION['email'])){
		include_once("user_class.php");
		User::logout($_POST['email']);
	}
	else {
		header("Location:index.php");
	}
?>