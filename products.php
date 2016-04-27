<!DOCTYPE html>
<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Tienda virtual</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Sitio web de comercio electrónico">
		<meta name="author" content="Liotta, Emiliano - Hourquebie, Lucas">
		<!--Hojas de estilo CSS-->
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" >
		<link rel="stylesheet" type="text/css" href="./css/skeleton.css" >
		<link rel="stylesheet" type="text/css" href="./css/normalize.css" >
		<link rel="stylesheet" type="text/css" href="./css/hover.css">
		<link rel="stylesheet" type="text/css" href="./css/custom.css">
		<!-- fin hojas de estilo CSS-->
		<!--Scripts JS-->
		<script src="js/jquery-1.12.3.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/npm.js"></script>
		<!--fin scripts JS-->
	</head>
	<body>

		<!--HEADER -->

		<header>
			<nav class="navbar navbar-default navbar-fixed-top transparencia altura-header">
				<div class="container-fluid">
				<!-- Marca y agrupación de links para pantallas pequeñas -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h3 class="negrita centrar">Tienda<span class="destacado">Virtual</span></h3>
					</div>
					<!-- Colector de links de la barra de navegación -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li id="home"><a href="products.php"><span class="hvr-wobble-vertical">INICIO</span></a></li>
							<li><a href="products.php"><span class="hvr-wobble-vertical">PRODUCTOS</span></a></li>
							<li><a href="/about"><span class="hvr-wobble-vertical">ACERCA DE</span></a></li>
							<li><a href="/contact"><span class="hvr-wobble-vertical">CONTACTO</span></a></li>
						</ul>
							<form class="navbar-form navbar-left" role="search">
								<div class="form-group">
									<input type="text" class="u-full-width" placeholder="Buscar productos...">
								</div>
								<button type="submit" class="button">BUSCAR</button>
							</form>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ingresar<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="user_login.php">Acceder</a></li>
								<li><a href="user_register.php">Registrarse</a></li>
							</ul>
							</li>
						</ul>
					</div><!-- fin del colector de links de la barra de navegación -->
				</div>
			</nav>
		</header>

		<!--FIN del HEADER -->

		<!-- CUERPO -->

		<div id="cuerpo">
			<div class="container-fluid">
				<div class="col-xs-12 col-md-12">
					<div class="row well">
						<table class="table">
							<tr>
								<th>Foto</th>
								<th>Producto</th>
								<th>Categoría</th>
								<th>Caducidad</th>
								<th>Precio</th>
							</tr>
							<tr>
								<td class="centrar">
									<a href="product.php"><img src="images/ex1.jpg" class="img-responsive img-thumbnail" alt="Imagen de producto" width="90"></a>
								</td>
								<td>Micro Intel Core I7 4790k 4.40ghz 8mb Haswell Socket 1150 Hd</td>
								<td>Computación</td>
								<td>27/07/2016</td>
								<td>$6599,00</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!--FIN del CUERPO -->

		<!--FOOTER -->

		<footer>
			<div class="">Copyright © 2016</div>
				<div class="destacado"><a href="#">Términos y condiciones</a> | <a href="#">Políticas de privacidad</a> | <a href="#">Ayuda</a></div>
		</footer>

		<!--FIN del FOOTER -->

	</body>
</html>