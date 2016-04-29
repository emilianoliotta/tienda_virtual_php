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



		public static function getProducts(){

			include_once("connection.php");

			$link = connect();
			$query = "SELECT nombre, precio, caducidad, idCategoriaProducto, idProducto FROM `productos`";

			$result = mysqli_query($link, $query);
			mysqli_close($link);
			if (mysqli_num_rows($result) > 0){
				return $result;
			}
			return NULL;

		}



		public static function getCategory($id){
			include_once("connection.php");

			$link = connect();
			$query = "SELECT nombre FROM `categorias_productos` WHERE `idCategoriaProducto` = $id";

			$result = mysqli_query($link, $query);
			mysql_close($link);
			if (mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_array($result);
				return $row['nombre'];
			}
			return NULL;

		}

	}
?>