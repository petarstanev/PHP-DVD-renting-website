<?php
require_once("Core/Model.php");

/**
 * Model FilterByDirector
 */
class FilterByDirector extends Model
{
    var $result = '';
    var $allDirectors = array();
    var $messages = array();

    /**
     * @return allDirectors
     * Return all unique directors names.
     */
    public function getAllDirectors()
    {
        try {
            $sql = "SELECT DISTINCT(director)
                    FROM dvds;";
            $this->result = $this->db->query($sql);

            return $allDirectors = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }

    /**
     * @param $director
     * @return allDVDs
     *
     * Get all movies from a director.
     */
    public function getAllDVDsByDirector($director)
    {
        try {
            $sql = "SELECT *
                    FROM dvds
                    WHERE director='" . $director . "';";

            $this->result = $this->db->query($sql);

            return $allDVDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }
}
