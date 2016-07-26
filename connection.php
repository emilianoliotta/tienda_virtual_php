<?php

	DEFINE('DB_USER','grupo44');
	DEFINE('DB_PASS','Sai0Jooh');
	DEFINE('DB_HOST','localhost');
	DEFINE('DB_NAME','grupo44');

	function connect(){

		$dbconnect = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die('Imposible conectar con el host de la BD' . mysqli_connect_error());

		mysqli_select_db($dbconnect, DB_NAME) or exit('Error al seleccionar BD');

		return $dbconnect;

	}

?>
