<?php
namespace App\Controller;
use App\Model\GamesManager;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        if ($_SESSION['role'] === 'admin') {
            $gamesManager = new GamesManager();
            $games = $gamesManager->listGames();
            require('View/adminDashboardView.php');
        } else {
            throw new \Exception('Accès non autorisé!');
        }
    }
}