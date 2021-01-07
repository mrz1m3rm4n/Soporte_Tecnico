<?php require_once 'logs/conexion.php'; ?>

<?php if (isset($_SESSION['usuario'])) : ?>
	<?php include_once 'cabecera.php' ?>

		<?php include_once 'lateral.php' ?>

		<div class="clearfix"></div>

		<div class="contenedor">
			<h2 class="titulo">Estatus</h2>

			<?php if (isset($_SESSION['completado'])) : ?> 
				<div class="alerta alerta-exito">
					<?=$_SESSION['completado'];?>
				</div>
			<?php elseif(isset($_SESSION['errores']['general'])) : ?>	
				<div class="alerta alerta-error">
					<?=$_SESSION['errores']['general'];?>
				</div>
			<?php endif; ?>

			<?php
				$estatus_edit  = ConseguirEstatu($db, $_GET['id_estatus']);
				if (!isset($estatus_edit['id_estatus'])) {  
					echo "<script>location.href='index.php';</script>";
				}
			?>

			<form action="logs/guardar-estatus.php?editar=<?=$estatus_edit['id_estatus']?>" method="POST">
				<input type="text" name="estatus" autofocus="autofocus" class="input" value="<?=$estatus_edit['estatus']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'estatus') : ''; ?>

				<input type="submit" name="submit" value="Guardar">
			</form>

			<?php borrarErrores(); ?>

		</div> 

		<div class="clearfix"></div>

		<div class="formulario">
			<h2>Informacion</h2>
			<table>
				<tr>
					<th>Estatus</th>
					<th>Modificadores</th>
				</tr>

				<?php
					$estatus_view  = ConseguirEstatus($db);
					if (!empty($estatus_view)) :
						while ($estatus = mysqli_fetch_assoc($estatus_view)) :
				?>
							<tr>
								<td><?=$estatus['estatus']?></td>
								<td>
									<a href="editar-estatus.php?id_estatus=<?=$estatus['id_estatus']?>" class="btn editar">Editar</a>
									<a href="logs/eliminar-estatus.php?id_estatus=<?=$estatus['id_estatus']?>" class="btn eliminar">Eliminar</a>
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