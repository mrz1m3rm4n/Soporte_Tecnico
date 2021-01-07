<?php require_once 'logs/conexion.php'; ?>

<?php if (isset($_SESSION['usuario'])): ?>
	<?php include_once 'cabecera.php' ?>
 
		<?php include_once 'lateral.php' ?>

		<div class="clearfix"></div>

		<div class="contenedor">

			<h2 class="titulo">Usuarios</h2>

			<form action="logs/guardar-clientes.php" method="POST" class="cuadrosgrandes">
				<?php if(isset($_SESSION['completado'])) : ?>
					<div class="alerta alerta-exito">
						<?=$_SESSION['completado'];?>
					</div>
				<?php elseif(isset($_SESSION['errores']['general'])) : ?>
					<div class="alerta alerta-errores">
						<?=$_SESSION['errores']['general'];?>
					</div>
				<?php endif; ?>

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

				<input type="text" name="nombre" class="input" placeholder="Nombre">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';?>

				<input type="text" name="apellidos" class="input" placeholder="Apellidos">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '';?>

				<input type="text" name="telefono" class="input" placeholder="Telefono">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'telefono') : '';  ?>

				<input type="text" name="celular" class="input" placeholder="Celular">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'celular') : ''; ?>

				<input type="email" name="correo" class="input" placeholder="Correo">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'correo') : ''; ?>

				<input type="submit" name="submit" value="Guardar">
			</form> 		

			<?php borrarErrores(); ?>

		</div>

		<div class="clearfix"></div>

		<div class="formulario usuarios">
			<h2>Informacion</h2>
			<table class="editargrande">
				<tr>		 		
					<th>Negocio</th>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Celular</th>
					<th class="correo">Correo</th>
					<th>Modificadores</th>
				</tr>

				<?php  
					$usuario_view = ConseguirUsuariosT($db);
					if(!empty($usuario_view)) :
						while($usuario_vi = mysqli_fetch_assoc($usuario_view)) :
				?>
							<tr>
								<td><?=$usuario_vi['negocio']?></td>
								<td><?=$usuario_vi['nombre']?></td>
								<td><?=$usuario_vi['telefono']?></td>
								<td><?=$usuario_vi['celular']?></td>
								<td class="correo"><?=$usuario_vi['correo']?></td>
								<td>
									<a href="editar-usuarios.php?id_clientes=<?=$usuario_vi['id_clientes']?>" class="btn editar">Editar</a>
									<a href="logs/eliminar-usuarios.php?id_clientes=<?=$usuario_vi['id_clientes']?>" class="btn eliminar">Eliminar</a>
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