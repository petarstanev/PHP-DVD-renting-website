<?php
require_once("Core/Model.php");

/**
 * Model AllDVDs used fro getting all dvds information from DB.
 */
class AllCDs extends Model
{
    var $result = '';
    var $messages = array();

    /**
     * Get all dvds from database.
     */
    public function getAllCDs()
    {
        try {
            $sql = "SELECT *
                    FROM cds;";
            $this->result = $this->db->query($sql);

            return $allCDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }
}