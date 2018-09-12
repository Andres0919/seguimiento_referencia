<?php
class PintaData {
	public static $tablename = "pinta";


	public function PintaData(){
		$this->codigo = null;
		$this->proceso_id = null;
		$this->fecha_fin = "NOW()";
		$this->estado = 1;
	}

	public function add(){
		$sql = "insert into pinta (codigo,proceso_id,fecha_fin,estado) ";
		$sql .= "value ('$this->codigo',$this->proceso_id,'',$this->estado)";
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

	// partiendo de que ya tenemos creado un objecto PintaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PintaData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PintaData());

	}

	public static function getByProcessId($id){
		$sql = "select * from ".self::$tablename." where proceso_id=".$id." and estado=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PintaData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PintaData());
	}

	public function getProceso(){
		$sql = "select * from ".self::$tablename." where referenciamuestra_id = $this->referencia_id and area_id = $this->area_id";

		$query = Executor::doit($sql);
		return Model::one($query[0],new PintaData());
	}

	public function setState($pinta, $id){
		$sql = "update ".self::$tablename." set fecha_fin=NOW(), estado=0 where proceso_id=$id and codigo=$pinta";
		Executor::doit($sql);
	}


}

?>