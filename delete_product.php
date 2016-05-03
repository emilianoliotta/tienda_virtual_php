<?php
	if (session_id() == '') {
		session_start();
	}
	include_once("user_class.php");
	if (User::existsSession()){
		$user = User::current();
		include_once("connection.php");

		$product_id = $_POST['idProducto'];
		if (isset($product_id)){
			$link = connect();
			$query = "SELECT nombre FROM `productos` WHERE `idProducto` = '$product_id' AND `idUsuario` = '$user[idUsuario]'";
			$result = mysqli_query($link, $query);
			if (!mysqli_num_rows($result) > 0){
				$_SESSION['message_error'] = "El producto no se encontró.";
				header("Location: products_management.php");
			}else{
        $product = mysqli_fetch_array($result);
				$query = "DELETE FROM `productos` WHERE `idProducto` = '$product_id'";
				$result = mysqli_query($link, $query);
				mysqli_close($link);
				if ($result){
					$_SESSION['message_success'] = "Se eliminó el producto " . $product['nombre'] . ".";
					header("Location: products_management.php");
				}
			}
		}else{
			$_SESSION['message_error'] = "Error - No se puede eliminar. Ingrese a 'products_management.php'";
			header("Location: products_management.php");
		}
	}else {
		$_SESSION['message-error'] = "Acceso denegado. Debe iniciar sesión.";
		header("Location: user_login.php");
	}
?>
