<?php 
    $id = $_POST['idRecibir'];
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

    $proceso = new ProcessData();
    $proceso->id = $id;
    $proceso->encargado_id = $user->id;
    $proceso->recibirRef();
    $params[0] = "Referencia recibida";
    $params[1] = "success";
    Core::redir("./index.php?view=home",$params);
    die();
?>