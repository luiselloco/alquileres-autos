<?php
    session_start();

    if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Empleado') {
    		header("location: ../../login/login.php");
    	}
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> Inicio | Empleados </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la libreria de iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<?php require_once('../../layouts/nav.php'); ?>

	<!-- Creamos el contenido principal de la pagina -->
	<main>
		<section class="py-5 container">
			<div class="row row-cols-sm-3 g-3">
				<div class="col">
					<div class="card border-dark border-3 bg-transparent">
						<a class="btn btn-outline-light fs-4 text-dark" href="historial/reservasE.php">
							<i class="bi-book" style="font-size: 8rem;">
								<br>
							</i>
							Reservas
						</a>
					</div>
				</div>
				<div class="col">
					<div class="card border-dark border-3 bg-transparent">
						<a class="btn btn-outline-light fs-4 text-dark" href="proveedores/proveedoresE.php">
							<i class="bi-person-lines-fill" style="font-size: 8rem;">
								<br>
							</i>
							Proveedores
						</a>
					</div>
				</div>
				<div class="col">
					<div class="card border-dark border-3 bg-transparent">
						<a class="btn btn-outline-light fs-4 text-dark" href="motoristas/motoristasE.php">
							<i class="bi-file-earmark-person" style="font-size: 8rem;">
								<br>
							</i>
							Motoristas
						</a>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php require_once('../../layouts/footer.php'); ?>
</body>
</html>