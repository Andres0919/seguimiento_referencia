<?php 
    $estado = new KindData();
    $estado->id = $_GET['id'];

    $estado->del();

    $params[0] = "Estado Muestra Eliminado";
	$params[1] = "success";
	Core::redir("./index.php?view=estadoMuestra",$params);
?>