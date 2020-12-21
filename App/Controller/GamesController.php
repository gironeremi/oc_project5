<?php
namespace App\Controller;
use App\Model\GamesManager;

class GamesController extends Controller
{
    public function addGame()
    {
        if ($_SESSION['role'] === 'admin') {
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
                    die();
                }
            }
        } else {
            throw new \Exception('Accès non autorisé!');
        }
    }
    public function updateGame()
    {
        if ($_SESSION['role'] === 'admin') {
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
                    die();
                }
            }
        } else {
            throw new \Exception('Accès non autorisé!');
        }
    }
    public function deleteGame()
    {
         if ($_SESSION['role'] === 'admin') {
            $gameId = $this->cleanVar($_GET['game_id']);
            $gamesManager = new GamesManager();
            $deleteGame = $gamesManager->deleteGame($gameId);
            if ($deleteGame === false) {
                throw new \Exception('Erreur lors de la suppression du jeu.');
            } else {
                $successMessage = "Le jeu a été retiré de la liste!";
                require('View/template.php');
            }
        } else {
            throw new \Exception('Accès non autorisé!');
        }
    }
    public function getGameEditor()
    {
        if ($_SESSION['role'] === 'admin') {
            if (isset($_GET['game_id']) && $_GET['game_id'] > 0) {
                $gameId = $this->cleanVar($_GET['game_id']);
                $gamesManager = new GamesManager();
                $game = $gamesManager->getGameById($gameId);
            }
            require('View/gameEditorView.php');
        } else {
            throw new \Exception('Accès non autorisé!');
        }
    }
}