<!-- Modal -->
		<section class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"> Nuevo motorista </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<article class="modal-body">
						<form autocomplete="off" method="POST" action="crMotA.php">
							<div class="row mb-2">
								<label for="nameMot" class="col-sm-5 col-form-label"> Ingrese el nombre: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="nameMot" id="nameMot" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="EdadMot" class="col-sm-5 col-form-label"> Ingrese la edad: </label>
								<div class="col-sm-6">
									<input type="number" min="0" max="100" class="form-control" name="edadMot" id="EdadMot" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="TelMot" class="col-sm-5 col-form-label"> Ingrese el teléfono: </label>
								<div class="col-sm-6">
									<input type="number" class="form-control" name="telMot" required id="TelMot">
								</div>
							</div>
							<div class="row mb-2">
								<label for="HourMot" class="col-sm-5 col-form-label"> Ingrese el horario: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="hourMot" required id="HourMot">
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