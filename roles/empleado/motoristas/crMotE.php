<?php
	session_start();
	
	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Empleado') {
    		header("location: ../../../login/login.php");
    	}
    }

	require_once('../../../DB/connectDB.php');

	// Recibimos los datos que se enviaron desde el FORM
	$nameMot = $_POST['nameMot'];
	$edadMot = $_POST['edadMot'];
	$telMot = $_POST['telMot'];
	$hourMot = $_POST['hourMot'];

	// Ingresamos los datos junto con la conexion
	$ins = $conn->prepare("INSERT INTO motoristas (Nombre_mot, Edad, Telefono, Horario) VALUES (?, ?, ?, ?)");
	$ins->bindParam(1, $nameMot);
	$ins->bindParam(2, $edadMot);
	$ins->bindParam(3, $telMot);
	$ins->bindParam(4, $hourMot);
	$ins->execute();

	//Comparamos el ingreso de los datos
	if (!$ins) {
		// En caso de dar error
		echo
			'<script>
				alert("Error al registrar los datos!");
				location.reload();
			</script>'
		;
	} else {
		// Cuando todo este correcto
		echo 
			'<script>
				alert("Datos registrados correctamente!");
				window.location.href = "motoristasE.php";
			</script>'
		;
	}

	//Cerramos la conexion
	$conn = null;
	
?>