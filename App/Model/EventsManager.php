<?php
namespace App\Model;
class EventsManager extends Manager
{
    public function listEvents($firstEvent, $eventsPerPage)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT *,DATE_FORMAT(eventDate,\'%d/%m/%Y\')AS eventDate_fr FROM events INNER JOIN users ON events.user_id = users.user_id
INNER JOIN games ON events.game_id = games.game_id WHERE eventDate > NOW() ORDER BY eventDate LIMIT :first_event, :events_per_page');
        $req->bindValue(':first_event', $firstEvent, \PDO::PARAM_INT);
        $req->bindValue(':events_per_page', $eventsPerPage, \PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function listEventsById($userId)
    {
        $db = $this->getDbConnect();
        //joindre dans la requête SQL les bonnes informations
        $events = $db->prepare('SELECT *, DATE_FORMAT(eventDate,\'%d/%m/%Y\')AS eventDate_fr FROM events INNER JOIN users ON events.user_id = users.user_id
INNER JOIN games ON events.game_id = games.game_id WHERE events.user_id = ? AND eventDate > NOW() ORDER BY eventDate');
        $events->execute(array($userId));
        return $events->fetchAll();
    }
    public function getNumberOfEvents()
    {
        $db = $this->getDbConnect();
        $req = $db->query('SELECT COUNT(*) AS numberOfEvents FROM events');
        return $numberOfEvents = (int)$req->fetchColumn();
    }
    /*
      * EVENT CRUD
      */
    public function addEvent($eventName, $userId, $gameId, $eventInformations, $eventDate)
    {
        $db = $this->getDbConnect();
        $newEvent = $db->prepare("INSERT INTO events(eventName, user_id, game_id, informations, eventDate) VALUES (?,?,?,?,?)");
        return $newEvent->execute(array($eventName, $userId, $gameId, $eventInformations, $eventDate));
    }
    public function getEventById($eventId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT *, DATE_FORMAT(eventDate,\'%d/%m/%Y\')AS eventDate_fr FROM events INNER JOIN users ON events.user_id = users.user_id
INNER JOIN games ON events.game_id = games.game_id WHERE events.event_id = ?');
        $req->execute(array($eventId));
        return $req->fetch();
    }
    public function updateEvent($eventId, $eventName, $gameId, $eventInformations, $eventDate)
    {
        $db = $this->getDbConnect();
        $updateEvent = $db->prepare('UPDATE events SET eventName = ?, game_id = ?, informations = ?, eventDate = ? WHERE event_id = ?');
        $updateEvent->execute(array($eventName, $gameId, $eventInformations, $eventDate, $eventId));
    }
    public function DeleteEvent($eventId)
    {
        $db = $this->getDbConnect();
        $deleteEvent = $db->prepare('DELETE FROM events WHERE event_id = ?');
        $deleteEvent->execute(array($eventId));
    }
}