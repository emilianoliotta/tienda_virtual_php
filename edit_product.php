<?php
	if (session_id() == '') {
		session_start();
	}
	include_once("user_class.php");
	if (User::existsSession()){
		$user = User::current();
    if (isset($_POST['update'])){
      if (isset($_POST['product_id']) && isset($_POST['name']) && isset($_POST['category_id']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['expiration'])){
        include_once("connection.php");
        $link = connect();
        $query = "SELECT nombre FROM `productos` WHERE `idProducto` = '$_POST[product_id]' AND `idUsuario` = '$user[idUsuario]'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0){
					if (isset($_FILES['image']) && $_FILES['image']['size']){
						$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
	  				$image_type = addslashes($_FILES['image']['type']);
	  				$query = "UPDATE `productos` SET `idCategoriaProducto` = '$_POST[category_id]', `nombre` = '$_POST[name]', `descripcion` = '$_POST[description]', `precio` = '$_POST[price]', `caducidad` = '$_POST[expiration]', `contenidoimagen` = '$image', `tipoimagen` = '$image_type' WHERE `idProducto` = '$_POST[product_id]'";
					}else {
						$query = "UPDATE `productos` SET `idCategoriaProducto` = '$_POST[category_id]', `nombre` = '$_POST[name]', `descripcion` = '$_POST[description]', `precio` = '$_POST[price]', `caducidad` = '$_POST[expiration]' WHERE `idProducto` = '$_POST[product_id]'";
					}
    			$result = mysqli_query($link, $query);
  				mysqli_close($link);
  				if ($result){
    				$_SESSION['message_success'] = "Se actualizó el producto ";
    				header("Location: products_management.php");
    			}else{
    				$_SESSION['message_error'] = "Error, no se pudo actualizar el producto.";
  					header("Location: products_management.php");
    			}
        }else {
          mysqli_close($link);
          $_SESSION['message_error'] = "Error, no se pudo actualizar el producto.";
          header("Location: products_management.php");
        }
      }else {
        $_SESSION['message-error'] = "Faltan campos. Todos los campos son obligatorios.";
        header("Location: products_management.php");
      }
		}else{
			$_SESSION['message_error'] = "Debe completar un formulario para modificar un producto.";
			header("Location: products_management.php");
		}
  }else {
    $_SESSION['message-error'] = "Solo los usuarios logueados pueden modificar productos.";
    header("Location: user_login.php");
  }
?>
