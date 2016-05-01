<?php
	if (session_id() == '') {
		session_start();
	}
	include_once("connection.php");

	$categoria = $_POST['category'];
	if (isset($categoria)){
		$link = connect();
		$query = "SELECT nombre FROM `categorias_productos` WHERE `nombre` = '$categoria'";
		$result = mysqli_query($link, $query);
		if (mysqli_num_rows($result) > 0){
			$_SESSION['message_error'] = "La categoría ya existe";
			header("Location: category_new.php");
		}else{
			$query = "INSERT INTO `categorias_productos` (`idCategoriaProducto`, `nombre`) VALUES (NULL, '$categoria')";
			$result = mysqli_query($link, $query);
			mysqli_close($link);
			if ($result){
				$_SESSION['message_success'] = "Se agregó exitosamente la categoría " . $categoria;
				header("Location: category_new.php");
			}
		}
	}else{
		$_SESSION['message_error'] = "Debe completar un formulario para ingresar una categoría.";
		header("Location: category_new.php");
	}
?>
