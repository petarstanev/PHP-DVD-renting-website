<?php
require_once("Core/Model.php");

/**
 * Model FilterByDirector
 */
class FilterByWriter extends Model
{
    var $result = '';
    var $allWriters = array();
    var $messages = array();

    /**
     * @return allWritesrs
     * Return all unique directors names.
     */
    public function getAllWriters()
    {
        try {
            $sql = "SELECT DISTINCT(writer)
                    FROM cds;";
            $this->result = $this->db->query($sql);

            return $allWriters = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }

    /**
     * @param $writer
     * @return allCDs
     *
     * Get all movies from a writer.
     */
    public function getAllCDsByWriter($writer)
    {
        try {
            $sql = "SELECT *
                    FROM cds
                    WHERE writer='" . $writer . "';";

            $this->result = $this->db->query($sql);

            return $allCDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }
}
