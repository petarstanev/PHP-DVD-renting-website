<?php

/**
 * Created by PhpStorm.
 * User: Petar
 * Date: 31/12/2015
 * Time: 00:33
 */
class DVD {
	public $id;
	public $title;
	public $cast;
	public $director;
	public $genre;
	public $synopsis;
	public $image;
	public $renterID;
	public $year;
	public $priceBand;
	public $price;
	/**
	 * DVD constructor.
	 *
	 * @param $priceBand
	 * @param $id
	 * @param $title
	 * @param $cast
	 * @param $director
	 * @param $genre
	 * @param $synopsis
	 * @param $image
	 * @param $renterID
	 * @param $year
	 */
	public function __construct( $id ) {

		$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );

		$id  = mysql_real_escape_string( $id );
		$sql    = "SELECT *
                    FROM dvds
                    WHERE id = '" . $id . "';";
		$result = $db->query( $sql );
		$result_row = $result->fetch( PDO::FETCH_ASSOC );

		$this->id        = $id;
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
		$this->title     = $result_row['title'];
		$this->cast      = $result_row['cast'];
		$this->director  = $result_row['director'];
		$this->genre     = $result_row['genre'];
		$this->synopsis  = $result_row['synopsis'];
		$this->image     = $result_row['image'];
		$this->renterID  = "";
		$this->year      = $result_row['year'];
	}




}