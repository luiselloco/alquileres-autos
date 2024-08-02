<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title> Iniciar Sesión </title>
		<link rel="stylesheet" href="../assets/css/estilos.css">
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body style="font-family: 'Noto Sans', sans-serif;">
		<main class="contenedor-form">
			<section class="formulario">
				<h2> Iniciar Sesión </h2>
				<form id="loginForm" action="validar.php" method="POST">
					<label for="Usuario"> Ingrese el usuario </label>
					<input type="text" placeholder="Usuario" name="usuario" id="usuario" required>
					<label for="Pass"> Ingrese la contraseña </label>
					<input type="password" placeholder="Contraseña" name="contra" id="contra" required>
					<label for="Rol"> Elija su rol </label>
					<select name="tipousuario" title="Elija su rol">
						<option value="Administrador"> Administrador </option>
						<option value="Empleado"> Empleado </option>
						<option value="Usuario"> Usuario </option>
					</select>
					<button type="submit" value="Iniciar Sesión"> Iniciar Sesión </button>
				</form>
				<p> Eres nuevo, <a href="registrar.php"> Crea una cuenta. </a></p>
			</section>
		</main>
	</body>
</html>