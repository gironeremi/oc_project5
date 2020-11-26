<?php
namespace App\Model;
class AdminManager extends Manager
{
    public function listPosts()
    {
        $db = $this->getDbConnect();
        $req = $db->query('SELECT * FROM posts ORDER BY creation_date');
        return $req;
    }
    public function addPost($postTitle, $postContent, $postPublishDate)
    {
        $db = $this->getDbConnect();
        $newPost = $db->prepare('INSERT INTO posts(title, content, publish_date) VALUES (?,?,?)');
        return $affectedLines = $newPost->execute(array($postTitle, $postContent, $postPublishDate));
    }
    public function deletePost($postId)
    {
        $db = $this->getDbConnect();
        $deletePost = $db->prepare('DELETE FROM posts WHERE post_id = ?');
        $deletePost->execute(array($postId));
    }
    public function updatePost($postId, $postTitle, $postContent, $postPublishDate)
    {
        $db = $this->getDbConnect();
        $updatePost = $db->prepare('UPDATE posts SET title = ? , content = ? , publish_date = ? WHERE post_id = ?');
        $updatePost->execute(array($postTitle, $postContent, $postPublishDate, $postId));
    }
    public function validateComment($commentId)
    {
        $db = $this->getDbConnect();
        $unflagComment = $db->prepare('UPDATE comments SET status = 2 WHERE comment_id = ?');
        $unflag = $unflagComment->execute(array($commentId));
        return $unflag;
    }
    public function deleteComment($commentId)
    {
        $db = $this->getDbConnect();
        $deleteComment = $db->prepare('DELETE FROM comments WHERE comment_id = ?');
        $deleteComment->execute(array($commentId));
    }
    public function listFlaggedComments()
    {
        $db = $this->getDbConnect();
        $flaggedComments = $db->query('SELECT comments.comment_id, comments.member_id, comments.comment, members.member_name FROM comments INNER JOIN members ON comments.member_id = members.member_id WHERE status = 1');
        return $flaggedComments;
    }
}