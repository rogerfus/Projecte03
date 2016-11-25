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
							<a class="active" href="modificarUsuarios.php">Modificar Usuarios</a></li>	<?php
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
					<h2>Agregar un recurso</h2> 
					<!--<p><span>Created with <i class="sl-icon-heart"></i> by the fine folks at <a href="http://freehtml5.co">FreeHTML5.co</a></span></p>-->
				</div>
			</div>

			<div class="row" >

			<?php if (isset($_SESSION['goodNews'])) {echo "<h4 style='color:green'>". $_SESSION['goodNews']."</h4>"; $_SESSION['goodNews']="";}?>
			<form method="post" name="afegirRecurs" id="afegirRecurs" action="procAgregarRecurso.php" enctype="multipart/form-data">
				<dl>
					<dt>
						<label for="nombre">Nombre</label>
					</dt>
					<dd><input type="text" id="nombre" name="rec_name" /></dd>
				</dl>
				<dl>
					<dt>
						<label for="tipo">Tipo del recurso</label>
					</dt>
					<select name="rec_tipo">
						<option value="Aula">Aula</option>
						<option value="Despacho">Despacho</option>
						<option value="SalaReuniones">Sala de Reuniones</option>
						<option value="Portatil">Portatil</option>
						<option value="Proyector">Proyector</option>
						<option value="Movil">Movil</option>
					</select>
				</dl>
				<input type='radio' name='rec_estado' value='0' $rec_est_0/>Inhabilitado</br>
				<input type='radio' name='rec_estado' value='1' $rec_est_1/>Con incidencias</br>
				<input type='radio' name='rec_estado' checked value='2' $rec_est_2/>En buen estado</br></br>
				<!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
    			<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
			    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
			    <label for="fichero_usuario">Enviar este fichero:</label> <input name="archivo" type="file" />
			    <br>
				<button type="submit">Afegir</button>
			</form>
			<?php if (isset($_SESSION['errores'])) {echo "<h4 style='color:red'>". $_SESSION['errores']."</h4>"; $_SESSION['errores']="";} if (isset($_SESSION['errorPass'])) {echo "<h4 style='color:red'>". $_SESSION['errorPass']."</h4>"; $_SESSION['errorPass']="";} ?>
		</div>
					
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

