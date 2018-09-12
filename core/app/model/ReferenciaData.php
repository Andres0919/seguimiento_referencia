<?php
	class ReferenciaData {
		public static $tablename = "referencia";


		public function ReferenciaData(){
		}

		public function add(){
			$sql = "insert into referencia (nombre) ";
			$sql .= "value (\"$this->nombre\")";

			return Executor::doit($sql);
		}
		
		public function addRefMues($refCol, $muestra){
			$sql = "insert into referenciamuestra (referenciacoleccion_id, muestra_id) value ($refCol, $muestra)";
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

		// partiendo de que ya tenemos creado un objecto ReferenciaData previamente utilizamos el contexto
		public function update(){
			$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
			Executor::doit($sql);
		}

		public static function getById($id){
			$sql = "select * from ".self::$tablename." where id=$id";
			$query = Executor::doit($sql);
			return Model::one($query[0],new ReferenciaData());
		}

		public static function getByName($nombre){
			$sql = "select * from ".self::$tablename." where nombre='$nombre'";
			$query = Executor::doit($sql);
			return Model::one($query[0],new ReferenciaData());
		}

		public static function getAll(){
			$sql = "select * from ".self::$tablename;
			$query = Executor::doit($sql);
			return Model::many($query[0],new ReferenciaData());
		}
		
		public static function getLike($q){
			$sql = "select * from ".self::$tablename." where name like '%$q%'";
			$query = Executor::doit($sql);
			return Model::many($query[0],new ReferenciaData());
		}

		public static function getByRefMues($refCol, $muestra){
			$sql = "select * from referenciamuestra where referenciacoleccion_id = $refCol and muestra_id = $muestra";
			$query = Executor::doit($sql);
			return Model::many($query[0],new ReferenciaData());
		}


	}
?>