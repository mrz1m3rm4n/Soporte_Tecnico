<?php
	
	require_once 'conexion.php';

	if (isset($_POST['submit'])) {

	 	$email = trim($_POST['email']);
	 	$password = $_POST['password'];

	 	$sql = "SELECT * FROM usuarios WHERE email = '$email'";
	 	$login = mysqli_query($db, $sql);

	 	if ($login && mysqli_num_rows($login) == 1) {
	 		$usuario = mysqli_fetch_assoc($login);
	 		$verify = password_verify($password, $usuario['password']);

	 		if ($verify) {
	 			$_SESSION['usuario'] = $usuario;
	 		}else{
	 			$_SESSION['error_login'] = "Login inccorrecto";
	 		}
	 	}else{
	 		$_SESSION['error_login'] = "Login inccorrecto";
	 	}
	} 

	echo "<script>location.href='../index.php';</script>";
?>