<?php
require_once("Core/Model.php");

/**
 * Model DVD
 */
class CD extends Model
{
    public $id;
    public $title;
    public $artist;
    public $writer;
    public $genre;
    public $synopsis;
    public $image;
    public $clientRenting;
    public $year;
    public $priceBand;
    public $price;

    /**
     * DVD constructor.
     *
     * @param $priceBand
     * @param $id
     * @param $title
     * @param $artist
     * @param $writer
     * @param $genre
     * @param $synopsis
     * @param $image
     * @param $renterID
     * @param $year
     */

    /**
     * @param $id
     *
     * Create cd object from id.
     */
    public function __construct($id)
    {
        parent::__construct();
        $id = mysql_real_escape_string($id);
        $sql = "SELECT *
                    FROM cds
                    WHERE id = '" . $id . "';";

        $result = $this->db->query($sql);

        $result_row = $result->fetch(PDO::FETCH_ASSOC);


        $this->id = $id;
        $this->priceBand = $result_row['priceBand'];
        switch ($this->priceBand) {
            case "A":
                $this->price = 3.50;
                break;
            case "B":
                $this->price = 2.50;
                break;
            case "C":
                $this->price = 1;
                break;
        }

        $this->title = $result_row['title'];
        $this->artist = $result_row['artist'];
        $this->writer = $result_row['writer'];
        $this->genre = $result_row['genre'];
        $this->synopsis = $result_row['synopsis'];
        $this->image = $result_row['image'];
        if(!is_null($result_row['clientRenting'])){
        //$this->renterID = $result_row['renterID'];
            $this->clientRenting="";
        }else{
            $this->clientRenting="";
        }
        $this->year = $result_row['year'];

        $this->db=null;
    }


}