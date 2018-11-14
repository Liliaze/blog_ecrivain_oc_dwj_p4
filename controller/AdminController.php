<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 14/11/2018
 * Time: 22:47
 */

class AdminController extends PageController
{
    public function checkIsAdmin() {
        if ($_SESSION['admin'] == 1)
            return true;
        else {
            require('view/frontend/adminLogin.php');
            return false;
        }
    }
    public function displayAdminPage() {
            require('view/admin/admin.php');
    }
    public function createNewArticle() {
        $title = "Nouvel article";
        $articleContent = "Rédiger ici le contenu du nouvel épisode! Pensez à sauvegarder régulièrement. Enjoy !";
        $number = 42;
        $this->_chapterManager->newChapter($title, $number, $articleContent);
        $chapter = $this->_chapterManager->getLastChapter();
        require('view/admin/newArticle.php');
    }
    public function save($id, $number, $newTitle, $newArticle) {
        $this->_chapterManager->updateChapter($id, $number, $newTitle, $newArticle);
        $_SESSION['success'] = "Modifications sauvegardées";
    }
    public function publish($id) {
        $this->_chapterManager->publishChapter($id);
        $_SESSION['success'] = "Chapitre publiée";
        $this->displayAdminPage();
    }
    public function saveArticle($action, $id, $number, $newTitle, $newArticle) {
        $this->save($id, $number, $newTitle, $newArticle);
        switch ($action) {
            case 'save':
                break;
            case 'publish':
                $this->_chapterManager->publishChapter($id);
                $_SESSION['success'] = "Modifications sauvegardées et article publié";
                break;
            case 'goChapter':
                $this->_chapterManager->publishChapter($id);
                $_SESSION['success'] = "Modifications sauvegardées et article publié, le voici :";
                $this->displayChapter($id);
                return;
            case 'goAdmin':
                $this->displayAdminPage();
                return;
            default:
                $_SESSION['error'] = "une erreur est survenue, action non reconnue";
        }
        $chapter = $this->_chapterManager->getLastChapter();
        require ('view/admin/newArticle.php');
    }
    public function modifyArticle($id)
    {
        $chapter = $this->_chapterManager->getChapter($id);
        require('view/admin/newArticle.php');
    }
    public function deleteChapter($id) {
        $this->_chapterManager->deleteDefinitivelyChapter($id);
        $_SESSION['success'] = "Article définitivement supprimé";
        $this->displayAdminPage();
    }
    public function unPublish($id) {
        $newChapter = $this->_chapterManager->lightDeleteChapter($id);
        $_SESSION['success'] = "Article non publié";
        $this->displayAdminPage();
    }
}