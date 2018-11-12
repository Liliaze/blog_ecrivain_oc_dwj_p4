<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 01/11/2018
 * Time: 14:50
 */

    try {
        session_start();

        require("./controller/PageController.php");
        require("./controller/UserController.php");

        $pageController = new PageController();
        $userController = new UserController();
        
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'goHome' :
                    $pageController->sayWelcome();
                    break;
                case 'goChapter' :
                    if (isset($_GET['idChapter']) && $_GET['idChapter'] > 0)
                        $pageController->displayChapter($_GET['idChapter']);
                    break;
                case 'goChapterList' :
                    $pageController->displayChapterList();
                    break;
                case 'goAuthor' :
                    $pageController->displayAuthorPage();
                    break;
                case 'goLogin' :
                    $pageController->displayLoginPage();
                    break;
                case 'validUser' :
                    $userController->checkClassicUser(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['mdp']));
                    $pageController->displayLoginPage();
                    break;
                case 'unlog' :
                    $userController->unlog();
                    $pageController->displayLoginPage();
                    break;
                case 'likeComment' :
                    if (isset($_GET['idChapter']) && $_GET['idChapter'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0)
                        $pageController->likeComment($_GET['idChapter'], $_GET['idComment']);
                    break;
                case 'unlikeComment' :
                    if (isset($_GET['idChapter']) && $_GET['idChapter'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0)
                        $pageController->dislikeComment($_GET['idChapter'], $_GET['idComment']);
                    break;
                case 'signaledComment' :
                    if (isset($_GET['idChapter']) && $_GET['idChapter'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0)
                        $pageController->signaledComment($_GET['idChapter'], $_GET['idComment']);
                    break;
                case 'goAdmin' :
                    $userController->checkClassicUser(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['mdp']));
                    $pageController->displayAdminPage();
                    break;
                case 'goContact' :
                    $pageController->displayContactPage();
                    break;
                case 'addComment' :
                    $pageController->addComment($_GET['idChapter'], $_POST['comment']);
                    break;
                default:
                    $pageController->sayWelcome();
            }
        }
        else {
            $pageController->sayWelcome();
        }
    }
    catch(Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }