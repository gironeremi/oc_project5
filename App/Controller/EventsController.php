<?php
namespace App\Controller;
use App\Model\CommentsManager;
use App\Model\EventsManager;
use App\Model\GamesManager;
use App\Model\PlayersManager;

class EventsController extends Controller
{
    public function listEvents()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = $this->cleanVar($_GET['page']);
        } else {
            $currentPage = 1;
        }
        $eventsManager = new EventsManager();
        $numberOfEvents = $eventsManager->getNumberOfEvents();
        $eventsPerPage = 4;
        $pages = ceil($numberOfEvents / $eventsPerPage);
        $firstEvent = (($currentPage - 1) * $eventsPerPage);
        $events = $eventsManager->listEvents($firstEvent, $eventsPerPage);
        require('View/listEventsView.php');
    }
    public function getEventById()
    {
        $eventId = intval($_GET['event_id']);
        if (is_int($eventId)) {
            $eventsManager = new EventsManager();
            $commentsManager = new CommentsManager();
            $playersManager= new PlayersManager();
            $event = $eventsManager->getEventById($eventId);
            $comments = $commentsManager->listComments($eventId);
            $listPlayers = $playersManager->listPlayers($eventId);
            $players = array_column($listPlayers, 'username');
            require('View/eventView.php');
        }
    }
    public function getEventEditor()
    {
        if (isset($_GET['event_id']) && $_GET['event_id'] > 0) {
            $eventId = $this->cleanVar($_GET['event_id']);
            $eventsManager = new EventsManager();
            $event = $eventsManager->getEventById($eventId);
        }
        $gamesManager = new GamesManager();
        $games = $gamesManager->listGames();
        require('View/eventEditorView.php');
    }
    public function addEvent()
    {
        $userId = $this->cleanVar($_SESSION['userId']);
        $eventName = $this->cleanVar($_POST['eventName']);
        $eventInformations = $this->cleanVar($_POST['eventInformations']);
        $eventDate = $this->cleanVar($_POST['eventDate']);
        $gameId = $this->cleanVar($_POST['game_id']);
        if (empty($eventName) || empty($eventInformations) || empty($eventDate) || empty($gameId) || empty($userId))
        {
            throw new \Exception('Toutes les données ne sont pas saisies!');
        } else {
            $eventsManager = new EventsManager();
            $affectedLines = $eventsManager->addEvent($eventName, $userId, $gameId, $eventInformations, $eventDate);
            if ($affectedLines === false) {
                throw new \Exception('impossible d\'ajouter cette aventure');
            } else {
                $successMessage = "Bravo! Votre séance est fixée! ";
                require('View/template.php');
            }
        }

    }
    public function updateEvent()
    {
        $eventId = $this->cleanVar($_GET['event_id']);
        $eventName = $this->cleanVar($_POST['eventName']);
        $eventInformations = $this->cleanVar($_POST['eventInformations']);
        $eventDate = $this->cleanVar($_POST['eventDate']);
        $gameId = $this->cleanVar($_POST['game_id']);
        if (empty($eventId) || empty($eventName) || empty($eventInformations) || empty($eventDate) || empty($gameId))
        {
            throw new \Exception('Toutes les données ne sont pas saisies!');
        } else {
            $eventsManager = new EventsManager();
            $affectedLines = $eventsManager->updateEvent($eventId, $eventName, $gameId, $eventInformations, $eventDate);
            if ($affectedLines === false) {
                throw new \Exception('impossible de modifier cette aventure');
            } else {
                $successMessage = "Bravo! Votre séance est modifiée! ";
                require('View/template.php');
            }
        }
    }
    public function deleteEvent()
    {
        $eventId = $this->cleanVar($_GET['event_id']);
        if (empty($eventId)) {
            throw new \Exception('Erreur lors de la suppression.');
        } else {
            $eventsManager = new EventsManager();
            $eventsManager->DeleteEvent($eventId);
            $successMessage = 'La séance est annulée!';
            require('View/template.php');
        }
    }
}