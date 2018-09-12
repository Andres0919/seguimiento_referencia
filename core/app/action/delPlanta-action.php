<?php
    $planta = new PlantaData();
    $planta->id = $_GET['id'];

    $planta->del();

    $alert = "Planta Eliminada";
    Core::redir("./index.php?view=plantas&alert=".$alert);
?>