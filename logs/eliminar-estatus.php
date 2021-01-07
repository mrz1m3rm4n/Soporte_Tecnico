<?php
	require_once 'conexion.php';

	if (isset($_GET['id_estatus'])) {
		$estatus_id = $_GET['id_estatus'];

		$sql = "DELETE FROM cat_estatus WHERE id_estatus = $estatus_id";
		$borrar = mysqli_query($db, $sql);
	}

	echo "<script>location.href='..estatus.php';</script>";
?>