<?php

require_once("Models/allDVDs.php");

$view = new stdClass();
$view->pageTitle = 'All DVDs';

$allDVDs = new AllDVDs();
$result = $allDVDs->getAllDVDs();
$view->result = $result;

require_once("Views/allDVDs.phtml");
