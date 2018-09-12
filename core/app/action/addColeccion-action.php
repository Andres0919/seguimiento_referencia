<?php
	$coleccion = new ColeccionData();
	$coleccion->nombre = $_POST["nombre"];
	
	$coleccion->add();


	$alert = "Coleccion creada";
	Core::redir("./index.php?view=coleccion&alert=".$alert);

?>