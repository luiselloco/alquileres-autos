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

	// Traemos los datos desde la BD
	$exec = $conn->query("SELECT * FROM motoristas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Lista de motoristas </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<?php require_once('../../../layouts/nav.php'); ?>

	<main>
		<article class="container-fluid">
			<h4 class="m-2"><a href="../index_empleados.php" class="bi-arrow-left text-dark" title="Regresar" role="button"></a> Motoristas </h4>
		</article>

		<section class="container-fluid table-responsive mt-3">
			<button type="button" class="btn btn-outline-dark m-1" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi-file-earmark-person"></i> Nuevo motorista </button>
			<table class="table table-bordered table-dark table-striped">
				<thead class="table-light">
					<tr>
						<th scope="col"> # </th>
						<th scope="col"> Motorista </th>
						<th scope="col"> Edad </th>
						<th scope="col"> Teléfono </th>
						<th scope="col"> Horario </th>
						<th scope="col"> Opciones </th>
					</tr>
				</thead>
				<tbody>
					<?php
						while ($fila = $exec->fetch(PDO::FETCH_ASSOC)) {
							$idMot = $fila['ID_MOT'];
							$nameMot = $fila['Nombre_mot'];
							$edadMot = $fila['Edad'];
							$telMot = $fila['Telefono'];
							$hourMot = $fila['Horario'];
					?>
					<tr>
						<!-- Mostramos los resultados obtenidos de la BD en la tabla -->
						<td scope="row"><?php echo $idMot; ?></td>
						<td><?php echo $nameMot; ?></td>
						<td><?php echo $edadMot.' años'; ?></td>
						<td><?php echo $telMot; ?></td>
						<td><?php echo $hourMot; ?></td>
						<td>
							<a class="bi-pencil-square fs-2 text-warning" title="Editar" href="editMotE.php?id=<?php echo(base64_encode($idMot)); ?>"></a>
							<a class="bi-person-x fs-2 text-danger" title="Eliminar" href="delMotE.php?id=<?php echo(base64_encode($idMot)); ?>"></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>

		<!-- Modal -->
		<section class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"> Nuevo motorista </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<article class="modal-body">
						<form autocomplete="off" method="POST" action="crMotE.php">
							<div class="row mb-2">
								<label for="nameMot" class="col-sm-5 col-form-label"> Ingrese el nombre: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="nameMot" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="EdadMot" class="col-sm-5 col-form-label"> Ingrese la edad: </label>
								<div class="col-sm-6">
									<input type="number" min="0" max="100" class="form-control" name="edadMot" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="TelMot" class="col-sm-5 col-form-label"> Ingrese el teléfono: </label>
								<div class="col-sm-6">
									<input type="number" class="form-control" name="telMot" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="HourMot" class="col-sm-5 col-form-label"> Ingrese el horario: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="hourMot" required>
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