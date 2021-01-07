<?php
	require_once 'conexion.php';

	if (isset($_GET['id_sucursales'])) {
		$sucursales_v = $_GET['id_sucursales'];

		$sql = "DELETE FROM cat_sucursales WHERE id_sucursales = $sucursales_v";
		$borrar = mysqli_query($db, $sql);
	}

	echo "<script>location.href='../sucursales.php';</script>";
?>