<?php require_once 'logs/conexion.php'; ?>

<?php if(isset($_SESSION['usuario'])) : ?>
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

			<form action="logs/guardar-gnegocio.php" method="POST">
				<input type="text" name="gironegocio" autofocus="autofocus" class="input" placeholder="GIRO DE NEGOCIO">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'gironegocio') : '';?>

				<input type="submit" name="submit" value="Guardar">
			</form>		

			<?php borrarErrores(); ?>

		</div> 

		<div class="clearfix"></div>

		<div class="formulario">
			<h2>Informacion</h2>
			<table>
				<tr>
					<th>Giro del Negocio</th>
					<th>Modificadores</th>
				</tr>

				<?php 
					$gnegocio_view  = ConseguirGiroNegocio($db);
					if (!empty($gnegocio_view)) :
						while ($gnegocio_v = mysqli_fetch_assoc($gnegocio_view)) :
				?>
							<tr>
								<td><?=$gnegocio_v['gironegocio']?></td>
								<td>
									<a href="editar-gnegocio.php?id_gnegocio=<?=$gnegocio_v['id_gnegocio']?>" class="btn editar">Editar</a>
									<a href="logs/eliminar-gnegocio.php?id_gnegocio=<?=$gnegocio_v['id_gnegocio']?>" class="btn eliminar">Eliminar</a>
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