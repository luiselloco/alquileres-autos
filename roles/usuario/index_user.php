<?php
  //Iniciamos la sesion segun el perfil del usuario
  session_start();

  //Valida el usuario y su rol que tiene de ser diferente redirecciona a la pagina segun su rol
  if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
  	header('location: ../../login/login.php');
  } else {
  	if ($_SESSION['tipousuario'] != 'Usuario') {
      header("location: ../../login/login.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
	<title> Inicio | Usuarios </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<header>
		<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<img src="https://img.icons8.com/color/48/000000/traffic-jam.png" alt="Logo" width="30">
					</ul>
					<span class="navbar-text">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<button type="button" class="btn btn-dark dropdown-toggle btn-md" data-bs-toggle="dropdown" data-bd-display="static" data-bs-display="static" aria-expanded="false"><i class="bi bi-person-circle"></i>
								</button>
								<ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-white" aria-labelledby="navbarDarkDropdownMenuLink">
									<li class="text-center"><?php echo $_SESSION['usuario']; ?><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item text-center" href="reservas/reservasU.php"> Mis reservas </a></li>
									<li><a class="dropdown-item text-center" href="../../login/cerrar_sesion.php"> Cerrar sesión </a></li>
								</ul>
							</li>
						</ul>
					</span>
				</div>
			</div>
		</nav>
	</header>

	<main>
		<section>
			<img src="../../assets/img/Background-home.png" class="img-fluid" alt="Portada">
		</section>

		<article class="text-center">
			<span> Stock de vehiculos </span>
			<h2> Tenemos todo tipo de vehiculos </h2>
		</article>

		<section class="py-5 container">
			<article class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
				<div class="col">
					<div class="card shadow-sm">
						<img src="../../assets/img/Nissan-sentra.jpg" alt="IMG_1" class="img-fluid">
						<div class="card-body">
							<h3 class="fw-bold"> Nissan Sentra </h3>
               <span class="fw-bold fs-5 text-danger"> $50.00 </span>
               <p class="card-text bi-star"> (6 Reviews). </p>
               <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Nissan Sentra')); ?>&precio=<?php echo(base64_encode('50.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
               <a class="btn btn-outline-danger" href="../../catalogo/sentra.html" title="Detalles"> Ver detalles </a>
						</div>
					</div>
				</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="../../assets/img/corolla1.png" alt="IMG_2" class="img-fluid">
							<br>
							<div class="card-body">
								<h3 class="fw-bold"> Toyota Corolla </h3>
                <span class="fw-bold fs-5 text-danger"> $56.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Toyota Corolla')); ?>&precio=<?php echo(base64_encode('56.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
                <a title="Detalles" class="btn btn-outline-danger" href="../../catalogo/toyota.html"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="../../assets/img/kia-soul.jpg" alt="IMG_3" class="img-fluid">
							<div class="card-body">
								<h3 class="fw-bold"> Kia Soul </h3>
                <span class="fw-bold fs-5 text-danger"> $60.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Kia Soul')); ?>&precio=<?php echo(base64_encode('60.00')) ?>" class="btn btn-outline-danger"> Rentar </a>
                <a title="Detalles" class="btn btn-outline-danger" href="../../catalogo/kia.html"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="../../assets/img/hyundai-accent.jpg" alt="IMG_4" class="img-fluid">
							<div class="card-body">
								<h3 class="fw-bold"> Hyundai Accent </h3>
                <span class="fw-bold fs-5 text-danger"> $75.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Hyundai Accent')); ?>&precio=<?php echo(base64_encode('75.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
                <a title="Detalles" class="btn btn-outline-danger" href="../../catalogo/hyundai.html"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="../../assets/img/toyota.png" alt="IMG_5" class="img-fluid">
							<br>
							<div class="card-body">
								<h3 class="fw-bold"> Toyota Hilux 4X4 </h3>
                <span class="fw-bold fs-5 text-danger"> $100.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Toyota Hilux 4x4')); ?>&precio=<?php echo(base64_encode('100.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
                <a title="Detalles" class="btn btn-outline-danger" href="../../catalogo/hilux.html"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="../../assets/img/toyota-prado.jpg" alt="IMG_6" class="img-fluid">
							<div class="card-body">
								<h3 class="fw-bold"> Toyota Prado </h3>
                <span class="fw-bold fs-5 text-danger"> $175.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Toyota Prado')); ?>&precio=<?php echo(base64_encode('175.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
                <a title="Detalles" class="btn btn-outline-danger" href="../../catalogo/prado.html"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="../../assets/img/BMW.jpg" alt="IMG_7" class="img-fluid">
							<br>
							<div class="card-body">
								<h3 class="fw-bold"> BMW Series 3 </h3>
                <span class="fw-bold fs-5 text-danger"> $250.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('BMW Series 3')); ?>&precio=<?php echo(base64_encode('250.00')) ?>" class="btn btn-outline-danger"> Rentar </a>
                <a title="Detalles" class="btn btn-outline-danger" href="../../catalogo/bmw.html"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="https://crdms.images.consumerreports.org/c_lfill,w_470,q_auto,f_auto/prod/cars/cr/car-versions/12566-2019-mini-cooper-s" alt="IMG_8" class="img-fluid">
							<div class="card-body">
								<h3 class="fw-bold"> Mini Cooper </h3>
                <span class="fw-bold fs-5 text-danger"> $260.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Mini Cooper')); ?>&precio=<?php echo(base64_encode('260.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
                <a title="Detalles" class="btn btn-outline-danger" href="../../catalogo/cooper.html"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="https://buscouncoche.es/wp-content/uploads/2019/05/jeep-renegade-change-the-way-frontal.png" alt="IMG_9" class="img-fluid">
							<div class="card-body">
								<h3 class="fw-bold"> Jeep Renegade </h3>
                <span class="fw-bold fs-5 text-danger"> $300.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Jeep Renegade')); ?>&precio=<?php echo(base64_encode('300.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
                <a title="Detalles" class="btn btn-outline-danger" href="../../catalogo/jeep.html"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="https://www.autoasesor.com/mitsubishi/Imagenes/lancer.png" alt="IMG_10" class="img-fluid">
							<div class="card-body">
								<h3 class="fw-bold"> Mitsubishi Lancer </h3>
                <span class="fw-bold fs-5 text-danger"> $550.00 </span>
                <p class="card-text bi-star"> (6 Reviews). </p>
                <a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Mitsubishi Lancer')); ?>&precio=<?php echo(base64_encode('550.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
                <a class="btn btn-outline-danger" href="../../catalogo/lancer.html" title="Detalles"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="https://www.chevrolet.com.pa/content/dam/chevrolet/na/mx/es/index/cars/2019-spark/colorizer/01-images/2019-spark-plata-brillante-imwidth=1200.png" alt="IMG_11" class="img-fluid">
							<br>
							<div class="card-body">
								<h3 class="fw-bold"> Chevrolet Spark GT </h3>
								<span class="fw-bold fs-5 text-danger"> $160.00 </span>
								<p class="card-text bi-star"> (6 Reviews). </p>
								<a title="Rentar" href="alquiler/alquilar.php?car=<?php echo(base64_encode('Chevrolet Spark GT')); ?>&precio=<?php echo(base64_encode('160.00')); ?>" class="btn btn-outline-danger"> Rentar </a>
								<a class="btn btn-outline-danger" href="../../catalogo/spark.html" title="Detalles"> Ver detalles </a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow-sm">
							<img src="../../assets/img/proximamente.jpg" alt="IMG_12" class="img-fluid">
							<div class="card-body">
								<h3> - </h3>
                <span> - </span>
                <p class="card-text bi-star"> Nuevos carros proximamente. </p>
							</div>
						</div>
					</div>
				</div>
			</article>
		</section>
	</main>
	<?php require_once('../../layouts/footer.php'); ?>
</body>
</html>