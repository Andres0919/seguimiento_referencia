<?php 
    $area = new AreaData();
    $area->id = $_GET['id'];

    $area->del();

    $alert = "Area Eliminada";
    Core::redir("./index.php?view=areas&alert=".$alert);
?>