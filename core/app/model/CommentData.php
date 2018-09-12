<?php
class CommentData {
	public static $tablename = "comment";


	public function CommentData(){
		$this->comment = "";
		$this->ticket_id = "";	
	}

	public function add(){
		$sql = "insert into comment (description, ticket_id) ";
		$sql .= "value (\"$this->description\", \"$this->ticket_id\")";
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
	
	public function getAll($ticket_id){
		$sql = "select * from ".self::$tablename. " where ticket_id=$ticket_id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());
	}
}
?>