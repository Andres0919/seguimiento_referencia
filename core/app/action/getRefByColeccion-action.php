<?php 
    $id = $_REQUEST['id'];
    $referencias = new ColeccionData();
    $referencias->id = $id;
    $result = $referencias->getAllRefByColeccion();
    echo json_encode($result);
?>