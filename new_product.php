<?php
	if (session_id() == '') {
		session_start();
	}
	include_once("user_class.php");
	if (User::existsSession()){
		$user = User::current();

		include_once("connection.php");
		if (isset($_POST['submit'])){
      if (isset($_POST['name']) && isset($_POST['category_id']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['expiration']) && isset($_FILES['image'])){
        $current_date = date('Y-m-d');
				$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
				$image_type = addslashes($_FILES['image']['type']);
        $link = connect();
				$query = "INSERT INTO `productos` (`idProducto`, `idUsuario`, `idCategoriaProducto`, `nombre`, `descripcion`, `precio`, `publicacion`, `caducidad`, `contenidoimagen`, `tipoimagen`) VALUES (NULL, '$user[idUsuario]', '$_POST[category_id]', '$_POST[name]', '$_POST[description]', '$_POST[price]', CURDATE(), '$_POST[expiration]', '$image', '$image_type')";
  			$result = mysqli_query($link, $query);
				mysqli_close($link);
				if ($result){
  				$_SESSION['message_success'] = "Se añadió el producto ". $_POST['name'];
  				header("Location: products_management.php");
  			}else{
  				$_SESSION['message_error'] = "Error, no se pudo agregar el producto.";
					header("Location: product_new.php");
  			}
      }else {
        $_SESSION['message-error'] = "Faltan campos. Todos los campos son obligatorios.";
        header("Location: product_new.php");
      }
		}else{
			$_SESSION['message_error'] = "Debe completar un formulario para ingresar una categoría.";
			header("Location: product_new.php");
		}
  }else {
    $_SESSION['message-error'] = "Solo los usuarios logueados pueden agregar productos.";
    header("Location: user_login.php");
  }
?>
