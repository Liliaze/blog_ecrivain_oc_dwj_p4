<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 14:16
 */
require_once('model/ChapterManager.php');
require_once('model/CommentManager.php');

//add papaController
//ne mettre que chapterController

class PageController {
    protected $_chapterManager;
    protected $_commentManager;
    protected $_oneChapter;
    protected $_lastChapter;
    protected $_chapterList;
    protected $_commentsSignaledList;
    protected $_commentsChapterList;

    public function __construct() {
        $this->_chapterManager = new ChapterManager();
        $this->updateChapterList();
        $this->_commentManager = new CommentManager();
    }
    public function updateChapterList() {
        $this->_chapterList = $this->_chapterManager->getChapterList();
    }
    public function updateCommentSignaledList() {
        $this->_commentsSignaledList = $this->_commentManager->getSignaledList();
    }
    public function setOneChapter($idChapter) {
        $this->_oneChapter = $this->_chapterManager->getChapter($idChapter);
    }
    public function setCommentsChapterList($idChapter) {
        $this->_commentsChapterList = $this->_commentManager->getComments($idChapter);
    }
    public function displayChapter($idChapter)
    {
        $this->setOneChapter($idChapter);
        $this->setCommentsChapterList($idChapter);
        require('view/frontend/chapter.php');
    }
    public function displayChapterList()
    {
        require('view/frontend/chapterList.php');
    }
    public function addComment($idChapter, $comment)
    {
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
        //$this->displayChapter($idChapter);
    }
    public function likeComment($idChapter, $idComment) {
        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
            $this->_commentManager->likeComment($idComment);
        }
        else {
             $_SESSION['warning'] = 'Merci de vous identifier pour pouvoir aimer un commentaire';
        }
        header('location: index.php?action=chapter&idChapter='.$idChapter);
        //$this->displayChapter($idChapter);
    }
    public function dislikeComment($idChapter, $idComment) {
        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
            $this->_commentManager->dislikeComment($idComment);
        }
        else {
            $_SESSION['warning'] = 'Merci de vous identifier pour indiquer que vous n\'aimez pas un commentaire';
        }
        $this->displayChapter($idChapter);
    }
    public function signaledComment($idChapter, $idComment) {
        $this->_commentManager->signalComment($idComment);
        $_SESSION['success'] = "Commentaire signalé !";
        header('location: index.php?action=chapter&idChapter='.$idChapter);
        //$this->displayChapter($idChapter);
    }
    public function sayWelcome()
    {
        $this->_lastChapter = $this->_chapterManager->getLastChapter();
        require('view/frontend/home.php');
    }
    public function displayAuthorPage()
    {
        require('view/frontend/author.php');
    }
    public function displayContactPage() {
        require('view/frontend/contact.php');
    }

    public function displayLoginPage() {
        require('view/frontend/login.php');
    }
    public function displayRegisterPage() {
        require('view/frontend/register.php');
    }
    public function displayLegalPage() {
        require('view/frontend/legal.php');
    }

}