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
							<li><a class="active" href="#">Modificar Usuarios</a></li>
								<?php
							echo "<li style='color: #2EFE64;''>";
							?>
							<a href="estadisticas.php">Estadisticas</a></li>
								<?php
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
		if (!$conexion) {
		    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}
		//llamamos a la función extract para extraer los datos del array $_REQUEST y lo meta todo en las variables del mismo nombre del html
		extract($_REQUEST);

		$sql = "SELECT * FROM tbl_usuarios WHERE habilitado = '1'";
		

		//echo $sql;
	
		$usuarios = mysqli_query($conexion, $sql);
		
		if(mysqli_num_rows($usuarios)!=0){
			echo "<h3> Número de usuarios: " . mysqli_num_rows($usuarios) . "</h3>";?><h3><a href="afegirUsuari.php">Añadir un usuario</a></h3>
			<h4 style="color:red"><?php if (isset($_SESSION['errores'])) {echo $_SESSION['errores'];} ?></h4>
			<?php
			while($usu = mysqli_fetch_array($usuarios)){
			$usu_name = $usu['usu_name'];$usu_pass=$usu['usu_pass']; $usu_id=$usu['usu_id']?> 
				<form method="post" name="Form" id="Form" action="modificacionUsuarios.php">
		
			
			<input type="text" name="usu_name" value="<?php echo $usu_name;?>" />
			<input type="password" id="pass" name="usu_pass" value="<?php echo $usu_pass;?>" />
			<input type="hidden" name="usu_id" value="<?php echo $usu_id;?>" />
			<input type="hidden" name="contra_antigua" value="<?php echo $usu_pass;?>" />
			<input type="hidden" name="nombre_antiguo" value="<?php echo $usu_name;?>" />
			<button type="reset">Reset</button>
			<button type="submit">Submit</button>
		
		
		</form>
		<form method="post" name="Form" id="Form" action="deshabilitar.php">
		<input type="hidden" name="usu_id" value="<?php echo $usu_id;?>" />
			<button type="submit" style="color:red">deshabilitar</button>
		</form>
		<br/>
			<?php }} ?>

			<?php  
			
		
		$sql = "SELECT * FROM tbl_usuarios WHERE habilitado = '0'";
		

		//echo $sql;
	
		$usuarios = mysqli_query($conexion, $sql);
		if(mysqli_num_rows($usuarios)!=0){
			echo "<h3> Número de usuarios deshabilitados: " . mysqli_num_rows($usuarios) . "</h3>";?>
			<h4 style="color:red"><?php if (isset($_SESSION['errores'])) {echo $_SESSION['errores'];} ?></h4>
			<?php
			while($usu = mysqli_fetch_array($usuarios)){
			$usu_name = $usu['usu_name'];$usu_pass=$usu['usu_pass']; $usu_id=$usu['usu_id']?> 
			<form method="post" name="Form" id="Form" action="habilitar.php">
		
			
			<input type="text" name="usu_name" value="<?php echo $usu_name;?>" disabled />
			<input type="password" id="pass" name="usu_pass" value="<?php echo $usu_pass;?>" disabled/>
			<input type="hidden" name="usu_id" value="<?php echo $usu_id;?>"/>
			<button type="submit" style="color:green">habilitar</button>
			
		</form>
		
		<?php
		}
		} else {
			echo " <br/> <br/> No hay usuarios!";
		}
			//$echo=su_id;
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

