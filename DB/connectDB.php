<?php
	try {
		$conn = new PDO("mysql:host=127.0.0.1;dbname=BDAlquiler","root","");
	} catch (PDOException $ex) {
		print_r("Error: ". $ex->getMessage());
		//die($ex->getMessage());
		die();
	}
?>
