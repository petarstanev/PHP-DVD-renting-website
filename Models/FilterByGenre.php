<?php

class FilterByGenre {
	var $result = '';
	var $allGenres = array() ;

	var $messages = array();

	public function getAllGenres(){
		$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );
		try {
			$sql    = "SELECT DISTINCT(genre)
                    FROM dvds;";
			$this->result = $db->query( $sql );

			return $allGenres = $this->result->fetchAll( PDO::FETCH_ASSOC );
		} catch ( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}

	public function getAllDVDsByGenre($genre){
		$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );
		try {
			$sql    = "SELECT *
                    FROM dvds
                    WHERE genre='".$genre."';";

			$this->result = $db->query( $sql );

			return $allDVDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
		} catch ( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}

}
