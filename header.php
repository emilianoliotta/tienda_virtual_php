<?php
	error_reporting(E_ERROR);
	ini_set('display_errors', 'on');
	include_once("user_class.php");
	include_once("category_class.php");

	$categories = Category::getCategories();
	$category_link_on_products_menu = '';
	$categories_link = '';

	if(isset($_GET['idCategoriaProducto'])){
		$categoryID = $_GET['idCategoriaProducto'];
		$categoryParameter = '<input type="text" value="' . $categoryID . '" class="u-full-width" name="idCategoriaProducto" hidden>';
		$categoryParameterForSearch = '?idCategoriaProducto=' . $categoryID;
	}
	else {
		$categoryParameter = '';
		$categoryParameterForSearch = '';
	}

	if(isset($_GET['search'])){
		$searchData = $_GET['search-data'];
		$searchParameter = '?search-data=' . $searchData . '&search=';
		$searchParameterForCategories = '&search-data=' . $searchData . '&search=';
	}
	else {
		$searchParameter = '';
		$searchParameterForCategories = '';
	}

	if(isset($_GET['orderBy']) && isset($_GET['order'])){
		$orderBy = $_GET['orderBy'];
		$order = $_GET['order'];
		$orderByParameter = '<input type="text" value="' . $orderBy . '" class="u-full-width" name="orderBy" hidden>';
		$orderParameter = '<input type="text" value="' . $order . '" class="u-full-width" name="order" hidden>';
		$orderByParameterForSearch = 'orderBy=' . $orderBy . "&order=" . $order;
	}
	else {
		$orderByParameter = '';
		$orderParameter = '';
		$orderByParameterForSearch = '';
	}

	if (User::existsSession()){
		if(User::hasAdminPrivileges()){
			$category_link_on_products_menu = '<li><a href="categories_management.php"><span style="color:#b86733" class="negrita">Administrar categorías <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span></a></li>';
			$categories_link = '</span><a href="categories_management.php" class="btn btn-primary btn-xs"> Editar</a>';
		}
		$user_current = User::current();
		$user_email = $user_current['email'];
		$dropdown_content = '
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $user_email . '<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="user_edit.php">Editar cuenta</a></li>
				<li><a href="user_logout.php">Cerrar sesión</a></li>
			</ul>';
		$product_dropdown_content = '
			<li class="dropdown">
				<a href="#" class="dropdown-toggle hvr-wobble-vertical" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PRODUCTOS <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:green"></span></a>
				<ul class="dropdown-menu">
					<li><a href="product_new.php"><span style="color:green" class="negrita">Publicar producto <span class="glyphicon glyphicon-upload" aria-hidden="true"></span></span></a></li>
					<li><a href="products_management.php"><span style="color:#337ab7" class="negrita">Administrar mis productos <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span></a></li>' . $category_link_on_products_menu . '					
				</ul>
			</li>';
	}
	else {
		$dropdown_content = '
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ingresar<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="user_login.php">Acceder</a></li>
				<li><a href="user_register.php">Registrarse</a></li>
			</ul>';
		$product_dropdown_content = '';
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
							' . $product_dropdown_content . '
						</ul>
							<form class="navbar-form navbar-left" role="search" method="GET" action="products.php">
								<div class="form-group">
									<input type="text" class="u-full-width" placeholder="Buscar productos..." name="search-data">'. $categoryParameter . $orderByParameter . $orderParameter .
								'</div>
								<button type="submit" name="search" class="button"><span class="glyphicon glyphicon-search negrita" aria-hidden="true"></span></button>
							</form>
							<div class="navbar-form navbar-left">
								<button type="button" name="filter-button" id="filter-button" class="button">Filtrar productos</button>
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

		<div class="container-fluid filter-panel" id="filter-panel">
			<div class="col-xs-12 col-md-12">
				<div class="row well">
					<?php if (is_null($categories)){
						echo "<p>No hay categorías para mostrar.</p>";
					}else {
						if (isset($_GET['idCategoriaProducto'])){
							if ($searchParameter == ''){
								echo "<a href='products.php?" . $orderByParameterForSearch . "' class='category-link negrita' id='remove-filter-button'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><span> Eliminar filtrado de categorías</span></a>";
							}else {
								echo "<a href='products.php" . $searchParameter . "&" . $orderByParameterForSearch . "' class='category-link negrita' id='remove-filter-button'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><span> Eliminar filtrado de categorías</span></a>";
							}
						}
						while ($row = mysqli_fetch_array($categories)){
							if (isset($_GET['idCategoriaProducto']) && $_GET['idCategoriaProducto'] == $row['idCategoriaProducto']){
					?>
								<a href="products.php?idCategoriaProducto=<?php echo $row['idCategoriaProducto'] . $searchParameterForCategories . "&" . $orderByParameterForSearch; ?>" class="category-link negrita"><?php echo $row['nombre']; ?></a>
					<?php
							}else{
					?>
								<a href="products.php?idCategoriaProducto=<?php echo $row['idCategoriaProducto'] . $searchParameterForCategories . "&" . $orderByParameterForSearch; ?>" class="category-link"><?php echo $row['nombre']; ?></a>
					<?php
							}
						}
					}
					?>
					<?php echo $categories_link; ?>
				</div>
				<?php if(isset($_GET['search'])){ ?>
					<div class="row well">
						<a href='products.php<?php if($categoryParameterForSearch == ''){echo "?" . $orderByParameterForSearch;}else{echo $categoryParameterForSearch . "&" . $orderByParameterForSearch;} ?>' class='category-link negrita' id='remove-filter-button'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><span> Eliminar filtrado de búsqueda</span></a>
						<div class="">Buscando <span class="italica destacado"><?php echo $searchData; ?></span></div>
					</div>
				<?php } ?>
			</div>
		</div>
