<?php 
    $planta = new PlantaData();
    $planta->nombre = $_POST['nombre'];

    $planta->add();

    $alert = "Planta Creada";
    Core::redir("./index.php?view=plantas&alert=".$alert);
?>