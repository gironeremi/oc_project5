<?php
namespace App\Controller;
use App\Model\CommentsManager;
use App\Model\EventsManager;
use App\Model\GamesManager;

class EventsController extends Controller
{
    public function listEvents()
    {
        $eventsManager = new EventsManager();
        $events = $eventsManager->listEvents();
        require('View/listEventsView.php');
    }
    public function getEventById()
    {
        $eventId = intval($_GET['event_id']);
        if (is_int($eventId)) {
            $eventsManager = new EventsManager();
            $commentsManager = new CommentsManager();
            $event = $eventsManager->getEventById($eventId);
            $comments = $commentsManager->listComments($eventId);
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
    //à modifier, bien entendu
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