<?php
require_once("Core/Model.php");

/**
 * Model FilterByGenre
 */
class FilterByGenre extends Model
{
    var $result = '';
    var $allGenres = array();
    var $messages = array();

    /**
     * @return allGenres
     * Return all unique Genres.
     */
    public function getAllGenres()
    {
        try {
            $sql = "SELECT DISTINCT(genre)
                    FROM cds;";
            $this->result = $this->db->query($sql);

            return $allGenres = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }

    /**
     * @param genre
     * @return allCDs
     *
     * Get all cds from a genre.
     */
    public function getAllCDsByGenre($genre)
    {
        try {
            $sql = "SELECT *
                    FROM cds
                    WHERE genre='" . $genre . "';";

            $this->result = $this->db->query($sql);
            return $allCDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }

}
