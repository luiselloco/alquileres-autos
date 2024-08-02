<?php
	//Continuamos con la sesion
	session_start();

	$nameUs = $_SESSION['nombre'];

	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
		header('location: ../../../login/login.php');
	} else {
		if ($_SESSION['tipousuario'] != 'Usuario') {
			header("location: ../../../login/login.php");
		}
	}

	require_once('../../../DB/connectDB.php');

	// Creamos una consulta a la BD
	$sql = "SELECT
				alquiler.ID,
				alquiler.Marca,
				alquiler.Nombre,
                alquiler.Apellido,
				alquiler.CantCar,
				alquiler.Tel,
				alquiler.TipoCar,
				alquiler.Residencia,
				alquiler.Fecha_ret,
				alquiler.Fecha_dev,
				alquiler.Name_mot,
				alquiler.Total_pago,
				alquiler.Estado
			FROM alquiler
			JOIN usuarios 
			ON alquiler.Nombre = usuarios.Nombre
			WHERE alquiler.Nombre = ?";
	$query = $conn->prepare($sql);
	$query->bindParam(1, $nameUs, PDO::PARAM_STR);
	$query->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
	<title> Usuario | Reservas </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<?php require_once('../../../layouts/nav.php'); ?>
	<main>
		<article class="container-fluid">
			<h4 class="m-2"><a href="../index_user.php" class="bi-arrow-left text-dark" title="Regresar" role="button"></a> Reservas </h4>
		</article>

		<section class="container-fluid table-responsive mt-3">
			<table class="table table-bordered table-dark table-striped">
				<thead class="table-light">
					<tr>
						<th scope="col"> # </th>
						<th scope="col"> Marca </th>
						<th scope="col"> Nombre </th>
						<th scope="col"> Apellido </th>
						<th scope="col"> Cantidad </th>
						<th scope="col"> Teléfono </th>
						<th scope="col"> Carro </th>
						<th scope="col"> Residencia </th>
						<th scope="col"> Retiro </th>
						<th scope="col"> Devolución </th>
						<th scope="col"> Motorista </th>
						<th scope="col"> Pago </th>
						<th scope="col"> Estado </th>
						<th scope="col"> Opciones </th>
					</tr>
				</thead>
				<tbody>
					<?php
						while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
							$idAlq = $fila['ID'];
							$markAlq = $fila['Marca'];
							$nameAlq = $fila['Nombre'];
							$apeAlq = $fila['Apellido'];
							$cantcarAlq = $fila['CantCar'];
							$telAlq = $fila['Tel'];
							$tcarAlq = $fila['TipoCar'];
							$resAlq = $fila['Residencia'];
							$f_retiroAlq = $fila['Fecha_ret'];
							$f_devAlq = $fila['Fecha_dev'];
							$nameAlqMot = $fila['Name_mot'];
							$pagoAlq = $fila['Total_pago'];
							$stateAlq = $fila['Estado'];
					?>
				<tr>
					<td scope="row"><?php echo $idAlq; ?></td>
					<td><?php echo $markAlq; ?></td>
					<td><?php echo $nameAlq; ?></td>
					<td><?php echo $apeAlq; ?></td>
					<td><?php echo $cantcarAlq; ?></td>
					<td><?php echo $telAlq; ?></td>
					<td><?php echo $tcarAlq; ?></td>
					<td><?php echo $resAlq; ?></td>
					<td><?php echo $f_retiroAlq; ?></td>
					<td><?php echo $f_devAlq; ?></td>
					<td><?php echo $nameAlqMot; ?></td>
					<td><?php echo '$'.$pagoAlq; ?></td>
					<td><?php echo $stateAlq; ?></td>
					<td>
						<a href="cancelar.php?estado=<?php echo(base64_encode($idAlq)); ?>" class="bi-x-square-fill fs-3 text-warning" title="Cancelar"></a>
						<a href="ticket.php?ticket=<?php echo(base64_encode($idAlq)); ?>" class="bi-file-pdf fs-3 text-danger" title="Generar Ticket"></a>
					</td>
				</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>
	</main>
	<?php require_once('../../../layouts/footer.php'); ?>
</body>
</html>
