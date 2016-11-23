<?php session_start();
$dataHoy = date("Y") ."-". date("m") ."-". date("d");
extract($_REQUEST);
if (isset($fecha)) {
$data = $fecha;
}else{$data = $dataHoy;}
// if (isset($_SESSION['data'])) {
// 	$data_procesar = $_SESSION['data'];
// }else{
// 	$data_procesar = $dataHoy;
// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pruebas</title>
</head>
<body>
<?php 
	if (!$_POST) {
		//$step = 1;
?>
		<form method="POST" action="pruebas.view.php">
			<input type="date" name="fecha" min="<?php echo $dataHoy; ?>" value="<?php echo $data; ?>"  >
			<input type="submit">
		</form>	
<?php
	}else{
		$step = 1;
	if ($step != 2){
		$dia = $_POST['fecha'];
		$step = 2;
		?>
		<form method="POST" action="pruebas.view.php">
			<input type="hidden" name="dia" value="<?php echo $dia;?>" />
			<select name="horaIni">
	 			<?php 
	 			for ($i=1; $i < 25 ; $i++) { 
	 				echo "<option value='$i'> $i </option>";
	 			} ?>
	 			
 			</select>
			<input type="submit">

		</form>
	<?php }else{
		$dia = $_POST['fecha'];
		$horaIni = $_POST['horaIni'];
		?>
		<form method="POST" action="pruebas.view.php">
			<input type="hidden" name="dia" value="<?php echo $dia;?>"/>
			<input type="hidden" name="horaIni" value="<?php echo $horaIni;?>"/>
			<input type="timer" name="horaFin" max=16:00 step=3600>
			<input type="submit">

		</form>

		<?php
	}}
?>



</body>
</html>
<?php 
//onchange="location.reload()" 


// <select name="color" onchange="location.reload()">
// 			<option value="red"> 01 </option>
// 			<option value="red"> 02</option>
// 			<option value="red"> 03</option>
// 			<option value="red"> 04</option>
// 		</select>
?>