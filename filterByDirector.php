<?php

require_once("Models/FilterByDirector.php");

$view = new stdClass();
$view->pageTitle = 'FilterByDirector';

$filterByDirector = new FilterByDirector();

$allDirectors = $filterByDirector->getAllDirectors();
$view->allDirectors = $allDirectors;
if (isset($_POST["directorSelect"])) {
    $result = $filterByDirector->getAllDVDsByDirector($_POST["director"]);
    $view->result = $result;
}

require_once("Views/filterByDirector.phtml");
