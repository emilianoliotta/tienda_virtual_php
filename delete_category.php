<?php
	if (session_id() == '') {
		session_start();
	}
	include_once("user_class.php");
	if (User::existsSession()){
		$user = User::current();
		include_once("connection.php");

		$category_id = $_POST['idCategoriaProducto'];
		if (isset($category_id) && isset($_POST['delete'])){
			$link = connect();
			$query = "SELECT nombre FROM `categorias_productos` WHERE `idCategoriaProducto` = '$category_id'";
			$result = mysqli_query($link, $query);
			if (!mysqli_num_rows($result) > 0){
				$_SESSION['message_error'] = "La categoría no se encontró.";
				header("Location: categories_management.php");
			}
			else {
        $category = mysqli_fetch_array($result);

				// Consultar si existem productos asociados a la categoría
				$query = "SELECT * FROM `productos` WHERE `idCategoriaProducto` = '$category_id'";
				$result = mysqli_query($link, $query);
				if(mysqli_num_rows($result) > 0){
					$_SESSION['message_error'] = "Error - No se pudo eliminar porque existen productos asociados.";
					header("Location: categories_management.php");
				}
				else {
					$query = "DELETE FROM `categorias_productos` WHERE `idCategoriaProducto` = '$category_id'";
					$result = mysqli_query($link, $query);
					mysqli_close($link);
					if ($result){
						$_SESSION['message_success'] = "Se eliminó la categoría '" . $category['nombre'] . "'.";
						header("Location: categories_management.php");
					}else {
						$_SESSION['message_error'] = "Error - No se pudo eliminar.";
						header("Location: categories_management.php");
					}
				}
			}
		}
		else {
			$_SESSION['message_error'] = "Error - No se puede eliminar. Ingrese a 'categories_management.php'";
			header("Location: categories_management.php");
		}
	}
	else {
		$_SESSION['message-error'] = "Acceso denegado.";
		header("Location: products.php");
	}
?>
