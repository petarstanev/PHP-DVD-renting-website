<?php

$view = new stdClass();
$view->pageTitle = 'Basket';


require_once('Models/Basket.php');

$basket = new Basket();

require_once("Views/basket.phtml");