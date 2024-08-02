<?php
	$base_url = 'http://localhost/Alquiler/';
?>
<header>
	<nav class="navbar navbar-dark bg-dark navbar-expand-xl">
		<!-- Etiquetas de contenedor que contendran al nav de nuestra pag -->
		<div class="container-fluid">
			<!-- Boton que aparecera al visitar la pagina desde una pantalla diferente -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<!-- Icono del boton que aparecera al ser pantalla responsiva -->
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Contenedor de la barra de navegacion -->
			<div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<img src="https://img.icons8.com/color/48/000000/traffic-jam.png" alt="Logo" width="30">
					</li>
				</ul>

				<!-- Boton que se muestra al final de la barra de navegacion -->
				<span class="navbar-text">
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<!-- Boton que obtendra por medio de PHP el nombre de usuario -->
							<button type="button" class="btn btn-dark dropdown-toggle btn-md" data-bs-toggle="dropdown" data-bd-display="static" data-bs-display="static" aria-expanded="false" title="Menu">
								<i class="bi-person-circle"></i>
							</button>
							<!-- Menu que se obtendra al presionar sobre nuestro nombre de usuario -->
							<ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-white" aria-labelledby="navbarDarkDropdownMenuLink">
								<li class="text-center"><?php echo $_SESSION['usuario']; ?><hr class="dropdown-divider bg-white"></li>
								<li><a class="dropdown-item text-center" href=<?php echo $base_url;?>login/cerrar_sesion.php> Cerrar sesión </a></li>
							</ul>
						</li>
					</ul>
				</span>
			</div>
		</div>
	</nav>
</header>