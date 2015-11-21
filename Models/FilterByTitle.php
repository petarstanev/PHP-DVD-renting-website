<?php

class FilterByTitle {
	var $result = '';
	var $messages = array();

	public function getAllDVDsByTitle( $title ) {
		$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );
		try {
			$sql = "	SELECT *
					  	FROM dvds
						WHERE title
						LIKE '%" . $title . "%';";

			$this->result = $db->query( $sql );
			if ( $this->result->rowCount() > 0 ) {

				return $allDVDs = $this->result->fetchAll( PDO::FETCH_ASSOC );
			} else {
				return "No results found for '" . $title . "'";
			}
		} catch
		( PDOException $ex ) {
			$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
		}
	}
}
