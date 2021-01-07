<?php require_once 'logs/conexion.php'; ?>
<?php require_once 'logs/redireccion.php'; ?>
<?php require_once 'helpers.php'; ?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="">
	<title>Soporte</title>
	<?php if (!isset($_SESSION['usuario'])): ?>
		<link rel="stylesheet" type="text/css" href="css/sinsesion.css">
	<?php endif ?>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<nav>
		<div id="menu">
			<ul>
				<?php
					if (isset($_SESSION['usuario'])) :
				?>
						<li><a href="index.php">Inicio</a></li>
						<li><a href="estatus.php">Estatus</a></li>
						<li><a href="gnegocio.php">Giro Negocios</a></li>				
						<li><a href="negocio.php">Negocio</a></li>
						<li><a href="sucursales.php">Sucursales</a></li>
						<li><a href="usuarios.php">Usuario</a></li>				
						<li><a href="reporte.php">Reporte</a></li>
				<?php
					endif;
				?>
			</ul>
		</div> 
	</nav> 

	<main class="main">