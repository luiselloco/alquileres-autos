<?php
	//Continuamos con la sesion
	session_start();

	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
		header('location: ../../../login/login.php');
	} else {
		if ($_SESSION['tipousuario'] != 'Usuario') {
			header("location: ../../../login/login.php");
		}
	}

	require_once('../../../DB/connectDB.php');

	if (isset($_REQUEST['estado'])) {
		$estadoAlq = base64_decode($_REQUEST['estado']);

		$cons = $conn->prepare("UPDATE alquiler SET Estado = 'Cancelado' WHERE ID = ?");
		$cons->bindParam(1, $estadoAlq);
		$cons->execute();

		echo 
			'<script>
				alert("Cancelación exitosa!");
				window.location.href = "reservasU.php";
			</script>'
		;
	}

	$conn = null;
?>
