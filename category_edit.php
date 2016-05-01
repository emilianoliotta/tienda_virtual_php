<!DOCTYPE html>
<html lang="es">
	<?php include_once("head.php");	?>
	<body>

		<?php
			include_once("messages.php");

			include_once("user_class.php");
			if (session_id() == '') {
				session_start();
			}
			if (User::existsSession()){
				$user = User::current();
				if ($user['email'] != "admin@admin"){
					$_SESSION['message_error'] = "Acceso denegado. Sin permisos.";
					header("Location: products.php");
				}
			}else {
				$_SESSION['message_error'] = "Acceso denegado.";
				header("Location: user_login.php");
			}

			include_once("header.php");
		?>

		<?php
			include_once("connection.php");
			$link = connect();
			$query = "SELECT * FROM `categorias_productos` ORDER BY `nombre` ASC";

			$result = mysqli_query($link, $query);
			mysqli_close($link);
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
							<h4 class="negrita">Editar<span class="destacado"> Categoría</span></h4>
							<hr>
							<div class="container">
								<form action="edit_category.php" method="POST">
									<div class="form-group">
										<select class="form-control" name="category_id" required>
											<option value="">Selecciona categoría a editar</option>
											<?php while ($row = mysqli_fetch_array($result)){ ?>
										  	<option value="<?php echo $row['idCategoriaProducto']; ?>"><?php echo $row['nombre']; ?></option>
										  <?php } ?>
										</select>
									</div>
									<div class="form-group">
										<input type="text" required class="u-full-width" placeholder="Categoría" name="category_name">
									</div>
									<button type="submit" class="button" name="update">Actualizar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--FIN del CUERPO -->

		<?php include_once("footer.php"); ?>

	</body>
</html>
