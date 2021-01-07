<?php
	$servidor = 'localhost';
	$usuario = 'root';
	$password = '';
	$basededatos = 'soporte';
	$puerto = '3308';

	$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

	mysqli_query($db, "SET NAMES 'utf8'");

	if (!isset($_SESSION)) {
		session_start();
	}
?>