<?php session_start();

if (isset($_SESSION['usu_name'])) {
	require 'views/afegirUsuari.view.php';
} else {
	header('Location: login.php');
}

