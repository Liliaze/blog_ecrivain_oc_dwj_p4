<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 14:16
 */

require_once('Handler\utils.php');
require_once('model/ChapterManager.php');
require_once('model/CommentManager.php');

class ChapterController {

    use Handler\utils\CleanArgument, Handler\utils\IsConnected;

    protected $_chapterManager;
    protected $_commentManager;
    protected $_oneChapter;
    protected $_previousIdChapter;
    protected $_nextIdChapter;
    protected $_lastChapter;
    protected $_chapterList;
    protected $_commentsChapterList;

    public function __construct() {
        $this->_chapterManager = new ChapterManager();
        $this->updateChapterList();
        $this->_commentManager = new CommentManager();
    }
    protected function updateChapterList() {
        $this->_chapterList = $this->_chapterManager->getChapterList();
    }
    public function home()
    {
        $this->_lastChapter = $this->_chapterManager->getLastPublishChapter();
        require('view/frontend/home.php');
    }
    public function displayFirstChapter()
    {
        $idPDO = $this->_chapterManager->getFirstPublishChapterId();
        while ($data = $idPDO->fetch()) {
            header('location: index.php?action=chapter&idChapter='.$data['id']);
        }
        $idPDO->closeCursor();
    }
    public function displayChapter()
    {
        $idChapter = $this->getCleanArgument('idChapter');
        $this->setOneChapter($idChapter);
        $this->setPreviousAndNextIdChapter($idChapter);
        $this->setCommentsChapterList($idChapter);
        require('view/frontend/chapter.php');
    }
    private function setOneChapter($idChapter) {
        $this->_oneChapter = $this->_chapterManager->getChapter($idChapter);
    }
    private function setCommentsChapterList($idChapter) {
        $this->_commentsChapterList = $this->_commentManager->getComments($idChapter);
    }
    private function setPreviousAndNextIdChapter($idChapter) {
        $list = $this->_chapterManager->getChapterList();
        $currentChapter = $this->_chapterManager->getChapter($idChapter);
        while ($data = $currentChapter->fetch()) {
            if (intval($data['numberChapter']) > 0) {
                $pdoID = $this->_chapterManager->getIdByNumberChapter($data['numberChapter'] - 1);
                while ($dataID = $pdoID->fetch()) {
                    $this->_previousIdChapter = $dataID['id'];
                    break;
                }
                $pdoID->closeCursor();
            }
            else {
                $this->_previousIdChapter = null;
            }
            while ($dataList = $list->fetch()) {
                if (intval($data['numberChapter']) < intval($dataList['numberChapter'])) {
                    $pdoID = $this->_chapterManager->getIdByNumberChapter($data['numberChapter'] + 1);
                    while ($dataID = $pdoID->fetch()) {
                        $this->_nextIdChapter = $dataID['id'];
                        break;
                    }
                    $pdoID->closeCursor();
                    break;
                } else {
                    $this->_nextIdChapter = null;
                    break;
                }
            }
            $list->closeCursor();
            break;
        }
        $currentChapter->closeCursor();
    }
    public function displayChapterList()
    {
        require('view/frontend/chapterList.php');
    }
    public function addComment()
    {
        $idChapter = $this->getCleanArgument('idChapter');
        $comment = $this->getCleanArgument('comment');
        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
            if ($idChapter > 0) {
                if (!empty(htmlspecialchars($comment))) {
                    $this->_commentManager->addComment($idChapter, $_SESSION['id'], $comment);
                    $_SESSION['success'] = 'Commentaire ajouté avec succès';
                }
                else
                    $_SESSION['warning'] = "Veuillez complèter le champ de commentaire avant d'envoyer";
            }
            else {
                $_SESSION['error'] = "ERREUR : Le numéro de chapitre transmis n'est pas correct. Choisissez un chapitre";
                require('view/frontend/chapterList.php');
            }
        }
        else {
            $_SESSION['warning'] = 'Merci de vous identifier pour pouvoir poster un commentaire';
        }
        header('location: index.php?action=chapter&idChapter='.$idChapter);
    }
    public function likeComment() {
        $idChapter = $this->getCleanArgument('idChapter');
        $idComment = $this->getCleanArgument('idComment');
        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
            $this->_commentManager->likeComment($idComment);
        }
        else {
             $_SESSION['warning'] = 'Merci de vous identifier pour pouvoir aimer un commentaire';
        }
        header('location: index.php?action=chapter&idChapter='.$idChapter);
    }
    public function dislikeComment() {
        $idChapter = $this->getCleanArgument('idChapter');
        $idComment = $this->getCleanArgument('idComment');
        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
            $this->_commentManager->dislikeComment($idComment);
        }
        else {
            $_SESSION['warning'] = 'Merci de vous identifier pour indiquer que vous n\'aimez pas un commentaire';
        }
        header('location: index.php?action=chapter&idChapter='.$idChapter);
    }
    public function signaledComment($idChapter, $idComment) {
        $this->_commentManager->signalComment($idComment);
        $_SESSION['success'] = "Commentaire signalé !";
        header('location: index.php?action=chapter&idChapter='.$idChapter);
    }
}