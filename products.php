<!DOCTYPE html>
<?php
	include_once("product_class.php");
	
	$products = Product::getProducts();
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
				<div class="col-xs-12 col-md-12">
					<div class="row well">
						<?php if (!is_null($products)){ ?>
						<table class="table">
							<tr>
								<th>Foto</th>
								<th>Producto</th>
								<th>Categoría</th>
								<th>Caducidad</th>
								<th>Precio</th>
							</tr>
							<?php
								while ($row = mysqli_fetch_array ($products)) {
							?>
							<tr>
								<td style="width: 120px;">
									<a href="product.php?idProducto=<?php echo $row['idProducto']; ?>"><img src="showimage.php?idProducto=<?php echo $row['idProducto'];?>" class="img-responsive img-thumbnail" alt="Imagen de producto" width="90"></a>
								</td>
								<td><a href="product.php?idProducto=<?php echo $row['idProducto']; ?>"><?php echo $row['nombre'];?></a></td>
								<td style="width: 300px;"><?php echo Product::getCategory($row['idCategoriaProducto']); ?></td>
								<td style="width: 100px;"><?php echo date("d/m/y", strtotime($row['caducidad'])); ?></td>
								<td style="width: 120px;">$<?php echo $row['precio']; ?></td>
							</tr>
							<?php
							}
							?>
						</table>
						<?php }else{
							echo "<span>No hay productos.</span>" ;
						} ?>
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