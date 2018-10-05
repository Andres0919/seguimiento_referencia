<?php
	$referencia = new ReferenciaData();
	$referencia->nombre = $_POST["nombre"];
	$referencia->categoria_id = $_POST["familia"];
	
	$referencia->add();

	$params[0] = "Referencia Creada";
	$params[1] = "success";
	Core::redir("./index.php?view=referencias",$params);
?>