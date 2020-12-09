<?php
session_start();
require 'vendor/autoload.php';
use App\Controller\Controller;
use App\Controller\ErrorsController;
use App\Controller\EventsController;
use App\Controller\UsersController;
use App\Controller\CommentsController;

$action = "";
$controller = new Controller();
$eventsController = new EventsController();
$usersController = new UsersController();
$commentsController = new CommentsController();
if (isset($_GET['action'])) {
    $action = $controller->cleanVar($_GET['action']);
}
try {
    switch ($action) {
        case 'listEvents':
            $eventsController->listEvents();
            break;
        case 'getEventById':
            $eventsController->getEventById();
            break;
        case 'register':
            $usersController->register();
            break;
        case 'login':
            $usersController->login();
            break;
        case 'userDashboard':
            $usersController->userDashboard();
            break;
        case 'logout':
            $usersController->logout();
            break;
        case 'getEventEditor':
            $eventsController->getEventEditor();
            break;
        case 'addEvent':
            $eventsController->addEvent();
            break;
        case 'addComment':
            $commentsController->addComment();
            break;
        default:
            $controller->home();
    }
}
catch(Exception $e) {
    $error = new ErrorsController();
    $error->error($e);
}