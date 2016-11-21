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

	try {
		$conexion = new PDO('mysql:host=localhost;dbname=bd_cromo', 'root', '');
	} catch (PDOException $e) {
		echo "Error:" . $e->getMessage();;
	}

	$statement = $conexion->prepare('
		SELECT * FROM tbl_usuarios WHERE usu_name = :usu_name AND usu_pass = :usu_pass'
	);
	$statement->execute(array(
		':usu_name' => $usu_name,
		':usu_pass' => $usu_pass
	));

	$resultado = $statement->fetchAll();
	foreach ($resultado as $usu) {
		$usu_id = $usu['usu_id'];
		echo $usu_id;
	}
	if ($resultado !== false) {
		$_SESSION['usu_name'] = $usu_name;
		header('Location: index.php');
	} else {
		$errores .= '<li>Datos Incorrectos</li>' . " ----- " . $resultado . " ----- " . $usu_name . " ----- " . $contra;
	}
}

require 'views/login.view.php';

?>












<?php 
// <?php session_start();

// if (isset($_SESSION['usu_name'])) {
// 	header('Location: index.php');
// }

// $errores = '';

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// 	$usu_name = filter_var(strtolower($_POST['usu_name']), FILTER_SANITIZE_STRING);
// 	$usu_pass = $_POST['usu_pass'];
// 	$contra = $usu_pass;
// 	$usu_pass = hash('sha512', $usu_pass);


// ///////////////////////////////////////////////////////////////////////////////////////////
// $conexion = mysqli_connect('localhost', 'root', '', 'bd_cromo');
// 		//le decimos a la conexión que los datos los devuelva diréctamente en utf8, así no hay que usar htmlentities
// 		$acentos = mysqli_query($conexion, "SET NAMES 'utf8'");
// 		if (!$conexion) {
// 		    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
// 		    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
// 		    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
// 		    exit;
// 		}
// 		//llamamos a la función extract para extraer los datos del array $_REQUEST y lo meta todo en las variables del mismo nombre del html
// 		extract($_REQUEST);

// 		$sql = "SELECT * FROM tbl_usuarios WHERE usu_name = $usu_name AND usu_pass = $usu_pass";
		

// 		//echo $sql;
	
// 		$usuario = mysqli_query($conexion, $sql);
		
// 		while($recurso = mysqli_fetch_array($usuario)){
// 			$_SESSION['usu_name'] = $recurso['usu_name'];
// 			header('Location: index.php');
// 		}
// 		// if(mysqli_num_rows($usuario)==1){
// 		// 	while($recurso = mysqli_fetch_array($reservas)){
// 		// 	$_SESSION['usu_name'] = $usu_name;
// 		// 	header('Location: index.php');
// 		// 	}
// 		// } else {
// 		// 	$errores .= '<li>Datos Incorrectos</li>';
// 		// }
// 	}
// 			//$_SESSION['usu_id'] = $usu_id;
// 		//echo $usu_id;
// 		//mysqli_close(1);
// 		require 'views/login.view.php';
		
?>