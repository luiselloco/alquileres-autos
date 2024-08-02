<?php //PAGINA PARA VER LOS REGISTROS DE LOS EMPLEADOS ?>

<?php
    session_start();

    // Conexion a la base de datos
	$conn = mysqli_connect("localhost", "root", "", "alquiler") or die('Error al conectar a la BD');

	// Preparamos una sentencia a la BD
	$cons = "SELECT * FROM alquiler";

	// Ejecutamos la consulta
	$res = mysqli_query($conn, $cons);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> Historial de alquiler </title>
    <!-- Enlace a libreria de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la libreria de iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<!-- Etiquetas de contenedor que contendran al nav de nuestra pag -->
			<div class="container-fluid">
				<!-- Boton que aparecera al visitar la pagina desde una dimension de pantalla diferente -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<!-- Icono del boton que aparecera al ser pantalla responsiva -->
					<span class="navbar-toggler-icon"></span>
				</button>
				<!-- Contenedor que obtendra la barra de navegacion -->
				<div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<img src="https://img.icons8.com/color/48/000000/traffic-jam.png" alt="Logo" width="30">
					</ul>
					<!-- Boton que se muestra al final de la barra de navegacion -->
					<span class="navbar-text">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<!-- Boton que obtendra por medio de PHP el nombre de usuario y un menu -->
								<button type="button" class="btn btn-dark dropdown-toggle btn-sm" data-bs-toggle="dropdown" data-bd-display="static" data-bs-display="static" aria-expanded="false"><i class="bi bi-person-circle"></i>
								</button>
								<!-- Menu que se obtendra al presionar sobre nuestro nombre de usuario -->
								<ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
									<li class="text-center"><?php echo $_SESSION['usuario']; ?><hr class="dropdown-divider"></li>
									<!-- Enlace que redirecciona al archivo cerrar sesion.php -->
									<li>
										<a class="dropdown-item text-center" href="../../../login/cerrar_sesion.php"> Cerrar sesión </a>
									</li>
								</ul>
							</li>
						</ul>
					</span>
				</div>
			</div>
		</nav>
	</header>

	<main>
		<section class="container-fluid">
			<a href="../index_empleados.php" class="btn btn-outline-dark m-1 mb-2" role="button"><i class="bi-chevron-compact-left"></i></a>
			<div class="d-flex" aria-label="Encabezado con buscador">
				<h4 class="mb-0"> Historial de alquileres </h4>
				<form class="d-flex ms-auto">
					<label for="search" class="col-form-label me-2"> Buscar: </label>
					<input class="form-control form-control-sm search" id="buscar" type="search" aria-label="Search">
				</form>
			</div>
		</section>

		<!---->
		<section class="container-fluid table-responsive mt-3">
			<table class="table table-bordered table-hover table-striped">
				<thead class="table-light">
					<tr>
						<th scope="col"> # </th>
						<th scope="col"> Marca </th>
						<th scope="col"> Nombre </th>
						<th scope="col"> Cantidad </th>
						<th scope="col"> Telefono </th>
						<th scope="col"> Tipo carro </th>
						<th scope="col"> Residencia </th>
						<th scope="col"> Retiro </th>
						<th scope="col"> Devolución </th>
						<th scope="col"> N° tarjeta </th>
						<th scope="col"> Titular </th>
						<th scope="col"> Fecha de vencimiento </th>
						<th scope="col"> Código de seguridad </th>
						<th scope="col"> Opciones </th>
					</tr>
				</thead>
				<tbody>
					<?php
						//Iniciamos un contador para ver el total de datos
						$i = 0;
						//Iniciamos la condicion while que obtendra todos los datos de la BD
						while ($fila = mysqli_fetch_assoc($res)) {
							$idAlq = $fila['ID'];
							$mark = $fila['Marca'];
							$name = $fila['Fullname'];
							$cantcar = $fila['CantCar'];
							$tel = $fila['Tel'];
							$rolcar = $fila['TipoCar'];
							$resid = $fila['Residencia'];
							$fecha_ret = $fila['Fecha_ret'];
							$fecha_devo = $fila['Fecha_dev'];
							$num_card = $fila['Num_tar'];
							$tit_card = $fila['Titular'];
							$fecha_ven = $fila['Fecha_ven'];
							$code_seg = $fila['Cod_seg'];

							//Sumamos todo los datos obtenidos
							$i++;
					?>
					<tr>
						<!-- Mostramos los resultados obtenidos de la BD en la tabla -->
						<th scope="row"><?php echo $idAlq; ?></th>
						<td><?php echo $mark; ?></td>
						<td><?php echo $name; ?></td>
						<td><?php echo $cantcar; ?></td>
						<td><?php echo $tel; ?></td>
						<td><?php echo $rolcar; ?></td>
						<td><?php echo $resid; ?></td>
						<td><?php echo $fecha_ret; ?></td>
						<td><?php echo $fecha_devo; ?></td>
						<td><?php echo $num_card; ?></td>
						<td><?php echo $tit_card; ?></td>
						<td><?php echo $fecha_ven; ?></td>
						<td><?php echo $code_seg; ?></td>
						<td>
							<a href="#"><i class="bi-person-x" style="font-size: 1.5rem;"></i></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>
	</main>

	<!-- Enlace a las librerias de JavaScript de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<?php
	mysqli_close($conn);
?>