<?php

require_once("Models/FilterByGenre.php");

$view = new stdClass();
$view->pageTitle = 'FilterByGenre';

$filterByGenre = new FilterByGenre();

$allGenres = $filterByGenre->getAllGenres();
$view->allGenres = $allGenres;
if (isset($_POST["genreSelect"])) {
    $result = $filterByGenre->getAllDVDsByGenre($_POST["genre"]);
    $view->result = $result;
}

require_once("Views/filterByGenre.phtml");
