<?php
require_once("Core/Model.php");

class FilterByTitle extends Model{
	var $result = '';
	var $messages = array();

	public function getAllDVDsByTitle( $title ) {
		try {
			$sql = "	SELECT *
					  	FROM dvds
						WHERE title
						LIKE '%" . $title . "%';";

			$this->result = $this->db->query( $sql );
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
