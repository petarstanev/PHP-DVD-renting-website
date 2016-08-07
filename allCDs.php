<?php

require_once("Models/AllCDs.php");

$view = new stdClass();
$view->pageTitle = 'All DVDs';

$allCDs = new AllCDs();
$result = $allCDs->getAllCDs();
$view->result = $result;

require_once("Views/allCDs.phtml");
