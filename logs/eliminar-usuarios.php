<?php
	require_once 'conexion.php';

	if (isset($_GET['id_clientes'])) {
		$clientes_v = $_GET['id_clientes'];

		$sql = "DELETE FROM cat_clientes WHERE id_clientes = $clientes_v";
		$borrar = mysqli_query($db, $sql);
	}

	echo "<script>location.href='../usuarios.php';</script>";
?>