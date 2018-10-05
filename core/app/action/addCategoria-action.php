<?php
	$categoria = new CategoryData();
	$categoria->nombre = $_POST["nombre"];
	
	$categoria->add();

	$params[0] = "Categoria Creada";
	$params[1] = "success";
	Core::redir("./index.php?view=categoria",$params);

?>