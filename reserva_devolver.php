<?php session_start();

if (isset($_SESSION['usu_name'])) {
	$res_id = $_GET['res_id'];
	$usu_name = $_SESSION['usu_name'];
	$data = date("Y") . date("m") . date("d") . date("G") . date("i") . date("s");
	$conexion = new PDO('mysql:host=localhost;dbname=bd_cromo','root','');


	$statement = $conexion->prepare('SELECT * FROM tbl_reservas WHERE res_id = :res_id');
	$statement->execute(array(
		':res_id' => $res_id
	));
	$resultados = $statement->fetchAll();
	foreach ($resultados as $recursos) {
		$rec_id = $recursos['rec_id'];
	}


	$statement = $conexion->prepare('UPDATE `tbl_reservas` SET `res_fechafin` = :res_fechafin WHERE `tbl_reservas`.`res_id` = :res_id;');
	$statement->execute(array(
		':res_fechafin' => $data,
		':res_id' => $res_id
	));

	$statement = $conexion->prepare('UPDATE `tbl_recursos` SET `rec_disp` = :rec_disp WHERE `rec_id` = :rec_id;');
	$statement->execute(array(
		':rec_disp' => '1',
		':rec_id' => $rec_id
	));

header('Location:devolucion.php');
} else {
	header('Location: login.php');
}



?>