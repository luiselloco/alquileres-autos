<?php
	session_start();
	
	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Administrador') {
    		header("location: ../../../login/login.php");
    	}
    }

    require_once('../../../DB/connectDB.php');

	if (isset($_REQUEST['id'])) {
		$delIDAlq = base64_decode($_REQUEST['id']);

		$sql = $conn->prepare("DELETE FROM alquiler WHERE ID = ?");
		$sql->bindParam(1, $delIDAlq);
		$sql->execute();

		if (!$sql) {
			echo 
				'<script>
					alert("Error al eliminar los datos!")
					window.history.go(-1);
				</script>'
			;
		} else {
			echo 
				'<script>
					confirm("¿Desea eliminar los datos?");
					console.log("Datos eliminados correctamente!");
					window.location.href = "reservasA.php";
				</script>'
			;
		}
	}

	// Cerramos la conexion
	$conn = null;
?>