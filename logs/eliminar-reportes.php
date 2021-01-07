<?php
	require_once 'conexion.php';

	if (isset($_GET['id_reportes'])) {
		$reportes_v = $_GET['id_reportes'];

		$sql = "DELETE FROM reportes WHERE id_reportes = $reportes_v";
		$borrar = mysqli_query($db, $sql);
	}

	echo "<script>location.href='../reporte.php';</script>";
?>