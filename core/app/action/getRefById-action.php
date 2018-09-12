<?php 
    $id = $_REQUEST['id'];
    $proceso = ProcessData::getById($id);
    $proceso->pinta = PintaData::getByProcessId($id); 
    echo json_encode($proceso);
?>