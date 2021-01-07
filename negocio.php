<?php require_once 'logs/conexion.php'; ?>

<?php if(isset($_SESSION['usuario'])) :?>
	<?php include_once 'cabecera.php' ?> 
 
		<?php include_once 'lateral.php' ?>

		<div class="clearfix"></div>

		<div class="contenedor">
			<h2 class="titulo">Negocio</h2>

			<?php if (isset($_SESSION['completado'])) : ?> 
				<div class="alerta alerta-exito">
					<?=$_SESSION['completado'];?>
				</div>
			<?php elseif(isset($_SESSION['errores']['general'])) : ?>	
				<div class="alerta alerta-error">
					<?=$_SESSION['errores']['general'];?>
				</div>
			<?php endif; ?>	
			
			<form action="logs/guardar-negocio.php" method="POST">
				<select name="estatus">
								<option>Estatus</option>
					<?php
						$estatus = ConseguirEstatus($db);
						if (!empty($estatus)) :
							while($estatu = mysqli_fetch_assoc($estatus)):
					?>
								<option value="<?=$estatu['id_estatus']?>">
									<?=$estatu['estatus']?>
								</option>
					<?php
							endwhile;
						endif;
					?>
				</select>

				<select name="gnegocio">
								<option>Giro del Negocio</option>
					<?php
						$gironegocio = ConseguirGiroNegocio($db);
						if (!empty($gironegocio)) :
							while($gnegocio = mysqli_fetch_assoc($gironegocio)):
					?>
								<option value="<?=$gnegocio['id_gnegocio']?>">
									<?=$gnegocio['gironegocio']?>
								</option>
					<?php
							endwhile;
						endif;
					?>
				</select>

				<input type="text" name="negocio" class="input" placeholder="NEGOCIO">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'negocio') : '';?>

				<input type="submit" name="submit" value="Guardar">
			</form>

			<?php borrarErrores(); ?>

		</div>

		<div class="clearfix"></div>

		<div class="formulario negocio">
			<h2>Informacion</h2>
			<table>
				<tr>	 			
					<th>Estatus</th>
					<th>Giro</th>
					<th>Negocio</th>
					<th>Modificadores</th>
				</tr>

				<?php 
					$negocio_view = ConseguirNegocioT($db);
					if(!empty($negocio_view)) :
						while($negocio_v = mysqli_fetch_assoc($negocio_view)) :
				?>
							<tr>
								<td><?=$negocio_v['estatus']?></td>
								<td><?=$negocio_v['gironegocio']?></td>
								<td><?=$negocio_v['negocio']?></td>
								<td>
									<a href="editar-negocio.php?id_negocios=<?=$negocio_v['id_negocios']?>" class="btn editar">Editar</a>
									<a href="logs/eliminar-negocio.php?id_negocios=<?=$negocio_v['id_negocios']?>" class="btn eliminar">Eliminar</a>
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
	  endif; ?>