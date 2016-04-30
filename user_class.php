<?php
	class User{

		/* Métodos de acceso, modificación y creación de usuarios */

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

				header("Location:products.php");
				$_SESSION['message_success'] = "Sesión iniciada exitosamente.";
			}
			else {
				header("Location:user_login.php");
				$_SESSION['message_error'] = "Datos incorrectos.";
			}

		}

		public static function logout($email){
			session_start();
			session_destroy();
			session_start();
			$_SESSION['message_success'] = "Sesión cerrada exitosamente.";
		}

		public static function register($data){

			if (!User::validateData($data)){
				header("Location:user_register.php");
				return NULL;
			}

			include_once("connection.php");
			$link = connect();

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

		public static function update($data){

			if (!User::validatePassword($data['clave'])){
				$_SESSION['message_error'] = "Contraseña incorrecta.";
				return NULL;
			}
			if (!User::validateFormFields($data, false)){
				return NULL;
			}

			include_once("connection.php");
			$link = connect();

			$user_current = User::current();
			$idUsuario = $user_current['idUsuario']; // No se utliza el ID del formulario para evitar que un usario modifique la información de otro usuario
			$nombre = mysqli_escape_string($link, $data['nombre']);
			$apellido = mysqli_escape_string($link, $data['apellido']);
			$telefono = mysqli_escape_string($link, $data['telefono']);

			$query = "UPDATE `usuarios` SET apellido = '$apellido', nombre = '$nombre', telefono = '$telefono' WHERE idUsuario = '$idUsuario'";

			$result = mysqli_query($link, $query);
			mysqli_close($link);

			if ($result){
				$_SESSION['message_success'] = "Datos de cuenta actualizados.";
			}
		}

		/* Métodos de manejo de sesión */

		// Devuelve TRUE si existe una sesión de usuario activa, FALSE en caso contrario
		public static function existsSession(){
			return isset($_SESSION['email']);
		}

		// Devuelve los datos del usuario logueado, NULL en caso contrario
		public static function current(){
			if (User::existsSession()){
				include_once("connection.php");
				$link = connect();
				$email = $_SESSION['email'];
				$query = "SELECT idUsuario, email, nombre, apellido, telefono FROM `usuarios` WHERE `email` = '$email'";
				$result = mysqli_fetch_array(mysqli_query($link, $query));
				mysqli_close($link);
				return $result;
			}
			else {
				return NULL;
			}
		}

		/* Métodos de validación de datos */

		// Valida datos de registro de usuario
		private static function validateData($data){

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

			return User::validateFormFields($data, true);

		}

		// Valida si se completaron los campos del formulario
		private static function validateFormFields($data, $with_email_validation){

			# Verificación de existencia de datos
			$email = ($data['email'] != "");
			$clave = ($data['clave'] != "");
			$nombre = ($data['nombre'] != "");
			$apellido = ($data['apellido'] != "");
			$telefono = ($data['telefono'] != "");
			$condition = $clave && $nombre && $apellido && $telefono;
			if ($with_email_validation){
				$condition = $condition && $email;
			}
			if (!$condition){
				$_SESSION['message_error'] = "Todos los campos tienen que estar completos.";
				return false;
			}
			return true;
		}

		// Valida la contraseña del usuario
		private static function validatePassword($password){
			include_once("connection.php");
			$link = connect();

			$user_current = User::current();
			$idUsuario = $user_current['idUsuario'];
			$query = "SELECT clave FROM `usuarios` WHERE `idUsuario` = '$idUsuario'";
			$result = mysqli_fetch_array(mysqli_query($link, $query));
			mysqli_close($link);
			return ((string)$result['clave'] == (string )$password);
		}

	}
?>
