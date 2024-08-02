<?php
	session_start();
	
	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Administrador') {
    		header("location: ../../login/login.php");
    	}
    }

	require_once('../../../DB/connectDB.php');

	// Recibimos los datos que se enviaron desde el FORM
	$nameM = $_POST['nameMot'];
	$edadM = $_POST['edadMot'];
	$telM = $_POST['telMot'];
	$hourMot = $_POST['hourMot'];

	// Ingresamos los datos junto con la conexion
	$ins = $conn->prepare("INSERT INTO motoristas (Nombre_mot, Edad, Telefono, Horario) VALUES (?, ?, ?, ?)");
	$ins->bindParam(1, $nameM);
	$ins->bindParam(2, $edadM);
	$ins->bindParam(3, $telM);
	$ins->bindParam(4, $hourMot);

	$ins->execute();
	if (!$ins) {
		echo
			'<script>
				alert("Error al registrar los datos!");
				location.reload();
			</script>'
		;
	} else {
		echo 
			'<script>
				alert("Datos registrados correctamente!");
				window.location.href = "motoristasA.php";
			</script>'
		;
	}
	
	$conn = null;
?>