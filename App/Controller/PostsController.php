<?php
namespace App\Controller;
use App\Model\PostManager;
class PostsController extends Controller
{
    public function listPosts()
    {
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
        require('View/listPostsView.php');
    }
    public function getPostShort($str)
    {
        $contentExtract = mb_substr($str, 0, 180);
        $lastSpace = mb_strrpos($contentExtract,' ', 0);
        echo nl2br(mb_substr($str, 0, $lastSpace)). "...";
    }
    public function nextPost()
    {
        $postId = $_GET['post_id'];
        if ($postId > 0) {
            $postManager = new PostManager();
            $postManager->getNextPost($postId);
            require('View/postView.php');
        }
    }
    public function previousPost()
    {
        if ($_GET['post_id'] > 0) {
            $postId = $_GET['post_id'];
            $postManager = new PostManager();
            $postManager->getPreviousPost($postId);
            require('View/postView.php');
        }
    }
}