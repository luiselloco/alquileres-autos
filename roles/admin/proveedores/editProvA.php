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
		$editIDP = base64_decode($_REQUEST['id']);

		$exec = $conn->prepare("SELECT * FROM proveedores WHERE ID = ?");
		$exec->bindParam(1, $editIDP);
		$exec->execute();

		$fila = $exec->fetch(PDO::FETCH_ASSOC);

		$editIDP = $fila['ID'];
		$nameP = $fila['Proveedor'];
		$markP = $fila['Marca'];
		$cantCarP = $fila['CantCar'];
		$yearCP = $fila['Año'];
		$placasCP = $fila['Placas'];
		$polCP = $fila['Poliza'];
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Editor gestor de proveedores </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body class="bg-secondary" style="font-family: 'Noto Sans', sans-serif;">
	<!-- Form y main -->
	<main class="p-0 m-5 d-flex justify-content-center">
		<section>
			<form method="POST" class="rounded-3 shadow bg-white">
				<h3 class="mb-3 border-bottom border-1 text-center"><a href="proveedoresA.php" class="bi-arrow-left fs-2 text-dark" title="Regresar"></a> Editar proveedor </h3>
				<div class="row mb-3">
					<label for="proveedor" class="col-sm-5 ms-1 col-form-label"> Editar proveedor: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="proveedor" name="namePr" required value="<?php echo $nameP; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="marcaP" class="col-sm-5 ms-1 col-form-label"> Editar marca: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="marcaPr" id="marcaP" required value="<?php echo $markP; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="cantidadCP" class="col-sm-5 ms-1 col-form-label"> Editar cantidad: </label>
					<div class="col-sm-6">
						<input type="number" class="form-control" name="cantidadCPr" id="cantidadCP" required value="<?php echo $cantCarP; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="añoCP" class="col-sm-5 ms-1 col-form-label"> Editar año del carro: </label>
					<div class="col-sm-6">
						<input type="number" class="form-control" name="añoCPr" id="añoCP" required value="<?php echo $yearCP; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="placasCP" class="col-sm-5 ms-1 col-form-label"> Editar placas: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="placasCPr" id="placasCP" required value="<?php echo $placasCP; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="poliCP" class="col-sm-5 ms-1 col-form-label"> Editar poliza del carro: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="poliCPr" id="poliCP" required value="<?php echo $polCP; ?>">
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<button type="submit" class="btn btn-outline-primary" name="actualizar" role="button"> Actualizar </button>
				</div>
			</form>
			<?php
				if (isset($_POST['actualizar'])) {
					// Recibimos los datos que se enviaron desde el FORM
					$upd_nameP = $_POST['namePr'];
					$upd_marcaP = $_POST['marcaPr'];
					$upd_cantidadP = $_POST['cantidadCPr'];
					$upd_yearP = $_POST['añoCPr'];
					$upd_placasCP = $_POST['placasCPr'];
					$upd_poliCP = $_POST['poliCPr'];

					// Ejecutamos la sentencia junto con la conexion
					$updP = $conn->prepare("UPDATE proveedores SET Proveedor = ?, Marca = ?, CantCar = ?, Año = ?, Placas = ?, Poliza = ? WHERE ID = ?");
					$updP->bindParam(1, $upd_nameP);
					$updP->bindParam(2, $upd_marcaP);
					$updP->bindParam(3, $upd_cantidadP);
					$updP->bindParam(4, $upd_yearP);
					$updP->bindParam(5, $upd_placasCP);
					$updP->bindParam(6, $upd_poliCP);
					$updP->bindParam(7, $editIDP);
					$updP->execute();

					if (!$updP) {
						echo 
							'<script>
								alert("Error al actualizar los datos!");
								location.reload();
							</script>'
						;
					} else {
						echo 
							'<script>
								alert("Datos actualizados correctamente!");
								window.location.href = "proveedoresA.php";
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