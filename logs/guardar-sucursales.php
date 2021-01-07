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
		$negocios = isset($_POST['negocios']) ? mysqli_real_escape_string($db, $_POST['negocios']) : false;
		$sucursales = isset($_POST['sucursales']) ? mysqli_real_escape_string($db, $_POST['sucursales']) : false;
		$fechainicio = isset($_POST['fechainicio']) ? mysqli_real_escape_string($db, $_POST['fechainicio']) : false;
		$fechafin = isset($_POST['fechafin']) ? mysqli_real_escape_string($db, $_POST['fechafin']) : false;
		$licencia = isset($_POST['licencia']) ? mysqli_real_escape_string($db, $_POST['licencia']) : false;
		$direccion = isset($_POST['direccion']) ? mysqli_real_escape_string($db, $_POST['direccion']) : false;

		$errores = array(); // CREA ARRAY DE ERRORES

// VALIDA SI NO ESTA VACIO,          NO ES NUMERICO,        SI NO HAY NUMEROS,
		if (!empty($sucursales) && !is_numeric($sucursales) && !preg_match("/[0-9]/",$sucursales)) {
			$sucursales_validado = true;			
		}else{
			$sucursales_validado = false;
			$errores['sucursales'] = "La sucursal no es valida";
		}

		if (!empty($licencia)) {
			$licencia_valido = true;
		}else{
			$licencia_invalido = false;
			$errores['licencia'] = "La licencia no es valida";
		}

		if (!empty($fechainicio) && $fechainicio <= isset($fechafin)) {
			$fechainicio_validado = true;			
		}else{
			$fechainicio_validado = false;
			$errores['fechainicio'] = "La fecha de inicio no es valida";
		}

		if (isset($fechafin) >= $fechainicio) {
			$fechafin_validado = true;			
		}else{
			$fechafin_validado = false;
			$errores['fechafin'] = "La fecha de finalizacion no es valida";
		}

		$guardar_sucursales = false;
		
		// CUENTA LOS ERRORES
		if (count($errores) == 0) {
			$guardar_sucursales = true;

			$sql = "SELECT * FROM cat_sucursales WHERE id_negocios = '$negocios' and sucursales = '$sucursales'";
			$isset_sucursales = mysqli_query($db, $sql);

			if (mysqli_num_rows($isset_sucursales) > 0 && !isset($_GET['editar'])) {
				$_SESSION['errores']['general'] = "La sucursal ya existe";
			}else{
				if (isset($_GET['editar'])) {
					$sucursales_id = $_GET['editar'];
					$sql = "UPDATE cat_sucursales SET id_negocios = '$negocios', sucursales = '$sucursales', fechainicio = '$fechainicio', fechafin = '$fechafin', licencia = '$licencia', direccion = '$direccion' WHERE id_sucursales = $sucursales_id";
				}else{
					$sql = "INSERT INTO cat_sucursales VALUES (NULL, '$negocios', '$sucursales', '$fechainicio', '$fechafin' ,'$licencia', '$direccion');";
				}

				$guardar = mysqli_query($db, $sql);

				echo "<script>location.href='../sucursales.php';</script>";

				if ($guardar) {
					$_SESSION['completado'] = "El registro de la sucursal se completo con exito";
				}else{
					$_SESSION['errores']['general'] = 'Fallo el registro de la sucursal';
				}
			}
		}else{
			$_SESSION['errores'] = $errores;
			if (isset($_GET['editar'])) {
				echo "<script>location.href='../editar-sucursales.php?id_sucursales='.$_GET['editar'];</script>";
			}else{
				echo "<script>location.href='../sucursales.php';</script>";
			}
		}
	}

	echo "<script>location.href='../sucursales.php';</script>";
?>