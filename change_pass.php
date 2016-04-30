<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');

	include_once("user_class.php");
	session_start();

	if (!User::existsSession()){
		if (isset($_POST['login'])){
			User::login($_POST['email'], $_POST['clave']);
		}
	} else {
		$data = $_POST;
    if (isset($data['submit'])){
      include_once("connection.php");
      if (!isset($data['clave_actual']) || !isset($data['nueva_clave']) || !isset($data['nueva_clave_repetida'])){ #Si no se completaron todos los campos
        $_SESSION['message_error'] = "Faltan datos para cambiar la contraseña, debe completar todos los campos";
        header("Location: user_edit.php");
      }elseif($data['nueva_clave'] == $data['nueva_clave_repetida']){ #Si las claves nuevas coinciden
        $link = connect();
        $current_user = User::current();
        # Busco en la DB la tupla del usuario actual
        $current_user_email = $current_user['email'];
        $query = "SELECT clave FROM `usuarios` WHERE `email` = '$current_user_email'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0){ # En caso de una query exitosa
          $row = mysqli_fetch_array($result);
          if ($row['clave'] == $data['clave_actual']){ # Si la clave actual ingresada coincide
            $query = "UPDATE  `usuarios` SET  `clave` =  $data['nueva_clave'] WHERE  `idUsuario` = $row['idUsuario'] LIMIT 1"; # Actualizo la clave
            $result = $mysqli_query($link, $query);
            if ($result){ # Dependiendo del resultado, lo informo y redirijo
              $_SESSION['message_success'] = "Se cambió la contraseña exitosamente";
              header("Location: user_edit.php");
            }else{
              $_SESSION['message_error'] = "Ocurrió un error al cambiar la contraseña";
              header("Location: user_edit.php");
            }
          }else {
            $_SESSION['message_error'] = "ERROR - La contraseña ingresada es incorrecta";
            header("Location: user_edit.php");
          }
        }else {
          $_SESSION['message_error'] = "ERROR - No se encontro el usuario en la Base de Datos";
          header("Location: user_edit.php");
        }
      }else {
        $_SESSION['message_error'] = "ERROR - Las contraseñas no coinciden";
        header("Location: user_edit.php");
      }
    }
	}
?>
