<?php
	include_once("connection.php");

	// se recibe el valor que identifica la imagen en la tabla
	$id = $_GET['idProducto'];


	$link = connect();
	// se recupera la información de la imagen
	$query = "SELECT contenidoimagen, tipoimagen FROM `productos` WHERE `idProducto` = $id ";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_array($result);

	mysqli_close($link);

	header("Content-type: " . $row['tipoimagen']);
	echo $row['contenidoimagen'];
?>
