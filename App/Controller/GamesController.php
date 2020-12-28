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
            $target_dir = 'public/images/';
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    //echo "Le fichier est une image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                    throw new \Exception('le fichier n\'est pas une image.');
                }
            }
            if (file_exists($target_file)) {
                $uploadOk = 0;
                throw new \Exception('le fichier existe déjà');
            }
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $uploadOk = 0;
                throw new \Exception('Le fichier est trop gros. La limite est de 500Ko.');
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                throw new \Exception('Seuls les fichiers JPG, PNG et JPEG sont autorisés');
            }
            if ($uploadOk == 0) {
                throw  new \Exception('Désolé, le fichier n\'a pu être transmis.');
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $successMessage = "Le fichier " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a été transmis.";
                    $picture = $_FILES["fileToUpload"]["name"];
                } else {
                    throw  new \Exception('Désolé, le fichier n\'a pu être transmis.');
                }
            }
            if (empty($gameName) || empty($style) ||empty($picture)) {
                throw new \Exception('Toutes les données ne sont pas saisies!');
            } else {
                $gamesManager = new GamesManager();
                $newGame = $gamesManager->addGame($gameName, $style, $picture);
                if ($newGame === false) {
                    throw new \Exception('impossible d\'ajouter ce jeu!');
                } else {
                    $successMessage .= "<br />Nouveau jeu de rôle ajouté!";
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