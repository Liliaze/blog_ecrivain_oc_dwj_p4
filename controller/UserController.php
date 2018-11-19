<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 20:58
 */

require_once('model/UserManager.php');

class UserController
{
    private $_userManager;

    public function __construct() {
        $this->_userManager = new UserManager();
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
            if ($user->rowCount() != 1) {
                $_SESSION['warning'] = "Erreur : identifiant inconnu, merci de vérifier vos données.";
                return false;
            }
            while ($data = $user->fetch()) {
                if (password_verify($mdp,$data['mdp']) == false) {
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

    public function registerUser($login, $mdp) {
        $mdp = htmlspecialchars($mdp);
        $login = htmlspecialchars($login);
        if (!empty($mdp) && !empty($login)) {
            $this->_userManager->registerUser($login, password_hash($mdp, PASSWORD_ARGON2I));
            $this->checkClassicUser($login, $mdp);
            header('location: index.php?action=login');
        }
        else
            $_SESSION['warning'] = "Merci de vérifier les données saisies";
    }
}