<?php 
    $id = $_POST['idEntrega'];
    $pintas = $_POST['pinta'];
    $area_id = $_POST['area_id'];
    $pinta = new PintaData();
    
    if(isset($_POST['pass'])){
        $user = UserData::getByPass($_POST['pass']);
        if(!$user){
            $alert = "Contraseña Incorrecta";
            Core::redir("./index.php?view=home&alert=".$alert);
            die();
        }
    }else{
        $user = Core::$user;
    }
    $proceso_area = ProcessData::getById($id)->area_id;
    if ($user->area_id != $proceso_area) {
        $alert = "El area no coincide";
        Core::redir("./index.php?view=home&alert=".$alert);
        die();
    }

    foreach ($pintas as $codigo) {
        PintaData::setState($codigo, $id);
    }
    $pintasAvailable = PintaData::getByProcessId($id);
    if(count($pintasAvailable) == 0){
        ProcessData::finishProcess($id);
    }
    $proceso = new ProcessData();
    $proceso->referencia_id = ProcessData::getRefByIdProcess($id)->referenciaMuestra_id;
    $proceso->area_id = $area_id;
    $proceso->isReceived = 0;
    $proceso->fecha_inicio = "''";
    $pinta->proceso_id = $proceso->add();
    foreach ($pintas as $codigo) {
        $pinta->codigo = $codigo;
        $pinta->add();
    }
    $alert = "REFERENCIA ENTREGADA";
    Core::redir("./index.php?view=home&alert=".$alert);
    die();
?>