<?php

$view = new stdClass();
$view->pageTitle = 'Register';

require_once('Models/Registration.php');
$registration = new Registration();

require_once("views/registration.phtml");