<?php
namespace App\Model;
class PlayersManager extends Manager
{
    public function addPlayer($eventId, $userId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('INSERT INTO events_has_users (event_id, user_id) VALUES (?,?)');
        return $req->execute(array($eventId, $userId));
    }
    public function deletePlayer($eventId, $userId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('DELETE events_has_users.* FROM events_has_users WHERE event_id = ? AND user_id = ?');
        return $req->execute(array($eventId, $userId));
    }
    public function listPlayers($eventId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT users.username FROM users INNER JOIN events_has_users ON users.user_id = events_has_users.user_id WHERE events_has_users.event_id = ?');
        $req->execute(array($eventId));
        return $req->fetchAll();
    }
    public function listEventsByPlayer($userId)
    {
        $db =$this->getDbConnect();
        $req = $db->prepare('SELECT events.*, DATE_FORMAT(eventDate,\'%d/%m/%Y\')AS eventDate_fr FROM events INNER JOIN events_has_users ON events_has_users.event_id = events.event_id WHERE events_has_users.user_id = ? ORDER BY eventDate');
        $req->execute(array($userId));
        return $req->fetchAll();
    }
}