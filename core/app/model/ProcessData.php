<?php
class ProcessData {
	public static $tablename = "proceso";


	public function ProcessData(){
		$this->area_id = null;
		$this->fecha_inicio = "NOW()";
		$this->encargado_id = 1;
		$this->observacion = "";
		$this->estado = 1;
		$this->isReceived = 1;
	}

	public function getProcessName($name){ return AreaData::getByName($name)->id; }

	public function add(){
		$sql = "insert into proceso (referenciamuestra_id,area_id,fecha_inicio,encargado_id,observacion,estado,isReceived) ";
		$sql .= "value ($this->referencia_id,$this->area_id,$this->fecha_inicio,$this->encargado_id,\"$this->observacion\",$this->estado,$this->isReceived)";

		$last_id = Executor::doit($sql);
		return $last_id[1];
	}

	public function recibirRef(){
		$sql = "update ".self::$tablename." set encargado_id=$this->encargado_id, fecha_inicio=$this->fecha_inicio, isReceived=$this->isReceived where id=$this->id";
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

	// partiendo de que ya tenemos creado un objecto ProcessData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getAll(){
		$sql = "select r.nombre as referencia, c.nombre as coleccion, em.nombre as muestra, a.nombre as area, u.nombre as encargado, p.* from ".self::$tablename." p ";
		$sql .= "inner join referenciaMuestra rm ";
		$sql .= "on p.referenciamuestra_id = rm.id ";
		$sql .= "inner join referenciacoleccion rc ";
		$sql .= "on rm.referenciacoleccion_id = rc.id ";
		$sql .= "inner join referencia r ";
		$sql .= "on r.id = rc.referencia_id ";
		$sql .= "inner join coleccion c ";
		$sql .= "on rc.coleccion_id = c.id ";
		$sql .= "inner join estadomuestra em ";
		$sql .= "on rm.muestra_id = em.id ";
		$sql .= "inner join area a ";
		$sql .= "on p.area_id = a.id ";
		$sql .= "inner join usuario u ";
		$sql .= "on p.encargado_id = u.id ";
		$sql .= " order by p.id asc";

		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcessData());


	}

	public static function getAllActive(){
		$sql = "select r.nombre as referencia, c.nombre as coleccion, em.nombre as muestra, a.nombre as area, u.nombre as encargado, p.* from ".self::$tablename." p ";
		$sql .= "inner join referenciaMuestra rm ";
		$sql .= "on p.referenciamuestra_id = rm.id ";
		$sql .= "inner join referenciacoleccion rc ";
		$sql .= "on rm.referenciacoleccion_id = rc.id ";
		$sql .= "inner join referencia r ";
		$sql .= "on r.id = rc.referencia_id ";
		$sql .= "inner join coleccion c ";
		$sql .= "on rc.coleccion_id = c.id ";
		$sql .= "inner join estadomuestra em ";
		$sql .= "on rm.muestra_id = em.id ";
		$sql .= "inner join area a ";
		$sql .= "on p.area_id = a.id ";
		$sql .= "inner join usuario u ";
		$sql .= "on p.encargado_id = u.id ";
		$sql .= "where p.estado=1 and a.nombre <> 'molderia'";
		$sql .= " order by id asc";

		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcessData());

	}

	public static function getAllMolderia(){
		$sql = "select r.nombre as referencia, c.nombre as coleccion, em.nombre as muestra, a.nombre as area, u.nombre as encargado, p.* from ".self::$tablename." p ";
		$sql .= "inner join referenciaMuestra rm ";
		$sql .= "on p.referenciamuestra_id = rm.id ";
		$sql .= "inner join referenciacoleccion rc ";
		$sql .= "on rm.referenciacoleccion_id = rc.id ";
		$sql .= "inner join referencia r ";
		$sql .= "on r.id = rc.referencia_id ";
		$sql .= "inner join coleccion c ";
		$sql .= "on rc.coleccion_id = c.id ";
		$sql .= "inner join estadomuestra em ";
		$sql .= "on rm.muestra_id = em.id ";
		$sql .= "inner join area a ";
		$sql .= "on p.area_id = a.id ";
		$sql .= "inner join usuario u ";
		$sql .= "on p.encargado_id = u.id ";
		$sql .= "where p.estado=1 and a.nombre = 'molderia'";
		$sql .= " order by id asc";

		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcessData());

	}
	
	public  function getById($id){
		$sql = "select r.nombre as referencia, c.nombre as coleccion, em.nombre as muestra, a.nombre as area, u.nombre as encargado, p.* from ".self::$tablename." p ";
		$sql .= "inner join referenciaMuestra rm ";
		$sql .= "on p.referenciamuestra_id = rm.id ";
		$sql .= "inner join referenciacoleccion rc ";
		$sql .= "on rm.referenciacoleccion_id = rc.id ";
		$sql .= "inner join referencia r ";
		$sql .= "on r.id = rc.referencia_id ";
		$sql .= "inner join coleccion c ";
		$sql .= "on rc.coleccion_id = c.id ";
		$sql .= "inner join estadomuestra em ";
		$sql .= "on rm.muestra_id = em.id ";
		$sql .= "inner join area a ";
		$sql .= "on p.area_id = a.id ";
		$sql .= "inner join usuario u ";
		$sql .= "on p.encargado_id = u.id ";
		$sql .= "where p.id=".$id;

		$query = Executor::doit($sql);
		return Model::one($query[0],new ProcessData());

	}

	public function getRefByIdProcess($id){
		$sql = "select referenciaMuestra_id from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProcessData());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcessData());
	}

	public function getProceso(){
		$sql = "select * from ".self::$tablename." where referenciamuestra_id = $this->referencia_id and area_id = $this->area_id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProcessData());
	}

	public function finishProcess($id){
		$sql = "update ".self::$tablename." set estado=0 where id=$id";
		Executor::doit($sql);
	}
}

?>