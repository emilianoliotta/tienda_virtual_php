<!DOCTYPE html>
<html lang="es">
	<?php include_once("head.php");	?>
	<body>

		<?php
			include_once("messages.php");
			include_once("user_class.php");
			if (session_id() == ''){ session_start(); }
      if (User::existsSession()){
        $user = User::current();
      }else {
        header("Location: user_login.php");
        $_SESSION['message_error'] = "Debe iniciar sesión.";
      }

			include_once("header.php");
		?>

		<?php
			include_once("category_class.php");
      include_once("product_class.php");
      $categories = Category::getCategories();
      $products = Product::getMyProducts($user['idUsuario']);
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
							<h4 class="negrita">Administrar<span class="destacado"> Productos</span></h4>
							<hr>
							<div class="container">

                <?php
                if (!is_null($products)){
                  while ($product = mysqli_fetch_array($products)){

                    echo '
                    <div class="panel panel-default">
                      <div class="panel-heading"><a href="product.php?idProducto='. $product['idProducto'] .'"><span class="negrita negra">'. $product['nombre'] .'  -  $'. $product['precio'] .'</span></a></div>
                      <div class="panel-body">
                        <div class="media">
                          <div class="media-left">
                            <a href="product.php?idProducto='. $product['idProducto'] .'">
                              <img class="media-object" style="width:90px;" src="showimage.php?idProducto='. $product['idProducto'] .'" alt="Imagen '. $product['nombre'] .'">
                            </a>
                          </div>
                          <div class="media-body" style="text-align: initial">
                            <p>
                              '. $product['descripcion'] .'
                            </p>
                            <span class="negrita">Caduca: '. date("d/m/y", strtotime($product['caducidad'])) .'</span>
                          </div>
                        </div>
                        <a class="btn btn-primary btn-sm edit-product-button" id="'. $product['idProducto'] .'">Editar</a>
                        <form method="post" action="delete_product.php" style="margin:0px; display:inline;" id="delete-form-'.$product['idProducto'].'"><input type="hidden" name="idProducto" value="'. $product['idProducto'] .'"></input><input type="hidden" name="delete" value="1"></input><a href="javascript:{}" onclick="document.getElementById(\'delete-form-'.$product['idProducto'].'\').submit(); return false;" class="btn btn-danger btn-sm">Eliminar</a></form>
                        <form class="edit-product-form" id="form-'. $product['idProducto'] .'" action="edit_product.php" method="post" style="margin-top:1em;" enctype="multipart/form-data">
                          <div class="form-group">
                            <input type="text" required class="u-full-width" placeholder="Nombre" name="name" value="'.$product['nombre'].'">
                          </div>
                          <input type="hidden" name="product_id" value="'. $product['idProducto'] .'">
                          <div class="form-group">
                            <select class="form-control" name="category_id" required>
                              <option value="">Selecciona categoría</option>
                    ';
                ?>
                              <?php
                              $categories = Category::getCategories();
                              while ($row = mysqli_fetch_array($categories)){
                                if ($row['idCategoriaProducto'] == $product['idCategoriaProducto']){
                              ?>
                                  <option value="<?php echo $row['idCategoriaProducto']; ?>" selected="selected"><?php echo $row['nombre']; ?></option>
                              <?php
                                }else{
                              ?>
                                <option value="<?php echo $row['idCategoriaProducto']; ?>"><?php echo $row['nombre']; ?></option>
                              <?php
                                }
                              }
                              ?>
                <?php
                  echo '
                            </select>
                          </div>
                          <div class="form-group">
                            <textarea type="text" required class="u-full-width" placeholder="Descripción..." autocomplete="off" name="description">'.$product['descripcion'].'</textarea>
                          </div>
                          <div class="form-group">
                            <input type="number" step="0.01" required class="u-full-width" placeholder="Precio" name="price" value="'.$product['precio'].'">
                          </div>
                          <div class="form-group">
                            <input type="date" required class="u-full-width" name="expiration" value="'.$product['caducidad'].'">
                          </div>
                          <div class="form-group">
                            <input type="file" class="u-full-width" name="image">
                          </div>
                          <button type="submit" class="button" name="update">EDITAR</button>
                        </form>
                      </div>
                    </div>
                    ';
                  }
                }else {
                  echo '<p>No tienes productos.</p>';
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
