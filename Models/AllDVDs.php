<?php
require_once("Core/Model.php");

/**
 * Model AllDVDs used fro getting all dvds information from DB.
 */
class AllDVDs extends Model
{
    var $result = '';
    var $messages = array();

    /**
     * Get all dvds from database.
     */
    public function getAllDVDs()
    {
        try {
            $sql = "SELECT *
                    FROM dvds;";
            $this->result = $this->db->query($sql);

            return $allDVDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }
}