<?php
namespace App\Controller;
use App\Model\CommentsManager;
use App\Model\EventsManager;
use App\Model\GamesManager;

class EventsController extends Controller
{
    public function listEvents()
    {
        $eventsManager = new EventsManager();
        $events = $eventsManager->listEvents();
        require('View/listEventsView.php');
    }
    public function getEventById()
    {
        $eventId = intval($_GET['event_id']);
        if (is_int($eventId)) {
            $eventsManager = new EventsManager();
            $commentsManager = new CommentsManager();
            $event = $eventsManager->getEventById($eventId);
            $comments = $commentsManager->listComments($eventId);
            require('View/eventView.php');
        }
    }
    public function getEventEditor()
    {
        /* utilisé pour mettre à jour un évènement
            if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
            $postsManager = new PostManager();
            $post = $postsManager->getPostById($_GET['post_id']);
            }
        */
        $gamesManager = new GamesManager();
        $games = $gamesManager->listGames();
        require('View/eventEditorView.php');
    }
    //à adapter
    public function addEvent()
    {
        $userId = $this->cleanVar($_SESSION['userId']);
        $eventName = $this->cleanVar($_POST['eventName']);
        $eventInformations = $_POST['eventInformations'];//pas de cleanVar ici, TinyMCE possède son propre système de nettoyage de données.
        $eventDate = $this->cleanVar($_POST['eventDate']);
        $gameId = $this->cleanVar($_POST['game_id']);
        if (empty($eventName) || empty($eventInformations) || empty($eventDate) || empty($gameId) || empty($userId))
        {
            throw new \Exception('Toutes les données ne sont pas saisies!');
        } else {
            $eventsManager = new EventsManager();
            $affectedLines = $eventsManager->addEvent($eventName, $userId, $gameId, $eventInformations, $eventDate);
            if ($affectedLines === false) {
                throw new \Exception('impossible d\'ajouter cette aventure');
            } else {
                $successMessage = "Bravo! Votre séance est fixée! ";
                require('View/template.php');
                //$usersController = new UsersController();
                //$usersController->userDashboard();
            }
        }

    }
    //à modifier, bien entendu
    public function updatePost()
    {
        $postId = $_GET['post_id'];
        $postTitle = $this->cleanVar($_POST['postTitle']);
        $postContent = $_POST['postContent'];//cleanVar retiré, TinyMCE fait dejà le taf.
        $postPublishDate = $this->cleanVar($_POST['postPublishDate']);
        if (empty($postTitle) || empty($postContent) || empty($postPublishDate)) {
            throw new \Exception('Toutes les données ne sont pas saisies!');
        } else {
            $adminManager = new AdminManager();
            $adminManager->updatePost($postId, $postTitle, $postContent, $postPublishDate);
            $successMessage = 'La séance a été mise à jour. Cool!';
            $usersController = new UsersController();
            $usersController->userDashboard();
        }
    }
    //à modifier, bien entendu
    public function deletePost()
    {
        $postId = $_GET['post_id'];
        $adminManager = new AdminManager();
        $adminManager->deletePost($postId);
        $successMessage = 'Le chapitre est supprimé!';
        require('View/template.php');
    }
}