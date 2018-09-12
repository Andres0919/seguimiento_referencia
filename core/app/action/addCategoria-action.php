<?php
	$categoria = new CategoryData();
	$categoria->nombre = $_POST["nombre"];
	
	$categoria->add();


	$alert = "Categoria Creada";
	Core::redir("./index.php?view=categoria&alert=".$alert);

?>