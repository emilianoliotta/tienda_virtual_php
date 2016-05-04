<?php
	include_once("user_class.php");
	if (session_id() == '') { session_start(); }
	if (!User::existsSession()) {
		header("Location: user_login.php");
		$_SESSION['message_error'] = "Inicio de sesión requerido para publicar un producto.";
	}
 ?>

<!DOCTYPE html>
<html lang="es">
	<?php include_once("head.php");	?>
	<body>

		<?php
			include_once("messages.php");
			include_once("header.php");
      include_once("category_class.php");
      $categories = Category::getCategories();
		?>

		<!-- CUERPO -->

		<div id="cuerpo">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-xs-12 col-md-6">
						<span class="centrar margen-inferior"><img src="images/banner.png" alt="Responsive image" class="img-responsive"></span>
						<div class="panel centrar">
							<br>
							<h4 class="negrita">Nuevo<span class="destacado"> Producto</span></h4>
							<hr>
							<div class="container">
								<form method="POST" action="new_product.php" enctype="multipart/form-data" id="new-product-form">
									<div class="form-group">
										<input type="text" required class="u-full-width" placeholder="Nombre" name="name" autofocus>
									</div>
                  <div class="form-group">
                    <select class="form-control" name="category_id" required>
 											<option value="">Selecciona categoría</option>
 											<?php while ($row = mysqli_fetch_array($categories)){ ?>
 										  	<option value="<?php echo $row['idCategoriaProducto']; ?>"><?php echo $row['nombre']; ?></option>
 										  <?php } ?>
 										</select>
									</div>
									<div class="form-group">
										<textarea type="text" required class="u-full-width" placeholder="Descripción..." autocomplete="off" name="description"></textarea>
									</div>
									<div class="form-group">
										<input type="number" required class="u-full-width" placeholder="Precio" name="price">
									</div>
									<div class="form-group">
										<input type="date" required class="u-full-width" name="expiration">
									</div>
									<div class="form-group">
										<input type="file" class="u-full-width" name="image">
									</div>
									<button type="submit" class="button" name="submit">AGREGAR</button>
								</form>
								<p class="campo-obligatorio">Todos los campos son obligatorios</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--FIN del CUERPO -->

		<?php include_once("footer.php"); ?>

	</body>

	<script type="text/javascript">
		// VALIDATIONS - Validaciones de los datos de los formularios
		$("#new-product-form").validate();
	</script>

</html>
