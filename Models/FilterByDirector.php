<?php

class FilterByDirector {
	var $result = '';
	var $allDirectors = array() ;

	var $messages = array();

	public function getAllDirectors(){
		$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );
		try {
			$sql    = "SELECT DISTINCT(director)
                    FROM dvds;";
			$this->result = $db->query( $sql );

			return $allDirectors = $this->result->fetchAll( PDO::FETCH_ASSOC );
		} catch ( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}

	public function getAllDVDsByDirector($director){
		$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );
		try {
			$sql    = "SELECT *
                    FROM dvds
                    WHERE director='".$director."';";

			$this->result = $db->query( $sql );

			return $allDVDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
		} catch ( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}

}
