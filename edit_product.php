<?php
	if (session_id() == '') {
		session_start();
	}
  include_once("product_class.php");
  if (isset($_POST['update'])){
    $data = array(
      'product_id' => $_POST['product_id'],
      'name' => $_POST['name'],
      'category_id' => $_POST['category_id'],
      'description' => $_POST['description'],
      'price' => $_POST['price'],
      'expiration' => $_POST['expiration']
    );

    $success = false;
    try {
      $success = Product::update($data);
    } catch (Exception $exception) {
      $_SESSION['message_error'] = $exception->getMessage();
    }
    if ($success){
      $_SESSION['message_success'] = "Producto actualizado.";
    }
    header("Location: products_management.php");
  }
?>
