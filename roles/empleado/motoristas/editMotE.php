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

	if (isset($_REQUEST['id'])) {
		$editIDM = base64_decode($_REQUEST['id']);

		$exec = $conn->prepare("SELECT * FROM motoristas WHERE ID_MOT = ?");
		$exec->bindParam(1, $editIDM);
		$exec->execute();

		$fila = $exec->fetch(PDO::FETCH_ASSOC);

		$editIDM = $fila['ID_MOT'];
		$nameMo = $fila['Nombre_mot'];
		$edadMo = $fila['Edad'];
		$telMo = $fila['Telefono'];
		$hourMo = $fila['Horario'];
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Empleado | motoristas </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body class="bg-secondary" style="font-family: 'Noto Sans', sans-serif;">
	<!-- Form y main -->
	<main class="p-0 m-5 d-flex justify-content-center">
		<section>
			<form method="POST" class="rounded-3 shadow bg-white" action="">
				<h3 class="mb-3 border-bottom border-1 text-center"><a href="motoristasE.php" class="bi-arrow-left fs-2 text-dark" title="Regresar"></a> Editar motorista </h3>
				<div class="row mb-3">
					<label for="nameMotorista" class="col-sm-5 ms-1 col-form-label"> Editar motorista: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nameMot" required value="<?php echo $nameMo; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="edadMo" class="col-sm-5 ms-1 col-form-label"> Editar edad: </label>
					<div class="col-sm-6">
						<input type="number" min="0" max="100" class="form-control" name="edadM" required value="<?php echo $edadMo; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="telMot" class="col-sm-5 ms-1 col-form-label"> Editar telefono: </label>
					<div class="col-sm-6">
						<input type="number" class="form-control" name="telfMot" required value="<?php echo $telMo; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="HourMot" class="col-sm-5 ms-1 col-form-label"> Editar el horario: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="hourMot" required value="<?php echo $hourMo; ?>">
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<button type="submit" class="btn btn-outline-primary" name="actualizar" role="button"> Actualizar </button>
				</div>
			</form>
			<?php
				if (isset($_POST['actualizar'])) {
					$upd_nameM = $_POST['nameMot'];
					$upd_edadM = $_POST['edadM'];
					$upd_telM = $_POST['telfMot'];

					$updM = $conn->prepare("UPDATE motoristas SET Nombre_mot = ?, Edad = ?, Telefono = ? WHERE ID_MOT = ?");
					$updM->bindParam(1, $upd_nameM);
					$updM->bindParam(2, $upd_edadM);
					$updM->bindParam(3, $upd_telM);
					$updM->bindParam(4, $editIDM);
					$updM->execute();

					//Comprobamos que los datos se registren correctamente con un mensaje
					if (!$updM) {
						echo 
							'<script>
								alert("Error al eliminar los datos!");
								location.reload();
							</script>'
						;
					} else {
						echo 
							'<script>
								alert("Datos actualizados correctamente!");
								window.location.href = "motoristasE.php";
							</script>'
						;
					}
				}

				// Cerramos la conexion
				$conn = null;
			?>
		</section>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>