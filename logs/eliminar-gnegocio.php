<?php
	require_once 'conexion.php';

	if (isset($_GET['id_gnegocio'])) {
		$gnegocio_id = $_GET['id_gnegocio'];

		$sql = "DELETE FROM cat_gnegocios WHERE id_gnegocio = $gnegocio_id";
		$borrar = mysqli_query($db, $sql);
	}

	echo "<script>location.href='../gnegocio.php';</script>";
?>