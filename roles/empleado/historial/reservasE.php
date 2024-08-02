<?php
    session_start();

    if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Empleado') {
    		header("location: ../../../login/login.php");
    	}
    }

    //Incluimos la conexión a la BD
    require_once('../../../DB/connectDB.php');

	// Ejecutamos la consulta
	$sql = $conn->prepare("SELECT * FROM alquiler");
	$sql->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> Empleados | Historial </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<?php require_once('../../../layouts/nav.php'); ?>
	<main>
		<section class="container-fluid">
			<h4 class="m-2"><a href="../index_empleados.php" class="bi-arrow-left text-dark" title="Regresar" role="button"></a> Historial de alquileres </h4>
		</section>

		<section class="container-fluid table-responsive mt-3">
			<table class="table table-bordered table-dark table-striped">
				<thead class="table-light">
					<tr>
						<th scope="col"> # </th>
						<th scope="col"> Marca </th>
						<th scope="col"> Nombre </th>
						<th scope="col"> Cantidad </th>
						<th scope="col"> Teléfono </th>
						<th scope="col"> Tipo carro </th>
						<th scope="col"> Residencia </th>
						<th scope="col"> Retiro </th>
						<th scope="col"> Devolución </th>
						<th scope="col"> Motorista </th>
						<th scope="col"> Entrega </th>
						<th scope="col"> Pagar </th>
						<th scope="col"> Estado </th>
						<th scope="col"> Opciones </th>
					</tr>
				</thead>
				<tbody>
					<?php
						//Iniciamos la condicion while que obtendra todos los datos de la BD
						while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
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
							$disAlq = $fila['Entrega'];
							$pagoAlq = $fila['Total_pago'];
							$stateAlq = $fila['Estado'];
					?>
					<tr>
						<!-- Mostramos los resultados obtenidos de la BD en la tabla -->
						<td scope="row"><?php echo $idAlq; ?></td>
						<td><?php echo $markAlq; ?></td>
						<td><?php echo $nameAlq.' '.$apeAlq; ?></td>
						<td><?php echo $cantcarAlq; ?></td>
						<td><?php echo $telAlq; ?></td>
						<td><?php echo $tcarAlq; ?></td>
						<td><?php echo $resAlq; ?></td>
						<td><?php echo $f_retiroAlq; ?></td>
						<td><?php echo $f_devAlq; ?></td>
						<td><?php echo $nameAlqMot; ?></td>
						<td><?php echo $disAlq; ?></td>
						<td><?php echo '$'.$pagoAlq; ?></td>
						<td><?php echo $stateAlq; ?></td>
						<td>
							<a class="bi-check2-square fs-2 text-info" title="Entregar" href="entregasE.php?estado=<?php echo(base64_encode($idAlq)); ?>"></a>
							<a class="bi-x-square-fill fs-2 text-warning" title="Cancelar" href="cancelE.php?estado=<?php echo(base64_encode($idAlq)); ?>"></a>
							<a class="bi-trash fs-2 text-danger" title="Eliminar" href="delRE.php?eliminar=<?php echo(base64_encode($idAlq)); ?>"></a>
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

<?php
	$conn = null;
?>
