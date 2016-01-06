<?php

$view = new stdClass();
$view->pageTitle = 'Basket';


require_once('Models/Basket.php');

$basket = new Basket();

require_once('Models/Login.php');
$login = new Login();
//Check if user is logged in.
if ($login->isLoggedIn() == true) {
    $selectedMovies = $basket->getSelectedMovies();
    $totalCost = $basket->getTotalCost();
    $view->totalCost = $totalCost;
    $view->selectedMovies = $selectedMovies;
    require_once("Views/basket.phtml");
} else {
    require_once("Views/not_login.phtml");
}