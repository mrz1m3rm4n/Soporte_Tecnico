<?php require_once 'logs/conexion.php'; ?>

<?php if(isset($_SESSION['usuario'])) :?>
	<?php include_once 'cabecera.php' ?>

		<?php include_once 'lateral.php' ?>

		<div class="clearfix"></div>

		<div class="contenedor">

			<h2 class="titulo">Registro de Usuarios</h2>

			<?php if(isset($_SESSION['completado'])) : ?>
				<div class="alerta alerta-exito">
					<?=$_SESSION['completado'];?>
				</div>
			<?php elseif(isset($_SESSION['errores']['general'])) : ?>
				<div class="alerta alerta-errores">
					<?=$_SESSION['errores']['general'];?>
				</div>
			<?php endif; ?>

			<?php
				$usuario_actual = ConseguirClientesEdit($db, $_GET['id_clientes']);
				if (!isset($usuario_actual['id_clientes'])) {
					echo "<script>location.href='index.php';</script>";
				}
			?>

			<form action="logs/guardar-clientes.php?editar=<?=$usuario_actual['id_clientes']?>" method="POST">
				<select name="negocios"> 
					<option>Negocio</option>
					<?php
						$negocios = ConseguirNegocio($db);
						if(!empty($negocios)) :
							while($negocio = mysqli_fetch_assoc($negocios)) :
					?> 
								<option value="<?=$negocio['id_negocios']?>"<?=($negocio['negocio'] == $usuario_actual['negocio']) ? 'selected="selected"' : ""?>><?=$negocio['negocio']?>
								</option>
					<?php
							endwhile;
						endif;
					?>
					<option></option>
				</select>

				<input type="text" name="nombre" class="input" value="<?=$usuario_actual['nombre']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';?>

				<input type="text" name="apellidos" class="input" value="<?=$usuario_actual['apellidos']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '';?>

				<input type="text" name="telefono" class="input" value="<?=$usuario_actual['telefono']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'telefono') : '';  ?>

				<input type="text" name="celular" class="input" value="<?=$usuario_actual['celular']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'celular') : ''; ?>

				<input type="email" name="correo" class="input" value="<?=$usuario_actual['correo']?>">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'correo') : ''; ?>

				<input type="submit" name="submit" value="Guardar">
			</form> 		

			<?php borrarErrores(); ?>

		</div>

		<div class="clearfix"></div>

		<div class="formulario usuarios">
			<h2>Informacion</h2>
			<table>
				<tr>		 		
					<th class="correo">Negocio</th>
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
								<td class="correo"><?=$usuario_vi['negocio']?></td>
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