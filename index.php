<?php
session_start();
require 'vendor/autoload.php';
use App\Controller\Controller;
use App\Controller\ErrorsController;
use App\Controller\EventsController;
use App\Controller\UsersController;

$action = "";
$controller = new Controller();
$eventsController = new EventsController();
$usersController = new UsersController();
if (isset($_GET['action'])) {
    $action = $controller->cleanVar($_GET['action']);
}
try {
    switch ($action) {
        case 'listEvents':
            $eventsController->listEvents();
            break;
        case 'register':
            $usersController->register();
            break;
        case 'login':
            $usersController->login();
            break;
        case 'logout':
            $usersController->logout();
            break;
        default:
            $eventsController->listEvents();
    }
}
catch(Exception $e) {
    $error = new ErrorsController();
    $error->error($e);
}