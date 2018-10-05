<?php
	$coleccion = new ColeccionData();
	$coleccion->nombre = $_POST["nombre"];
	
	$coleccion->add();

	$params[0] = "Coleccion creada";
	$params[1] = "success";
	Core::redir("./index.php?view=coleccion",$params);

?>