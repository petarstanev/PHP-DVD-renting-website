<?php
require_once("Core/Model.php");
/**
 * Model Basket
 */
class Basket extends Model
{
    var $result = "";
    public $messages = array();
    /**
     * Basket Constructor.
     * Check-session and check if payAndLogout is pressed.
     */
    public function __construct()
    {
        parent::__construct();
        require_once('Models/CD.php');
        require_once('Models/Login.php');
        if (isset($_POST["payAndLogout"])) {
            $this->payAndLogout();
        }
    }
    /**
     * Get user id and movie id and use rentMovies()
     * Output a logout message and refresh the page.
     */
    public function payAndLogout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $email = mysql_real_escape_string($_SESSION['email']);
        $sql = "SELECT id
                    FROM users
                    WHERE email = '" . $email . "';";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();

        $this->rentMovies($row["id"]);


        session_destroy();
        header('Location: ' . $_SERVER['REQUEST_URI']);
        $this->messages[] = "You have been logged out.";
    }
    /**
     * @param $user_id
     * Update DB for every movie rented by user.
     */
    private function rentMovies($user_id)
    {

        foreach ($_SESSION['selectedCDs'] as $movie) {
            $movie=unserialize($movie);
            $sql = "UPDATE cds
				SET clientRenting='" . $user_id . "'
				WHERE id='" . $movie->id . "';";

            $this->db->query($sql);
        }
    }
    /**
     * @param $id
     * @return bool
     * Check if movie is rented.
     */
    private function checkIfMovieIsRented($id)
    {
        if(!empty($_SESSION['selectedCDs'])) {
            foreach ($_SESSION['selectedCDs'] as $movie) {
                $movie = unserialize($movie);
                if ($movie->id == $id) {
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * @return $_SESSION['selectedMovies']
     * Get selected movies if there is movie id in GET then add it to Session first.
     */
    public function getSelectedCDs()
    {
        if (isset($_GET["id"]))
        {
            $selectedMovieID = htmlspecialchars($_GET["id"]);
            if (!$this->checkIfMovieIsRented($_GET["id"])) {
                $cd = new CD($selectedMovieID);
                if( !isset($_SESSION['selectedCDs']) ) {
                    $_SESSION['selectedCDs'] = array();
                }
                array_push($_SESSION['selectedCDs'], serialize($cd));
            }
        }
    }
    /**
     * @return totalCost
     * Retrun total cost of all selected movies.
     */
    public function getTotalCost()
    {
        $totalCost = 0;
        foreach ($_SESSION['selectedCDs'] as $movie) {
            $movie= unserialize($movie);
            $totalCost += $movie->price;
        }
        return $totalCost;
    }
}