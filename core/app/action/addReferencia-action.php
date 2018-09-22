<?php
	$referencia = new ReferenciaData();
	$referencia->nombre = $_POST["nombre"];
	$referencia->categoria_id = $_POST["familia"];
	
	$referencia->add();

	$alert = "Referencia Creada";
	Core::redir("./index.php?view=referencias&alert=".$alert);
?>