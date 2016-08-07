<?php

require_once("Models/FilterByWriter.php");

$view = new stdClass();
$view->pageTitle = 'FilterByWriter';

$filterByWriter = new FilterByWriter();

$allWriters = $filterByWriter->getAllWriters();
$view->allWriters = $allWriters;
if (isset($_POST["directorSelect"])) {
    $result = $filterByWriter->getAllCDsByWriter($_POST["writer"]);
    $view->result = $result;
}

require_once("Views/filterByWriter.phtml");
