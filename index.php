<?php session_start();

if (isset($_SESSION['usu_name'])) {
	header('Location: portfolio.php');
} else {
	header('Location: login.php');
}

 ?>