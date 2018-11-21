<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 01/11/2018
 * Time: 14:50
 */

    try {
        session_start();

        require("./controller/BlogController.php");
        require("./controller/ChapterController.php");
        require("./controller/AdminController.php");
        require("./controller/UserController.php");

        $blogController = new BlogController();
        $chapterController = new ChapterController();
        $adminController = new AdminController();
        $userController = new UserController();

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'home' :
                    $chapterController->home();
                    break;
                case 'chapter' :
                    $chapterController->displayChapter();
                    break;
                case 'firstChapter' :
                    $chapterController->displayFirstChapter();
                    break;
                case 'chapterList' :
                    $chapterController->displayChapterList();
                    break;
                case 'author' :
                    $blogController->displayAuthorPage();
                    break;
                case 'legal' :
                    $blogController->displayLegalPage();
                    break;
                case 'register':
                    $userController->registerUser();
                    break;
                case 'login' :
                    $userController->displayLoginPage();
                    break;
                case 'validUserA' :
                    if (isset($_POST['login']) && isset($_POST['mdp']))
                        $userController->checkClassicUser(htmlspecialchars(trim($_POST['login'])), htmlspecialchars(trim($_POST['mdp'])));
                    $adminController->displayAdminPage();
                    break;
                case 'validUserB' :
                    if (isset($_POST['login']) && isset($_POST['mdp']))
                        $userController->checkClassicUser(htmlspecialchars(trim($_POST['login'])), htmlspecialchars(trim($_POST['mdp'])));
                    $userController->displayLoginPage();
                    break;
                case 'logout' :
                    $userController->logout();
                    break;
                case 'addComment' :
                    $chapterController->addComment();
                    break;
                case 'likeComment' :
                    $chapterController->likeComment();
                    break;
                case 'unlikeComment' :
                    $chapterController->dislikeComment();
                    break;
                case 'signaledComment' :
                    $chapterController->signaledComment($_GET['idChapter'], $_GET['idComment']);
                    break;
                case 'admin_home' :
                    $adminController->displayAdminPage();
                    break;
                case 'admin_new' :
                    $adminController->createNewArticle();
                    break;
                case 'admin_save' :
                    $adminController->saveArticle();
                    break;
                case 'admin_modifyChapter' :
                        $adminController->modifyArticle();
                    break;
                case 'admin_publish' :
                        $adminController->publish();
                    break;
                case 'admin_unPublish' :
                        $adminController->unPublish();
                    break;
                case 'admin_deleteChapter' :
                        $adminController->deleteChapter();
                    break;
                case 'admin_manualApprove' :
                        $adminController->approveComment();
                    break;
                case 'admin_deleteComment' :
                        $adminController->deleteComment();
                    break;
                case 'admin_commentCheck' :
                    $adminController->commentChecking();
                    break;
                case 'admin_manualApproveList' :
                        $adminController->approveCommentList();
                    break;
                case 'admin_deleteCommentList' :
                        $adminController->deleteCommentList();
                    break;
                default:
                    $chapterController->home();
                    break;
            }
        }
        else {
            $chapterController->home();
        }
    }
    catch(Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }