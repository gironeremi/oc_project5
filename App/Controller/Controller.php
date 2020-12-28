<?php
namespace App\Controller;
use App\Model\GamesManager;

class Controller
{
    public function cleanVar($str)
    {
        if (isset($str)) {
            return trim(htmlspecialchars(($str)));
        } else {
            return "";
        }
    }
    public function home()
    {
        $gamesManager = new GamesManager();
        $games = $gamesManager->listSomeGames();
        require('View/homeView.php');
    }
}