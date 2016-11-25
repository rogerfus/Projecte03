<?php session_start();

		extract($_REQUEST);
		if (count($horas)!=2) {
			$_SESSION['reserva'] = "Por favor, seleccione SOLO la hora de inicio y fin.";
			$_SESSION['idRecurso']= $idRecurso;
			$_SESSION['dia']=$dia;
			header('Location:tramitarReserva.php');
		}else{
		for ($i=0;$i<count($horas);$i++){     
			if ($i==0) {
				$horaIni=$horas[$i];
			}else{$horaFin=$horas[$i];}
		}
		$conexion = mysqli_connect('localhost', 'root', '', 'bd_cromo');
		$usu_name = $_SESSION['usu_name'];
		$sql = "SELECT * FROM `tbl_usuarios` WHERE `usu_name` = '$usu_name'";
		$usuario = mysqli_query($conexion, $sql);
		if(mysqli_num_rows($usuario)!=0){
			while($usu = mysqli_fetch_array($usuario)){
			$usu_id=$usu['usu_id'];
			}
		}

		$res_fechaini = "'".$dia." ".$horaIni.":00:00'";
		$res_fechafin = "'".$dia." ".$horaFin.":00:00'";

		$sql2 = "SELECT * FROM `tbl_reservas` WHERE ";
		$primera=1;
		for ($i=$horaIni; $i <$horaFin ; $i++) { 
			$horaUltima = ($horaFin-1);
			$res_fechaini = "'".$dia." ".$horaIni.":00:00'";
			$res_fechafin = "'".$dia." ".$horaFin.":00:00'";
			if ($primera==1) {
				$sql2 .= " res_fechaini = $res_fechaini OR res_fechafin = $res_fechafin ";
				$primera = 0;
			}else{
			$sql2 .= " res_fechaini = $res_fechaini OR res_fechafin = $res_fechafin ";
			}
		}
		$proteccion = mysqli_query($conexion, $sql2);
		if (mysqli_num_rows($proteccion)!=0) {
			$_SESSION['mensaje']="Alguien ha reservado alguna de las horas que querias mientras te decidias!";
			$_SESSION['idRecurso']= $idRecurso;
			$_SESSION['dia']=$dia;
			header('Location:tramitarReserva.php');
		}else{
		$usu_name=$_SESSION['usu_name'];
		$sql1 ="SELECT * FROM tbl_usuarios WHERE usu_name = '$usu_name'";
		$sacarId = mysqli_query($conexion, $sql1);
		if(mysqli_num_rows($sacarId)!=0){
			while ($sacarIdUsu = mysqli_fetch_array($sacarId)) {
				$usu_id = $sacarIdUsu['usu_id'];
			}
		}

		$sql1 = "INSERT INTO `tbl_reservas` (`res_id`, `rec_id`, `usu_id`, `res_fechaini`, `res_fechafin`, `dia`) VALUES (NULL, '$idRecurso', '$usu_id', $res_fechaini, $res_fechafin, '$dia');";
		//echo "$sql1";
		
		mysqli_query($conexion, $sql1);
		$_SESSION['idRecurso']= $idRecurso;
		$_SESSION['dia']=$dia;
		header('Location:tramitarReserva.php');}}
		