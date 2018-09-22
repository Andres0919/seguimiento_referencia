<?php
// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");
if(Session::getUID()=="") {
	$nombre = $_POST['nombre'];
	$pass = $_POST['password'];
	$base = new Database();
	$con = $base->connect();
	$user = UserData::getByName($nombre);

	if(isset($user)) {
		if($user->contra == $pass){
			//	print $userid;
			$_SESSION['user_id']=$user->id;
			//	setcookie('userid',$userid);
			//	print $_SESSION['userid'];
			print "Cargando ... $user->nombre";
			print "<script>window.location='index.php?view=home';</script>";
		}else{
			print "<script>alert('La contraseña no coincide');</script>";
			print "<script>window.location='index.php?view=login';</script>";
			die();
		}
	}else {
		print "<script>window.location='index.php?view=login';</script>";
	}
}else{
	print "<script>window.location='index.php?view=home';</script>";	
}
?>