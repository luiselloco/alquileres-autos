<?php
    session_start();

    if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Empleado') {
    		header("location: ../../../login/login.php");
    	}
    }

    //Incluimos la conexión a la BD
    require_once('../../../DB/connectDB.php');

	if (isset($_REQUEST['estado'])) {
		$estadoAlq = base64_decode($_REQUEST['estado']);

		// Ejecutamos el query que actualizara el estado de la entrega
		$exec = $conn->prepare("UPDATE alquiler SET Estado = 'Entregado' WHERE ID = ?");
		$exec->bindParam(1, $estadoAlq);
		$exec->execute();

		// Mostramos un mensaje de confirmacion
		echo '
			<script>
				alert("Entrega realizada!");
				window.location.href = "reservasE.php";
			</script>'
		;
	}

	// Cerramos la conexion
	$conn = null;
?>
