<?php
// VERIFICA QUE LE LLEGUE INFORMACION DEL FORMULARIO
	if (isset($_POST)) { 
		//PIDE LA CONECCION A LA BD
		require_once 'conexion.php'; 

		if (!isset($_SESSION)) { 
			//INICIA SESION
			session_start(); 
		} 
		// RECOGE LOS VALORES DEL FORMULARIO Y LOS VALIDA
		$gironegocio = isset($_POST['gironegocio']) ? mysqli_real_escape_string($db, $_POST['gironegocio']) : false;

		$errores = array(); // CREA ARRAY DE ERRORES

// VALIDA SI NO ESTA VACIO,          NO ES NUMERICO,        SI NO HAY NUMEROS,
		if (!empty($gironegocio) && !is_numeric($gironegocio) && !preg_match("/[0-9]/",$gironegocio)) {
			$gironegocio_validado = true;			
		}else{
			$gironegocio_validado = false;
			$errores['gironegocio'] = "El estatus no es valido";
		}

		$guardar_gironegocio = false;
		
		// CUENTA LOS ERRORES
		if (count($errores) == 0) {
			$guardar_gironegocio = true;

			$sql = "SELECT * FROM cat_gnegocios WHERE gironegocio = '$gironegocio'";
			$isset_gironegocio = mysqli_query($db, $sql);

			if (mysqli_num_rows($isset_gironegocio) > 0) {
				$_SESSION['errores']['general'] = "El giro del negocio ya existe";
			}else{
				if (isset($_GET['editar'])) {
					$gnegocio_id = $_GET['editar'];
					$sql = "UPDATE cat_gnegocios SET gironegocio = '$gironegocio' WHERE id_gnegocio = $gnegocio_id";
				}else{
					$sql = "INSERT INTO cat_gnegocios VALUES (NULL, '$gironegocio');";
				}

				$guardar = mysqli_query($db, $sql);
				echo "<script>location.href='../gnegocio.php';</script>";
				if ($guardar) {
					$_SESSION['completado'] = "El registro del estatus se completo con exito";
				}else{
					$_SESSION['errores']['general'] = 'Fallo el registro del giro del negocio';
				}
			}
		}else{
			$_SESSION['errores'] = $errores;
			if (isset($_GET['editar'])) {
				echo "<script>location.href='../editar-gnegocio.php?id_gnegocio='.$_GET['editar'];</script>";
			}else{
				echo "<script>location.href='../gnegocio.php';</script>";
			}
		}
	}

	echo "<script>location.href='../gnegocio.php';</script>";
?>