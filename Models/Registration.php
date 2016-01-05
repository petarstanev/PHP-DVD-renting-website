<?php
require_once( "Core/Model.php" );

class Registration extends Model {
	public $messages = array();

	public function __construct() {
		parent::__construct();
		if ( isset( $_POST["submit"] ) ) {
			$this->registerNewUser();
		}
	}

	private function registerNewUser() {
		if ( empty( $_POST['email'] ) ) {
			$this->messages[] = "Empty email";
		} elseif ( empty( $_POST['password'] ) ) {
			$this->messages[] = "Empty Password";
		} elseif ( strlen( $_POST['password'] ) < 6 ) {
			$this->messages[] = "Password has a minimum length of 6 characters";
		} elseif ( strlen( $_POST['email'] ) > 32 || strlen( $_POST['email'] ) < 2 ) {
			$this->messages[] = "Email cannot be shorter than 2 or longer than 64 characters";
		} elseif ( strlen( $_POST['email'] ) > 64 ) {
			$this->messages[] = "Email cannot be longer than 64 characters";
		} elseif ( empty( $_POST['address'] ) ) {
			$this->messages[] = "Your address is empty.";
		} elseif ( empty( $_POST['mobile'] ) ) {
			$this->messages[] = "Your mobile is empty.";
		} elseif ( ! preg_match( '/^[0-9,+]+/', $_POST['mobile'] ) ) {
			$this->messages[] = "Your mobile is not in correct format. I must be + and 9 to 13 numbers.";
		} else {
			try {
				$email    = mysql_real_escape_string( $_POST['email'] );
				$password = mysql_real_escape_string( md5( $_POST['password'] ) );
				$address  = mysql_real_escape_string( $_POST['address'] );
				$mobile   = mysql_real_escape_string( $_POST['mobile'] );


				$sql         = "SELECT * FROM users WHERE email = '" . $email . "';";
				$check_email = $this->db->query( $sql );
				if ( $check_email->rowCount() == 1 ) {
					$this->messages[] = "This email is already register.";
				} else {
					// write new user's data into database
					$sql         = "INSERT INTO users (email, password, address,mobile)
                            VALUES('" . $email . "', '" . $password . "', '" . $address . "', '" . $mobile . "');";
					$user_insert = $this->db->query( $sql );
					// if user has been added successfully
					if ( $user_insert ) {
						$this->messages[] = "Your account is created. You can now <a href='login.php'> Login.</a>";
					} else {
						$this->messages[] = "There was a problem with your registration.";
					}
				}
			} catch ( PDOException $ex ) {
				$this->messages[] = "Error with the database.<br>" . $ex->getMessage();
			}
		}
	}
}