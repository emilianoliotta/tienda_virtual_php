<?php
	include_once("user_class.php");
	session_start();
	if (!User::existsSession()){
		if (isset($_POST['login'])){
			User::login($_POST['email'], $_POST['clave']);
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
							<h4 class="negrita">Iniciar<span class="destacado"> Sesión</span></h4>
							<hr>
							<div class="container">
								<form method="POST" action="user_login.php">
									<div class="form-group">
										<input type="email" required class="u-full-width" placeholder="E-mail" name="email" autofocus>
									</div>
									<div class="form-group">
										<input type="password" required class="u-full-width" placeholder="Contraseña" name="clave">
									</div>
									<button type="submit" class="button" name="login">INICIAR SESIÓN</button>
								</form>
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