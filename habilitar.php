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
		$usu_id = $_POST['usu_id'];
		
		$sql = "UPDATE `tbl_usuarios` SET `habilitado` = b'1' WHERE `tbl_usuarios`.`usu_id` = $usu_id;";
		

		//UPDATE `tbl_recursos` SET `rec_disp` = b'0' WHERE `tbl_recursos`.`rec_id` = 4;

		//echo $sql."---------";
		



		$deshabilitar = mysqli_query($conexion, $sql);
		//header('Location:modificarUsuarios.php')
	

		
	
	
?>