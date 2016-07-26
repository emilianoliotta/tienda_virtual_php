<?php
	if (session_id() == '') {
		session_start();
	}
	include_once("user_class.php");
	if (User::existsSession()){
		$user = User::current();
		include_once("connection.php");

		$categoria = $_POST['category'];
		if (isset($categoria) && isset($_POST['submit'])){
			$link = connect();
			$query = "SELECT nombre FROM `categorias_productos` WHERE `nombre` = '$categoria'";
			$result = mysqli_query($link, $query);
			if (mysqli_num_rows($result) > 0){
				$_SESSION['message_error'] = "La categoría ya existe";
				header("Location: categories_management.php");
			}else{
				if($category_name == ""){
					$_SESSION['message_error'] = "Ningún nombre de categoría ingresado.";
					header("Location: categories_management.php");
				}
				else{
					$query = "INSERT INTO `categorias_productos` (`idCategoriaProducto`, `nombre`) VALUES (NULL, '$categoria')";
					$result = mysqli_query($link, $query);
					mysqli_close($link);
					if ($result){
						$_SESSION['message_success'] = "Se agregó exitosamente la categoría '" . $categoria . "'.";
						header("Location: categories_management.php");
					}
				}
			}
		}else{
			$_SESSION['message_error'] = "Debe completar un formulario para ingresar una categoría.";
			header("Location: categories_management.php");
		}
	}else {
		$_SESSION['message-error'] = "Acceso denegado.";
		header("Location: products.php");
	}
?>
