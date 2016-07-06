<?php
	include_once("user_class.php");
	if (session_id() == '') {
    session_start();
  }
	if (User::existsSession()) {
    $_SESSION['message_error'] = "Sesión ya iniciada.";
		header("Location:user_edit.php");
    return;
	}
 ?>

<!DOCTYPE html>
<html lang="es">
	<?php include_once("head.php");	?>
	<body id="js-user-registration">

		<?php
			include_once("messages.php");
			include_once("header.php");
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
							<h4 class="negrita">Crear<span class="destacado"> Cuenta</span></h4>
							<hr>
							<div class="container">
								<form method="POST" action="register_user.php" id="user-registration-form">
									<div class="form-group">
										<input type="email" required class="u-full-width" placeholder="E-mail" name="email" id="email" autofocus>
									</div>
									<div class="form-group">
										<input type="email" required class="u-full-width" placeholder="Repetir E-mail" autocomplete="off" name="email_repetido" id="email_repetido">
									</div>
									<div class="form-group">
										<input type="password" required class="u-full-width" placeholder="Contraseña" name="clave" id="clave" minlength="8">
									</div>
									<div class="form-group">
										<input type="password" required class="u-full-width" placeholder="Repetir contraseña" name="clave_repetida" id="clave_repetida" minlength="8">
									</div>
									<div class="form-group">
										<input type="text" class="u-full-width" placeholder="Nombre" name="nombre" required>
									</div>
									<div class="form-group">
										<input type="text" class="u-full-width" placeholder="Apellido" name="apellido" required>
									</div>
									<div class="form-group">
										<input type="tel" class="u-full-width" placeholder="Teléfono" name="telefono" minlength="6" required>
									</div>
									<button type="submit" class="button" name="register">REGISTRARSE</button>
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
</html>
