<?php
	include("connection.php");

	// se recibe el valor que identifica la imagen en la tabla
	$id = $_GET['idproducto'];


	$link = connect();
	// se recupera la información de la imagen
	$query = "SELECT contenidoimagen, tipoimagen FROM `productos` WHERE `idProducto` = $id ";
	$response = mysqli_query($link, $query);
	$row = mysqli_fetch_array($response);

	mysqli_close($link);

	header("Content-type: " . $row['tipoimagen']);
	echo $row['contenidoimagen'];
?>
