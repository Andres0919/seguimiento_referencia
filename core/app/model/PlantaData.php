<?php
class PlantaData {
	public static $tablename = "planta";


	public function PlantaData(){
	} 

	public function add(){
		$sql = "insert into ".self::$tablename." (nombre) ";
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
		$sql = "update ".self::$tablename." set plant=\"$this->plant\" where id=$this->id";
		Executor::doit($sql);
	}

	
	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PlantaData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PlantaData());

	}

	
}
?>