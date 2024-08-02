<?php
	//Continuamos con la sesion
	session_start();

	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
		header('location: ../../../login/login.php');
	} else {
		if ($_SESSION['tipousuario'] != 'Administrador') {
			header("location: ../../../login/login.php");
		}
	}

	require_once('../../../DB/connectDB.php');

	$query = $conn->query("SELECT * FROM alquiler");

	ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<main>
		<section>
			<table>
				<caption> Reporte de ingresos </caption>
				<tr>
					<th> ID </th>
					<th> Marca </th>
					<th> Nombre </th>
					<th> Cantidad </th>
					<th> Teléfono </th>
					<th> Carro </th>
					<th> Dirección </th>
					<th> Retiro </th>
					<th> Devolución </th>
					<th> Motorista </th>
					<th> Entrega </th>
					<th> Pago </th>
					<th> Estado </th>
				</tr>
				<tbody>
					<?php
						while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
							$IDAlq = $fila['ID'];
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
						<td><?php echo $IDAlq; ?></td>
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
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>
	</main>
	<style>
		* {
			box-sizing: content-box;
		}

		table, tr, td, th {
			border-collapse: collapse;
			border: 1px solid black;
		}
	</style>
</body>
</html>

<?php	
	$html = ob_get_clean();
	//echo $html;

	require_once '../../../libreria/dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	//use Dompdf\Options;
	$dompdf = new Dompdf();

	$options = $dompdf->getOptions();
	$options->set(array('isRemoteEnabled' => true));
	$dompdf->setOptions($options);

	//Prueba de DOMPDF
	$dompdf->loadHtml($html);

	$dompdf->setPaper('letter', 'landscape');
	$dompdf->render();
	$dompdf->stream("reportes.pdf", array("Attachment" => false));

	$conn = null;
?>
