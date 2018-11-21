<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 20:58
 */

require_once('handler/utils.php');
require_once('model/UserManager.php');

class UserController
{
    use Handler\utils\CleanArgument, Handler\utils\IsConnected;

    private $_userManager;

    public function __construct() {
        $this->_userManager = new UserManager();
    }
    public function displayLoginPage() {
        require('view/frontend/login.php');
    }

    public function logout() {
        $_SESSION['id'] = '';
        $_SESSION['admin'] = '';
        $_SESSION['login'] = '';
        $_SESSION['success'] = 'Déconnexion réussie';
        header( 'location: index.php?action=login');
    }

    public function checkClassicUser($login, $mdp) {
        $mdp = htmlspecialchars($mdp);
        $login = htmlspecialchars($login);
        if (!empty($mdp) && !empty($login)) {
            $user = $this->_userManager->checkUser($login, $mdp);
            if ($user->rowCount() < 1) {
                $_SESSION['warning'] = "Erreur : identifiant inconnu, merci de vérifier vos données.";
                return false;
            }
            while ($data = $user->fetch()) {
                if (md5($mdp) != $data['mdp']) {
                    $_SESSION['error'] = "Erreur : mauvais mot de passe";
                    return false;
                }
                else {
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['login'] = $data['login'];
                    $_SESSION['admin'] = $data['admin'];
                    $_SESSION['success'] = 'Bienvenue '.$_SESSION['login'] . " !" ;
                }
            }
            $user->closeCursor();
        }
        else {
            $_SESSION['error'] = 'erreur champs login ou mdp vide';
            $this->logout();
        }
    }

    public function registerUser() {
        $mdp = $this->getCleanArgument('mdp');
        $login = $this->getCleanArgument('login');
        $email = $this->getCleanArgument('email');
        if ($mdp && $login && $email) {
            $singleUser = $this->_userManager->singleUser($login);
            if ($singleUser->rowCount() == 0) {
                $this->_userManager->registerUser($login, md5($mdp), $email);
                $this->checkClassicUser($login, $mdp);
                header('location: index.php?action=login');
            }
            else {
                $_SESSION['warning'] = "Ce pseudo existe déjà, merci d'en choisir un autre";
            }
        }
        else
            $_SESSION['warning'] = "Merci de vérifier les données saisies";
        require('view/frontend/register.php');
    }

    public function displayRegisterPage() {
        if (!isset($login) && !isset($mdp) && !isset($email)){
            $login="";
            $mdp="";
            $email="";
        }
        require('view/frontend/register.php');
    }
}