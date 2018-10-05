<?php


// 14 de Abril del 2014
// Core.php
// @brief obtiene las configuraciones, muestra y carga los contenidos necesarios.
// actualizado [11-Aug-2016]
class Core {
	public static $theme = "";
	public static $root = "";

	public static $text = "";

	public static $user = null;
	public static $debug_sql = false;

	public static function includeCSS(){
		$path = "assest/css/";
		$handle=opendir($path);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="." && $entry!=".."){
					$fullpath = $path.$entry;
				if(!is_dir($fullpath)){
						echo "<link rel='stylesheet' type='text/css' href='".$fullpath."' />";
					}
				}
			}
		closedir($handle);
		}

	}

	public static function redir($url,$params=['','']){
		echo "<script>window.location='".$url."';</script>";
		setcookie("text", $params[0], time()+3);
		setcookie("type", $params[1], time()+3);
	}

	public static function includeJS(){
		$path = "res/js/";
		$handle=opendir($path);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="." && $entry!=".."){
					$fullpath = $path.$entry;
				if(!is_dir($fullpath)){
						echo "<script type='text/javascript' src='".$fullpath."'></script>";

					}
				}
			}
		closedir($handle);
		}

	}

}



?>