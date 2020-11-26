<?php
namespace App\Model;
class PostManager extends Manager
{
    public function listPosts($firstPost, $postsPerPages)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM posts ORDER BY creation_date LIMIT :first_post, :posts_per_pages');
        $req->bindValue(':first_post', $firstPost, \PDO::PARAM_INT);
        $req->bindValue(':posts_per_pages', $postsPerPages, \PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function getPostById($postId)
    {
            $db = $this->getDbConnect();
            $req = $db->prepare('SELECT * FROM posts WHERE post_id = ?');
            $req->execute(array($postId));
            return $post = $req->fetch();
    }
    public function getNextPost($postId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('CALL getNextPost(?)');
        $req->execute(array($postId));
        return $req->fetchColumn();
    }
    public function getPreviousPost($postId)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('CALL getPreviousPost(?)');
        $req->execute(array($postId));
        return $req->fetchColumn();
    }
    public function getNumberOfPosts()
    {
        $db = $this->getDbConnect();
        $req = $db->query('SELECT COUNT(*) AS number_of_posts FROM posts');
        return $numberOfPosts = (int) $req->fetchColumn();
    }
}