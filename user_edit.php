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

		<?php
			include("connection.php");

			$data = $_GET;
			if (!isset($data['userID'])){
				echo "Something went wrong.";
			}else{
				$idUsuario = $data['userID'];
				$link = connect();
				$query = "SELECT apellido, nombre, email, telefono FROM `usuarios` WHERE `idUsuario` = $data[userID]";

				$response = mysqli_query($link, $query);
				if ($response){
					$row = mysqli_fetch_array($response);
					$apellido = $row['apellido'];
					$nombre = $row['nombre'];
					$email = $row['email'];
					$telefono = $row['telefono'];	
				}else{
					#User not found
				}				
			}

		?>

		<div id="cuerpo">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-xs-12 col-md-6">
						<span class="centrar margen-inferior"><img src="images/banner.png" alt="Responsive image" class="img-responsive"></span>
						<div class="panel centrar">
							<br>
							<h4 class="negrita">Editar<span class="destacado"> Cuenta	</span></h4>
							<hr>
							<div class="container">
								<form action="edit_user.php" method="POST">
									<div class="form-group">
										<input type="email" required class="u-full-width" placeholder="E-mail" name="email" value=<?php echo '"'.$email.'"'; ?>>
									</div>
									<div class="form-group">
										<input type="email" required class="u-full-width" placeholder="Repetir E-mail" value=<?php echo '"'.$email.'"'; ?>>
									</div>
									<div class="form-group">
										<input type="text" class="u-full-width" placeholder="Nombre" name="name" value=<?php echo '"'.$nombre.'"'; ?>>
									</div>
									<div class="form-group">
										<input type="text" class="u-full-width" placeholder="Apellido" name="surname" value=<?php echo '"'.$apellido.'"'; ?>>
									</div>
									<div class="form-group">
										<input type="tel" class="u-full-width" placeholder="Teléfono" name="tel" value=<?php echo '"'.$telefono.'"'; ?>>
									</div>
									<input type="hidden" name="userID" value=<?php echo '"'.$idUsuario.'"'; ?>>
									<p class="campo-obligatorio" style="display:block">Todos los campos son obligatorios</p>
									<button type="submit" class="button">ACTUALIZAR</button>
								</form>
								
								<div class="container margen-superior">
									<button type="button" class="btn btn-danger" id="change-pass-btn">¿CAMBIAR CONTRASEÑA?</button>
									<form action="change_pass.php" method="POST" id="change-pass-form" class="margen-superior">
										<div class="form-group">
											<input type="password" required class="u-full-width" placeholder="Contraseña actual" name="actual-password">
										</div>
										<div class="form-group">
											<input type="password" required class="u-full-width" placeholder="Contraseña nueva" name="new-password">
										</div>
										<div class="form-group">
											<input type="password" required class="u-full-width" placeholder="Repetir contraseña nueva" name="repeated-new-password">
										</div>
										<button type="submit" class="button">ACEPTAR</button>
									</form>
								</div>
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