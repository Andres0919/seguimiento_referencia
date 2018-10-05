<?php 
    $planta = new PlantaData();
    $planta->nombre = $_POST['nombre'];

    $planta->add();

    $params[0] = "Planta Creada";
	$params[1] = "success";
	Core::redir("./index.php?view=plantas",$params);
?>