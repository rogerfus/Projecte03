<?php session_start();

	if (isset($_SESSION['usu_name']) && $_SESSION['usu_name']=='admin' ) {

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

		//extraemos las variables de usuario
		extract($_REQUEST);
		//ya he hecho las comprovaciones pertinentes y extraigo bien las variables.
		// echo "Estado: $rec_estado <br>";
		// echo "mensaje: $rec_mensaje <br>";
		// echo "id: $rec_id <br>";
		//Nos protegemos de posibles errores
		if ($rec_estado==0) {
			$est = 0;$est_txt="Inhabilitado.";
		}elseif($rec_estado==1){
			$est = 1;$est_txt="Con incidencias.";
		}else{$est = 2; $rec_mensaje = "El recurso está en plenas condiciones.";$est_txt="En perfecto estado.";}

		$sql = "UPDATE `tbl_recursos` SET `rec_estado` = '$est', `rec_mensaje` = '$rec_mensaje' WHERE `rec_id`=$rec_id";

		
		$modificar_recurso = mysqli_query($conexion, $sql);

		
		require 'views/modificarRecurso.view.php';
	} else {
		header('Location: login.php');
	}



?>
