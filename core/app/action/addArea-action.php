<?php
	$area = new AreaData();
	$area->nombre = $_POST["nombre"];
	
	$area->add();

	$params[0] = "Area Creada";
	$params[1] = "success";
	Core::redir("./index.php?view=areas",$params);

?>