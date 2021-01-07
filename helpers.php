<?php
	function mostrarError($errores, $campo){
		$alerta='';
		if (isset($errores[$campo]) && !empty($campo)){
			$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
		}

		return $alerta;
	}

	function borrarErrores(){
		$borrado=false;

		if(isset($_SESSION['errores'])){
	        $_SESSION['errores'] = null;
	        $borrado = true;
	    }

	    if(isset($_SESSION['completado'])){
	        $_SESSION['completado'] = null;     
	        $borrado = true;
	    }
 
	    if(isset($_SESSION['errores_estatus'])){
	        $_SESSION['errores_estatus'] = null;     
	        $borrado = true;
	    }

		return $borrado;
	}

	function ConseguirEstatus($conexion){ 
		$sql = "SELECT * FROM cat_estatus ORDER BY id_estatus ASC";
		$estatus = mysqli_query($conexion, $sql);

		$result = array();
		if ($estatus && mysqli_num_rows($estatus) >=1) {
			$result = $estatus;
		}

		return $result;
	}

	function ConseguirEstatu($conexion, $id_estatus){ 
		$sql = "SELECT * FROM cat_estatus WHERE id_estatus=$id_estatus";

		$ver_estatus = mysqli_query($conexion, $sql);

		$result = array();
 
		if ($ver_estatus && mysqli_num_rows($ver_estatus) >=1) {
			$result = mysqli_fetch_assoc($ver_estatus);
		}

		return $result;
	}

	function ConseguirGiroNegocio($conexion){
		$sql = "SELECT * FROM cat_gnegocios ORDER BY id_gnegocio ASC";
		$gironegocio = mysqli_query($conexion, $sql);

		$result = array();
		if ($gironegocio && mysqli_num_rows($gironegocio) >=1) {
			$result = $gironegocio;
		}

		return $result;
	}

	function ConseguirGNegocio($conexion, $id_gnegocio){
		$sql = "SELECT * FROM cat_gnegocios WHERE id_gnegocio = $id_gnegocio";
		
		$gironegocio = mysqli_query($conexion, $sql); 

		$result = array();
		if ($gironegocio && mysqli_num_rows($gironegocio) >=1) {
			$result = mysqli_fetch_assoc($gironegocio);
		}

		return $result;
	}

	function ConseguirSucursales($conexion){
		$sql = "SELECT * FROM cat_sucursales ORDER BY id_sucursales ASC";
		$sucursales = mysqli_query($conexion, $sql);

		$result = array();
		if ($sucursales && mysqli_num_rows($sucursales) >=1) {
			$result = $sucursales;
		}

		return $result;
	}

	function ConseguirNegocio($conexion){
		$sql = "SELECT * FROM negocios ORDER BY id_negocios ASC";
		$negocios = mysqli_query($conexion, $sql);

		$result = array();
		if ($negocios && mysqli_num_rows($negocios) >=1) {
			$result = $negocios;
		}

		return $result;
	}

	function ConseguirClientes($conexion){
		$sql = "SELECT * FROM cat_clientes ORDER BY id_clientes ASC";
		$clientes = mysqli_query($conexion, $sql);

		$result = array();
		if ($clientes && mysqli_num_rows($clientes) >=1) {
			$result = $clientes;
		}

		return $result;
	}

	function ConseguirReportesT($conexion){ 
		$sql = "SELECT reportes.id_reportes, cat_clientes.nombre, negocios.negocio, cat_estatus.estatus, reportes.fechareporta, reportes.fechasolucion, reportes.problema, reportes.codigoreportes FROM reportes INNER JOIN cat_clientes ON reportes.id_clientes = cat_clientes.id_clientes INNER JOIN negocios ON reportes.id_negocios = negocios.id_negocios INNER JOIN cat_estatus ON reportes.id_estatus = cat_estatus.id_estatus";

		$reportes = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($reportes && mysqli_num_rows($reportes) >=1) {
			$resultado = $reportes;
		}

		return $resultado;
	}

	function ConseguirReporteEdit($conexion, $id_reportes){ 
		$sql = "SELECT reportes.id_reportes, cat_clientes.nombre, negocios.negocio, cat_estatus.estatus, reportes.fechareporta, reportes.fechasolucion, reportes.problema, reportes.codigoreportes FROM reportes INNER JOIN cat_clientes ON reportes.id_clientes = cat_clientes.id_clientes INNER JOIN negocios ON reportes.id_negocios = negocios.id_negocios INNER JOIN cat_estatus ON reportes.id_estatus = cat_estatus.id_estatus WHERE id_reportes = $id_reportes";

		$reportes = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($reportes && mysqli_num_rows($reportes) >=1) {
			$resultado = mysqli_fetch_assoc($reportes);
		}

		return $resultado;
	}

	function ConseguirSucursalesT($conexion){
		$sql = "SELECT id_sucursales, negocios.negocio, sucursales, fechainicio, fechafin ,licencia, direccion FROM cat_sucursales INNER JOIN negocios ON cat_sucursales.id_negocios = negocios.id_negocios ORDER BY negocio ASC";

		$sucursal = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($sucursal && mysqli_num_rows($sucursal) >=1) {
			$resultado = $sucursal;
		}

		return $resultado;
	}

	function ConseguirNegocioT($conexion){
		$sql = "SELECT negocios.id_negocios, cat_estatus.estatus, cat_gnegocios.gironegocio, negocios.negocio FROM negocios INNER JOIN cat_estatus ON negocios.id_estatus = cat_estatus.id_estatus INNER JOIN cat_gnegocios ON negocios.id_gnegocio = cat_gnegocios.id_gnegocio ORDER BY negocio ASC ";

		$negocio = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($negocio && mysqli_num_rows($negocio) >=1) {
			$resultado = $negocio;
		}

		return $resultado;
	}

	function ConseguirUsuariosT($conexion){
		$sql = "SELECT cat_clientes.id_clientes, negocios.negocio, cat_clientes.nombre, cat_clientes.apellidos, cat_clientes.telefono, cat_clientes.celular, cat_clientes.correo FROM cat_clientes INNER JOIN negocios ON cat_clientes.id_negocios = negocios.id_negocios ORDER BY negocio ASC";

		$usuarios = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($usuarios && mysqli_num_rows($usuarios) >=1) {
			$resultado = $usuarios;
		}

		return $resultado;
	}

	function ConseguirNegocioEdit($conexion, $id_negocios){
		$sql = "SELECT negocios.id_negocios, cat_estatus.estatus, cat_gnegocios.gironegocio, negocios.negocio FROM negocios INNER JOIN cat_estatus ON negocios.id_estatus = cat_estatus.id_estatus INNER JOIN cat_gnegocios ON negocios.id_gnegocio = cat_gnegocios.id_gnegocio WHERE id_negocios = $id_negocios";

		$negocio = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($negocio && mysqli_num_rows($negocio) >=1) {
			$resultado = mysqli_fetch_assoc($negocio);
		}

		return $resultado;
	}
 
	function ConseguirSecursalEdit($conexion, $id_sucursales){
		$sql = "SELECT id_sucursales, negocios.negocio, sucursales, fechainicio, fechafin, licencia, direccion FROM cat_sucursales INNER JOIN negocios ON cat_sucursales.id_negocios = negocios.id_negocios WHERE id_sucursales = $id_sucursales";

		$sucursal = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($sucursal && mysqli_num_rows($sucursal) >=1) {
			$resultado = mysqli_fetch_assoc($sucursal);
		}

		return $resultado;
	}

	function ConseguirClientesEdit($conexion, $id_clientes){		
		$sql = "SELECT cat_clientes.id_clientes, negocios.negocio, cat_clientes.nombre, cat_clientes.apellidos, cat_clientes.telefono, cat_clientes.celular, cat_clientes.correo FROM cat_clientes INNER JOIN negocios ON cat_clientes.id_negocios = negocios.id_negocios WHERE id_clientes = $id_clientes";

		$usuarios = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($usuarios && mysqli_num_rows($usuarios) >=1) {
			$resultado = mysqli_fetch_assoc($usuarios);
		}

		return $resultado;
	}

?>