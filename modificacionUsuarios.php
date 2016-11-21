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

		//extraemos las variables de usuario
		extract($_REQUEST);
		//ya he hecho las comprovaciones pertinentes y extraigo bien las variables.
		//las variables extraidas son $usu_name , $usu_pass y $usu_id
		echo "nombre antiguo: $nombre_antiguo <br>";
		echo "nombre nuevo: $usu_name <br>";
		echo "contra antigua: $contra_antigua <br>";
		echo "contra nueva: $usu_pass <br>";
		//Nos protegemos de posibles errores
		if ($usu_name===$nombre_antiguo && $usu_pass===$contra_antigua) {
			$errores = "debes modificar algo antes de enviar.";
			$_SESSION['errores'] = $errores;
			header('Location:modificarUsuarios.php');
		}else{$_SESSION['errores'] = "";}



		$sql = "UPDATE `tbl_usuarios` SET ";

		//por si no envian nombre o contraseña
		if (isset($usu_name)) {
			$sql .= "`usu_name` = '$usu_name'";
			if (isset($usu_pass)) {
				if ($contra_antigua == $usu_pass) {
					
				} else {
					$usu_pass = hash('sha512', $usu_pass);
					$sql .= ", `usu_pass` = '$usu_pass' WHERE `tbl_usuarios`.`usu_id` = $usu_id;";
				}
			}
		}else{$usu_name=$nombre_antiguo;
			if (isset($usu_pass)) {
				if ($contra_antigua == $usu_pass) {
					$sql .= "`usu_pass` = '$usu_pass' WHERE `tbl_usuarios`.`usu_id` = $usu_id;";
				} else {
					$usu_pass = hash('sha512', $usu_pass);
				}
			}
		}


		$actualizar_recurso = mysqli_query($conexion, $sql);

	

		
	
	




	header('Location:modificarUsuarios.php');




?>
