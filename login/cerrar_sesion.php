<?php
	//Iniciamos sesion segun el usuario que ingreso y su rol
	session_start();

	//Destruimos la sesion
	session_destroy();

	//Con ayuda de JavaScript mandamos un mensaje y redireccionamos a la pagina principal
	echo 
		'<script>
			alert("Cerrando sesión...");
			window.location.href = "../index.html"
		</script>'
	;
?>