<!DOCTYPE html>
<?php
	include_once("product_class.php");
	include_once("category_class.php");
	include_once("products_pagination.php");

	$currentPage = (isset($_GET['currentPage'])) ? $_GET['currentPage'] : NULL;
	$search = (isset($_GET['search'])) ? $_GET['search-data'] : NULL;
	$categoryID = (isset($_GET['idCategoriaProducto'])) ? $_GET['idCategoriaProducto'] : NULL;
	$order_by = (isset($_GET['orderBy'])) ? $_GET['orderBy'] : "nombre";
	$order = (isset($_GET['order'])) ? $_GET['order'] : "ASC";

	$results = paginate_products($currentPage, $search, $categoryID, $order_by, $order);
	$products = $results['products'];
	$pagesAmount = $results['pagesAmount'];
?>
<html lang="es">
	<?php include_once("head.php"); ?>
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
						<?php
							if (isset($_SESSION['category_id'])){
								echo '<span class="glyphicon glyphicon-tag negrita" aria-hidden="true"></span><span class="negrita"> Categoría: ' . Category::getCategory($_SESSION['category_id']) . '</span></br></br>';
							}
						  if (!is_null($products)){
						?>
						<table class="table">
							<tr>
								<th>Foto</th>
								<th>Producto</th>
								<th>Categoría</th>
								<th><?php
				 							if (isset($_GET['orderBy']) && $_GET['orderBy'] == "caducidad") {
												if ($_GET['order'] == "ASC"){
													if ($categoryParameterForSearch == '') {
														if ($searchParameter == '') {
															echo "<a href='products.php?orderBy=caducidad" . "&order=DESC'>Caducidad<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
														}else {
															echo "<a href='products.php" . $searchParameter . "&orderBy=caducidad" . "&order=DESC'>Caducidad<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
														}
													}else {
														echo "<a href='products.php" . $categoryParameterForSearch . $searchParameterForCategories . "&orderBy=caducidad" . "&order=DESC'>Caducidad<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
													}
												}else {
													if ($categoryParameterForSearch == '') {
														if ($searchParameter == '') {
															echo "<a href='products.php?orderBy=caducidad" . "&order=ASC'>Caducidad<span class='glyphicon glyphicon-triangle-top' aria-hidden='true'></span></a>";
														}else {
															echo "<a href='products.php" . $searchParameter . "&orderBy=caducidad" . "&order=ASC'>Caducidad<span class='glyphicon glyphicon-triangle-top' aria-hidden='true'></span></a>";
														}
													}else {
														echo "<a href='products.php" . $categoryParameterForSearch . $searchParameterForCategories . "&orderBy=caducidad" . "&order=ASC'>Caducidad<span class='glyphicon glyphicon-triangle-top' aria-hidden='true'></span></a>";
													}
												}
				 							}else {
												if ($categoryParameterForSearch == '') {
													if ($searchParameter == '') {
														echo "<a href='products.php?orderBy=caducidad" . "&order=ASC' class='negra'>Caducidad<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
													}else {
														echo "<a href='products.php" . $searchParameter . "&orderBy=caducidad" . "&order=ASC' class='negra'>Caducidad<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
													}
												}else {
													echo "<a href='products.php" . $categoryParameterForSearch . $searchParameterForCategories . "&orderBy=caducidad" . "&order=ASC' class='negra'>Caducidad<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
												}
				 							}
										?>
								</th>
								<th>
									<?php
			 							if (isset($_GET['orderBy']) && $_GET['orderBy'] == "precio") {
											if ($_GET['order'] == "ASC"){
												if ($categoryParameterForSearch == '') {
													if ($searchParameter == '') {
														echo "<a href='products.php?orderBy=precio" . "&order=DESC'>Precio<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
													}else {
														echo "<a href='products.php" . $searchParameter . "&orderBy=precio" . "&order=DESC'>Precio<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
													}
												}else {
													echo "<a href='products.php" . $categoryParameterForSearch . $searchParameterForCategories . "&orderBy=precio" . "&order=DESC'>Precio<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
												}
											}else {
												if ($categoryParameterForSearch == '') {
													if ($searchParameter == '') {
														echo "<a href='products.php?orderBy=precio" . "&order=ASC'>Precio<span class='glyphicon glyphicon-triangle-top' aria-hidden='true'></span></a>";
													}else {
														echo "<a href='products.php" . $searchParameter . "&orderBy=precio" . "&order=ASC'>Precio<span class='glyphicon glyphicon-triangle-top' aria-hidden='true'></span></a>";
													}
												}else {
													echo "<a href='products.php" . $categoryParameterForSearch . $searchParameterForCategories . "&orderBy=precio" . "&order=ASC'>Precio<span class='glyphicon glyphicon-triangle-top' aria-hidden='true'></span></a>";
												}
											}
										}else {
											if ($categoryParameterForSearch == '') {
												if ($searchParameter == '') {
													echo "<a href='products.php?orderBy=precio" . "&order=ASC' class='negra'>Precio<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
												}else {
													echo "<a href='products.php" . $searchParameter . "&orderBy=precio" . "&order=ASC' class='negra'>Precio<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
												}
											}else {
												echo "<a href='products.php" . $categoryParameterForSearch . $searchParameterForCategories . "&orderBy=precio" . "&order=ASC' class='negra'>Precio<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span></a>";
											}
										}
									?>
								</th>
							</tr>
							<?php
								while ($row = mysqli_fetch_array ($products)) {
							?>
							<tr>
								<td style="width: 120px;">
									<a href="product.php?idProducto=<?php echo $row['idProducto']; ?>"><img src="showimage.php?idProducto=<?php echo $row['idProducto'];?>" class="img-responsive img-thumbnail" alt="Imagen de producto" width="90"></a>
								</td>
								<td><a href="product.php?idProducto=<?php echo $row['idProducto']; ?>"><?php echo $row['nombre'];?></a></td>
								<td style="width: 300px;"><?php echo Category::getCategory($row['idCategoriaProducto']); ?></td>
								<td style="width: 120px;"><?php echo date("d/m/y", strtotime($row['caducidad'])); ?></td>
								<td style="width: 120px;">$<?php echo $row['precio']; ?></td>
							</tr>
							<?php
							}
							?>
						</table>
						<hr>
						<div class="text-center">
							<?php
								include_once("products_pagination_links.php");
								generate_pagination_links($pagesAmount, $currentPage, $search, $categoryID, $order_by, $order);
							?>
						</div>
						<?php }else{
							echo "<span>No hay productos.</span>" ;
						} ?>
					</div>
				</div>
			</div>
		</div>

		<!--FIN del CUERPO -->

		<?php include_once("footer.php"); ?>

	</body>
</html>
