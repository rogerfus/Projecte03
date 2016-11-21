<?php session_start();

if (isset($_SESSION['usu_name'])) {
	require 'views/contenido.view.php';
} else {
	header('Location: login.php');
}

?>