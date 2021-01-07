<?php
	require_once 'conexion.php';

	if (isset($_GET['id_negocios'])) {
		$negocio_v = $_GET['id_negocios'];

		$sql = "DELETE FROM negocios WHERE id_negocios = $negocio_v";
		$borrar = mysqli_query($db, $sql);

	}

	echo "<script>location.href='../negocio.php';</script>";
?>