<?php

class Basket {
	var $result = "";
	//public $selectedMovies = array() ;
	public $messages = array();

	public function __construct() {
		require_once('Models/DVD.php');
		require_once('Models/Login.php');
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ( isset( $_POST["payAndLogout"] ) ) {
			$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );

			$email  = mysql_real_escape_string( $_SESSION['email'] );

			$sql    = "SELECT id
                    FROM users
                    WHERE email = '" . $email . "';";
			$stmt = $db->prepare($sql);

			$stmt->execute();
			$row = $stmt->fetch();



			foreach( $_SESSION['selectedMovies'] as $movie){
				$sql    = "UPDATE dvds
				SET renterID='" . $row["id"] . "'
				WHERE id='".$movie->id."';";
				$db->query( $sql );
			}

			session_destroy();
			header('Location: '.$_SERVER['REQUEST_URI']);
			$this->messages[] = "You have been logged out.";
		}
	}

	public function checkIfMovieIsRented($id){
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
			if (!$this->checkIfMovieIsRented($_GET["id"])) {
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