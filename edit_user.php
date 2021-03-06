<?php
	include_once("user_class.php");
	if (session_id() == '') {
    session_start();
  }
	if (User::existsSession()){
		if (isset($_POST['update'])){
			$data = array(
				'clave' => $_POST['clave'],
				'nombre' => $_POST['nombre'],
				'apellido' => $_POST['apellido'],
				'telefono' => $_POST['telefono']
			);

			$success = false;
			try {
				$success = User::update($data);
			} catch (Exception $exception) {
				$_SESSION['message_error'] = $exception->getMessage();
			}
			if ($success){
				$_SESSION['message_success'] = "Datos de cuenta actualizados.";
			}
			header("Location:user_edit.php");
		}
	}
	else {
		header("Location:products.php");
		$_SESSION['message_error'] = "No existe una sesión iniciada.";
	}
?>
