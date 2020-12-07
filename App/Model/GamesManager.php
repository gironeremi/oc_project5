<?php
namespace App\Model;
class GamesManager extends Manager
{
    public function listGames()
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM games');
        $req->execute();
        return $req;
    }
}