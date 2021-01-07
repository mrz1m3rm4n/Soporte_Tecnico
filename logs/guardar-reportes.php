<?php
// VERIFICA QUE LE LLEGUE INFORMACION DEL FORMULARIO

	if (isset($_POST['submit'])) { 
		//PIDE LA CONECCION A LA BD
		require_once 'conexion.php'; 

		if (!isset($_SESSION)) { 
			//INICIA SESION
			session_start(); 
		} 
		// RECOGE LOS VALORES DEL FORMULARIO Y LOS VALIDA
		$clientes = isset($_POST['clientes']) ? (int)$_POST['clientes'] : false;
		$negocios = isset($_POST['negocios']) ? (int)$_POST['negocios'] : false;
		$estatus = isset($_POST['estatus']) ? (int)$_POST['estatus'] : false;
		$fechareporta = isset($_POST['fechareporta']) ? mysqli_real_escape_string($db, $_POST['fechareporta']) : false;
		$fechasolucion = isset($_POST['fechasolucion']) ? mysqli_real_escape_string($db, $_POST['fechasolucion']) : false;
		$problema = isset($_POST['problema']) ? preg_replace("/[[:space:]]/"," ", trim($_POST['problema'])) : false;
		$codigoreportes = isset($_POST['codigoreportes']) ? mysqli_real_escape_string($db, $_POST['codigoreportes']) : false;

		$errores = array(); // CREA ARRAY DE ERRORES

// VALIDA SI NO ESTA VACIO,          NO ES NUMERICO,        SI NO HAY NUMEROS,

		if (!empty($fechareporta) && $fechareporta <= $fechasolucion) {
			$fechareporta_validado = true;			
		}else{
			$fechareporta_validado = false;
			$errores['fechareporta'] = "La fecha de reporte no es valida";
		}

		if ($fechasolucion >= $fechareporta) {
			$fechasolucion_validado = true;			
		}else{
			$fechasolucion_validado = false;
			$errores['fechasolucion'] = "La fecha de cierre de reporte no es valida";
		}

		if (!empty($problema)) {
			$problema_validado = true;			
		}else{
			$problema_validado = false;
			$errores['problema'] = "El problema no es valido";
		}

		$guardar_sucursales = false;

		// CUENTA LOS ERRORES
		if (count($errores) == 0) {
			$guardar_sucursales = true;

			$cli = str_split($clientes,5); $cli_id = $cli[0];
			$pro = str_split($problema,5); $pro_id = $pro[0];
			$fec = str_split($fechareporta,10); $fec_id = $fec[0];
			$codigo_i = $pro_id.$cli_id.$fec_id.rand(3, 10);

			$sql = "SELECT * FROM reportes WHERE codigoreportes = '$codigoreportes'";
			$isset_sucursales = mysqli_query($db, $sql);

			if (mysqli_num_rows($isset_sucursales) > 0 && !isset($_GET['editar'])) {
				$codigo_i = $pro_id.$cli_id.$fec_id.rand(3, 10);
			}

			if (mysqli_num_rows($isset_sucursales) > 0 && !isset($_GET['editar'])) {
				$_SESSION['errores']['general'] = "El reporte ya existe";
			}else{
				if (isset($_GET['editar'])) {
					$reportes_id = $_GET['editar'];
					$sql = "UPDATE reportes SET id_clientes = '$clientes', id_negocios = '$negocios', id_estatus = '$estatus', fechareporta = '$fechareporta', fechasolucion = '$fechasolucion', problema = '$problema', codigoreportes = '$codigoreportes' WHERE id_reportes = $reportes_id";
				}else{
					$sql = "INSERT INTO reportes VALUES (NULL, '$clientes', '$negocios', '$estatus', '$fechareporta', '$fechasolucion', '$problema', '$codigo_i');";
				}

				$guardar = mysqli_query($db, $sql);
 
				echo "<script>location.href='../index.php';</script>";

				if ($guardar) {
					$_SESSION['completado'] = "El registro del reporte se completo con exito, codigo de reporte: '$codigo_i'";
				}else{
					$_SESSION['errores']['general'] = 'Fallo el registro del reporte';
				}
			}
		}else{
			$_SESSION['errores'] = $errores;
			if (isset($_GET['editar'])) {
				echo "<script>location.href='../editar-reportes.php?id_reportes='.$_GET['editar'];</script>";
			}else{
				echo "<script>location.href='../reporte.php';</script>";
			}
		}
	}

	echo "<script>location.href='../index.php';</script>";
?>