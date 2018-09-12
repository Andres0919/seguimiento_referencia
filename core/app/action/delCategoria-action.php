<?php 
    $categoria = new CategoryData();
    $categoria->id = $_GET['id'];

    $categoria->del();

    $alert = "Categoria Eliminada";
    Core::redir("./index.php?view=categoria&alert=".$alert);
?>