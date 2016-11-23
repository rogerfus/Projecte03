<?php session_start();

if (isset($_SESSION['usu_name'])) {
	extract($_REQUEST);
	require 'views/tramitarReserva.view.php';
} else {
	header('Location: login.php');
}

