<?php
namespace App\Model;
class CommentManager extends Manager
{
    public function listComments($postId)
    {
        $db = $this->getDbConnect();
        $comments = $db->prepare('SELECT comments.comment_id, comments.status, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y\') AS comment_date_fr, members.member_name FROM comments INNER JOIN members ON comments.member_id = members.member_id WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }
    public function addComment($postId, $author, $comment)
    {
        $db = $this->getDbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, member_id , comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));
        return $affectedLines;
    }
    public function flagComment($commentId)
    {
        $db = $this->getDbConnect();
        $flagComment = $db->prepare('UPDATE comments SET status = 1 WHERE comment_id = ?');
        $flag = $flagComment->execute(array($commentId));
        return $flag;
    }
}