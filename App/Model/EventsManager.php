<?php
namespace App\Model;
class EventsManager extends Manager
{
    public function listEvents()
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM events');
        $req->execute();
        return $req;
    }
}