<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	include_once("user_class.php");
	include_once("category_class.php");

	$categories = Category::getCategories();
	$categories_link = '';

	if (User::existsSession()){
		$user_current = User::current();
		$user_email = $user_current['email'];
		$dropdown_content = '
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $user_email . '<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="user_edit.php">Editar cuenta</a></li>
				<li><a href="user_logout.php">Cerrar sesión</a></li>
			</ul>';
			if(User::hasAdminPrivileges()){
				$categories_link = '</span><a href="categories_management.php" class="btn btn-primary btn-xs"> Editar</a>';
			}
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
							<li><a href="about.php"><span class="hvr-wobble-vertical">ACERCA DE</span></a></li>
						</ul>
							<form class="navbar-form navbar-left" role="search" method="GET" action="products.php">
								<div class="form-group">
									<input type="text" class="u-full-width" placeholder="Buscar productos..." name="search-data">
								</div>
								<button type="submit" name="search" class="button">BUSCAR</button>
							</form>
							<div class="navbar-form navbar-left">
								<button type="button" name="categories-button" id="categories-button" class="button">Categorías</button>
							</div>
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

		<div class="container-fluid categories-panel" id="categories-panel">
			<div class="col-xs-12 col-md-12">
				<div class="row well">
					<?php if (is_null($categories)){
						echo "<p>No hay categorías para mostrar.</p>";
					}else {
						if(session_id() == '') {
							session_start();
						}
						if (isset($_SESSION['category_id'])){
							echo "<a href='products.php?idCategoriaProducto=0' class='category-link negrita' id='remove-filter-button'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><span> Eliminar filtro</span></a>";
						}
						while ($row = mysqli_fetch_array($categories)){
							if (isset($_SESSION['category_id']) && $_SESSION['category_id'] == $row['idCategoriaProducto']){
					?>
								<a href="products.php?idCategoriaProducto=<?php echo $row['idCategoriaProducto']; ?>" class="category-link negrita"><?php echo $row['nombre']; ?></a>
					<?php
							}else{
					?>
								<a href="products.php?idCategoriaProducto=<?php echo $row['idCategoriaProducto']; ?>" class="category-link"><?php echo $row['nombre']; ?></a>
					<?php
							}
						}
					}
					?>
					<?php echo $categories_link; ?>
				</div>
			</div>
		</div>
