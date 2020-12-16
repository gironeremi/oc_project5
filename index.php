<?php
session_start();
require 'vendor/autoload.php';
use App\Controller\Controller;
use App\Controller\ErrorsController;
use App\Controller\EventsController;
use App\Controller\UsersController;
use App\Controller\CommentsController;
use \App\Controller\PlayersController;
use \App\Controller\AdminController;
use \App\Controller\GamesController;
$action = "";
$controller = new Controller();
$eventsController = new EventsController();
$usersController = new UsersController();
$commentsController = new CommentsController();
$playersController = new PlayersController();
$adminController = new AdminController();
$gamesController = new GamesController();
if (isset($_GET['action'])) {
    $action = $controller->cleanVar($_GET['action']);
}
try {
    switch ($action) {
    /* EVENTS */
        case 'listEvents':
            $eventsController->listEvents();
            break;
        case 'getEventById':
            $eventsController->getEventById();
            break;
    /* USERS */
            case 'register':
            $usersController->register();
            break;
        case 'login':
            $usersController->login();
            break;
        case 'userDashboard':
            $usersController->userDashboard();
            break;
        case 'addComment':
            $commentsController->addComment();
            break;
        case 'logout':
            $usersController->logout();
            break;
    /* CRUD EVENT */
        case 'getEventEditor':
            $eventsController->getEventEditor();
            break;
        case 'addEvent':
            $eventsController->addEvent();
            break;
        case 'updateEvent':
            $eventsController->updateEvent();
            break;
        case 'deleteEvent':
            $eventsController->deleteEvent();
            break;
    /* PLAYERS */
        case 'addPlayer':
            $playersController->addPlayer();
            break;
        case 'deletePlayer':
            $playersController->deletePlayer();
            break;
    /* ADMIN */
        case 'adminDashboard':
            $adminController->adminDashboard();
            break;
    /* CRUD GAMES */
        case 'getGameEditor':
            $gamesController->getGameEditor();
            break;
        case 'addGame':
            $gamesController->addGame();
            break;
        case 'updateGame':
            $gamesController->updateGame();
            break;
        case 'deleteGame':
            $gamesController->deleteGame();
            break;
        default:
            $controller->home();
    }
}
catch(Exception $e) {
    $error = new ErrorsController();
    $error->error($e);
}