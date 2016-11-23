<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no,
	 initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	 <!-- <link href='https://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'> -->
	 <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	 <!-- <link rel="stylesheet" href="/login/css/estilos.css"> -->
	 <link rel="stylesheet" type="text/css" href="css/cromo.css">
	<title>Iniciar Sesión</title>
</head>
<body>
	<div class="contenedor">
		<h1 class="titulo">Iniciar Sesión</h1>
		<hr class="border">

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
			<div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input type="text" name="usu_name" class="usuario" placeholder="Usuario">
			</div>

			<div class="form-group">
				<i class="icono izquierda fa fa-lock"></i><input type="password" name="usu_pass" class="password_btn" placeholder="Contraseña">
				<i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
			</div>
			
			<?php if(!empty($errores)): ?>
				<div class="error">
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
			<?php endif; ?>
		</form>

		
	</div>
</body>
</html>