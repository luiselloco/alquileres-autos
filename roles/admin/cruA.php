<?php
	session_start();

	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Administrador') {
    		header("location: ../../login/login.php");
    	}
    }

	require_once('../../DB/connectDB.php');

	// Recibimos los datos que se enviaron desde el FORM
	$user = $_POST['usuario'];
	$pass = $_POST['contra'];
	$name = $_POST['nombre'];
	$ape = $_POST['apellido'];
	$email = $_POST['correo'];
	$roluser = $_POST['tipousuario'];

	//Generamos un hash para la contraseña
	$pwd_hash = password_hash($pass, PASSWORD_DEFAULT);

	// Ingresamos los datos
	$insert = $conn->prepare("INSERT INTO usuarios (Usuario, Passw, Nombre, Apellido, Correo, Tipousuario) VALUES (?, ?, ?, ?, ?, ?)");
	$insert->bindParam(1, $user);
	$insert->bindParam(2, $pwd_hash);
	$insert->bindParam(3, $name);
	$insert->bindParam(4, $ape);
	$insert->bindParam(5, $email);
	$insert->bindParam(6, $roluser);

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

	$insert->execute();
	if (!$insert) {
		echo 
			'<script>
				alert("Error al registrar usuario");
				location.reload();
			</script>'
		;
	} else {
		echo 
			'<script>
				alert("Usuario registrado correctamente");
				window.location.href = "gUser.php";
			</script>'
		;
	}

	$insert = null;
	$conn = null;
?>