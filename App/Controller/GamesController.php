<?php
namespace App\Controller;
use App\Model\GamesManager;

class GamesController extends Controller
{
    //ici ajout vérification de l'admin pour toutes les méthodes
    public function addGame()
    {
        $gameName = $this->cleanVar($_POST['gameName']);
        $style = $this->cleanVar($_POST['style']);
        if (empty($gameName) || empty($style)) {
            throw new \Exception('Toutes les données ne sont pas saisies!');
        } else {
            $gamesManager = new GamesManager();
            $newGame = $gamesManager->addGame($gameName, $style);
            if ($newGame === false) {
                throw new \Exception('impossible d\'ajouter ce jeu!');
            } else {
                $successMessage = "Nouveau jeu de rôle ajouté!";
                require('View/template.php');
            }
        }
    }
    public function updateGame()
    {
        $gameId = $this->cleanVar($_GET['game_id']);
        $gameName = $this->cleanVar($_POST['gameName']);
        $style = $this->cleanVar($_POST['style']);
        if (empty($gameName) || empty($style) || empty($gameId)) {
            throw new \Exception('Toutes les données ne sont pas saisies!');
        } else {
            $gamesManager = new GamesManager();
            $updateGame = $gamesManager->updateGame($gameName, $style, $gameId);
            if ($updateGame === false) {
                throw new \Exception('impossible de modifier ce jeu!');
            } else {
                $successMessage = "Jeu de rôle modifié!";
                require('View/template.php');
            }
        }
    }
    public function deleteGame()
    {
        $gameId = $this->cleanVar($_GET['game_id']);
        $gamesManager = new GamesManager();
        $deleteGame = $gamesManager->deleteGame($gameId);
        if ($deleteGame === false) {
            throw new \Exception('Erreur lors de la suppression du jeu.');
        } else {
            $successMessage = "Le jeu a été retiré de la liste!";
            require('View/template.php');
        }
    }
    public function getGameEditor()
    {
        if (isset($_GET['game_id']) && $_GET['game_id'] > 0) {
            $gameId = $this->cleanVar($_GET['game_id']);
            $gamesManager = new GamesManager();
            $game = $gamesManager->getGameById($gameId);
        }
        require('View/gameEditorView.php');
    }
}