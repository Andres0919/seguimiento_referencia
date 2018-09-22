<?php 
    $id = $_POST['idRecibir'];
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
    if ($user->area_id != $proceso_area && $user->id != 1) {
        $alert = "El area no coincide";
        Core::redir("./index.php?view=home&alert=".$alert);
        die();
    }

    $proceso = new ProcessData();
    $proceso->id = $id;
    $proceso->encargado_id = $user->id;
    $proceso->recibirRef();
    $alert = "Referencia recibida";
    Core::redir("./index.php?view=home&alert=".$alert);
    die();
?>