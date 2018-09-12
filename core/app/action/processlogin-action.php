<?php
// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");
if(Session::getUID()=="") {
	$nombre = $_POST['nombre'];
	$pass = sha1(md5($_POST['password']));
	$base = new Database();
	$con = $base->connect();
	$user = UserData::getByName($nombre);

	if(isset($user)) {
		//	print $userid;
		$_SESSION['user_id']=$user->id;
		//	setcookie('userid',$userid);
		//	print $_SESSION['userid'];
		print "Cargando ... $user->nombre";
		print "<script>window.location='index.php?view=home';</script>";
	}else {
		print "<script>window.location='index.php?view=login';</script>";
	}
}else{
	print "<script>window.location='index.php?view=home';</script>";	
}
?>