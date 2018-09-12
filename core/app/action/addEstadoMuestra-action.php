<?php
    $estado = new KindData();
    $estado->nombre = $_POST['nombre'];
    $estado->add();

    $alert = "Estado Muestra Creado";
    Core::redir("./index.php?view=estadoMuestra&alert=".$alert);
?>