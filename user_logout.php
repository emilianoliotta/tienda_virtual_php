<?php
	include_once("user_class.php");
	if (session_id() == '') {
    session_start();
  }
	if (User::existsSession()){
		User::logout($_POST['email']);
		header("Location:user_login.php");
	}
	else {
		header("Location:products.php");
	}
?>
