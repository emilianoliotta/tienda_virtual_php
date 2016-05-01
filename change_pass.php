<?php
	include_once("user_class.php");
	if (session_id() == ''){ session_start(); }
	if (User::existsSession()){
		if (isset($_POST['change_password'])){
			$data = array(
				'clave_actual' => $_POST['clave_actual'],
				'nueva_clave' => $_POST['nueva_clave'],
				'nueva_clave_repetida' => $_POST['nueva_clave_repetida']
			);

			$success = false;
			try {
				$success = User::updatePassword($data);
			} catch (Exception $exception) {
				$_SESSION['message_error'] = $exception->getMessage();
			}
			if ($success){
				$_SESSION['message_success'] = "Contraseña actualizada.";
			}
			header("Location:user_edit.php");
		}
	}
	else {
		header("Location:products.php");
		$_SESSION['message_error'] = "No existe una sesión iniciada.";
	}
?>
