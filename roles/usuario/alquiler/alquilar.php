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

	if (isset($_REQUEST['car']) && isset($_REQUEST['precio'])) {
		$carselect = base64_decode($_REQUEST['car']);
		$price = base64_decode($_REQUEST['precio']);

		//DATOS DE LOS CARROS DESDE LA BD
		$cons = $conn->prepare("SELECT Marca FROM proveedores WHERE Marca = ?");
		$cons->bindParam(1, $carselect);
		$cons->execute();

		$fila = $cons->fetch(PDO::FETCH_ASSOC);

		$marcaCar = $fila['Marca'];
	}

	$execMot = $conn->query("SELECT Nombre_mot FROM motoristas");

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
	<title> Usuario | Rentar </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<?php require_once('../../../layouts/nav.php'); ?>
	<main>
		<section class="container p-2 d-flex justify-content-start">
			<form action="insertAlquiler.php" method="POST" class="border rounded-3 shadow bg-light p-2">
				<h4 class="mb-3 mt-2 text-center"><a href="../index_user.php" class="bi-arrow-left fs-3 text-dark" title="Regresar"></a> Información personal </h4>
				<div class="row mb-3">
					<label for="SelectedCar" class="col-sm-5 col-form-label"> Carro seleccionado: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="carselect" required value="<?php echo $marcaCar; ?>" readonly>
					</div>
				</div>
				<div class="row mb-3">
					<label for="Precio" class="col-sm-5 col-form-label"> Precio $: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="price" name="precio" readonly value="<?php echo $price; ?>" />
					</div>
				</div>
				<div class="row mb-3">
					<label for="Nombre" class="col-sm-5 col-form-label"> Nombre: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nombre" required>
					</div>
				</div>
				<div class="row mb-3">
					<label for="Nombre" class="col-sm-5 col-form-label"> Apellido: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="apellido" required>
					</div>
				</div>
				<div class="row mb-3">
					<label for="CCarros" class="col-sm-5 col-form-label"> Cantidad de carros: </label>
					<div class="col-sm-3">
						<input type="number" min="1" max="20" class="form-control" name="ccarros" required id="cantcarros" onchange="Precio()">
					</div>
				</div>
				<div class="row mb-3">
					<label for="Celular" class="col-sm-5 col-form-label"> Teléfono: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="telefono" required>
					</div>
				</div>
				<div class="row mb-3">
					<label for="Categoria" class="col-sm-5 col-form-label"> Tipo de carro: </label>
					<div class="col-sm-5">
						<select name="tcar" class="form-select">
							<option value="Estándar"> Estándar </option>
							<option value="Automático"> Automático </option>
							<option value="Combinado"> Combinado </option>
						</select>
					</div>
				</div>
				<div class="row mb-3">
					<label for="Residencia" class="col-sm-5 col-form-label"> Residencia: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="direccion" required value="">
					</div>
				</div>
				<div class="row mb-3">
					<label for="FechaRetiro" class="col-sm-5 col-form-label"> Fecha y hora de retiro: </label>
					<div class="col-sm-6">
						<input type="datetime-local" class="form-control" name="fretiro" value="">
					</div>
				</div>
				<div class="row mb-3">
					<label for="FechaDevol" class="col-sm-5 col-form-label"> Fecha y hora de devolución: </label>
					<div class="col-sm-6">
						<input type="datetime-local" class="form-control" name="fdevolucion">
					</div>
				</div>
				<div class="row mb-3">
					<label for="Entrega" class="col-sm-5 col-form-label"> Entrega por: </label>
					<div class="col-sm-5">
						<select name="entregaAlq" class="form-select">
							<option value="Domicilio"> Domicilio </option>
							<option value="Empresa"> Empresa </option>
						</select>
					</div>
				</div>
				<div class="row mb-3">
					<label for="Motorista" class="col-sm-5 col-form-label"> Seleccione un motorista: </label>
					<div class="col-sm-6">
						<select name="motorista" class="form-select">
							<option value="Sin motorista"> Sin motorista </option>
								<?php
								while ($filaMot = $execMot->fetch(PDO::FETCH_ASSOC)){
									echo '<option value="'.$filaMot['Nombre_mot'].'">'.$filaMot['Nombre_mot'].'</option>';
									}
								?>
						</select>
					</div>
				</div>
				<!--<div class="row mb-3">
					<label for="CardCredit" class="col-sm-5 col-form-label"> Método de pago: </label>
					<div class="col-sm-7">
						<input class="form-check-input" type="radio" value="Agregar" name="tarjeta" data-bs-toggle="modal" data-bs-target="#exampleModal">
						<img src="https://assets.static-bahn.de/dam/jcr:76ef9714-ce76-4edf-8475-3c79840de0f8/241960-321268.jpg" alt="marcas" height="50" width="200">
						<br>
						<input type="radio" class="form-check-input" name="tarjeta">
						<img src="https://rehileteproyectos.com/wp-content/uploads/2017/09/paypal.png" alt="paypal" height="50" width="200">
					</div>
				</div>-->
				<div class="row mb-3">
					<label for="TotalPago" class="col-sm-5 col-form-label"> Cantidad a pagar: </label>
					<div class="col-sm-6">
						<h4 id="Tpago"> $0.00 </h4>
					</div>
				</div>
				<input type="hidden" name="state" value="Pendiente">
				<div class="d-flex justify-content-center">
					<button type="submit" class="btn btn-outline-primary" value="Reservar" role="button" name="reservar"><i class="bi-clipboard-check"></i> Reservar </button>
				</div>
			</form>
		</section>

		<!-- Modal
		<section class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"> Datos de la tarjeta </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<article class="modal-body">
						<form action="#" method="POST" autocomplete="off">
							<div class="row mb-3">
								<label for="NumCard" class="col-sm-5 col-form-label"> Numero de tarjeta: </label>
								<div class="input-group col">
									<span class="input-group-text"><i class="bi-credit-card"></i></span>
									<input type="text" class="form-control" name="num_card" required minlength="0" maxlength="16">
								</div>
							</div>
							<div class="row mb-3">
								<label for="NombreTarjeta" class="col-sm-5 col-form-label"> Nombre del titular: </label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="titular" value="" required>
								</div>
							</div>
							<div class="row mb-3">
								<label for="Expires" class="col-sm-5 col-form-label"> Fecha de vencimiento: </label>
								<div class="col-sm-6">
									<input type="month" class="form-control" name="fvenc" value="">
								</div>
							</div>
							<div class="row mb-3">
								<label for="Expires" class="col-sm-5 col-form-label"> Código de seguridad: </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="codseg">
								</div>
							</div>
							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-outline-primary" value="$ Pagar" role="button">
							</div>
						</form>
					</article>
				</div>
			</div>
		</section> -->
	</main>

	<style>
		main {
			background-image: url('../../../assets/img/Car-Portada.png');
			background-position: center;
			background-size: cover;
			background-attachment: fixed;
			background-repeat: no-repeat;
		}
	</style>
	<script src="../../../assets/js/calculo_pago.js"></script>
	<?php require_once('../../../layouts/footer.php'); ?>
</body>
</html>

<?php $conn = null; ?>
