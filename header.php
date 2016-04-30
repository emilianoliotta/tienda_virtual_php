<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	include_once("user_class.php");
	if (User::existsSession()){
		$user_current = User::current();
		$user_email = $user_current['email'];
		$dropdown_content = '
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $user_email . '<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="user_edit.php">Editar cuenta</a></li>
				<li><a href="user_logout.php">Cerrar sesión</a></li>
			</ul>';
	}
	else {
		$dropdown_content = '
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ingresar<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="user_login.php">Acceder</a></li>
				<li><a href="user_register.php">Registrarse</a></li>
			</ul>';
	}

	$header =
	'<!--HEADER -->

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
							<li class="dropdown">' . $dropdown_content . '</li>
						</ul>
					</div><!-- fin del colector de links de la barra de navegación -->
				</div>
			</nav>
		</header>

		<!--FIN del HEADER -->';

	echo $header;

?>
