<!DOCTYPE html>
<?php
	include_once("product_class.php");

	if (isset($_GET['idProducto'])){
		$data = Product::getProductData($_GET['idProducto']);
		if (is_null($data)){
			header("Location: index.php"); #No se encontro el producto
		}
	}else{
		header("Location: index.php"); #No se especifico producto
	}
?>
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
					<div class="col-xs-12 col-md-6">
						<div class="panel centrar">
							<br>
							<div class="container">
								<div class="row centrar">
									<img src="showimage.php?idProducto=<?php echo $data['idProducto'];?>" class="img-responsive img-rounded" alt="Imagen de producto">
								</div>
								<hr>
								<div><span class="negrita">Categoría: </span><?php echo $data['categoria']; ?></div>
								<div><span class="negrita">Fecha de publicación: </span><?php echo date("d/m/y", strtotime($data['publicacion'])); ?></div>
								<div><span class="negrita">Fecha de caducidad: </span><?php echo date("d/m/y", strtotime($data['caducidad'])); ?></div>
								<br>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="well">
							<h4 class="negrita"><?php echo $data['nombre'];?></h4>
							<hr>
							<div>
								<div class="container-fluid">
									<div class="row">
										<p><span class="negrita">DESCRIPCIÓN: </span><?php echo $data['descripcion']; ?></p>
									</div>
								</div>
							</div>
							<hr>
							<div class="centrar">
								<p class="negrita">$<?php echo $data['precio']; ?></p>
								<a href="user_login.php" class="button">INICIAR SESIÓN PARA COMPRAR</a>
								<p></p>
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