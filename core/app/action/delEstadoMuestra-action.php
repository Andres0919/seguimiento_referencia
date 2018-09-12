<?php 
    $estado = new KindData();
    $estado->id = $_GET['id'];

    $estado->del();

    $alert = "Estado Muestra Eliminado";
    Core::redir("./index.php?view=estadoMuestra&alert=".$alert);
?>