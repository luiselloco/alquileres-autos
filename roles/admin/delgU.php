<?php
	
	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Administrador') {
    		header("location: ../../login/login.php");
    	}
    }
    
	require_once('../../DB/connectDB.php');

	if (isset($_REQUEST['id'])) {
		$delUID = base64_decode($_REQUEST['id']);

		$del = $conn->prepare("DELETE FROM usuarios WHERE ID = ?");
		$del->bindParam(1, $delUID);
		$del->execute();

		if (!$del) {
			echo 
				'<script>
					alert("Error al eliminar los datos!");
					window.history.go(-1);
				</script>'
			;
		} else {
			echo 
				'<script>
					confirm("¿Desea eliminar los datos?");
					console.log("Datos eliminados correctamente!");
					window.location.href = "gUser.php";
				</script>'
			;
		}
	}

	$conn = null;
?>