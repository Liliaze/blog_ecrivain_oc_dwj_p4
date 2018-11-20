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
        require("./controller/AdminController.php");
        require("./controller/UserController.php");

        $pageController = new PageController();
        $adminController = new AdminController();
        $userController = new UserController();

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'home' :
                    $pageController->sayWelcome();
                    break;
                case 'chapter' :
                    if (isset($_GET['idChapter']) && $_GET['idChapter'] > 0)
                        $pageController->displayChapter($_GET['idChapter']);
                    break;
                case 'chapterList' :
                    $pageController->displayChapterList();
                    break;
                case 'author' :
                    $pageController->displayAuthorPage();
                    break;
                case 'legal' :
                    $pageController->displayLegalPage();
                    break;
                case 'register':
                    if (isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['email']))
                        $userController->registerUser(htmlspecialchars(trim($_POST['login'])), htmlspecialchars(trim($_POST['mdp'])), htmlspecialchars(trim($_POST['email'])));
                    else
                        $pageController->displayRegisterPage();
                    break;
                case 'login' :
                    $pageController->displayLoginPage();
                    break;
                case 'validUserA' :
                    if (isset($_POST['login']) && isset($_POST['mdp']))
                        $userController->checkClassicUser(htmlspecialchars(trim($_POST['login'])), htmlspecialchars(trim($_POST['mdp'])));
                    $adminController->displayAdminPage();
                    break;
                case 'validUserB' :
                    if (isset($_POST['login']) && isset($_POST['mdp']))
                        $userController->checkClassicUser(htmlspecialchars(trim($_POST['login'])), htmlspecialchars(trim($_POST['mdp'])));
                    $pageController->displayLoginPage();
                    break;
                case 'logout' :
                    $userController->logout();
                    break;
                case 'addComment' :
                    if (isset($_GET['idChapter']))
                        $pageController->addComment(htmlspecialchars($_GET['idChapter']), trim($_POST['comment']));
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
                case 'admin' :
                    if ($adminController->checkIsAdmin()) {
                        if (isset($_GET['ac'])) {
                            switch ($_GET['ac']) {
                                case 'log' :
                                    $adminController->displayAdminPage();
                                    break;
                                case 'new' :
                                    $adminController->createNewArticle();
                                    break;
                                case 'save' :
                                    if (isset($_POST['save']) && htmlspecialchars(isset($_GET['idChapter']))
                                        && isset($_POST['numberArticle']) && isset($_POST['titleArticle']) && isset($_POST['textArticle']))
                                        $adminController->saveArticle($_POST['save'], htmlspecialchars($_GET['idChapter']), $_POST['numberArticle'], $_POST['titleArticle'], $_POST['textArticle']);
                                    break;
                                case 'modifyChapter' :
                                    if (isset($_GET['idChapter']))
                                        $adminController->modifyArticle(htmlspecialchars($_GET['idChapter']));
                                    break;
                                case 'publish' :
                                    if (isset($_GET['idChapter']))
                                        $adminController->publish(htmlspecialchars($_GET['idChapter']));
                                    break;
                                case 'unPublish' :
                                    if (isset($_GET['idChapter']))
                                        $adminController->unPublish(htmlspecialchars($_GET['idChapter']));
                                    break;
                                case 'deleteChapter' :
                                    if (isset($_GET['idChapter']))
                                        $adminController->deleteChapter(htmlspecialchars($_GET['idChapter']));
                                    break;
                                case 'manualApprove' :
                                    if (isset($_GET['idComment']))
                                        $adminController->approveComment(htmlspecialchars($_GET['idComment']));
                                    break;
                                case 'deleteComment' :
                                    if (isset($_GET['idComment']))
                                        $adminController->deleteComment(htmlspecialchars($_GET['idComment']));
                                    break;
                                case 'commentCheck' :
                                    $adminController->commentChecking();
                                    break;
                                default:
                                    $adminController->displayAdminPage();
                            }
                        }
                        else
                                $adminController->displayAdminPage();
                    }
                    break;
                default:
                    $_SESSION['error'] = "action : " . $_GET['action'] . " non reconnu, retour accueil - penser à suppriemr ce message de debug";
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