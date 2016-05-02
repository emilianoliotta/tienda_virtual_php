<?php
	include_once("user_class.php");
	if (session_id() == '') {
    session_start();
  }
	if (User::existsSession()){
		if (User::logout($_POST['email'])){
			header("Location:user_login.php");
			$_SESSION['message_success'] = "Sesión cerrada exitosamente.";
		}
	}
	else {
		header("Location:user_login.php");
		$_SESSION['message_error'] = "Necesita iniciar sesión.";
	}
?>
