<?php
namespace App\Model;
class GamesManager extends Manager
{
    public function listGames()
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM games');
        $req->execute();
        return $req->fetchAll();
    }
    public function getGameById($gameId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM games WHERE game_id = ?');
        $req->execute(array($gameId));
        return $req->fetch();
    }
    public function listSomeGames()
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM games LIMIT 0,3');
        $req->execute();
        return $req;
    }
    public function addGame($gameName, $style)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('INSERT INTO games(gameName, style) VALUES (?,?)');
        return $req->execute(array($gameName, $style));
    }
    public function updateGame($gameName, $style, $gameId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('UPDATE games SET gameName = ?, style = ? WHERE game_id = ?');
        $req->execute(array($gameName, $style, $gameId));
    }
    public function deleteGame($gameId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('DELETE FROM games WHERE game_id = ?');
        return $req->execute(array($gameId));
    }
}