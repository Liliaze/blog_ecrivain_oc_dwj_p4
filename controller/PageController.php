<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 14:16
 */
require_once('model/ChapterManager.php');
require_once('model/CommentManager.php');

class PageController {
    private $_chapterManager;
    private $_commentManager;
    private $_oneChapter;
    private $_lastChapter;
    private $_chapterList;
    private $_commentsChapterList;

    public function __construct() {
        $this->_chapterManager = new ChapterManager();
        $this->updateChapterList();
        $this->_commentManager = new CommentManager();
    }
    public function updateChapterList() {
        $this->_chapterList = $this->_chapterManager->getChapterList();
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
    public function addComment($idChapter, $idUser, $comment)
    {
        $this->_commentManager->addComment($idChapter, $idUser, $comment);
        echo "Commentaire ajouté";
        require('view/frontend/chapterList.php');
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
    public function displayAdminLoginPage() {
        require('view/frontend/adminLogin.php');
    }
    public function displayLoginPage() {
        require('view/frontend/login.php');
    }
}