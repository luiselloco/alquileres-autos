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

	// Comparamos el id que se presiono con el requerido
	if (isset($_REQUEST['id'])) {
		$delIDM = base64_decode($_REQUEST['id']);

		// Ejecutamos la consulta junto con la conexion
		$exec = $conn->prepare("DELETE FROM motoristas WHERE ID_MOT = ?");
		$exec->bindParam(1, $delIDM);
		$exec->execute();

		// Mostramos un mensaje de confirmacion
		if (!$exec) {
			echo 
				'<script>
					alert("Error al eliminar los datos!");
					location.reload();
				</script>'
			;
		} else {
			echo 
				'<script>
					confirm("¿Desea eliminar los datos?");
					console.log("Datos eliminados correctamente!");
					window.location.href = "motoristasE.php";
				</script>'
			;
		}
	}

	// Cerramos la conexion
	$conn = null;
?>