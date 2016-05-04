<?php
	class Product{

		const ROWS_PER_PAGE = 6;
		const NO_ERROR = "No existen errores.";

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

		public static function getProducts($search = "", $category_id, $order_by, $order, $offset = 0, $rowsAmount = PHP_INT_SIZE){

			include_once("connection.php");

			$link = connect();
			if (isset($category_id)){
				$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos` WHERE (`nombre` LIKE '%$search%' OR `descripcion` LIKE '%$search%') AND (`caducidad` >= CURDATE()) AND (`idCategoriaProducto` = '$category_id') ORDER BY $order_by $order LIMIT $offset, $rowsAmount";
			}
			else {
				$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos` WHERE (`nombre` LIKE '%$search%' OR `descripcion` LIKE '%$search%') AND `caducidad` >= CURDATE() ORDER BY $order_by $order LIMIT $offset, $rowsAmount";
			}

			$result = mysqli_query($link, $query);
			mysqli_close($link);
			if (mysqli_num_rows($result) > 0){
				return $result;
			}
			return NULL;
		}

		public static function getRowsAmount($search = "", $category_id = NULL){
			include_once("connection.php");
			$link = connect();
			if(session_id() == '') { session_start(); }
			if ($category_id != NULL){
				$query = "SELECT COUNT(*) FROM `productos` WHERE (`nombre` LIKE '%$search%' OR `descripcion` LIKE '%$search%') AND `caducidad` >= CURDATE() AND `idCategoriaProducto` = '$category_id'";
			}
			else {
				$query = "SELECT COUNT(*) FROM `productos` WHERE (`nombre` LIKE '%$search%' OR `descripcion` LIKE '%$search%') AND `caducidad` >= CURDATE()";
			}
			$result = mysqli_query($link, $query);
			mysqli_close($link);

			$row = mysqli_fetch_row($result);
			return $row[0];
		}

		public static function create($data){
			$validation = Product::validateFormFields($data);
			if($validation != Product::NO_ERROR){
				throw new Exception($validation, 1);
			}

			include_once("connection.php");
			$link = connect();

			$query = "INSERT INTO `productos` (`idProducto`, `idUsuario`, `idCategoriaProducto`, `nombre`, `descripcion`, `precio`, `publicacion`, `caducidad`, `contenidoimagen`, `tipoimagen`) VALUES (NULL, '$data[user_id]', '$data[category_id]', '$data[name]', '$data[description]', '$data[price]', CURDATE(), '$data[expiration]', '$data[image]', '$data[image_type]')";
			$result = mysqli_query($link, $query);
			mysqli_close($link);

			return $result;
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

		private static function validateFormFields($data){

			# Verificación de existencia de datos
			$name = ($data['name'] != "");
			$category_id = ($data['category_id'] != "");
			$description = ($data['description'] != "");
			$price = ($data['price'] != "");
			$expiration = ($data['expiration'] != "");
			$user_id = ($data['user_id'] != "");
			#$image = ($data['image'] != "");
			#$image_type = ($data['image_type'] != "");

			$condition = $name && $category_id && $description && $price && $expiration && $user_id;
			if (!$condition){
				return "Todos los campos tienen que estar completos.";
			}
			return Product::NO_ERROR;
		}
	}
?>
