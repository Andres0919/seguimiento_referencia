<?php
class UserData {
	public static $tablename = "usuario";

	public function UserData(){
	}

	public function getOrigin(){ return OriginData::getById($this->origin_id); }
	public function getArea(){ return AreaData::getById($this->area_id); }

	public function add(){
		$sql = "insert into ".self::$tablename." (nombre,contra,rol,planta_id,area_id) ";
		$sql .= "value (\"$this->nombre\",\"$this->contra\",$this->rol,$this->planta_id,$this->area_id)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",email=\"$this->email\",lastname=\"$this->lastname\",username=\"$this->username\",is_active=$this->is_active,kind=$this->kind,area_id=$this->area_id,origin_id=$this->origin_id where id=$this->id";
		Executor::doit($sql);
	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	public static function getByName($nombre){
		$sql = "select * from ".self::$tablename." where nombre='$nombre'";
		$query = Executor::doit($sql);

		return Model::one($query[0],new UserData());
	}

	public static function getByPass($pass){
		$sql = "select * from ".self::$tablename." where contra='$pass'";
		$query = Executor::doit($sql);

		return Model::one($query[0],new UserData());
	}

	public static function getAll(){
		$sql = "select a.nombre as area, p.nombre as planta, u.* from ".self::$tablename." u ";
		$sql .= "inner join planta p ";
		$sql .= "on u.planta_id = p.id ";
		$sql .= "inner join area a ";
		$sql .= "on u.area_id = a.id";

		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


}

?>