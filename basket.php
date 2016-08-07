<?php

$view = new stdClass();
$view->pageTitle = 'Basket';


require_once('Models/Basket.php');

$basket = new Basket();

require_once('Models/Login.php');
$login = new Login();
//Check if user is logged in.
if ($login->isLoggedIn() == true) {
    $basket->getSelectedCDs();

    if(!empty($_SESSION['selectedCDs'])){
        $totalCost = $basket->getTotalCost();
        $view->totalCost = $totalCost;
    }
    require_once("Views/basket.phtml");
} else {
    header("Location: login.php");//redirect to the login page
    exit();
}