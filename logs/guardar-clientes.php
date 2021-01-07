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
		$negocios = isset($_POST['negocios']) ? (int)$_POST['negocios'] : false;
		$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
		$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
		$telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($db, $_POST['telefono']) : false;
		$celular = isset($_POST['celular']) ? mysqli_real_escape_string($db, $_POST['celular']) : false;
		$correo = isset($_POST['correo']) ? mysqli_real_escape_string($db, $_POST['correo']) : false;

		$errores = array(); // CREA ARRAY DE ERRORES

// VALIDA SI NO ESTA VACIO,          NO ES NUMERICO,        SI NO HAY NUMEROS
		if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)) {
			$nombre_validado = true;			
		}else{
			$nombre_validado = false;
			$errores['nombre'] = "El nombre no es valido";
		}

		if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)) {
			$apellidos_validado = true;			
		}else{
			$apellidos_validado = false;
			$errores['apellidos'] = "Los apellidos no son validos"; 
		}
		
		if (!empty($celular) && is_numeric($celular)) {
			$celular_validado = true;			
		}else{
			$celular_validado = false;
			$errores['celular'] = "El celular no es valido";
		}

		$guardar_estatus = false;
		
		// CUENTA LOS ERRORES
		if (count($errores) == 0) {
			$guardar_estatus = true;

			$sql = "SELECT * FROM cat_clientes WHERE nombre = '$nombre' and apellidos = '$apellidos'";
			$isset_estatus = mysqli_query($db, $sql);

			if (mysqli_num_rows($isset_estatus) > 0 && !isset($_GET['editar'])) {
				$_SESSION['errores']['general'] = "El registro del cliente ya existe";
			}else{				 
				if (isset($_GET['editar'])) {					
					$usuario_id = $_GET['editar'];					
					$sql = "UPDATE cat_clientes SET id_negocios = '$negocios', nombre = '$nombre', apellidos = '$apellidos', telefono = '$telefono', celular = '$celular', correo = '$correo' WHERE id_clientes = $usuario_id";
				}else{
					$sql = "INSERT INTO cat_clientes VALUES (NULL, '$negocios', '$nombre', '$apellidos', '$telefono', '$celular', '$correo');";
				}

				$guardar = mysqli_query($db, $sql);
				echo "<script>location.href='../usuarios.php';</script>";

				if ($guardar) {
					$_SESSION['completado'] = "El registro del cliente se completo con exito";
				}else{
					$_SESSION['errores']['general'] = 'Fallo el registro del cliente';
				}
			}
		}else{
			$_SESSION['errores'] = $errores;
			if (isset($_GET['editar'])) {
				echo "<script>location.href='../editar-usuario.php?id_clientes='.$_GET['editar'];</script>";
			}else{
				echo "<script>location.href='../usuarios.php';</script>";
			}
		}
	}

	echo "<script>location.href='../usuarios.php';</script>";
?>