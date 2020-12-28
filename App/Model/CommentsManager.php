<?php
namespace App\Model;
class CommentsManager extends Manager
{
    public function listComments($eventId)
    {
        $db = $this->getDbConnect();
        $comments = $db->prepare("SELECT *, DATE_FORMAT(date,'%d/%m/%Y')AS date_fr from comments INNER JOIN users ON comments.user_id = users.user_id WHERE event_id = ? ORDER BY date DESC");
        $comments->execute(array($eventId));
        return $comments->fetchAll();
    }
    public function addComment($eventId, $userId, $comment)
    {
        $db = $this->getDbConnect();
        $newComment = $db->prepare("INSERT INTO comments(event_id, user_id, comment, date) VALUES (?,?,?, NOW())");
        return $newComment->execute(array($eventId, $userId, $comment));
    }
}