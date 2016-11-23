<!DOCTYPE html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cromo</title>
	
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="css/simple-line-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<?php 
	//<form name="f1" action="realizar_reserva_update.php" method="GET"> 
	?>
	
	<div id="fh5co-page">
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="header-inner">
			<IMG SRC="logo.png" width="60"/><br/><br/>


				<h1><?php echo $_SESSION['usu_name']; ?></h1><br/><br/> <h1><a href="cerrar.php">Cerrar Sesion</a></br></h1>
				<nav role="navigation">
					<ul>
						

						<li><a class="active" href="">Recursos</a></li>
						<li><a href="devolucion.php">Devoluciones</a></li>
						<li><a href="incidencias.php">Incidencias</a></li>
						<?php 
						if ($_SESSION['usu_name'] == 'admin') {
							echo "<li style='color: #2EFE64;''>";
							?>
							<a href="estadisticas.php">Estadisticas</a></li>	<?php
							echo "<li style='color: #2EFE64;''>";
							?>
							<a href="modificarUsuarios.php">Modificar Usuarios</a></li>	<?php
						}
						
						?>
						
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<div id="fh5co-work-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2>Disponibilidad de recursos</h2>
					<!--<p><span>Created with <i class="sl-icon-heart"></i> by the fine folks at <a href="http://freehtml5.co">FreeHTML5.co</a></span></p>-->
				</div>
			</div>
			<div class="row">
					
<?php
	echo "El id del recurso es: $idRecurso </br>";
	$fecha = date("Y-m-d", strtotime($dia));
	echo "La fecha es: $fecha<br/>";	
	$conexion = mysqli_connect('localhost', 'root', '', 'bd_cromo');
	$sql = "SELECT *, DATE_FORMAT(res_fechaini,'%H') AS res_fechaini FROM `tbl_reservas` WHERE `dia` = '$fecha' ";
	$reservas = mysqli_query($conexion, $sql);
	$done = 7;
	if(mysqli_num_rows($reservas)!=0){
	while($recurso = mysqli_fetch_array($reservas)){
		$fecha = $recurso['res_fechaini'];
		echo "$fecha";
		echo "<form name='hora'>";
		for ($hora=8; $hora<$fecha ; $hora++) { 
				echo "$hora<input type='checkbox' name='horas' value'$hora'>";
		}
		
		echo "<input type='submit' value='reservar'>";
		echo "</form></br>";
	}}else{echo "no hay datos";}
?>		
					
			</div>
		</div>
	</div>
	<footer id="fh5co-footer" role="contentinfo">
	
		<div class="container">
			<!--<div class="col-md-3 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
				<h3>About Us</h3>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
			</div>-->
			
			<div class="col-md-12 fh5co-copyright text-center">
				<p>&copy; 2016 Proyecto 2 <span>Designed with <i class="icon-heart"></i> by Roger/Eric/Musta</span></p>	
			</div>
			
		</div>
	</footer>
	</div>
	
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- MAIN JS -->
	<script src="js/main.js"></script>

	</body>
</html>

