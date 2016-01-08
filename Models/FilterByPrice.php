<?php
require_once("Core/Model.php");

/**
 * Model FilterByPrice
 */
class FilterByPrice extends Model
{
    var $result = '';
    var $messages = array();

    /**
     * @param $price
     * @return allDVDs
     *
     * Get all movies with that price
     */
    public function getAllDVDsByPrice($price)
    {
        try {
            $sql = "	SELECT *
					  	FROM dvds
						WHERE priceBand='" . $price . "';";

            $this->result = $this->db->query($sql);
            if ($this->result->rowCount() > 0) {

                return $allDVDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return "No results found for '" . $price . "'";
            }
        } catch
        (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }
}
