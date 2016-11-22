<?php session_start();

if (isset($_SESSION['usu_name'])) {
	header('Location: index.php');
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usu_name = filter_var(strtolower($_POST['usu_name']), FILTER_SANITIZE_STRING);
	$usu_pass = $_POST['usu_pass'];
	$contra = $usu_pass;
	$usu_pass = hash('sha512', $usu_pass);

	$conexion = mysqli_connect('localhost', 'root', '', 'bd_cromo');
	if (!$conexion) {
		    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		    exit;
	}
	$sql = "SELECT * FROM tbl_usuarios WHERE usu_name = '$usu_name' AND usu_pass = '$usu_pass' AND habilitado = '1'";
	$usuarios = mysqli_query($conexion, $sql);
	if(mysqli_num_rows($usuarios) >'0'){
		while($usu = mysqli_fetch_array($usuarios)){
			$usu_name_bd = $usu['usu_name'];
			$usu_pass_bd = $usu['usu_pass'];
		}
	}
	if ($usu_name==$usu_name_bd && $usu_pass==$usu_pass_bd) {
		$_SESSION['usu_name'] = $usu_name;
		header('Location: index.php');
	} else {
		$errores .= '<li>Datos Incorrectos o estas deshabilitado</li>';
	}
}

require 'views/login.view.php';

?>