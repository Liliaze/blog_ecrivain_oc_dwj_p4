<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 14/11/2018
 * Time: 22:47
 */

class AdminController extends ChapterController
{
    protected $_commentsSignaledList;

    private function isAdmin () {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            return true;
        }
        header('location: index.php?action=home');
        exit();
    }
    private function updateCommentSignaledList() {
        $this->_commentsSignaledList = $this->_commentManager->getSignaledList();
    }
    public function displayAdminPage() {
        $this->isAdmin();
        $this->updateChapterList();
        $this->updateCommentSignaledList();
        require('view/admin/admin.php');
    }
    public function createNewArticle() {
        $this->isAdmin();
        $title = "Nouvel article";
        $articleContent = "Rédiger ici le contenu du nouvel épisode! Pensez à sauvegarder régulièrement. Enjoy !";
        $numberPDO = $this->_chapterManager->getMaxNumberChapter();
        $number = -1;
        while ($data = $numberPDO->fetch()) {
            $number = intval($data['numberChapter']) + 1;
        }
        $numberPDO->closeCursor();
        $this->_chapterManager->newChapter($title, $number, $articleContent);
        $chapter = $this->_chapterManager->getLastChapter();
        require('view/admin/newArticle.php');
    }
    private function save($id, $number, $newTitle, $newArticle) {
        $this->isAdmin();
        $this->_chapterManager->updateChapter($id, $number, $newTitle, $newArticle);
        $_SESSION['success'] = "Modifications sauvegardées";
    }
    public function publish() {
        $this->isAdmin();
        $id = $this->getCleanArgument('idChapter', 1);
        $this->_chapterManager->publishChapter($id);
        $_SESSION['success'] = "Chapitre publiée";
        header('location: index.php?action=admin_home');
    }
    public function saveArticle() {
        $this->isAdmin();
        $action = $this->getCleanArgument('save', 1);
        $id = $this->getCleanArgument('idChapter', 1);
        $number = $this->getCleanArgument('numberArticle', 0);
        $newTitle = $this->getCleanArgument('titleArticle', 0);
        $newArticle = $this->getCleanArgument('textArticle', 0);
        switch ($action) {
            case 'save':
                $this->save($id, $number, $newTitle, $newArticle);
                break;
            case 'publish':
                $this->save($id, $number, $newTitle, $newArticle);
                $this->_chapterManager->publishChapter($id);
                $_SESSION['success'] = "Modifications sauvegardées et article publié";
                break;
            case 'unPublish':
                $this->save($id, $number, $newTitle, $newArticle);
                $this->_chapterManager->lightDeleteChapter($id);
                $_SESSION['success'] = "Modifications sauvegardées et article dépublié";
                break;
            case 'chapter':
                $this->save($id, $number, $newTitle, $newArticle);
                $this->_chapterManager->publishChapter($id);
                $_SESSION['success'] = "Modifications sauvegardées et article publié, le voici :";
                header('location: index.php?action=chapter&idChapter='.$id);
                return;
            case 'admin':
                header('location: index.php?action=admin_home');
                return;
            default:
                $_SESSION['error'] = "une erreur est survenue, action non reconnue";
        }
        $chapter = $this->_chapterManager->getChapter($id);
        require ('view/admin/newArticle.php');
    }
    public function commentChecking() {
        $this->isAdmin();
        $commentList = $this->_commentManager->getAllComments();
        require('view/admin/commentChecking.php');
    }
    public function modifyArticle()
    {
        $this->isAdmin();
        $id = $this->getCleanArgument('idChapter', 1);
        $chapter = $this->_chapterManager->getChapter($id);
        require('view/admin/newArticle.php');
    }
    public function deleteChapter() {
        $this->isAdmin();
        $id = $this->getCleanArgument('idChapter', 1);
        $this->_chapterManager->deleteDefinitivelyChapter($id);
        $_SESSION['success'] = "Article définitivement supprimé";
        header('location: index.php?action=admin_home');
    }
    public function unPublish() {
        $this->isAdmin();
        $id = $this->getCleanArgument('idChapter', 1);
        $newChapter = $this->_chapterManager->lightDeleteChapter($id);
        $_SESSION['success'] = "Article non publié";
        header('location: index.php?action=admin_home');
    }
    public function deleteComment() {
        $this->isAdmin();
        $id = $this->getCleanArgument('idComment', 1);
        $this->_commentManager->hardDeleteComment($id);
        $_SESSION['success'] = "Commentaire définitivement supprimé.";
        header('location: index.php?action=admin_home');
    }
    public function approveComment() {
        $this->isAdmin();
        $id = $this->getCleanArgument('idComment', 1);
        $this->_commentManager->approveComment($id);
        $_SESSION['success'] = "Commentaire approuvée";
        header('location: index.php?action=admin_home');
    }
    public function deleteCommentList() {
        $this->isAdmin();
        $id = $this->getCleanArgument('idComment', 1);
        $this->_commentManager->hardDeleteComment($id);
        $_SESSION['success'] = "Commentaire définitivement supprimé.";
        header('location: index.php?action=admin_commentCheck');
    }
    public function approveCommentList() {
        $this->isAdmin();
        $id = $this->getCleanArgument('idComment', 1);
        $this->_commentManager->approveComment($id);
        $_SESSION['success'] = "Commentaire approuvé";
        header('location: index.php?action=admin_commentCheck');
    }
}