<?php
namespace App\Model;
class EventsManager extends Manager
{
    public function listEvents()
    {
        $db = $this->getDbConnect();
        //joindre dans la requête SQL les bonnes informations
        $req = $db->prepare('SELECT * FROM events INNER JOIN users ON events.user_id = users.user_id
INNER JOIN games ON events.game_id = games.game_id');
        $req->execute();
        return $req;
    }
    public function addEvent($eventName, $userId, $gameId, $eventInformations, $eventDate)
    {
        $db = $this->getDbConnect();
        $newEvent = $db->prepare("INSERT INTO events(eventName, user_id, game_id, informations, eventDate) VALUES (?,?,?,?,?)");
        return $newEvent->execute(array($eventName, $userId, $gameId, $eventInformations, $eventDate));
        //return $affectedLines = $newEvent->execute(array($postTitle, $postContent, $postPublishDate));
    }
}