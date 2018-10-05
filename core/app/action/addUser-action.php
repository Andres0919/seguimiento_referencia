<?php
    $user = new UserData();
    $user->nombre = $_POST['usuario'];
    $user->contra = $_POST['contra'];
    $user->rol = $_POST['rol'];
    $user->planta_id = $_POST['planta_id'];
    $user->area_id = $_POST['area_id'];
    $user->add();

    $params[0] = "Usuario Creado";
	$params[1] = "success";
	Core::redir("./index.php?view=users",$params);
?>