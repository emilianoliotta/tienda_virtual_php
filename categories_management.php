<!DOCTYPE html>
<html lang="es">
	<?php include_once("head.php");	?>
	<body id="js-categories-management">

		<?php
			include_once("messages.php");

			include_once("user_class.php");
			if (session_id() == ''){ session_start(); }
			
			// Validar sesión iniciada
			try {
				User::validateSession();
			} catch (Exception $exception) {
				$_SESSION['message_error'] = $exception->getMessage();
				header("Location:user_login.php");
				return;
			}

			// Validar privilegios de administrador
			try {
				User::validateAdminPrivileges();
			} catch (Exception $exception) {
				$_SESSION['message_error'] = $exception->getMessage();
				header("Location:products.php");
				return;
			}

			include_once("header.php");
		?>

		<?php
			include_once("category_class.php");
      $categories = Category::getCategories();
		 ?>

		<!-- CUERPO -->

		<div id="cuerpo">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-xs-12 col-md-8">
						<span class="centrar margen-inferior"><img src="images/banner.png" alt="Responsive image" class="img-responsive"></span>
						<div class="panel centrar">
							<br>
							<h4 class="negrita">Administrar<span class="destacado"> Categorías</span></h4>
							<hr>
							<div class="container">
                <div class="row">
                  <button type="button" name="new-category-button" id="new-category-button" class="margin-bottom">Agregar categoría</button>
                  <form action="new_category.php" method="POST" id="new-category-form">
  									<div class="form-group">
  										<input type="text" required class="u-full-width" placeholder="Categoría" name="category" id="new-category-input">
  									</div>
  									<button type="submit" class="button" name="submit">Aceptar</button>
  								</form>
                </div>
                <?php
                if (!mysqli_num_rows($categories) > 0){
                  echo '<p>No hay categorías.</p>';
                }else {

                  while($row = mysqli_fetch_array($categories)){
                    echo '
                    <div class="row category-row">
                      <div class="col-xs-12 col-md-8">
                        <span class="negrita">'. $row['nombre'] .'</span>
                      </div>
                      <div class="col-xs-12 col-md-2">
                        <button class="btn btn-primary btn-xs edit-category-button" style="height:24px" id="'. $row['idCategoriaProducto'] .'">Editar</buttn>
                      </div>
                      <div class="col-xs-12 col-md-2">
                        <form method="post" action="delete_category.php" style="margin:0px"><input type="hidden" name="idCategoriaProducto" value="'. $row['idCategoriaProducto'] .'"></input><button type="submit" class="btn btn-danger btn-xs" style="height: 24px" name="delete">Eliminar</button></form>
                      </div>
                      <form action="edit_category.php" method="POST" class="edit-category-form" id="form-'. $row['idCategoriaProducto'] .'">
      										<input type="hidden" name="category_id" value="'. $row['idCategoriaProducto'] .'" class="edit-category-input"></input>
      									<div class="form-group">
      										<input type="text" required class="u-full-width" placeholder="Nuevo nombre" name="category_name" value="'. $row['nombre'] .'">
      									</div>
      									<button type="submit" class="button" name="update">Actualizar</button>
      								</form>
                    </div>';
                  }
                  echo '<br>';
                }
                ?>
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
