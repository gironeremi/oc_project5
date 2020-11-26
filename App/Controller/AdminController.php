<?php
namespace App\Controller;
use App\Model\AdminManager;
use App\Model\PostManager;
class AdminController extends Controller
{
    public function admin()
    {
        if ($_SESSION['isAdmin'] == 1) {
            $adminManager = new AdminManager();
            $flaggedComments = $adminManager->listFlaggedComments();
            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $currentPage = $this->cleanVar($_GET['page']);
            } else {
                $currentPage = 1;
            }
            $postManager = new PostManager();
            $numberOfPosts = $postManager->getNumberOfPosts();
            $postsPerPage = 4;
            $pages = ceil($numberOfPosts / $postsPerPage);
            $firstPost = (($currentPage - 1) * $postsPerPage);
            $posts = $postManager->listPosts($firstPost, $postsPerPage);
            require('View/adminView.php');
        } else {
            throw new \Exception('Accès non autorisé!');
        }
    }
    public function addPost()
    {
        $postTitle = $this->cleanVar($_POST['postTitle']);
        $postContent = $_POST['postContent'];//pas de cleanVar ici, TinyMCE possède son propre système de nettoyage de données.
        $postPublishDate = $this->cleanVar($_POST['postPublishDate']);
        if (empty($postTitle) || empty($postContent) ||empty($postPublishDate))
        {
            throw new \Exception('Toutes les données ne sont pas saisies!');
        } else {
            $adminManager = new AdminManager();
            $affectedLines = $adminManager->addPost($postTitle, $postContent, $postPublishDate);
            if ($affectedLines === false) {
                throw new \Exception('impossible d\'ajouter ce chapitre');
            } else {
                $successMessage = "Le chapitre a été ajouté!";
                require('View/template.php');
            }
        }
    }
    public function getPostEditor()
    {
        if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
            $postsManager = new PostManager();
            $post = $postsManager->getPostById($_GET['post_id']);
        }
        require('View/postEditorView.php');
    }
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
            $successMessage = 'Le chapitre a été mis à jour!';
            require('View/template.php');
        }
    }
    public function deletePost()
    {
        $postId = $_GET['post_id'];
        $adminManager = new AdminManager();
        $adminManager->deletePost($postId);
        $successMessage = 'Le chapitre est supprimé!';
        require('View/template.php');
    }
    public function validateComment()
    {
        $commentId = $_GET['comment_id'];
        $adminManager = new AdminManager();
        $adminManager->validateComment($commentId);
        $successMessage = 'Commentaire validé!';
        require('View/template.php');
    }
    public function deleteComment()
    {
        $commentId = $_GET['comment_id'];
        $adminManager = new AdminManager();
        $adminManager->deleteComment($commentId);
        $successMessage = 'Commentaire supprimé!';
        require('View/template.php');
    }
}