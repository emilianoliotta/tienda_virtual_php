<?php
	class Comment{

		const NO_ERROR = "No existen errores.";

		public static function getComments($product_id){

			include_once("connection.php");

			$link = connect();
      $product_id = mysqli_escape_string($link, $product_id);
			$query = "SELECT comentario, idProducto, idComentarioProducto FROM `comentarios_productos` WHERE `idProducto` = $product_id";

      $result = mysqli_query($link, $query);
			mysqli_close($link);
			if (mysqli_num_rows($result) > 0){
				return $result;
			}
			return NULL;
		}

		public static function create($data){
			$validation = Comment::validateFormFields($data);
			if($validation != Comment::NO_ERROR){
				throw new Exception($validation, 1);
			}

			include_once("connection.php");
			$link = connect();

			$query = "INSERT INTO `comentarios_productos` (`idComentarioProducto`, `idProducto`, `comentario`) VALUES (NULL, '$data[product_id]', '$data[comment]')";
			$result = mysqli_query($link, $query);
			mysqli_close($link);
      return $result;

		}

		private static function validateFormFields($data){

			# Verificación de existencia de datos
			$comment = ($data['comment'] != "");
			$product_id = ($data['product_id'] != "" && is_numeric($data['product_id']));

			$condition = $comment && $product_id;
			if (!$condition){
				return "Todos los campos tienen que estar completos con valores válidos.";
			}
			return Comment::NO_ERROR;
		}
	}
?>
