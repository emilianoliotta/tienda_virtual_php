<?php
	if (session_id() == '') {
		session_start();
	}
	include_once("user_class.php");
	if (User::existsSession() && User::hasAdminPrivileges()){
		$user = User::current();
    if (isset($_POST['update'])){
      include_once("connection.php");

      $category_name = $_POST['category_name'];
      $category_id = $_POST['category_id'];
  		if (isset($category_name) && isset($category_id)){
  			$link = connect();
        $query = "SELECT nombre FROM `categorias_productos` WHERE `nombre` = '$category_name'";
  			$result = mysqli_query($link, $query);
  			if (mysqli_num_rows($result) > 0){
  				$_SESSION['message_error'] = "La categoría ya existe.";
  				header("Location: categories_management.php");
  			}else{
          $query = "UPDATE  `categorias_productos` SET  `nombre` = '$category_name' WHERE  `idCategoriaProducto` =  '$category_id'";
    			$result = mysqli_query($link, $query);
          mysqli_close($link);
    			if ($result){
  					$_SESSION['message_success'] = "Se actualizó exitosamente la categoría a '" . $category_name . "'";
  					header("Location: categories_management.php");
    			}else{
            $_SESSION['message_error'] = "No se pudo actualizar la categoría.";
  					header("Location: categories_management.php");
          }
        }
  		}else{
  			$_SESSION['message_error'] = "Debe completar los campos formulario para editar una categoría.";
  			header("Location: categories_management.php");
  		}
    }else {
      $_SESSION['message_error'] = "Debe completar un formulario para ingresar una categoría.";
      header("Location: categories_management.php");
    }
	}else {
		$_SESSION['message-error'] = "Acceso denegado.";
		header("Location: products.php");
	}
?>
