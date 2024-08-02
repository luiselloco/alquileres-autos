<?php
	session_start();

	if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Administrador') {
    		header("location: ../../login/login.php");
    	}
    }
	//Conexion a la base de datos
	require_once('../../DB/connectDB.php');

	if (isset($_REQUEST['id'])) {
		$editarUID = base64_decode($_REQUEST['id']);
		$sql = $conn->prepare("SELECT * FROM usuarios WHERE ID = ?");
		$sql->bindParam(1, $editarUID);
		$sql->execute();

		$fila = $sql->fetch(PDO::FETCH_ASSOC);

		$editarUID = $fila['ID'];
		$name = $fila['Nombre'];
		$ape = $fila['Apellido'];
		$user = $fila['Usuario'];
		$email = $fila['Correo'];
		$rol = $fila['Tipousuario'];

	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Admin | Editar usuario </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body class="bg-secondary" style="font-family: 'Noto Sans', sans-serif;">
	<main class="p-0 m-5 d-flex justify-content-center">
		<section>
			<form method="POST" class="rounded-3 shadow bg-white" action="">
				<h3 class="mb-3 border-bottom border-1 text-center"><a href="gUser.php" class="bi-arrow-left fs-2 text-dark" title="Regresar"></a> Editar usuarios </h3>
				<div class="row mb-3">
					<label for="nombre" class="col-sm-5 ms-1 col-form-label"> Editar nombre: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nombre" id="nombre" required value="<?php echo $name; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="apellido" class="col-sm-5 ms-1 col-form-label"> Editar apellido: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="apellido" id="apellido" required value="<?php echo $ape; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="usuario" class="col-sm-5 ms-1 col-form-label"> Editar usuario: </label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="usuario" id="usuario" required value="<?php echo $user; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="usuario" class="col-sm-5 ms-1 col-form-label"> Editar correo: </label>
					<div class="col-sm-6">
						<input type="email" class="form-control" name="correo" id="correo" required value="<?php echo $email; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label for="usuario" class="col-sm-5 ms-1 col-form-label"> Editar rol: </label>
					<div class="col-sm-6">
						<select class="form-select" name="tipousuario" aria-label="Seleccion de roles">
							<option><?php echo "$rol"; ?></option>
							<option disabled> ────────────── </option>
							<option value="Administrador"> Administrador </option>
							<option value="Empleado"> Empleado </option>
							<option value="Usuario"> Usuario </option>
						</select>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<button type="submit" class="btn btn-outline-primary" name="actualizar" role="button"> Actualizar </button>
				</div>
			</form>
			<?php
				if (isset($_POST['actualizar'])) {
					
					// Recibimos los datos que se enviaron desde el FORM
					$upd_name = $_POST['nombre'];
					$upd_ape = $_POST['apellido'];
					$upd_user = $_POST['usuario'];
					$upd_email = $_POST['correo'];
					$upd_rol = $_POST['tipousuario'];

					// Creamos la sentencia que actualizara los datos
					$upd = $conn->prepare("UPDATE usuarios SET Nombre = ?, Apellido = ?, Usuario = ?, Correo = ?, Tipousuario = ? WHERE ID = ?");
					$upd->bindParam(1, $upd_name);
					$upd->bindParam(2, $upd_ape);
					$upd->bindParam(3, $upd_user);
					$upd->bindParam(4, $upd_email);
					$upd->bindParam(5, $upd_rol);
					$upd->bindParam(6, $editarUID);
					$upd->execute();

					if (!$upd) {
						echo 
							'<script>
								alert("Error al actualizar los datos!");
								window.history.go(-1);
							</script>'
						;
					} else {
						echo 
							'<script>
								alert("Datos actualizados correctamente!");
								window.location.href = "gUser.php";
							</script>'
						;
					}
				}

				$conn = null;
			?>
		</section>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
