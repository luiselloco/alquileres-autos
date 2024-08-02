<?php
	// Conexion a la base de datos
	require_once('../DB/connectDB.php');

	//Recibimos los datos
	$user = $_POST['usuario'];
	$pass = $_POST['contra'];
	$name = $_POST['nombre'];
	$ape = $_POST['apellido'];
	$email = $_POST['correo'];
	$roluser = $_POST['tipousuario'];

	// Generamos un hash para encriptar la contraseña
	$pwd_hash = password_hash($pass, PASSWORD_DEFAULT);

	//Preparamos la sentencia con los datos a ingresar
	$insertar = $conn->prepare("INSERT INTO usuarios (Usuario, Passw, Nombre, Apellido, Correo, Tipousuario) VALUES (?, ?, ?, ?, ?, ?)");

	$insertar->bindParam(1, $user);
	$insertar->bindParam(2, $pwd_hash);
	$insertar->bindParam(3, $name);
	$insertar->bindParam(4, $ape);
	$insertar->bindParam(5, $email);
	$insertar->bindParam(6, $roluser);

	// Verificamos si el usuario existe
	$verifyuser = $conn->prepare("SELECT * FROM usuarios WHERE Usuario = ?");
	$verifyuser->bindParam(1, $user, PDO::PARAM_STR);
	$verifyuser->execute();
	if ($verifyuser->fetchColumn() > 0) {
		echo 
			'<script>
				alert("El usuario ya existe");
				window.history.go(-1);
			</script>'
		;
	}

	// Verificamos si el correo existe
	$verifyemail = $conn->prepare("SELECT * FROM usuarios WHERE Correo = ?");
	$verifyemail->bindParam(1, $email, PDO::PARAM_STR);
	$verifyemail->execute();
	if ($verifyemail->fetchColumn() > 0) {
		echo 
			'<script>
				alert("El correo ya existe");
				window.history.go(-1);
			</script>'
		;
	}

	// Verificamos si la contraseña existe
	$verifypass = $conn->prepare("SELECT * FROM usuarios WHERE Passw = ?");
	$verifypass->bindParam(1, $pwd_hash, PDO::PARAM_STR);
	if ($verifypass->fetchColumn() > 0) {
		$data = $verifypass->fetch(PDO::FETCH_ASSOC);
		if (password_verify($pass, $data['Passw'])) {
			echo 
				'<script>
					alert("La contraseña ya existe");
					window.history.go(-1);
				</script>'
			;
		}
	}

	// Ejecutamos la consulta
	$insertar->execute();
	if (!$insertar) {
		echo 
			'<script>
				alert("Error al registrar usuario");
				location.reload();
			</script>'
		;
	} else {
		echo 
			'<script>
				alert("Usuario registrado correctamente!");
				window.location.href = "registrar.php";
			</script>'
		;
	}

	//Cerramos la conexion
	$insertar = null;
	$conn = null;
?>
