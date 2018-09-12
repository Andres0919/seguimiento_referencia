<?php
    $user = new UserData();
    $user->nombre = $_POST['usuario'];
    $user->contra = $_POST['contra'];
    $user->rol = $_POST['rol'];
    $user->planta_id = $_POST['planta_id'];
    $user->area_id = $_POST['area_id'];
    $user->add();
    $alert = "Usuario Creado";
	Core::redir("./index.php?view=users&alert=".$alert);
?>