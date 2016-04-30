<?php
	session_start();
	if (isset($_SESSION['message_error'])){
		echo "ERROR: " . $_SESSION['message_error'];
		unset($_SESSION['message_error']);
	}
	if (isset($_SESSION['message_success'])){
		echo "INFO: " . $_SESSION['message_success'];
		unset($_SESSION['message_success']);
	}
?>
