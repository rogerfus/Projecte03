<?php session_start();

if (isset($_SESSION['usu_name'])) {
	$rec_id = $_GET['rec_id'];
	$comentario = 'inc_comentario'.$rec_id;
	$inc_comentario = filter_var(strtolower($_GET[$comentario]), FILTER_SANITIZE_STRING);
	$usu_name = $_SESSION['usu_name'];
	$conexion = new PDO('mysql:host=localhost;dbname=bd_cromo','root','');

	$statement = $conexion->prepare('SELECT * FROM tbl_usuarios WHERE usu_name = :usu_name');
	$statement->execute(array(
		':usu_name' => $usu_name
	));
	$resultados = $statement->fetchAll();
	foreach ($resultados as $recursos) {
			$usu_id = $recursos['usu_id'];
			// echo "<tr><td>" . $recursos['rec_id'] . "</td><td>" . $recursos['rec_name'] . "</td><td>" . $recursos['rec_tipo'] . "</td><td>" . $recursos['rec_disp'] . "</td><td>" . $recursos['rec_foto'] . "</td></tr>";
	}
	$statement = $conexion->prepare('INSERT INTO `tbl_incidencias` (`inc_id`, `usu_id`, `rec_id`, `inc_comentario`) VALUES (NULL, :usu_id, :rec_id, :inc_comentario);');
	$statement->execute(array(
		':usu_id' => $usu_id,
		':rec_id' => $rec_id,
		':inc_comentario' => $inc_comentario
	));
	header('Location:index.php');
} else {
	header('Location: login.php');
}



?>