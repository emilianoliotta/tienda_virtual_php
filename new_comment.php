<?php
	if (session_id() == '') {
		session_start();
	}

  include_once("comment_class.php");

	if (isset($_POST['submit'])){
  	$data = array(
			'comment' => $_POST['comment'],
			'product_id' => $_POST['product_id']
		);

		$success = false;
		try {
				$success = Comment::create($data);
		} catch (Exception $exception){
				$_SESSION['message_error'] = $exception->getMessage();
		}

		if ($success){
			$_SESSION['message_success'] = "Se añadió el comentario ";
		}
	}else{
		$_SESSION['message_error'] = "Debe completar un formulario para ingresar una producto.";
	}
  header("Location: product.php?idProducto=" . $_POST['product_id']);
?>
