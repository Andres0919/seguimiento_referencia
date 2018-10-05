<?php
    $estado = new KindData();
    $estado->nombre = $_POST['nombre'];
    $estado->add();

    $params[0] = "Estado Muestra Creado";
	$params[1] = "success";
	Core::redir("./index.php?view=estadoMuestra",$params);
?>