<?php
  /**
   *
   */
  class Category{

    public static function getCategories(){
      include_once("connection.php");

      $link = connect();
      $query = "SELECT nombre, idCategoriaProducto FROM `categorias_productos` ORDER BY `nombre` ASC";
      $result = mysqli_query($link, $query);
      if (mysqli_num_rows($result) > 0){
        return $result;
      }else {
        return NULL;
      }
      mysqli_close($link);
    }

    public static function getCategory($id){
			include_once("connection.php");

			$link = connect();
			$query = "SELECT nombre FROM `categorias_productos` WHERE `idCategoriaProducto` = $id";

			$result = mysqli_query($link, $query);
			mysqli_close($link);
			if (mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_array($result);
				return $row['nombre'];
			}
			return NULL;
		}

  }

 ?>
