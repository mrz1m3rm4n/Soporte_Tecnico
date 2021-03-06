<?php require_once 'logs/conexion.php'; ?>

<?php if (isset($_SESSION['usuario'])) : ?>
	<?php require_once 'cabecera.php'; ?>
 
		<?php include_once 'lateral.php' ?>

		<div class="clearfix"></div>

		<div class="contenedor"> 
			<h2 class="titulo">Sucursales</h2>

			<?php if(isset($_SESSION['completado'])) :?>
				<div class="alerta alerta-exito">
					<?=$_SESSION['completado'];?>
				</div>
			<?php elseif(isset($_SESSION['errores']['general'])) :?>
				<div class="alerta alerta-error">
					<?=$_SESSION['errores']['general'];?>
				</div>
			<?php endif; ?>

			<form action="logs/guardar-sucursales.php" method="POST">
				<select name="negocios">
					<option>Negocio</option>
					<?php 
						$negocios = ConseguirNegocio($db);
						if(!empty($negocios)) :
							while($negocio = mysqli_fetch_assoc($negocios)) :
					?> 
								<option value="<?=$negocio['id_negocios']?>"><?=$negocio['negocio']?>
								</option>
					<?php
							endwhile;
						endif;
					?>
					<option></option>
				</select>

				<input type="text" name="sucursales" autofocus="autofocus" class="input" placeholder="SECURSAL">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'sucursales') : '';?>

				<input type="date" name="fechainicio" class="input">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'fechainicio') : '';?>

				<input type="date" name="fechafin" class="input">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'fechafin') : '';?>

				<input type="text" name="licencia" class="input" placeholder="LICENCIA">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'licencia') : '';?>

				<input type="text" name="direccion" class="input" placeholder="DIRECCION">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'direccion') : '';?>

				<input type="submit" name="submit" value="Guardar">		
			</form>

			<?php borrarErrores(); ?>

		</div>

		<div class="clearfix"></div>

		<div class="formulario sucursales">
			<h2>Informacion</h2>
			<table>  
				<tr>				
					<th>Negocio</th>
					<th>Sucursal</th>
					<th>Licencia</th>
					<th>Modificadores</th>
				</tr>

				<?php  
					$sucursales_view = ConseguirSucursalesT($db);
					if(!empty($sucursales_view)) :
						while($sucursales_v = mysqli_fetch_assoc($sucursales_view)) :
				?>
							<tr> 
								<td><?=$sucursales_v['negocio']?></td>
								<td><?=$sucursales_v['sucursales']?></td>
								<td><?=$sucursales_v['licencia']?></td>
								<td>
									<a href="editar-sucursales.php?id_sucursales=<?=$sucursales_v['id_sucursales']?>" class="btn editar">Editar</a>
									<a href="logs/eliminar-sucursales.php?id_sucursales=<?=$sucursales_v['id_sucursales']?>" class="btn eliminar">Eliminar</a>
								</td>
							</tr>
				<?php
						endwhile;
					endif;
				?>
			</table>
		</div>

	<?php require_once 'pie.php'; ?>
<?php else : 
	echo "<script>location.href='index.php';</script>";
	  endif;?> 