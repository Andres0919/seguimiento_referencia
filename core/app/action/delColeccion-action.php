<?php 
    $coleccion = new ColeccionData();
    $coleccion->id = $_GET['id'];

    $coleccion->del();

    $alert = "Coleccion Eliminada";
    Core::redir("./index.php?view=coleccion&alert=".$alert);
?>