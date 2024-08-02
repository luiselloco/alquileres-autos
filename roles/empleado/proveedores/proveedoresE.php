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

	$res = $conn->query("SELECT * FROM proveedores");
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> Empleado | Proveedores </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la libreria de iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<?php require_once('../../../layouts/nav.php'); ?>

	<main>
		<article class="container-fluid">
			<h4 class="m-2"><a href="../index_empleados.php" class="bi-arrow-left text-dark" title="Regresar" role="button"></a> Proveedores </h4>
		</article>

		<section class="container-fluid table-responsive mt-3">
			<button type="button" class="btn btn-outline-dark mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi-person-bounding-box"></i> Nuevo proveedor </button>
			<table class="table table-bordered table-dark table-striped">
				<thead class="table-light">
					<tr>
						<th scope="col"> # </th>
						<th scope="col"> Proveedor </th>
						<th scope="col"> Marca </th>
						<th scope="col"> Cantidad </th>
						<th scope="col"> Año </th>
						<th scope="col"> Placas </th>
						<th scope="col"> Poliza </th>
						<th scope="col"> Opciones </th>
					</tr>
				</thead>
				<tbody>
					<?php
						while ($fila = $res->fetch(PDO::FETCH_ASSOC)) {
							$idProv = $fila['ID'];
							$prov = $fila['Proveedor'];
							$mark = $fila['Marca'];
							$cant = $fila['CantCar'];
							$year = $fila['Año'];
							$placas = $fila['Placas'];
							$poli = $fila['Poliza'];
					?>
					<tr>
						<!-- Mostramos los resultados obtenidos de la BD en la tabla -->
						<th scope="row"><?php echo $idProv; ?></th>
						<td><?php echo $prov; ?></td>
						<td><?php echo $mark; ?></td>
						<td><?php echo $cant; ?></td>
						<td><?php echo $year; ?></td>
						<td><?php echo $placas; ?></td>
						<td><?php echo $poli; ?></td>
						<td>
							<a class="bi-pencil-square fs-2 text-warning" title="Editar" href="editProvE.php?id=<?php echo(base64_encode($idProv)); ?>"></a>
							<a class="bi-trash fs-2 text-danger" title="Eliminar" href="delProvE.php?id=<?php echo(base64_encode($idProv));?>"></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>

		<section class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"> Nuevo proveedor </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<article class="modal-body">
						<form autocomplete="off" method="POST" action="cprovE.php">
							<div class="row mb-2">
								<label for="nameProv" class="col-sm-5 col-form-label"> Ingrese el proveedor: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="nameProv" id="nameProv" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="markProv" class="col-sm-5 col-form-label"> Ingrese la marca: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="markProv" id="markProv" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="cantCProv" class="col-sm-5 col-form-label"> Ingrese la cantidad: </label>
								<div class="col-sm-6">
									<input type="number" id="cantCProv" class="form-control" name="cantCProv" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="yearprov" class="col-sm-5 col-form-label"> Ingrese el año: </label>
								<div class="col-sm-6">
									<input type="number" class="form-control" name="yearCProv" id="yearprov" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="placasCProv" class="col-sm-5 col-form-label"> Ingrese las placas: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="placasCProv" id="placasCProv" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="polizaCProv" class="col-sm-5 col-form-label"> Ingrese la aseguradora: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="polizaCProv" required id="polizaCProv">
								</div>
							</div>
							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-outline-primary" value="Registrarse" role="button">
							</div>
						</form>
					</article>
				</div>
			</div>
		</section>
	</main>
	<?php require_once('../../../layouts/footer.php'); ?>
</body>
</html>

<?php
	$conn = null;
?>