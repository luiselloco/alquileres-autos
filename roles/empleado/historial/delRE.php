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

	if (isset($_REQUEST['eliminar'])) {
		$idEnt = base64_decode($_REQUEST['eliminar']);

		// Ejecutamos el query que actualizara el estado de la entrega
		$exec = $conn->prepare("DELETE FROM alquiler WHERE ID = ?");
		$exec->bindParam(1, $idEnt);
		$exec->execute();

		// Mostramos un mensaje de confirmacion
		if (!$exec) {
			echo 
				'<script>
					alert("Error al eliminar los datos");
					location.reload();
				</script>'
			;
		} else {
			echo 
				'<script>
					confirm("¿Desea eliminar los datos?");
					console.log("Datos eliminados correctamente!");
					window.location.href = "reservasE.php";
				</script>'
			;
		}
	}

	// Cerramos la conexion
	$conn = null;
?>
