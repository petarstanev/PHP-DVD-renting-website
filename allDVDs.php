<?php

require_once("Models/allDVDs.php");

$view = new stdClass();
$view->pageTitle = 'Login';

$allDVDs = new AllDVDs();
$result = $allDVDs->getAllDVDs();
$view->result = $result;

require_once("Views/allDVDs.phtml");
