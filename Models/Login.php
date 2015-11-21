<?php

class Login {
	var $email = '';
	var $password = '';
	var $messages = array();

	public function __construct() {
		session_start();

		if ( isset( $_POST["logout"] ) ) {
			$this->logout();
		} // login via post data (if user just submitted a login form)
		elseif ( isset( $_POST["login"] ) ) {
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
				$db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );

				$email  = mysql_real_escape_string( $this->email );
				$sql    = "SELECT *
                    FROM users
                    WHERE email = '" . $email . "';";
				$result = $db->query( $sql );

				// if this user exist
				if ( $result->rowCount() == 1 ) {

					$result_row = $result->fetch( PDO::FETCH_ASSOC );

					if ( strcmp( md5($this->password), $result_row['password'] ) == 0 ) {
						$_SESSION['email'] = $result_row['email'];//remove
						$_SESSION['login'] = 1;
						$_SESSION['id'] = $result_row['id'];
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
		$_SESSION = array();
		session_destroy();

		$this->messages[] = "You have been logged out.";
	}


	/**
	 * simply return the current state of the user's login
	 * @return boolean user's login status
	 */
	public function isLoggedIn() {
		if ( isset( $_SESSION['login'] )) {
			return true;
		}

		return false;
	}
}
