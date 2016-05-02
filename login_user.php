<?php
	include_once("user_class.php");
	if (session_id() == '') {
    session_start();
  }
	if (!User::existsSession()){
		if (isset($_POST['login'])){
      $success = false;
			try {
					$success = User::login($_POST['email'], $_POST['clave']);
			} catch (Exception $exception) {
				header("Location:user_login.php");
				$_SESSION['message_error'] = $exception->getMessage();
			}
      if ($success){
        header("Location:products.php");
        $_SESSION['message_success'] = "Sesión iniciada exitosamente.";
      }
		}
	}
	else {
		header("Location:products.php");
		$_SESSION['message_error'] = "Ya existe una sesión iniciada.";
	}
?>
