<?php
	$area = new AreaData();
	$area->nombre = $_POST["nombre"];
	
	$area->add();


	$alert = "Area Creada";
	Core::redir("./index.php?view=areas&alert=".$alert);

?>