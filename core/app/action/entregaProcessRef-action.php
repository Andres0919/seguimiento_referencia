<?php 
    $id = $_POST['idEntrega'];
    $pintas = $_POST['pinta'];
    $area_id = $_POST['area_id'];
    $pinta = new PintaData();
    
    if(isset($_POST['pass'])){
        $user = UserData::getByPass($_POST['pass']);
        if(!$user){
            $params[0] = "Contraseña Incorrecta";
            $params[1] = "danger";
            Core::redir("./index.php?view=home",$params);
            die();
        }
    }else{
        $user = Core::$user;
    }
    $proceso_area = ProcessData::getById($id)->area_id;
    if ($user->area_id != $proceso_area && $user->id != 1) {
        $params[0] = "El area no coincide";
        $params[1] = "danger";
        Core::redir("./index.php?view=home",$params);
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
    $params[0] = "REFERENCIA ENTREGADA";
	$params[1] = "success";
	Core::redir("./index.php?view=home",$params);
    die();
?>