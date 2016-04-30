<?php
	include_once("user_class.php");
	session_start();
	if (!User::existsSession()){
		if (isset($_POST['register'])){
			$data = array(
				'email' => $_POST['email'],
				'email_repetido' => $_POST['email_repetido'],
				'clave' => $_POST['clave'],
				'clave_repetida' => $_POST['clave_repetida'],
				'nombre' => $_POST['nombre'],
				'apellido' => $_POST['apellido'],
				'telefono' => $_POST['telefono']
			);
			User::register($data);
		}
	}
	else {
		header("Location:index.php");
				$_SESSION['message_error'] = "Ya existe una sesión iniciada.";
	}
?>

<!DOCTYPE html>
<html lang="es">
	<?php
		include_once("head.php");
	?>
	<body>

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
								<form action="" method="POST" action="user_register.php">
									<div class="form-group">
										<input type="email" required class="u-full-width" placeholder="E-mail" name="email" autofocus>
									</div>
									<div class="form-group">
										<input type="email" required class="u-full-width" placeholder="Repetir E-mail" autocomplete="off" name="email_repetido">
									</div>
									<div class="form-group">
										<input type="password" required class="u-full-width" placeholder="Contraseña" name="clave">
									</div>
									<div class="form-group">
										<input type="password" required class="u-full-width" placeholder="Repetir contraseña" name="clave_repetida">
									</div>
									<div class="form-group">
										<input type="text" class="u-full-width" placeholder="Nombre" name="nombre">
									</div>
									<div class="form-group">
										<input type="text" class="u-full-width" placeholder="Apellido" name="apellido">
									</div>
									<div class="form-group">
										<input type="tel" class="u-full-width" placeholder="Teléfono" name="telefono">
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

		<!--FOOTER -->

		<footer>
			<div class="">Copyright © 2016</div>
				<div class="destacado"><a href="#">Términos y condiciones</a> | <a href="#">Políticas de privacidad</a> | <a href="#">Ayuda</a></div>
		</footer>

		<!--FIN del FOOTER -->

	</body>
</html>