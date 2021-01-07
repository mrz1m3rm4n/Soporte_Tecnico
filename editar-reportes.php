<?php require_once 'logs/conexion.php'; ?>

<?php if(isset($_SESSION['usuario'])) :?>
	<?php require_once 'cabecera.php' ?> 

		<?php include_once 'lateral.php' ?>

		<div class="clearfix"></div>

		<div class="contenedor">
			<h2 class="titulo">Registro de Reportes</h2>

			<?php if(isset($_SESSION['completado'])) :?>
				<div class="alerta alerta-exito">
					<?=$_SESSION['completado'];?>				
				</div>
			<?php elseif(isset($_SESSION['errores']['general'])) : ?>
				<div class="alerta alerta-errores">
					<?=$_SESSION['errores']['general'];?>
				</div>
			<?php endif; ?> 

			<?php
				$reporte_actual = ConseguirReporteEdit($db, $_GET['id_reportes']);
				if (!isset($reporte_actual['id_reportes'])) {
					echo "<script>location.href='index.php';</script>";
				}
			?>

			<form action="logs/guardar-reportes.php?editar=<?=$reporte_actual['id_reportes']?>" method="POST">
				<select name="clientes">
					<option>Cliente</option>
					<?php
						$clientes = ConseguirClientes($db);
						if(!empty($clientes)) :
							while($cliente = mysqli_fetch_assoc($clientes)) :
					?>
								<option value="<?=$cliente['id_clientes']?>"<?=($cliente['nombre'] == $reporte_actual['nombre']) ? 'selected="selected"' : ""?>><?=$cliente['nombre']?>					
								</option>
					<?php
							endwhile;
						endif;
					?>
				</select>

				<select name="negocios">
								<option>Negocio</option>
					<?php
						$negocios = ConseguirNegocio($db);
						if(!empty($negocios)) :
							while($negocio = mysqli_fetch_assoc($negocios)) :
					?> 
								<option value="<?=$negocio['id_negocios']?>"<?=($negocio['negocio'] == $reporte_actual['negocio']) ? 'selected="selected"' : ""?>><?=$negocio['negocio']?>	
								</option>
					<?php
							endwhile;
						endif;
					?>
					<option></option>
				</select>

				<select name="estatus">
								<option>Estatus</option>
					<?php
						$estatus = ConseguirEstatus($db);
						if (!empty($estatus)) :
							while($estatu = mysqli_fetch_assoc($estatus)):
					?>
								<option value="<?=$estatu['id_estatus']?>"<?=($estatu['estatus'] == $reporte_actual['estatus']) ? 'selected="selected"' : ""?>><?=$estatu['estatus']?>
								</option>
					<?php
							endwhile;
						endif;
					?> 
				</select>

				<input type="date" name="fechareporta" class="input" value="<?=$reporte_actual['fechareporta']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'fechareporta') : '';?>

				<input type="date" name="fechasolucion" class="input" value="<?=$reporte_actual['fechasolucion']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'fechasolucion') : '';?>

				<textarea name="problema" class="input problema">
					<?=$reporte_actual['problema']?>
				</textarea>

				<input type="text" name="codigoreportes" class="input" disabled value="<?=$reporte_actual['codigoreportes']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'codigoreportes') : '';?>

				<input type="submit" name="submit" value="Guardar"> 
			</form>				

			<?php borrarErrores(); ?>

		</div>

		<div class="clearfix"></div>

		<div class="formulario reportes">
			<h2>Informacion</h2>
			<table> 
				<tr>				
					<th>Cliente</th>
					<th>Negocio</th>
					<th>Fecha</th>
					<th>Folio</th>
					<th>Modificadores</th>
				</tr>

				<?php  
					$reportes_view = ConseguirReportesT($db);
					if(!empty($reportes_view)) :
						while($reportes_v = mysqli_fetch_assoc($reportes_view)) :
				?>
							<tr> 
								<td><?=$reportes_v['nombre']?></td>
								<td><?=$reportes_v['negocio']?></td>
								<td><?=$reportes_v['fechareporta']?></td>
								<td><?=$reportes_v['codigoreportes']?></td>
								<td>
									<a href="editar-reportes.php?id_reportes=<?=$reportes_v['id_reportes']?>" class="btn editar">Editar</a>
									<a href="logs/eliminar-reportes.php?id_reportes=<?=$reportes_v['id_reportes']?>" class="btn eliminar">Eliminar</a>
								</td>
							</tr>
				<?php
						endwhile;
					endif;
				?>
			</table>
		</div>

	<?php require_once 'pie.php' ?>
<?php else : 
	echo "<script>location.href='index.php';</script>";
	  endif;?> 