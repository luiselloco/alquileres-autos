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

	// Traemos los datos desde la BD
	$sql = $conn->prepare("SELECT * FROM motoristas");
	$sql->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Admin | Motoristas </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<?php require_once('../../../layouts/nav.php'); ?>
	<main>
		<article class="container-fluid">
			<h4 class="m-2"><a href="../index_admin.php" class="bi-arrow-left text-dark" title="Regresar" role="button"></a> Motoristas </h4>
		</article>

		<section class="container-fluid table-responsive mt-2">
			<button type="button" class="btn btn-outline-dark mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi-file-earmark-person"></i> Nuevo motorista </button>
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
						while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
							$idMot = $fila['ID_MOT'];
							$nameMot = $fila['Nombre_mot'];
							$edadMot = $fila['Edad'];
							$telMot = $fila['Telefono'];
							$hourMot = $fila['Horario'];
					?>
					<tr>
						<td scope="row"><?php echo $idMot; ?></td>
						<td><?php echo $nameMot; ?></td>
						<td><?php echo $edadMot.' años'; ?></td>
						<td><?php echo $telMot; ?></td>
						<td><?php echo $hourMot; ?></td>
						<td>
							<a class="bi-pencil-square fs-2 text-warning" title="Editar" href="editMotA.php?id=<?php echo(base64_encode($idMot)); ?>"></a>
							<a class="bi-person-x fs-2 text-danger" title="Eliminar" href="delMotA.php?id=<?php echo(base64_encode($idMot)); ?>"></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>
		<?php
			require_once('../../../layouts/modal_motorista.php');
		?>
	</main>
	<?php require_once('../../../layouts/footer.php'); ?>
</body>
</html>

<?php
	$conn = null;
?>