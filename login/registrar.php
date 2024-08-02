<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/css/estilosregistro.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title> Registrarse </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body style="font-family: 'Noto Sans', sans-serif;">
    <main class="contenedor-form2">
      <section class="formulario2">
        <h2><a href="login.php" class="bi-arrow-left" title="Regresar"></a> Crea tu cuenta </h2>
        <form action="registro_user.php" method="POST">
          <label for="Name"> Nombre </label>
          <input type="text" placeholder="Nombre" required name="nombre" id="nombre">
          <label for="Lastname"> Apellido </label>
          <input type="text" placeholder="Apellido" required name="apellido" id="apellido">
          <label for="Usuario"> Usuario </label>
          <input type="text" placeholder="Usuario" required name="usuario" id="usuario">
          <label for="Pass"> Contraseña </label>
          <input type="password" placeholder="Contraseña" required name="contra" id="contra">
          <label for="Email"> Correo </label>
          <input type="text" placeholder="Correo" required name="correo" id="correo">
          <input type="hidden" placeholder="Rol de Usuario" name="tipousuario" id="tipousuario" value="Usuario">
          <input type="submit" value="Registrarse">
        </form>
      </section>
    </main>
  </body>
</html>