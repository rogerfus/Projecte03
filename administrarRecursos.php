<?php session_start();

if (isset($_SESSION['usu_name']) && $_SESSION['usu_name']=='admin') {
	require 'views/administrarRecursos.view.php';
} else {
	header('Location: login.php');
}

