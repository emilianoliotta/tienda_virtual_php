<?php
	class User{

		public static function login($email, $clave){
			include_once("connection.php");

			$link = connect();
			$email = mysqli_escape_string($link, $email);
			$clave = mysqli_escape_string($link, $clave);
			$query = "SELECT * FROM `usuarios` WHERE `email` = '$email' AND `clave` = '$clave'";

			$result = mysqli_query($link, $query);

			if (mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_array($result);
				$email = $row['email'];

				$_SESSION['email'] = $email;

				$_SESSION['message_success'] = "Sesión iniciado exitosamente.";
				header("Location:index.php");
			}
			else {
				$_SESSION['message_error'] = "Datos incorrectos.";
				header("Location:user_login.php");
			}

		}

		public static function logout($email){
			session_start();
			session_destroy();
			$_SESSION['message_success'] = "Sesión cerrada exitosamente.";
			header("Location:user_login.php");
		}

		public static function register($data){

			# Verificación de existencia de datos
			if ((strlen($data['email']) + strlen($data['email_repetido']) + strlen($data['clave']) + strlen($data['clave_repetida']) + strlen($data['nombre']) + strlen($data['apellido']) + strlen($data['telefono'])) < 7){
				$_SESSION['message_error'] = "Todos los campos tiene que estar completos.";
				header("Location:user_register.php");
				return NULL;
			}
			# Verificación de emails
			if ($data['email'] != $data['email_repetido']){
				$_SESSION['message_error'] = "Los emails ingresados no coinciden.";
				header("Location:user_register.php");
				return NULL;
			}
			# Valicación de contraseña
			if (strlen($data['clave']) < 8){
				$_SESSION['message_error'] = "Las contraseña debe tener como mínimo 8 caracteres.";
				header("Location:user_register.php");
				return NULL;
			}
			# Verificación de contraseñas
			if ($data['clave'] != $data['clave_repetida']){
				$_SESSION['message_error'] = "Las contraseñas ingresadas no coinciden.";
				header("Location:user_register.php");
				return NULL;
			}

			include_once("connection.php");
			$link = connect();

			# Validación de unicidad de email
			$email = mysqli_escape_string($link, $data['email']);
			$query = "SELECT * FROM `usuarios` WHERE `email` = '$email'";
			$result = mysqli_query($link, $query);
			if (mysqli_num_rows($result) > 0){
				$_SESSION['message_error'] = "El email ingresado ya se encuentra en uso.";
				mysqli_close($link);
				return NULL;
			}

			# Creación de usuario
			$email = mysqli_escape_string($link, $data['email']);
			$clave = mysqli_escape_string($link, $data['clave']);
			$nombre = mysqli_escape_string($link, $data['nombre']);
			$apellido = mysqli_escape_string($link, $data['apellido']);
			$telefono = mysqli_escape_string($link, $data['telefono']);

			$query = "INSERT INTO `usuarios` (`idUsuario`, `clave`, `apellido`, `nombre`, `email`, `telefono`) VALUES (NULL, '$clave', '$apellido', '$nombre', '$email', '$telefono')";

			$result = mysqli_query($link, $query);
			mysqli_close($link);

			if ($result){
				User::login($email, $clave);
			}
			else {
				$_SESSION['message_error'] = "Error al iniciar sesión.";
				header("Location:user_register.php");
			}
		}

	}
?>