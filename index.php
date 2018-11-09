<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 01/11/2018
 * Time: 14:50
 */

    try {
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
                case 'goAdminLogin' :
                    $pageController->displayAdminLoginPage();
                    break;
                case 'goContact' :
                    $pageController->displayContactPage();
                    break;
                case 'goAdmin' :
                    if (!empty(htmlspecialchars($_POST['mdp'])) && !empty(htmlspecialchars($_POST['login']))) {
                        $userController->displayAdminPage(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['mdp']));
                    }
                    break;
                case 'addComment' :
                    if (isset($_GET['idChapter']) && $_GET['idChapter'] > 0) {
                        if (!empty(htmlspecialchars($_POST['comment'])) && !empty(htmlspecialchars($_POST['mdp'])) && !empty(htmlspecialchars($_POST['login']))) {
                            $user = $userController->checkClassicUser(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['mdp']));
                            if ($user >= 1)
                                $pageController->addComment($_GET['idChapter'], $user, $_POST['comment']);
                            else
                                echo "ERREUR : bad users";
                        }
                        else
                            echo "ERREUR : CHAMPS VIDE A COMPLETER";
                    }
                    else
                        echo "ERREUR : numéro de chapitre inconnu";
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