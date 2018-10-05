<?php 
    $categoria = new CategoryData();
    $categoria->id = $_GET['id'];

    $categoria->del();

    $params[0] = "Categoria Eliminada";
	$params[1] = "success";
	Core::redir("./index.php?view=categoria",$params);
?>