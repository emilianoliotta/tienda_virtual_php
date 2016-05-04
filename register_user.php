<?php
	include_once("user_class.php");
	if (session_id() == '') { session_start(); }
	if (!User::existsSession()){
		if (isset($_POST['register'])){
			$success = false;
			$data = array(
				'email' => $_POST['email'],
				'email_repetido' => $_POST['email_repetido'],
				'clave' => $_POST['clave'],
				'clave_repetida' => $_POST['clave_repetida'],
				'nombre' => $_POST['nombre'],
				'apellido' => $_POST['apellido'],
				'telefono' => $_POST['telefono']
			);
			try {
				$success = User::register($data);
			} catch (Exception $exception) {
				header("Location:user_register.php");
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
