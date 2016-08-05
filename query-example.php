<!DOCTYPE html>
<html>
<head>
  <title>Aplicacion</title>

</head>
<body>
	<?php
		include("connection.php");

		$link = connect();

		$query = "SELECT * FROM  `usuarios` WHERE  `clave` = 'lala'";

		$result = mysqli_query($link, $query);

		mysql_close($link);

		if ($result){
			echo "Numero de filas recuperadas: " . mysqli_num_rows($result) . "\n";
			while ($row = mysqli_fetch_array ($result)) {
				echo "Nombre: " . $row['nombre'] . ".";
			}
		}else {
			die("Query Invalido: " . mysqli_error() . "\n");
		}
	?>
</body>
</html>