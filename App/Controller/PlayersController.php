<?php
namespace App\Controller;
use App\Model\PlayersManager;

class PlayersController extends Controller
{
    public function addPlayer()
    {
        $eventId = $this->cleanVar($_GET['event_id']);
        $userId = $this->cleanVar($_SESSION['userId']);
        if (empty($eventId) || (empty($userId))) {
            throw new \Exception('Problème lors du traitement');
        } else {
            $playersManager = new PlayersManager();
            $playersManager->addPlayer($eventId, $userId);
            $successMessage = "Vous avez rejoint cette table!";
            require('View/template.php');
        }
    }

    public function deletePlayer()
    {
        $eventId = $this->cleanVar($_GET['event_id']);
        $userId = $this->cleanVar($_SESSION['userId']);
        if (empty($eventId) || (empty($userId))) {
            throw new \Exception('Problème lors du traitement');
        } else {
            $playersManager = new PlayersManager();
            $playersManager->deletePlayer($eventId, $userId);
            $successMessage = "Vous avez quitté cette table! L'organisateur va être triste :'(";
            require('View/template.php');
        }
    }
}