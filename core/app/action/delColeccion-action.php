<?php 
    $coleccion = new ColeccionData();
    $coleccion->id = $_GET['id'];

    $coleccion->del();

    $params[0] = "Coleccion Eliminada";
	$params[1] = "success";
	Core::redir("./index.php?view=coleccion",$params);
?>