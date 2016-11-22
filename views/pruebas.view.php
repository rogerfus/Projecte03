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
<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	<input type="date" name="fecha" onchange="location.reload()" min="<?php echo $dataHoy; ?>" value="<?php echo $data; ?>"  >
		<select name="color" onchange="location.reload()">
			<option value="red"> 01 </option>
			<option value="red"> 02</option>
			<option value="red"> 03</option>
			<option value="red"> 04</option>
		</select>
	<input type="submit" name="enviar">	
</form>	





</body>
</html>
<?php 
//onchange="location.reload()" 
?>