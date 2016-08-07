<?php
require_once("Core/Model.php");

/**
 * Model FilterByTitle
 */
class FilterByTitle extends Model
{
    var $result = '';
    var $messages = array();

    /**
     * @param $title
     * @return allCDs
     *
     * Get all movies that contain that title.
     */
    public function getAllCDsByTitle($title)
    {
        try {
            $sql = "	SELECT *
					  	FROM cds
						WHERE title
						LIKE '%" . $title . "%';";

            $this->result = $this->db->query($sql);
            if ($this->result->rowCount() > 0) {

                return $allCDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return "No results found for '" . $title . "'";
            }
        } catch
        (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }
}
