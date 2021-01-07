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
		$estatus = isset($_POST['estatus']) ? mysqli_real_escape_string($db, $_POST['estatus']) : false;

		$errores = array(); // CREA ARRAY DE ERRORES

// VALIDA SI NO ESTA VACIO,          NO ES NUMERICO,        SI NO HAY NUMEROS
		if (!empty($estatus) && !is_numeric($estatus) && !preg_match("/[0-9]/",$estatus)) {
			$estatus_validado = true;			
		}else{
			$nombre_validado = false;
			$errores['estatus'] = "El estatus no es valido";
		}

		$guardar_estatus = false;
		
		// CUENTA LOS ERRORES
		if (count($errores) == 0) {
			$guardar_estatus = true;

			$sql = "SELECT * FROM cat_estatus WHERE estatus = '$estatus'";
			$isset_estatus = mysqli_query($db, $sql);

			if (mysqli_num_rows($isset_estatus) > 0) {
				$_SESSION['errores']['general'] = "El registro del estatus ya existe";
			}else{
				if (isset($_GET['editar'])) {
					$estatus_id = $_GET['editar'];
					$sql = "UPDATE cat_estatus SET estatus = '$estatus' WHERE id_estatus = $estatus_id";
				}else{
					$sql = "INSERT INTO cat_estatus VALUES (NULL, '$estatus');";
				}				
				
				$guardar = mysqli_query($db, $sql);
				
				echo "<script>location.href='../estatus.php';</script>";
				if ($guardar) {
					$_SESSION['completado'] = "El registro del estatus se completo con exito";
				}else{
					$_SESSION['errores']['general'] = 'Fallo el registro del estatus';
				}
			}
		}else{
			$_SESSION['errores'] = $errores;			
			if (isset($_GET['editar'])) {
				echo "<script>location.href='../editar-estatus.php?id_estatus='.$_GET['editar'];</script>";
			}else{
				echo "<script>location.href='../estatus.php';</script>";
			}
		}
	}

	echo "<script>location.href='../estatus.php';</script>";
?>