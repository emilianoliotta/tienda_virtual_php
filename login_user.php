<?php
	include_once("user_class.php");
	session_start();
	if (!User::existsSession()){
		if (isset($_POST['login'])){
			User::login($_POST['email'], $_POST['clave']);
		}
	}
	else {
		header("Location:products.php");
		$_SESSION['message_error'] = "Ya existe una sesión iniciada.";
	}
?>