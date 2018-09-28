<?php
class ColeccionData {
	public static $tablename = "coleccion";
	public static $tablename2 = "referenciacoleccion";

	public function ColeccionData(){
	}

	public function getArea(){ return AreaData::getById($this->area_id); }
	public function getPriority(){ return PriorityData::getById($this->priority_id); }
	public function getStatus(){ return StatusData::getById($this->status_id); }
	public function getKind(){ return KindData::getById($this->kind_id); }
	public function getUser(){ return UserData::getById($this->asigned_id); }
	public function getGenerated(){return UserData::getById($this->generated_id);}

	public function add(){
		$sql = "insert into coleccion (nombre) ";
		$sql .= "value (\"$this->nombre\")";

		return Executor::doit($sql);
	}

	public function lastInsert(){
		$sql = "SELECT LAST_INSERT_ID()";
		$query = Executor::doit($sql);

		return Model::one($query[0],new ColeccionData());
	}

	public function addRefCol($ref, $col){
		$sql = "insert into referenciacoleccion (referencia_id, coleccion_id) value ($ref, $col)";
	
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

	// partiendo de que ya tenemos creado un objecto ColeccionData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",reference_id=\"$this->reference_id\",priority_id=\"$this->priority_id\",description=\"$this->description\",kind_id=\"$this->kind_id\",area_id=\"$this->area_id\" where id=$this->id";
		Executor::doit($sql);
	}

	public function asigncoleccion(){
		$sql = "update ".self::$tablename." set asigned_id=\"$this->asigned_id\",asigned_at= NOW(),status_id=2 where id = $this->id";
		Executor::doit($sql);
	}
	
	public function finishcoleccion(){
		$sql = "update ".self::$tablename." set finished_at= NOW(),status_id=3 where id = $this->id";
		Executor::doit($sql);
		
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ColeccionData());
	}

	public static function getByName($nombre){
		$sql = "select * from ".self::$tablename." where nombre='$nombre'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ColeccionData());
	} 

	public static function getByRefCol($referencia,$coleccion){
		$sql = "select * from ".self::$tablename2." where referencia_id=$referencia and coleccion_id=$coleccion";
		$query = Executor::doit($sql);

	
		return Model::one($query[0],new ColeccionData());
	}

	public static function getRepeated($pacient_id,$medic_id,$date_at,$time_at){
		$sql = "select * from ".self::$tablename." where pacient_id=$pacient_id and medic_id=$medic_id and date_at=\"$date_at\" and time_at=\"$time_at\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ColeccionData());
	}



	public static function getByMail($mail){
		$sql = "select * from ".self::$tablename." where mail=\"$mail\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ColeccionData());
	}

	public static function getEvery(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ColeccionData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ColeccionData());
	}

	public static function getAllPendings(){ 
		$sql = "select * from ".self::$tablename." where status_id=1";
		$query = Executor::doit($sql);
		
		return  Model::many($query[0],new ColeccionData());
	}

	public static function getAllPendingsUser($area_id){
		$sql = "select * from ".self::$tablename." where status_id = 1 and area_id =".$area_id;
		$query = Executor::doit($sql);

		return Model::many($query[0],new ColeccionData());
	}

	public static function getAllAsigned(){ 
		$sql = "select * from ".self::$tablename." where status_id=2";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ColeccionData());
	}

	public function getAllRefByColeccion(){
		$sql = "select r.nombre as referencia, c.nombre as coleccion, em.nombre as muestra,  rm.* from ".self::$tablename." c ";
		$sql .= "inner join ".self::$tablename2." rc ";
		$sql .= "on c.id = rc.coleccion_id ";
		$sql .= "inner join referencia r ";
		$sql .= "on r.id = rc.referencia_id ";
		$sql .= "inner join referenciaMuestra rm ";
		$sql .= "on rm.referenciaColeccion_id = rc.id ";
		$sql .= "inner join estadoMuestra em ";
		$sql .= "on rm.muestra_id = em.id ";
		$sql .= "where c.id=$this->id ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ColeccionData());
	}
	
	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ColeccionData());
	}

	public static function getOld(){
		$sql = "select * from ".self::$tablename." where date(date_at)<date(NOW()) order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ColeccionData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ColeccionData());
	}

	public static function getReference($id){
		$sql = "select r.nombre as referencia, c.nombre as coleccion, em.nombre as muestra,ct.nombre as categoria,  rm.* from referenciaMuestra rm ";
		$sql .= "inner join estadoMuestra em ";
		$sql .= "on em.id = rm.muestra_id ";
		$sql .= "inner join referenciaColeccion rc ";
		$sql .= "on rc.id = rm.referenciaColeccion_id ";
		$sql .= "inner join coleccion c ";
		$sql .= "on rc.coleccion_id = c.id ";
		$sql .= "inner join referencia r ";
		$sql .= "on rc.referencia_id = r.id ";
		$sql .= "inner join categoria ct ";
		$sql .= "on r.categoria_id = ct.id ";
		$sql .= "where rm.id=$id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ColeccionData());
	}
}

?>