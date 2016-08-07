<?php

require_once("Models/FilterByPrice.php");

$view = new stdClass();
$view->pageTitle = 'FilterByPrice';

$filterByPrice = new FilterByPrice();

if (isset($_POST["priceSelect"])) {
    $result = $filterByPrice->getAllCDsByPrice($_POST["price"]);
    $view->result = $result;
}
require_once("Views/filterByPrice.phtml");
