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
	<div id="fh5co-page">
	<header id="fh5co-header" role="banner">
		
		<div class="container">
		<IMG SRC="logo.png" width="60"><br/><br/>
			<div class="header-inner">
		<h1><?php echo $_SESSION['usu_name']; ?></h1><br/><br/> <h1><a href="cerrar.php">Cerrar Sesion</a></br></h1>
				<nav role="navigation">
				<nav role="navigation">
					<ul>
						

						<li><a href="portfolio.php">Recursos</a></li>
						<li><a class="active" href="#">Devoluciones</a></li>
						<li><a href="incidencias.php">Incidencias</a></li>
						<?php 
						if ($_SESSION['usu_name'] == 'admin') {
							echo "<li style='color: #2EFE64;''>";
							?>
							<a href="estadisticas.php">Estadisticas</a></li>	<?php
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

	try{
		$usu_name = $_SESSION['usu_name'];
		$conexion = new PDO('mysql:host=localhost;dbname=bd_cromo','root','');
		$statement = $conexion->prepare('SELECT * FROM tbl_usuarios WHERE usu_name = :usu_name');
		$statement->execute(array(
			':usu_name' => $usu_name
		));
		$resultados = $statement->fetchAll();
		foreach ($resultados as $recursos) {
			$usu_id = $recursos['usu_id'];
			//echo $usu_id . '</br>';
		}
		$statement = $conexion->prepare('SELECT * FROM `tbl_reservas` JOIN `tbl_recursos` ON `tbl_reservas`.rec_id=`tbl_recursos`.rec_id WHERE usu_id = :usu_id AND res_fechafin = :res_fechafin');
		$statement->execute(array(
			':usu_id' => $usu_id,
			':res_fechafin' => '0000-00-00 00:00:00'
		));
		$resultados = $statement->fetchAll();




		?>
		<form action="reserva_devolver.php" method="GET">
		
		<?php
		foreach ($resultados as $reservas) {
			echo '<div class="col-md-3 text-center">'; 
			echo '<div class="work-inner">';
			$foto=$reservas['rec_foto'];
			$foto= 'img/'.$foto;
			if (file_exists($foto)) {
				$foto = $foto;
			}else{$foto = 'img/0.jpg';}
			?>
			<a href="#" class="work-grid" style="background-image: url(<?php echo $foto; ?>);"></a>
		<?php
			//echo '<div class="desc">';
			echo '<h4><a href="#"> '.$reservas['rec_name'].'</a></h4>';
			echo '<span> '.$reservas['rec_tipo'].'</span><br/>';
			echo '<input type="radio" name="res_id" value="'.$reservas['res_id'].'"/>Devolver<br/>';
			echo '<input type="submit" value="Devolucion"/><br/><br/>';
			echo '</div>';
			echo '</div>';
			echo '</form>';
			}
		

			
		$conexion = null;

	}catch(PDOExeption $e){
		echo "Error: " . $e->getMessage();

	}
	
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

