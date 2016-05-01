<?php
	include_once("user_class.php");
	session_start();
	if (!User::existsSession()){
		if (isset($_POST['register'])){
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
				User::register($data);
			} catch (Exception $exception) {
				header("Location:user_register.php");
				$_SESSION['message_error'] = $exception->getMessage();
			}
		}
	}
	else {
		header("Location:products.php");
		$_SESSION['message_error'] = "Ya existe una sesión iniciada.";
	}
?>
