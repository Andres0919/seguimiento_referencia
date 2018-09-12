<?php
class AreaData {
	public static $tablename = "area";

	public function AreaData(){

	} 

	public function add(){
		$sql = "insert into area (nombre) ";
		$sql .= "value (\"$this->nombre\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",kind=\"$this->kind\" where id=$this->id";
		Executor::doit($sql);
	}

	
	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AreaData());
	}

	public static function getAreaName($name){
		$sql = "select * from ".self::$tablename." where nombre='$name'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AreaData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new AreaData());
	}

	public static function getAllGestion(){
		$sql = "select * from ".self::$tablename." where kind = 'Gestion'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AreaData());
	}

	
}
?>