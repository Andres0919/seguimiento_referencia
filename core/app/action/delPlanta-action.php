<?php
    $planta = new PlantaData();
    $planta->id = $_GET['id'];

    $planta->del();

    $params[0] = "Planta Eliminada";
	$params[1] = "success";
	Core::redir("./index.php?view=plantas",$params);
?>