<?php
require_once("Core/Model.php");

class AllDVDs extends Model{
	var $result = '';
	var $messages = array();

	public function getAllDVDs(){
		try {
			$sql    = "SELECT *
                    FROM dvds;";
			$this->result = $this->db->query( $sql );

			return $allDVDs = $this->result->fetchAll( PDO::FETCH_ASSOC );
		} catch ( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}
}
