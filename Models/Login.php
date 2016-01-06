<?php
require_once("Core/Model.php");

/**
 * Model Login
 */
class Login extends Model
{
    var $email = '';
    var $password = '';
    var $messages = array();

    /**
     * Constructor for Login.
     * Check for Session.
     * Check for post logout and login.
     */
    public function __construct()
    {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_POST["logout"])) {
            $this->logout();
        }
        if (isset($_POST["login"])) {
            $this->login();
        }
    }

    /**
     * Login user by getting post email and password.
     * Check them in database and if it correct add their email to Session.
     */
    public function login()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];


        // check login form contents
        if (empty($this->email)) {
            $this->messages[] = "Email is empty.";
        } elseif (empty($this->password)) {
            $this->messages[] = "Password is empty.";
        } else {
            try {
                $email = mysql_real_escape_string($this->email);
                $sql = "SELECT *
                    FROM users
                    WHERE email = '" . $email . "';";
                $result = $this->db->query($sql);

                // if this user exist
                if ($result->rowCount() == 1) {

                    $result_row = $result->fetch(PDO::FETCH_ASSOC);

                    if (strcmp(md5($this->password), $result_row['password']) == 0) {
                        $_SESSION['email'] = $email;
                        $_SESSION['selectedMovies'] = array();


                        $this->messages[] = "Login successfully";
                    } else {
                        $this->messages[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->messages[] = "This user does not exist.";
                }
            } catch (PDOException $ex) {
                $this->messages[] = "Error with the database.<br>" . $ex->getMessage();
            }
        }
    }

    /**
     * Logout a user.
     * Destroy the session and refresh the page.
     */
    public function logout()
    {
        session_destroy();
        header('Location: ' . $_SERVER['REQUEST_URI']);
        $this->messages[] = "You have been logged out.";
    }


    /**
     * Check if user is logged in.
     */
    public function isLoggedIn()
    {
        if (isset($_SESSION['email'])) {
            return true;
        }
        return false;
    }
}
