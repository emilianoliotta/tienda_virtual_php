<?php
	include_once("user_class.php");
	if (session_id() == '') {
    session_start();
  }
	if (!User::existsSession()){
		if (isset($_POST['login'])){
			try {
					User::login($_POST['email'], $_POST['clave']);
			} catch (Exception $exception) {
				header("Location:user_login.php");
				$_SESSION['message_error'] = $exception->getMessage();
			}
		}
	}
	else {
		header("Location:products.php");
		$_SESSION['message_error'] = "Ya existe una sesión iniciada.";
	}
?>
