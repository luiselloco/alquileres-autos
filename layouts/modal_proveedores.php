<!-- Modal -->
		<section class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"> Nuevo proveedor </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<article class="modal-body">
						<form autocomplete="off" method="POST" action="cProvA.php">
							<div class="row mb-2">
								<label for="nameProv" class="col-sm-5 col-form-label"> Ingrese el proveedor: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="nameProv" id="nameProv" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="markProv" class="col-sm-5 col-form-label"> Ingrese la marca: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="markProv" id="markProv" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="cantCProv" class="col-sm-5 col-form-label"> Ingrese la cantidad: </label>
								<div class="col-sm-6">
									<input type="number" id="cantCProv" class="form-control" name="cantCProv" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="yearprov" class="col-sm-5 col-form-label"> Ingrese el año: </label>
								<div class="col-sm-6">
									<input type="number" class="form-control" name="yearCProv" id="yearprov" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="placasCProv" class="col-sm-5 col-form-label"> Ingrese las placas: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="placasCProv" id="placasCProv" required>
								</div>
							</div>
							<div class="row mb-2">
								<label for="polizaCProv" class="col-sm-5 col-form-label"> Ingrese la aseguradora: </label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="polizaCProv" required id="polizaCProv">
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