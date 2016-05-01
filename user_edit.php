<?php
	include_once("user_class.php");
	session_start();
	if (!User::existsSession()) {
		header("Location:user_login.php");
	}
?>

<!DOCTYPE html>
<html lang="es">
	<?php include_once("head.php"); ?>
	<body>

		<?php
			include_once("messages.php");
			include_once("header.php");

			$current_user = User::current();
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
							<h4 class="negrita">Editar<span class="destacado"> Cuenta</span></h4>
							<hr>
							<div class="container">
								<form action="edit_user.php" method="POST">
									<div class="form-group">
										<input type="text" class="u-full-width" placeholder="Nombre" name="nombre" value=<?php echo '"' . $current_user['nombre'] . '"'; ?> required>
									</div>
									<div class="form-group">
										<input type="text" class="u-full-width" placeholder="Apellido" name="apellido" value=<?php echo '"' . $current_user['apellido'] . '"'; ?>required>
									</div>
									<div class="form-group">
										<input type="tel" class="u-full-width" placeholder="Teléfono" name="telefono" value=<?php echo '"' . $current_user['telefono'] . '"'; ?> required>
									</div>
									<div class="form-group">
										<input type="password" class="u-full-width" placeholder="Ingrese su contraseña para confirmar" name="clave" required>
									</div>
									<input type="hidden" name="idUsuario" value=<?php echo '"' . $current_user['idUsuario'] . '"'; ?>>
									<p class="campo-obligatorio" style="display:block">Todos los campos son obligatorios</p>
									<button type="submit" class="button" name="update">ACTUALIZAR</button>
								</form>
								<div class="container margen-superior">
									<button type="button" class="btn btn-danger btn-sm negrita" id="change-pass-btn">¿CAMBIAR CONTRASEÑA?</button>
									<form action="change_pass.php" method="POST" id="change-pass-form" class="margen-superior">
										<br>
										<div class="form-group">
											<input type="password" required class="u-full-width" placeholder="Contraseña actual" name="clave_actual">
										</div>
										<div class="form-group">
											<input type="password" required class="u-full-width" placeholder="Contraseña nueva" name="nueva_clave">
										</div>
										<div class="form-group">
											<input type="password" required class="u-full-width" placeholder="Repetir contraseña nueva" name="nueva_clave_repetida">
										</div>
										<button type="submit" class="button" name="change_password">ACEPTAR</button>
									</form>
									<hr>
								</div>
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
