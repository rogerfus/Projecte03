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
			<div class="header-inner">
			<IMG SRC="logo.png" width="60"/><br/><br/>


				<h1><?php echo $_SESSION['usu_name']; ?></h1><br/><br/> <h1><a href="cerrar.php">Cerrar Sesion</a></br></h1>
				<nav role="navigation">
					<ul>
						

						<li><a href="portfolio.php">Recursos</a></li>
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
					<h2>Administración de usuarios</h2> 
					<!--<p><span>Created with <i class="sl-icon-heart"></i> by the fine folks at <a href="http://freehtml5.co">FreeHTML5.co</a></span></p>-->
				</div>
			</div>

			<div class="row" >

					
<?php
	$conexion = mysqli_connect('localhost', 'root', '', 'bd_cromo');
		//le decimos a la conexión que los datos los devuelva diréctamente en utf8, así no hay que usar htmlentities
		$acentos = mysqli_query($conexion, "SET NAMES 'utf8'");
		$sql = "SELECT * FROM tbl_recursos";
		

		//echo $sql;
		echo "<h3><a href='agregarRecurso.php' style='color:green'>Agregar un recurso</a></h3>";
		$reservas = mysqli_query($conexion, $sql);
		
		if(mysqli_num_rows($reservas)!=0){
			echo "<h3> Número de recursos: " . mysqli_num_rows($reservas) . "</h3><br/>";
			while($recurso = mysqli_fetch_array($reservas)){
			$foto='img/'.$recurso['rec_foto'];

			echo '<div class="col-md-3 text-center">'; 
			echo '<div class="work-inner">';
			if (file_exists($foto)) {
				$foto = $foto;
			}else{$foto = 'img/0.jpg';}
			?>
			<a href="#" class="work-grid" style="background-image: url(<?php echo $foto; ?>);"></a>
		
		<?php
		$dataHoy = date("Y") ."-". date("m") ."-". date("d");
			echo "<form action='modificarRecurso.php' method='POST'>";
			$rec_est_0 = '';
			$rec_est_1 = '';
			$rec_est_2 = '';
			if ($recurso['rec_estado'] == 1) {
				$color = '#d6d617';
				$rec_est_1 = 'checked';
			}elseif ($recurso['rec_estado'] == 0) {
				$color = 'red';
				$rec_est_0 = 'checked';
			}else{$color = 'green';$rec_est_2 = 'checked';}
			echo "<h4><a href='#' style='color:$color'> ".$recurso['rec_name']."</a></h4>";
			echo '<span> '.$recurso['rec_tipo'].'</span><br/>';
			$id = $recurso['rec_id'];
			echo '<input type="hidden" name="rec_id" value="'.$id.'"/>';
			echo "
				<input type='radio' name='rec_estado' value='0' $rec_est_0/>Inhabilitado</br>
				<input type='radio' name='rec_estado' value='1' $rec_est_1/>Con incidencias</br>
				<input type='radio' name='rec_estado' value='2' $rec_est_2/>En buen estado</br>
			";
			if (isset($recurso['rec_mensaje'])) {
				$rec_mensaje = $recurso['rec_mensaje'];
			}else{$rec_mensaje = "";}
			echo "
				<input type='hidden' name='mensajeAntiguo' value='$rec_mensaje'/>
				<input type='text'  name='rec_mensaje' value='$rec_mensaje' maxlength='140'/>
			";

			echo '<input type="submit" value="Tramitar"/><br><br>';
			echo '</form>';
			echo "
				<form action='eliminarRecurso.php' method='POST'>
				<input type='hidden' name='rec_id' value='$id'>
				<input type='submit' style='color:red' value='eliminar'>
				</form>
			";
			echo '</div>';
			echo '</div>';
		
			}
		} else {
			echo " <br/> <br/> No hay datos que mostrar!";
		}
			//$_SESSION['usu_id'] = $usu_id;
		//echo $usu_id;
		mysqli_close($conexion);
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

