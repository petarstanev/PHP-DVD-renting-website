<?php

$view = new stdClass();
$view->pageTitle = 'Basket';


require_once('Models/Basket.php');

$basket = new Basket();


if ($basket->isLoggedIn() == true) {
	require_once("views/login.phtml");
} else {
	require_once("views/not_login.phtml");
}
