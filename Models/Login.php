<?php
require_once("Core/Model.php");

class Login extends Model{
	var $email = '';
	var $password = '';
	var $messages = array();

	public function __construct() {
		parent::__construct();
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ( isset( $_POST["logout"] ) ) {
			$this->logout();
		} // login via post data (if user just submitted a login form)
		if ( isset( $_POST["login"] ) ) {
			$this->login();
		}
	}

	public function login() {
		$this->email    = $_POST['email'];
		$this->password = $_POST['password'];


		// check login form contents
		if ( empty( $this->email ) ) {
			$this->messages[] = "Email is empty.";
		} elseif ( empty( $this->password ) ) {
			$this->messages[] = "Password is empty.";
		} else {
			try {
				$email  = mysql_real_escape_string( $this->email );
				$sql    = "SELECT *
                    FROM users
                    WHERE email = '" . $email . "';";
				$result = $this->db->query( $sql );

				// if this user exist
				if ( $result->rowCount() == 1 ) {

					$result_row = $result->fetch( PDO::FETCH_ASSOC );

					if ( strcmp( md5($this->password), $result_row['password'] ) == 0 ) {
						$_SESSION['email'] = $email;
						$_SESSION['selectedMovies'] = array();



						$this->messages[] = "Login successfully";
					} else {
						$this->messages[] = "Wrong password. Try again.";
					}
				} else {
					$this->messages[] = "This user does not exist.";
				}
			} catch ( PDOException $ex ) {
				$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
			}
		}
	}

	public function logout() {
		session_destroy();
		header('Location: '.$_SERVER['REQUEST_URI']);
		$this->messages[] = "You have been logged out.";
	}


	/**
	 * simply return the current state of the user's login
	 * @return boolean user's login status
	 */
	public function isLoggedIn() {
		//var_dump($_SESSION);

		if(isset($_SESSION['email'])) {
			return true;
		}
		return false;
	}
}
