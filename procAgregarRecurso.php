<?php session_start();
if (isset($_SESSION['usu_name']) && $_SESSION['usu_name']=='admin') {
	extract($_REQUEST);
	$dir_subida = '/img/';
	$conexion = mysqli_connect('localhost', 'root', '', 'bd_cromo');
	$sql="SELECT max(rec_id) + 1 AS elSiguiente FROM tbl_recursos";
	$verSiguiente = mysqli_query($conexion, $sql);
	if(mysqli_num_rows($verSiguiente)!=0){
		while($elSiguiente = mysqli_fetch_array($verSiguiente)){
			$next = $elSiguiente['elSiguiente'];
		}
	}
	$next=($next-3).".jpg";
	// echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";
 //    echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";
 //    echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";
 //    echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'];
	if ($rec_tipo == "SalaReuniones") {
		$rec_tipo = "Sala Reuniones";
	}
	$nombre_archivo = $_FILES['archivo']['name'];
	$nombre_archivo=$next.".jpg";
	move_uploaded_file($_FILES['archivo']['tmp_name'], "img/$nombre_archivo");
	$sql1="INSERT INTO `tbl_recursos` (`rec_id`, `rec_name`, `rec_tipo`, `rec_disp`, `rec_foto`, `rec_estado`) VALUES (NULL, '$rec_name', '$rec_tipo', b'1', '$next', '$rec_estado');";
	$agregarRecurso = mysqli_query($conexion, $sql1);
	header('Location: portfolio.php');
} else {
	header('Location: login.php');
}

