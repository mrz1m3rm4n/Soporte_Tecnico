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
		$estatus = isset($_POST['estatus']) ? (int)$_POST['estatus'] : false;
		$gnegocio = isset($_POST['gnegocio']) ? (int)$_POST['gnegocio'] : false;
		$negocio = isset($_POST['negocio']) ? mysqli_real_escape_string($db, $_POST['negocio']) : false;

		$errores = array(); // CREA ARRAY DE ERRORES

// VALIDA SI NO ESTA VACIO,
		if (!empty($negocio)) {
			$nombre_validado = true;			
		}else{
			$nombre_validado = false;
			$errores['negocio'] = "El nombre no es valido";
		}

		$guardar_sucursales = false;

		// CUENTA LOS ERRORES
		if (count($errores) == 0) {
			$guardar_sucursales = true;

			$sql = "SELECT * FROM negocios WHERE negocio = '$negocio'";
			$isset_sucursales = mysqli_query($db, $sql);

			if (mysqli_num_rows($isset_sucursales) > 0 && !isset($_GET['editar'])) {
				$_SESSION['errores']['general'] = "El negocio ya existe";
			}else{
				if (isset($_GET['editar'])) {
					$negocios_id = $_GET['editar'];
					$sql = "UPDATE negocios SET id_estatus = $estatus, id_gnegocio = $gnegocio, negocio = '$negocio' WHERE id_negocios = $negocios_id";

				}else{					
					$sql = "INSERT INTO negocios VALUES (NULL, '$estatus', '$gnegocio', '$negocio');";	
				} 

				$guardar = mysqli_query($db, $sql);
				
				echo "<script>location.href='../negocio.php';</script>";

				if ($guardar) {
					$_SESSION['completado'] = "El registro del negocio se completo con exito";
				}else{
					$_SESSION['errores']['general'] = 'Fallo el registro del negocio';
				}
			}
		}else{
			$_SESSION['errores'] = $errores;
			if (isset($_GET['editar'])) {
				echo "<script>location.href='../negocio.php?id_negocios='.$_GET['editar'];</script>";
			}else{
				echo "<script>location.href='../negocio.php';</script>";
			}
		}
	}

	echo "<script>location.href='../negocio.php';</script>";
?>