<?php

class AllDVDs {
	var $result = '';

	var $messages = array();

	public function __construct() {

	}

	public function getAllDVDs(){
		$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );
		try {
			$sql    = "SELECT *
                    FROM dvds;";
			$this->result = $db->query( $sql );

			return $allDVDs = $this->result->fetchAll( PDO::FETCH_ASSOC );
		} catch ( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}
}
