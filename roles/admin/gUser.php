<?php
    session_start();

    if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipousuario'])) {
    	header('location: ../../login/login.php');
    } else {
    	if ($_SESSION['tipousuario'] != 'Administrador') {
    		header("location: ../../login/login.php");
    	}
    }

    require_once('../../DB/connectDB.php');

	//Consultamos la base de datos
	$cons = $conn->prepare("SELECT * FROM usuarios");
	$cons->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap" rel="stylesheet">
    <title> Admin | Usuarios </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Noto Sans', sans-serif;">
	<?php 
		require_once('../../layouts/nav.php');
	?>
	<main>
		<section class="container-fluid">
			<h4 class="m-2"><a href="index_admin.php" class="bi-arrow-left text-dark" title="Regresar" role="button"></a> Lista de usuarios</h4>
		</section>

		<!-- Boton que hara de funcion modal -->
		<section class="container-fluid">
			<button type="button" class="btn btn-outline-dark m-1" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi-person-plus"></i> Nuevo usuario </button>
			<article class="table-responsive">
				<table class="table table-bordered table-dark table-striped">
					<thead class="table-light">
						<tr>
							<th scope="col"> # </th>
							<th scope="col"> Nombre </th>
							<th scope="col"> Apellido </th>
							<th scope="col"> Usuario </th>
							<th scope="col"> Correo </th>
							<th scope="col"> Rol </th>
							<th scope="col"> Opciones </th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($fila = $cons->fetch(PDO::FETCH_ASSOC)) {
							$idU = $fila['ID'];
							$name = $fila['Nombre'];
							$ape = $fila['Apellido'];
							$user = $fila['Usuario'];
							$email = $fila['Correo'];
							$rol = $fila['Tipousuario'];
						?>
						<tr>
							<!-- Mostramos los resultados obtenidos de la BD en la tabla -->
							<th scope="row"><?php echo $idU; ?></th>
							<td><?php echo $name; ?></td>
							<td><?php echo $ape; ?></td>
							<td><?php echo $user; ?></td>
							<td><?php echo $email; ?></td>
							<td><?php echo $rol; ?></td>
							<td>
								<a class="bi-pencil-square fs-2 text-warning" title="Editar" href="editgU.php?id=<?php echo(base64_encode($idU)); ?>"></a>
								<a class="bi-person-x fs-2 text-danger" title="Eliminar" href="delgU.php?id=<?php echo(base64_encode($idU)); ?>"></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</article>
		</section>
		<?php
			require_once('../../layouts/modal_usuario.php');
		?>
	</main>
	<?php require_once('../../layouts/footer.php'); ?>
</body>
</html>

<?php
	$conn = null;
?>
