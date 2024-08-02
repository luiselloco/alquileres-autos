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

	// Recibimos los datos que se enviaron desde el FORM
	$marca = $_POST['carselect'];
	$name = $_POST['nombre'];
	$ape = $_POST['apellido'];
	$cant = $_POST['ccarros'];
	$tel = $_POST['telefono'];
    $tipo_car = $_POST['tcar'];
	$resi = $_POST['direccion'];
	$f_retiro = $_POST['fretiro'];
	$f_devo = $_POST['fdevolucion'];
	$nameMot = $_POST['motorista'];
	$state = $_POST['state'];
	$entrega = $_POST['entregaAlq'];
	$price = $_POST['precio'];

	//Calculamos el precio a pagar
	$total = 0;
	$total = $price * $cant;

	// PREPARAMOS LA SENTENCIA
	$insert = $conn->prepare("INSERT INTO alquiler (Marca, Nombre, Apellido, CantCar, Tel, TipoCar, Residencia, Fecha_ret, Fecha_dev, Name_mot, Estado, Entrega, Total_pago) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$insert->bindParam(1, $marca);
	$insert->bindParam(2, $name);
	$insert->bindParam(3, $ape);
	$insert->bindParam(4, $cant);
	$insert->bindParam(5, $tel);
	$insert->bindParam(6, $tipo_car);
	$insert->bindParam(7, $resi);
	$insert->bindParam(8, $f_retiro);
	$insert->bindParam(9, $f_devo);
	$insert->bindParam(10, $nameMot);
	$insert->bindParam(11, $state);
	$insert->bindParam(12, $entrega);
	$insert->bindParam(13, $total);

	// Ejecutamos la consulta
	$insert->execute();
	if (!$insert) {
		echo '<script>
				alert("Error al registrar");
				location.reload();
			</script>'
		;
	} else {
		echo '<script>
				alert("Datos registrados correctamente, revise sus reservas!");
				window.location.href = "../index_user.php";
			</script>'
		;
	}

	// Cerramos la conexion
	$conn = null;
?>
