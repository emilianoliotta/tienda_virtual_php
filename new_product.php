<?php
	if (session_id() == '') {
		session_start();
	}
	include_once("user_class.php");
	if (User::existsSession()){
		$user = User::current();

		include_once("product_class.php");

		if (isset($_POST['submit'])){
    	$data = array(
				'name' => $_POST['name'],
				'category_id' => $_POST['category_id'],
				'description' => $_POST['description'],
				'price' => $_POST['price'],
				'expiration' => $_POST['expiration'],
				'image' => addslashes(file_get_contents($_FILES['image']['tmp_name'])),
				'image_type' => addslashes($_FILES['image']['type']),
				'user_id' => $user[idUsuario]
			);

			$success = false;
			try {
					$success = Product::create($data);
			} catch (Exception $exception){
					$_SESSION['message_error'] = $exception->getMessage();
					header("Location:product_new.php");
			}

			if ($success){
				$_SESSION['message_success'] = "Se añadió el producto ". $_POST['name'];
				header("Location: products_management.php");
			}
		}else{
			$_SESSION['message_error'] = "Debe completar un formulario para ingresar una producto.";
			header("Location: product_new.php");
		}
  }else {
    $_SESSION['message-error'] = "Solo los usuarios logueados pueden agregar productos.";
    header("Location: user_login.php");
  }
?>
