<?php
	// Conexion a la base de datos
	require_once('../DB/connectDB.php');

	//Iniciamos la sesion segun el perfil de usuario
	session_start();

	// Obtenemos los campos del lado del servidor con los enviados por el metodo POST del formulario.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Validamos los campos
		if (isset($_POST["usuario"]) && isset($_POST["contra"]) && isset($_POST["tipousuario"])) {
			$user = $_POST["usuario"];
			$pass = $_POST["contra"];
			$tip_user = $_POST["tipousuario"];

			// Verificamos los datos y preparamos la consulta
			$query = $conn->prepare("SELECT * FROM usuarios WHERE Usuario = ?");
			$query->bindParam(1, $user, PDO::PARAM_STR);
			$query->execute();

			// Verificamos el numero de fila en donde puede estar almacenado el usuario y si los resultados que obtenemos son mayor a 0 se pasara al bloque de arreglo.
			if ($query->rowCount() > 0) {
				// En esta parte creamos una variable que sera el dato de la fila que esta en la tabla asociado a un arreglo pasamos el resultado.
				$rowData = $query->fetch(PDO::FETCH_ASSOC);
				// Una vez encontrado el usuario verificamos la contraseña encriptada usando password_verify y le pasamos los parametros que seran: la contraseña digitada en el formulario por el usuario (sin encriptar) y lo comparamos con el que esta en la BD.
				if (password_verify($pass, $rowData["Passw"])) {

					// Una vez tengamos todo pasamos el usuario a la variable $_SESSION igualando lo que obtuvimos en la variable de dato de la fila.
					$_SESSION["usuario"] = $rowData['Usuario'];
					$_SESSION["nombre"] = $rowData['Nombre'];
					$_SESSION["tipousuario"] = $rowData['Tipousuario'];

					switch ($_SESSION["tipousuario"]) {
						case "Administrador":
							echo
								'<script>
									alert("Iniciando sesión...");
									window.location.assign("../roles/admin/index_admin.php");
								</script>'
							;
						break;
						case "Empleado":
							echo 
								'<script>
									alert("Iniciando sesión...");
									window.location.assign("../roles/empleado/index_empleados.php");
								</script>'
							;
						break;
						case "Usuario":
							echo
								'<script>
									alert("Iniciando sesión...");
									window.location.assign("../roles/usuario/index_user.php");
								</script>'
							;
						break;
					}

					// En caso contrario recarga la pagina si encuentra diferentes datos y muestra un mensaje de error.
				} else {
					echo 
						'<script>
							alert("Usuario o contraseña incorrectos!");
							window.history.go(-1);
						</script>'
					;
				}

				//En caso contrario recarga la pagina si las contraseñas no coinciden y muestra un mensaje de error.
			} else {
				echo 
					'<script>
						alert("La contraseñas no coinciden!");
						window.history.go(-1);
					</script>'
				;
			}
		}
	}

	// Cerramos la conexion
	$conn = null;
?>
