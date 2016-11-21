<?php session_start();

if (isset($_SESSION['usu_name'])) {
	header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usu_name = filter_var(strtolower($_POST['usu_name']), FILTER_SANITIZE_STRING);
	$usu_pass = $_POST['usu_pass'];
	$usu_pass2 = $_POST['usu_pass2'];

	$errores = '';

	if (empty($usu_name) or empty($usu_pass) or empty($usu_pass2)) {
		$errores .= '<li>Por favor rellena todos los datos correctamente</li>';
	} else {
		try {
			$conexion = new PDO('mysql:host=localhost;dbname=bd_cromo', 'root', '');
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		$statement = $conexion->prepare('SELECT * FROM tbl_usuarios WHERE usu_name = :usu_name LIMIT 1');
		$statement->execute(array(':usu_name' => $usu_name));
		$resultado = $statement->fetch();

		if ($resultado != false) {
			$errores .= '<li>El nombre de usuario ya existe</li>';
		}

		$usu_pass = hash('sha512', $usu_pass);
		$usu_pass2 = hash('sha512', $usu_pass2);

		if ($usu_pass != $usu_pass2) {
			$errores .= '<li>Las contraseñas no son iguales</li>';
		}
	}

	if ($errores == '') {
		$statement = $conexion->prepare('INSERT INTO tbl_usuarios (usu_id, usu_name, usu_pass) VALUES (null, :usu_name, :usu_pass)');
		$statement->execute(array(
			':usu_name' => $usu_name,
			':usu_pass' => $usu_pass
		));

		header('Location: login.php');
	}
}

require 'views/registrate.view.php';

?>