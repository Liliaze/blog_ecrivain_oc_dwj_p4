<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 22:12
 */

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($chapterId)
    {
        $comments = $this->_db->prepare('SELECT comments.id, comments.comment, DATE_FORMAT(comments.creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, users.login
            FROM comments INNER JOIN users ON comments.idUsers = users.id
            WHERE comments.idChapter=? ORDER BY comment_date_fr DESC');
        $comments->execute(array($chapterId));
        return $comments;
    }
    public function addComment($chapterId, $idLogin, $comment)
    {
        $comments = $this->_db->prepare('INSERT INTO comments(idChapter, idUsers, comment, creationDate, manualApprove, signaled, banished) VALUES(?, ?, ?, NOW(), 0, 0, 0)');
        $affectedLines = $comments->execute(array($chapterId, $idLogin, $comment));
        return $affectedLines;
    }
    public function signalComment($id)
    {
        $comments = $this->_db->prepare('UPDATE comments SET signaled=1 WHERE id=?');
        $signaledComment = $comments->execute(array($id));
        echo "retour signalComments : ".$signaledComment;
        return $signaledComment;
    }
    public function approveComment($postId, $author, $comment)
    {
        $comments = $this->_db->prepare('UPDATE comments SET manualApprove=1 WHERE id=?');
        $approvedComment = $comments->execute(array($id));
        echo "retour approuvedComments : ".$approvedComment;
        return $approvedComment;
    }
    public function deleteComment($postId, $author, $comment)
    {
        $comments = $this->_db->prepare('UPDATE comments SET banished=1 WHERE id=?');
        $banishedComment = $comments->execute(array($id));
        echo "retour banishedComments : ".$banishedComment;
        return $banishedComment;
    }
    public function hardDeleteComment($postId, $author, $comment)
    {
        $comments = $this->_db->prepare('DELETE FROM comments WHERE id=?');
        $deletedComment = $comments->execute(array($id));
        echo "retour deleteddComments : ".$deletedComment;
        return $deletedComment;
    }
}