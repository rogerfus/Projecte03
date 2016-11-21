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
		if(isset($_POST['submit'])){//to run PHP script on submit
		if(!empty($_POST['reservar'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['reservar'] as $selected){
		echo $selected."</br>";
		}
		}
		}


		if (isset($_POST['reservar'])){
		echo $_POST['reservar']; // Displays value of checked checkbox.
		}   
		
		$sql = "UPDATE `tbl_recursos` SET `rec_disp` = b'0' WHERE `tbl_recursos`.`rec_id` = $reservar;";
		

		//UPDATE `tbl_recursos` SET `rec_disp` = b'0' WHERE `tbl_recursos`.`rec_id` = 4;

		//echo $sql."---------";
		



		$actualizar_recurso = mysqli_query($conexion, $sql);

	

		
	
	
?>
<?php

if (isset($_SESSION['usu_name'])) {
	$rec_id = $_GET['reservar'];
	$usu_name = $_SESSION['usu_name'];
	$data = date("Y") . date("m") . date("d") . date("G") . date("i") . date("s");
	$conexion = new PDO('mysql:host=localhost;dbname=bd_cromo','root','');

	$statement = $conexion->prepare('SELECT * FROM tbl_usuarios WHERE usu_name = :usu_name');
	$statement->execute(array(
		':usu_name' => $usu_name
	));
	$resultados = $statement->fetchAll();

	foreach ($resultados as $recursos) {
			$usu_id = $recursos['usu_id'];
	}

	//$statement = $conexion->prepare('UPDATE `tbl_recursos` SET `rec_disp` = :rec_disp WHERE `rec_id` = :rec_id;');
	//$statement->execute(array(
	//	':rec_disp' => "b'0'",
	//	':rec_id' => $rec_id
	//));
	$statement2 = $conexion->prepare('INSERT INTO `tbl_reservas` (`res_id`, `rec_id`, `usu_id`, `res_fechaini`) VALUES (NULL, :rec_id, :usu_id, :res_fechaini);');
	$statement2->execute(array(
		':rec_id' => $rec_id,
		':usu_id' => $usu_id,
		':res_fechaini' => $data
	));



	header('Location:portfolio.php');
} else {
	header('Location: login.php');
}



?>
