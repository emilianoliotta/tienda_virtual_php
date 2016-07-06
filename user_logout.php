<?php
	include_once("user_class.php");
	if (session_id() == '') {
    session_start();
  }
	try {
		User::validateSession();
	} catch (Exception $exception) {
		$_SESSION['message_error'] = $exception->getMessage();
		header("Location:user_login.php");
		return;
	}
	if (User::logout($_POST['email'])){
		header("Location:user_login.php");
		$_SESSION['message_success'] = "Sesión cerrada exitosamente.";
	}
?>
