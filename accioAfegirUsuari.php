<?php session_start();

		//realizamos la conexión
	$conexion = mysqli_connect('localhost', 'root', '', 'bd_cromo');

		//le decimos a la conexión que los datos los devuelva diréctamente en utf8, así no hay que usar htmlentities
		$acentos = mysqli_query($conexion, "SET NAMES 'utf8'");

		if (!$conexion) {
		    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}

		extract($_REQUEST);
		

		$sql1 = "SELECT * FROM tbl_usuarios WHERE usu_name = $usu_name LIMIT 1";

		$algunUsu = mysqli_query($conexion, $sql1);
		
		if (mysqli_num_rows($algunUsu)===0) {
			$errores = '<li>El nombre de usuario ya existe</li><br>';
			$_SESSION['errores'] = $errores;
			header('Location:afegirUsuari.php');
		}
		if ($usu_pass != $usu_pass2) {
			$errorPass = '<li>Las contraseñas no coinciden</li>';
			$_SESSION['errorPass'] = $errorPass;
			header('Location:afegirUsuari.php');
		}
		$usu_pass = hash('sha512', $usu_pass);
		$sql = "INSERT INTO `tbl_usuarios` (`usu_id`, `usu_name`, `usu_pass`, `habilitado`) VALUES (NULL, '$usu_name', '$usu_pass', '1');";
		$_SESSION['goodNews'] = "S'ha afegit un usuari correctament.";

		$actualizar_recurso = mysqli_query($conexion, $sql);
		header('Location:afegirUsuari.php');
	

		
	
	
?>