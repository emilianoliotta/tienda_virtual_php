<?php
	include_once("user_class.php");
	session_start();
	if (User::existsSession()){
		if (isset($_POST['update'])){
			$data = array(
				'clave' => $_POST['clave'],
				'nombre' => $_POST['nombre'],
				'apellido' => $_POST['apellido'],
				'telefono' => $_POST['telefono']
			);
			User::update($data);
			header("Location:user_edit.php");
		}
	}
	else {
		header("Location:products.php");
		$_SESSION['message_error'] = "No existe una sesión iniciada.";
	}
?>