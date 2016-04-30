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

				header("Location:index.php");
				$_SESSION['message_success'] = "Sesión iniciado exitosamente.";
			}
			else {
				$_SESSION['message_error'] = "Datos incorrectos.";
			}

		}

		public static function logout($email){
			session_start();
			session_destroy();
			header("Location:user_login.php");
			$_SESSION['message_success'] = "Sesión cerrada exitosamente.";
		}

		public static function register($data){

			if (!User::validateData($data)){
				return NULL;
			}

			include_once("connection.php");
			$link = connect();

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
				header("Location:user_register.php");
				$_SESSION['message_error'] = "Error al iniciar sesión.";
			}
		}

		public static function existsSession(){
			return isset($_SESSION['email']);
		}

		public static function current(){
			if (User::existsSession()){
				include_once("connection.php");
				$link = connect();
				$email = $_SESSION['email'];
				$query = "SELECT email, nombre, apellido, telefono FROM `usuarios` WHERE `email` = '$email'";
				return mysqli_query($link, $query);
			}
			else {
				return NULL;
			}
		}

		private static function validateData($data){

			# Verificación de existencia de datos
			if ((strlen($data['email']) + strlen($data['email_repetido']) + strlen($data['clave']) + strlen($data['clave_repetida']) + strlen($data['nombre']) + strlen($data['apellido']) + strlen($data['telefono'])) < 7){
				$_SESSION['message_error'] = "Todos los campos tiene que estar completos.";
				return false;
			}
			# Verificación de emails
			if ($data['email'] != $data['email_repetido']){
				$_SESSION['message_error'] = "Los emails ingresados no coinciden.";
				return false;
			}
			# Valicación de contraseña
			if (strlen($data['clave']) < 8){
				$_SESSION['message_error'] = "Las contraseña debe tener como mínimo 8 caracteres.";
				return false;
			}
			# Verificación de contraseñas
			if ($data['clave'] != $data['clave_repetida']){
				$_SESSION['message_error'] = "Las contraseñas ingresadas no coinciden.";
				return false;
			}

			# Validación de unicidad de email

			include_once("connection.php");
			$link = connect();

			$email = mysqli_escape_string($link, $data['email']);
			$query = "SELECT * FROM `usuarios` WHERE `email` = '$email'";
			$result = mysqli_query($link, $query);
			if (mysqli_num_rows($result) > 0){
				$_SESSION['message_error'] = "El email ingresado ya se encuentra en uso.";
				mysqli_close($link);
				return false;
			}
			mysqli_close($link);

			return true;
		}

	}
?>