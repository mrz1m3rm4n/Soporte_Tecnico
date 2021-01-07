	<aside id="aside" class="total">
		<?php if(isset($_SESSION['usuario'])) : ?>
			<div id="usuarios-logeados" class="bloque">
				<h3>Bienvenido, <?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3>
				<a href="crearentradas.php" class="boton boton-verde">Crear Entrada</a>
				<a href="crearcategoria.php" class="boton">Crear Categoria</a>
				<a href="misdatos.php" class="boton boton-naranja">Mis Datos</a>
				<a href="logs/cerrar.php" class="boton boton-rojo">Cerrar Sesion</a>
			</div>
		<?php endif; ?>

		<?php if (!isset($_SESSION['usuario'])): ?>
			<div id="login" class="bloque">
				<h3>Identificate</h3>

				<?php if(isset($_SESSION['errores']['general'])) : ?>
					<div class="alerta alerta-error">
						<?=$_SESSION['errores']['general'];?>
					</div>

					<div id="register" class="bloque">	
					<h3>Registrate</h3>

					<form action="logs/registro.php" method="POST">
						<label for="nombre">Nombre:</label>
						<input type="text" name="nombre" placeholder="Nombre">
						<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

						<label for="apellidos">Apellidos:</label>
						<input type="text" name="apellidos" placeholder="Apellidos">
						<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

						<label for="email">Email:</label>
						<input type="email" name="email" placeholder="Email">
						<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

						<label for="password">Contraseña:</label>
						<input type="password" name="password" placeholder="Password">
						<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

						<input type="submit" name="submit" value="Registrar">
					</form>
				</div>
				<?php endif; ?>

				<form action="logs/login.php" method="POST" id="formulario-login">
					<label for="email">Email:</label>
					<input type="email" name="email" placeholder="Email">
					<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

					<label for="password">Contraseña:</label>
					<input type="password" name="password" placeholder="Password">
					<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

					<input type="submit" name="submit" value="Entrar">
				</form>
			</div>

			<?php borrarErrores(); ?>
			
		<?php endif ?>
	</aside>