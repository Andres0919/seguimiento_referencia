<?php 
    $area = new AreaData();
    $area->id = $_GET['id'];

    $area->del();

    $params[0] = "Area Eliminada";
	$params[1] = "success";
	Core::redir("./index.php?view=areas",$params);
?>