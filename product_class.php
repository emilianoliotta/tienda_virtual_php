<?php
	class Product{

		public static function getProductData($id){
			include_once("connection.php");

			$link = connect();
			$id = mysqli_escape_string($link, $id);
			$query = "SELECT nombre, descripcion, precio, publicacion, caducidad, idCategoriaProducto, idUsuario, idProducto FROM `productos` WHERE `idProducto` = $id";

			$result = mysqli_query($link, $query);

			if (mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_array($result);
				$nombre = $row['nombre'];
				$descripcion = $row['descripcion'];
				$precio = $row['precio'];
				$publicacion = $row['publicacion'];
				$caducidad = $row['caducidad'];
				$idCategoriaProducto = $row['idCategoriaProducto'];
				$idUsuario = $row['idUsuario'];
				$idProducto = $row['idProducto'];

				#Consulto nombre de categoria
				$query = "SELECT nombre FROM `categorias_productos` WHERE `idCategoriaProducto` = $idCategoriaProducto";
				$result = mysqli_query($link, $query);
				if (mysqli_num_rows($result) > 0){
					$row = mysqli_fetch_array($result);
					$categoria = $row['nombre'];
				}
				mysqli_close($link);
			}else{
				mysqli_close($link);
				return NULL;
			}
			if (isset($nombre)){
				$data['nombre'] = $nombre;
				$data['descripcion'] = $descripcion;
				$data['precio'] = $precio;
				$data['publicacion'] = $publicacion;
				$data['caducidad'] = $caducidad;
				$data['categoria'] = $categoria;
				$data['idCategoriaProducto'] = $idCategoriaProducto;
				$data['idUsuario'] = $idUsuario;
				$data['idProducto'] = $idProducto;
			}
			return $data;
		}

		public static function getProducts($category_id){

			include_once("connection.php");

			$link = connect();
			if(session_id() == '') {
				session_start();
			}
			if (isset($category_id) && $category_id == '0'){
				unset($category_id);
				unset($_SESSION['category_id']);
			}
			if (isset($category_id)){
				$_SESSION['category_id'] = $category_id;
				$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos` WHERE `caducidad` >= CURDATE() AND `idCategoriaProducto` = '$category_id'";
			}elseif(isset($_SESSION['category_id'])){
				$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos` WHERE `caducidad` >= CURDATE() AND `idCategoriaProducto` = '$_SESSION[category_id]'";
			}else{
				$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos` WHERE `caducidad` >= CURDATE()";
			}

			$result = mysqli_query($link, $query);
			mysqli_close($link);
			if (mysqli_num_rows($result) > 0){
				return $result;
			}
			return NULL;
		}

		public static function getProductsForSearch($search, $category_id){

			include_once("connection.php");

			$link = connect();
			if(session_id() == '') {
				session_start();
			}
			if (isset($category_id) && $category_id == '0'){
				unset($category_id);
				unset($_SESSION['category_id']);
			}
			if (isset($category_id)){
				$_SESSION['category_id'] = $category_id;
				$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos` WHERE (`nombre` LIKE '%$search%' OR `descripcion` LIKE '%$search%') AND (`caducidad` >= CURDATE()) AND (`idCategoriaProducto` = '$category_id')";
			}elseif(isset($_SESSION['category_id'])) {
				$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos` WHERE (`nombre` LIKE '%$search%' OR `descripcion` LIKE '%$search%') AND `caducidad` >= CURDATE() AND (`idCategoriaProducto` = '$_SESSION[category_id]')";
			}else {
				$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos` WHERE (`nombre` LIKE '%$search%' OR `descripcion` LIKE '%$search%') AND `caducidad` >= CURDATE()";
			}

			$result = mysqli_query($link, $query);
			mysqli_close($link);
			if (mysqli_num_rows($result) > 0){
				return $result;
			}
			return NULL;
		}

		public static function isCurrentUserTheOwner($product){
			include_once("user_class.php");
			$current_user = User::current();
			return ($product['idUsuario'] == $current_user['idUsuario']);
		}

		public static function getMyProducts($user_id){
			include_once("connection.php");
			$link = connect();
			if (isset($user_id)){
				$query = "SELECT nombre, precio, caducidad, descripcion, idCategoriaProducto, idProducto FROM `productos` WHERE `idUsuario` = '$user_id'";
			}else{
				return NULL;
			}
			$result = mysqli_query($link, $query);
			mysqli_close($link);
			if (mysqli_num_rows($result) > 0){
				return $result;
			}
			return NULL;
		}
	}
?>
