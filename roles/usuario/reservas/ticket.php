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

	if (isset($_REQUEST['ticket'])) {
		$ticket = base64_decode($_REQUEST['ticket']);

		//Ejecutamos la conexion y la consulta
		$res = $conn->prepare("SELECT * FROM alquiler WHERE ID = ?");
		$res->bindParam(1, $ticket);
		$res->execute();
	}

	date_default_timezone_set('America/El_Salvador');
	$date = date('d/m/y H:i:s');

	ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<main>
		<section>
			<h4 align="center"> alquilersv@es.com </h4>
			<hr>
			<p align="center"> Ticket N°<?php echo $ticket ?> </p>
			<p align="center"> Fecha: <?php echo $date; ?>  </p>
			<table>
				<caption> Descripción </caption>
				<tbody>
					<?php
						while ($fila = $res->fetch(PDO::FETCH_ASSOC)) {
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
					<td> Marca: </td>
					<td><b><?php echo $markAlq; ?></b></td>
				</tr>
				<tr>
					<td> Nombre: </td>
					<td><b><?php echo $nameAlq.' '.$apeAlq; ?></b></td>
				</tr>
				<tr>
					<td> Cantidad de carros: </td>
					<td><b><?php echo $cantcarAlq; ?></b></td>
				</tr>
				<tr>
					<td> Teléfono: </td>
					<td><b><?php echo $telAlq; ?></b></td>
				</tr>
				<tr>
					<td> Tipo de carro: </td>
					<td><b><?php echo $tcarAlq; ?></b></td>
				</tr>
				<tr>
					<td> Residencia: </td>
					<td><b><?php echo $resAlq; ?></b></td>
				</tr>
				<tr>
					<td> Fecha de retiro: </td>
					<td><b><?php echo $f_retiroAlq; ?></b></td>
				</tr>
				<tr>
					<td> Fecha de devolución: </td>
					<td><b><?php echo $f_devAlq; ?></b></td>
				</tr>
				<tr>
					<td> Nombre del motorista: </td>
					<td><b><?php echo $nameAlqMot; ?></b></td>
				</tr>
				<tr>
					<td> Tipo de entrega: </td>
					<td><b><?php echo $disAlq; ?></b></td>
				</tr>
				<tr>
					<p>
						<td> Total a pagar: </td>
						<td><b><?php echo '$'.$pagoAlq; ?></b></td>
					</p>
				</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>
	</main>
	<style>
		* {
			box-sizing: border-box;
		}

		.img {
			text-align: center;
			display: block;
		}

		main {
			padding: 20px 150px 150px 180px;
		}

		section {
			border: 1px dashed black;
		}

		caption {
			border-bottom: 2px solid black;
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

	$dompdf->setPaper('letter', 'portrait');
	$dompdf->render();
	$dompdf->stream("reportes.pdf", array("Attachment" => false));

	$conn = null;
?>
