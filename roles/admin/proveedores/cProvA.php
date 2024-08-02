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

	// Recibimos los datos que se enviaron a traves del FORM
	$namePA = $_POST['nameProv'];
	$markPA = $_POST['markProv'];
	$cantCPA = $_POST['cantCProv'];
	$yearCPA = $_POST['yearCProv'];
	$placasCPA = $_POST['placasCProv'];
	$polizaCPA = $_POST['polizaCProv'];

	$ins = $conn->prepare("INSERT INTO proveedores (Proveedor, Marca, CantCar, Año, Placas, Poliza) VALUES (?, ?, ?, ?, ?, ?)");
	$ins->bindParam(1, $namePA);
	$ins->bindParam(2, $markPA);
	$ins->bindParam(3, $cantCPA);
	$ins->bindParam(4, $yearCPA);
	$ins->bindParam(5, $placasCPA);
	$ins->bindParam(6, $polizaCPA);
	$ins->execute();

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
				window.location.href = "proveedoresA.php";
			</script>'
		;
	}

	//Cerramos la conexion
	$conn = null;

?>