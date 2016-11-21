<?php session_start();

if (isset($_SESSION['usu_name'])) {
	require 'views/disponibilidad.view.php';
} else {
	header('Location: login.php');
}

