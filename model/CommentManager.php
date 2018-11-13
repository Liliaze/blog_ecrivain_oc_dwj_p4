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
        $comments = $this->_db->prepare('SELECT comments.id, comments.idChapter, comments.comment, DATE_FORMAT(comments.creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, users.login, comments.nbLike, comments.nbDislike, comments.signaled
            FROM comments INNER JOIN users ON comments.idUsers = users.id
            WHERE comments.idChapter=? ORDER BY comment_date_fr DESC');
        $comments->execute(array($chapterId));
        return $comments;
    }
    public function addComment($chapterId, $idLogin, $comment)
    {
        $comments = $this->_db->prepare('INSERT INTO comments(idChapter, idUsers, comment, creationDate, manualApprove, nbLike, nbDislike, signaled, banished) VALUES(?, ?, ?, NOW(), 0, 0, 0, 0, 0)');
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
    public function approveComment($chapterId, $author, $comment)
    {
        $comments = $this->_db->prepare('UPDATE comments SET manualApprove=1 WHERE id=?');
        $approvedComment = $comments->execute(array($chapterId));
        echo "retour approuvedComments : ".$approvedComment;
        return $approvedComment;
    }
    public function deleteComment($chapterId, $author, $comment)
    {
        $comments = $this->_db->prepare('UPDATE comments SET banished=1 WHERE id=?');
        $banishedComment = $comments->execute(array($chapterId));
        echo "retour banishedComments : ".$banishedComment;
        return $banishedComment;
    }
    public function hardDeleteComment($chapterId, $author, $comment)
    {
        $comments = $this->_db->prepare('DELETE FROM comments WHERE id=?');
        $deletedComment = $comments->execute(array($chapterId));
        echo "retour deleteddComments : ".$deletedComment;
        return $deletedComment;
    }

    public function likeComment($idComment) {
        $nbLike = $this->_db->prepare('SELECT comments.nbLike, comments.likerList FROM comments WHERE comments.id=?');
        $nbLike->execute(array($idComment));
        while ($data= $nbLike->fetch()) {
            $arrayLiker = explode(";", $data['likerList']);
            for($i = 0; $i < count($arrayLiker); $i++) {
                if ($arrayLiker[$i] == $_SESSION['id']) {
                    $data['nbLike'] -= 1;
                    $addLike = $this->_db->prepare('UPDATE comments SET comments.nbLike=? WHERE comments.id=?');
                    $addLike->execute(array($data['nbLike'], $idComment));

                    unset($arrayLiker[$i]);
                    $likerList = implode(";", $arrayLiker);
                    $addId = $this->_db->prepare('UPDATE comments SET comments.likerList=? WHERE comments.id=?');
                    $addId->execute(array($likerList, $idComment));
                    return;
                }
            }
            $data['nbLike'] += 1;
            $addLike = $this->_db->prepare('UPDATE comments SET comments.nbLike=? WHERE comments.id=?');
            $addLike->execute(array($data['nbLike'], $idComment));

            if (trim($data['likerList']) == "")
                $likerList = $_SESSION['id'];
            else
                $likerList = $data['likerList'] . ";" . $_SESSION['id'];
            $addId = $this->_db->prepare('UPDATE comments SET comments.likerList=? WHERE comments.id=?');
            $addId->execute(array($likerList, $idComment));
        }
        $nbLike->closeCursor();
    }
    private function newIdCommentList($array, $value, $idUser) {

    }
    public function dislikeComment($idComment) {
        $nbDislike = $this->_db->prepare('SELECT comments.nbDislike, comments.dislikerList FROM comments WHERE comments.id=?');
        $nbDislike->execute(array($idComment));
        while ($data= $nbDislike->fetch()) {
            $arrayDisliker = explode(";", $data['dislikerList']);
            for($i = 0; $i < count($arrayDisliker); $i++) {
                if ($arrayDisliker[$i] == $_SESSION['id']) {
                    $data['nbDislike'] -= 1;
                    $addDislike = $this->_db->prepare('UPDATE comments SET comments.nbDislike=? WHERE comments.id=?');
                    $addDislike->execute(array($data['nbDislike'], $idComment));

                    unset($arrayDisliker[$i]);
                    $dislikerList = implode(";", $arrayDisliker);
                    $addId = $this->_db->prepare('UPDATE comments SET comments.dislikerList=? WHERE comments.id=?');
                    $addId->execute(array($dislikerList, $idComment));
                    return;
                }
            }
            $data['nbDislike'] += 1;
            $addDislike = $this->_db->prepare('UPDATE comments SET comments.nbDislike=? WHERE comments.id=?');
            $addDislike->execute(array($data['nbDislike'], $idComment));

            if (trim($data['dislikerList']) == "")
                $dislikerList = $_SESSION['id'];
            else
                $dislikerList = $data['dislikerList'] . ";" . $_SESSION['id'];
            $addId = $this->_db->prepare('UPDATE comments SET comments.dislikerList=? WHERE comments.id=?');
            $addId->execute(array($dislikerList, $idComment));
        }
        $nbDislike->closeCursor();
    }
}