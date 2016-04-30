<?php
	session_start();

	if (isset($_SESSION['message_error'])){
		echo "<div class='message message-error'><span class='centrar-vertical blanca negrita'>" . $_SESSION['message_error'] . "</span></div>";
	}
	if (isset($_SESSION['message_success'])){
		echo "<div class='message message-success'><span class='centrar-vertical blanca negrita'>" . $_SESSION['message_success'] . "</span></div>";
	}
	unset($_SESSION['message_error']);
	unset($_SESSION['message_success']);
?>