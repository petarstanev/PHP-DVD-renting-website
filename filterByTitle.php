<?php

require_once("Models/FilterByTitle.php");

$view = new stdClass();
$view->pageTitle = 'FilterByTitle';

$filterByTitle = new FilterByTitle();

if (isset($_POST["titleSelect"])) {
    $result = $filterByTitle->getAllCDsByTitle($_POST["title"]);
    $view->result = $result;
}

require_once("Views/filterByTitle.phtml");
