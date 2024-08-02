<!-- Modal -->
<section class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Nuevo usuario </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<article class="modal-body">
				<form autocomplete="off" method="POST" action="cruA.php">
					<div class="row mb-2">
						<label for="nombre" class="col-sm-5 col-form-label"> Ingrese el nombre: </label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="nombre" id="nombre" required>
						</div>
					</div>
					<div class="row mb-2">
						<label for="apellidos" class="col-sm-5 col-form-label"> Ingrese el apellido: </label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="apellido" id="apellidos" required>
						</div>
					</div>
					<div class="row mb-2">
						<label for="usuario" class="col-sm-5 col-form-label"> Ingrese el usuario: </label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="usuario" id="usuario" required>
						</div>
					</div>
					<div class="row mb-2">
						<label for="password" class="col-sm-5 col-form-label"> Ingrese la contraseña: </label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="contra" id="password" required>
						</div>
					</div>
					<div class="row mb-2">
						<label for="email" class="col-sm-5 col-form-label"> Ingrese el correo: </label>
						<div class="col-sm-6">
							<input type="email" class="form-control" name="correo" id="email" required>
						</div>
					</div>
					<div class="row mb-2">
						<label for="rol" class="col-sm-5 col-form-label"> Seleccione el rol: </label>
						<div class="col-sm-6">
							<select class="form-select" name="tipousuario" aria-label="Seleccion de roles">
								<option selected> Seleccione el rol </option>
								<option value="Administrador"> Administrador </option>
								<option value="Empleado"> Empleado </option>
								<option value="Usuario"> Usuario </option>
							</select>
						</div>
					</div>
					<div class="d-flex justify-content-center">
						<input type="submit" class="btn btn-outline-primary" value="Registrar" role="button">
					</div>
				</form>
			</article>
		</div>
	</div>
</section>