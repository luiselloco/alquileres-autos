<?php
  //Iniciamos la sesion segun el perfil del usuario
  session_start();

  //Valida el usuario y su rol que tiene de ser diferente redirecciona a la pagina segun su rol
  if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    header('location: ../../login/login.php');
  } else {
    if ($_SESSION['tipousuario'] != 'Administrador') {
      header("location: ../../login/login.php");
    }
  }
?>

<!-- Plantilla base de Bootstrap -->
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <!-- Enlace a los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la libreria de iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
    <title> Inicio | Admin </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body style="font-family: 'Noto Sans', sans-serif;">
    <!-- Llamamos el archivo de navegacion de nuestra pagina -->
    <?php require_once('../../layouts/nav.php'); ?>
    <!-- Creamos el contenido principal de la pagina -->
    <main>
      <section class="py-5">
        <div class="container">
          <div class="row row-cols-sm-4 g-4">
            <div class="col">
              <div class="card border-dark bg-transparent border-3">
                <a class="btn btn-outline-light fs-4 fw-bold text-dark" href="historial/reservasA.php">
                  <i class="bi-book" style="font-size: 8rem;">
                    <br>
                  </i>
                  Reservas
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card bg-transparent border-dark border-3">
                <a class="btn btn-outline-light fs-4 fw-bold text-dark" href="gUser.php">
                  <i class="bi-person" style="font-size: 8rem;">
                    <br>
                  </i>
                  Usuarios
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card border-3 bg-transparent border-dark">
                <a class="btn btn-outline-light fs-4 fw-bold text-dark" href="proveedores/proveedoresA.php">
                  <i class="bi-person-lines-fill" style="font-size: 8rem;">
                    <br>
                  </i>
                  Proveedores
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card border-3 bg-transparent border-dark">
                <a class="btn btn-outline-light fs-4 fw-bold text-dark" href="motoristas/motoristasA.php">
                  <i class="bi-file-earmark-person" style="font-size: 8rem;">
                    <br>
                  </i>
                  Motoristas
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php require_once('../../layouts/footer.php'); ?>
  </body>
</html>