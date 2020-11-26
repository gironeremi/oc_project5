<?php
session_start();
require 'vendor/autoload.php';
use App\Controller\Controller;
use App\Controller\ErrorsController;
use App\Controller\EventsController;

$action = "";
$controller = new Controller();
$eventsController = new EventsController();
if (isset($_GET['action'])) {
    $action = $controller->cleanVar($_GET['action']);
}
try {
    switch ($action) {
        case 'listEvents':
            $eventsController->listEvents();
            break;
        default:
            $eventsController->listEvents();
    }
}
catch(Exception $e) {
    $error = new ErrorsController();
    $error->error($e);
}