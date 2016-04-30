<!DOCTYPE html>
<?php
	include_once("product_class.php");

	if (isset($_GET['idProducto'])){
		$data = Product::getProductData($_GET['idProducto']);
		if (is_null($data)){
			header("Location: index.php"); #No se encontro el producto	
		}
	}else{
		header("Location: index.php"); #No se especifico producto
	}
?>
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
		<script src="js/custom.js"></script>
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
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div class="panel centrar">
							<br>
							<div class="container">
								<div class="row centrar">
									<img src="showimage.php?idProducto=<?php echo $data['idProducto'];?>" class="img-responsive img-rounded" alt="Imagen de producto">
								</div>
								<hr>
								<div><span class="negrita">Categoría: </span><?php echo $data['categoria']; ?></div>
								<div><span class="negrita">Fecha de publicación: </span><?php echo date("d/m/y", strtotime($data['publicacion'])); ?></div>
								<div><span class="negrita">Fecha de caducidad: </span><?php echo date("d/m/y", strtotime($data['caducidad'])); ?></div>
								<br>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="well">
							<h4 class="negrita"><?php echo $data['nombre'];?></h4>
							<hr>
							<div>
								<div class="container-fluid">
									<div class="row">
										<p><span class="negrita">DESCRIPCIÓN: </span><?php echo $data['descripcion']; ?></p>
									</div>
								</div>
							</div>
							<hr>
							<div class="centrar">
								<p class="negrita">$<?php echo $data['precio']; ?></p>
								<a href="user_login.php" class="button">INICIAR SESIÓN PARA COMPRAR</a>
								<p></p>
							</div>
						</div>
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