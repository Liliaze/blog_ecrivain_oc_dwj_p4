<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 01/11/2018
 * Time: 14:50
 */
    require("./controller/ChapterController.php");
    require("./controller/SimplePageController.php");
    require("./controller/UserController.php");

    $simplePageController = new SimplePageController();
    $chapterController = new ChapterController();
    $userController = new UserController();
    try {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'goHome' :
                    $simplePageController->sayWelcome();
                    break;
                case 'goChapter' :
                    $chapterController->displayChapter($_GET['id']);
                    break;
                case 'goChapterList' :
                    $chapterController->displayChapterList();
                    break;
                case 'goAuthor' :
                    $simplePageController->displayAuthorPage();
                    break;
                case 'goLogin' :
                    $userController->displayLoginPage();
                    break;
                case 'goContact' :
                    $simplePageController->displayContactPage();
                    break;
                case 'goAdmin' :
                    break;
                default:
                    $simplePageController->sayWelcome();
            }
        }
        else {
            $simplePageController->sayWelcome();
        }
    }
    catch(Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }