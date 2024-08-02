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

	$res = $conn->query("SELECT * FROM proveedores");

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> Admin | Proveedores </title>
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
			<h4 class="m-2"><a href="../index_admin.php" class="bi-arrow-left text-dark" title="Regresar" role="button"></a> Proveedores </h4>
		</article>

		<section class="container-fluid table-responsive mt-1">
			<button type="button" class="btn btn-outline-dark m-1" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi-person-bounding-box"></i> Nuevo proveedor </button>
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
							<a class="bi-pencil-square fs-2 text-warning" title="Editar" href="editProvA.php?id=<?php echo(base64_encode($idProv)); ?>"></a>
							<a class="bi-trash fs-2 text-danger" title="Eliminar" href="delProvA.php?id=<?php echo(base64_encode($idProv)); ?>"></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>
		<?php require_once('../../../layouts/modal_proveedores.php'); ?>
	</main>
	<?php require_once('../../../layouts/footer.php'); ?>
</body>
</html>

<?php
	$conn = null;
?>