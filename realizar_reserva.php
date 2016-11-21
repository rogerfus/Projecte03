<?php session_start();

if (isset($_SESSION['usu_name'])) {
	$rec_id = $reservar;
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
	echo $usu_id;


	//header('Location:portfolio.php');
} else {
	header('Location: login.php');
}



?>