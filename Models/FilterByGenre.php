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
                    FROM dvds;";
            $this->result = $this->db->query($sql);

            return $allGenres = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }

    /**
     * @param genre
     * @return allDVDs
     *
     * Get all movies from a genre.
     */
    public function getAllDVDsByGenre($genre)
    {
        try {
            $sql = "SELECT *
                    FROM dvds
                    WHERE genre='" . $genre . "';";

            $this->result = $this->db->query($sql);

            return $allDVDs = $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
        }
    }

}
