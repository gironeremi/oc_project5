<?php
namespace App\Controller;
use App\Model\EventsManager;

class EventsController extends Controller
{
    public function listEvents()
    {
        $eventsManager = new EventsManager();
        $events = $eventsManager->listEvents();
        require('View/listEventsView.php');
    }
}