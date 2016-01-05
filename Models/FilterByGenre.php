<?php
require_once("Core/Model.php");

class FilterByGenre extends Model{
	var $result = '';
	var $allGenres = array() ;
	var $messages = array();

	public function getAllGenres(){
		try {
			$sql    = "SELECT DISTINCT(genre)
                    FROM dvds;";
			$this->result = $this->db->query( $sql );

			return $allGenres = $this->result->fetchAll( PDO::FETCH_ASSOC );
		} catch ( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}

	public function getAllDVDsByGenre($genre){
		try {
			$sql    = "SELECT *
                    FROM dvds
                    WHERE genre='".$genre."';";

			$this->result = $this->db->query( $sql );

			return $allDVDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
		} catch ( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}

}
