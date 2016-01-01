<?php

$view = new stdClass();
$view->pageTitle = 'Login';


require_once('Models/Login.php');

$login = new Login();
if ($login->isLoggedIn()==true) {
	require_once("views/login.phtml");

} else {
	$view->messages = $login->messages;
	require_once("views/not_login.phtml");
}
