<?php
namespace App\Controller;
use App\Model\CommentManager;
class CommentsController extends Controller
{
    public function addComment()
    {
        $postId = $this->cleanVar($_GET['id']);
        $author = $this->cleanVar($_SESSION['memberId']);
        $comment = $this->cleanVar($_POST['comment']);
        if ((isset($postId)) && $postId > 0) {
            if (!empty($comment)) {
                $commentManager = new CommentManager();
                $affectedLines = $commentManager->addComment($postId, $author, $comment);
                if ($affectedLines === false) {
                    throw new \Exception('Impossible d\'ajouter le commentaire.');
                } else {
                    $successMessage = 'Commentaire ajouté!';
                    require('View/template.php');
                }
            }
        }
    }
    public function flagComment()
    {
            $commentId = $_GET['comment_id'];
            $commentManager = new CommentManager();
            $commentManager->flagComment($commentId);
            $successMessage = 'le commentaire a été signalé!';
            require('View/template.php');
    }
}