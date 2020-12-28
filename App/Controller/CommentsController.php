<?php
namespace App\Controller;
use App\Model\CommentsManager;

class CommentsController extends Controller
{
    public function addComment()
    {
        if (isset($_SESSION['user_id'])) {
            $eventId = $this->cleanVar($_GET['event_id']);
            $userId = $this->cleanVar($_SESSION['user_id']);
            $comment = $this->cleanVar($_POST['comment']);
            if ($eventId > 0 && $userId > 0) {
                if (!empty($comment)) {
                    $commentsManager = new CommentsManager();
                    $affectedLines = $commentsManager->addComment($eventId, $userId, $comment);
                    if ($affectedLines === false) {
                        throw new \Exception('Impossible d\'ajouter le commentaire.');
                    } else {
                        $successMessage = 'Commentaire ajouté!';
                        require('View/template.php');
                        die();
                    }
                }
            } else {
                throw new \Exception('Erreur commentaire ou utilisateur.');
            }
        }throw new \Exception('Seul un utilisateur connecté peut effectuer ceci.');
    }
}