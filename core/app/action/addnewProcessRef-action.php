<?php 
    $muestra = $_POST['muestra'];
    $user = Core::$user;
    $proceso = new ProcessData();
    $pinta = new PintaData();
    $coleccion = ColeccionData::getByName($_POST['coleccion'])->id;
    $referencia = ReferenciaData::getByName($_POST['referencia'])->id;
    $refCol = ColeccionData::getByRefCol($referencia,$coleccion);
    $refMues = [];
    $procesos_id = [];
    $codigospinta = explode('-',$_POST['pinta']);
    if (count($refCol) == 0) {
        ColeccionData::addRefCol($referencia, $coleccion);
        $refCol = ColeccionData::getByRefCol($referencia,$coleccion);
    }
    for ($i=0; $i < count($muestra); $i++) { 
        $refMues[$i] = ReferenciaData::getByRefMues($refCol->id, $muestra[$i]);
        if(count($refMues[$i]) == 0){
            ReferenciaData::addRefMues($refCol->id, $muestra[$i]);
            $refMues[$i] = ReferenciaData::getByRefMues($refCol->id, $muestra[$i]);
        }
    }
    foreach($refMues as $ref){
        $proceso->referencia_id = $ref[0]->id;
        $proceso->encargado_id = $user->id;
        $proceso->area_id = AreaData::getAreaName('PROGRAMACIÓN MOLDERÍA')->id;
        array_push($procesos_id,$proceso->add());
    }
    foreach ($procesos_id as $proceso_id) {
        $pinta->proceso_id = $proceso_id;
        foreach ($codigospinta as $codigo) {
            $pinta->codigo = $codigo;
            $pinta->add();
        }
    }
    $alert = "REFERENCIA INICIADA";
    Core::redir("./index.php?view=home&alert=".$alert);
?>