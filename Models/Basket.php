<?php

class Basket {
	var $result = "";
	//public $selectedMovies = array() ;
	public $messages = array();

	public function __construct(){
		require_once('Models/DVD.php');

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	public function checkIfBookIsRented($id){
		foreach( $_SESSION['selectedMovies'] as $movie){
			if($movie->id == $id){
				return true;
			}
		}
		return false;
	}

	public function getSelectedMovies(){

		if(isset($_GET["id"])) {

			$selectedMovieID = htmlspecialchars( $_GET["id"] );
			if (!$this->checkIfBookIsRented($_GET["id"])) {
				$dvd = new DVD( $selectedMovieID );
				array_push( $_SESSION['selectedMovies'], $dvd );
			}
		}
		return $_SESSION['selectedMovies'];
	}



	public function getTotalCost(){
		$totalCost = 0;
		foreach( $_SESSION['selectedMovies'] as $movie){
			$totalCost+=$movie->price;
		}
		return $totalCost;
	}


}