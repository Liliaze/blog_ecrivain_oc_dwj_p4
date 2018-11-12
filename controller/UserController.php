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
    private $_user;
    private $_admin;

    public function __construct() {
        $this->_userManager = new UserManager();
    }

    public function unlog() {
        $_SESSION['id'] = '';
        $_SESSION['admin'] = '';
        $_SESSION['login'] = '';
    }
    public function checkClassicUser($login, $mdp) {
        if (!empty(htmlspecialchars($mdp) && !empty(htmlspecialchars($login)))) {
            $this->_user = $this->_userManager->checkUser($login, $mdp);
            if ($this->_user != null) {
                $_SESSION['id'] = $this->_user;
                $_SESSION['login'] = $login;
                $_SESSION['admin'] = ($this->_user == 1) ? 1 : 0;
                $_SESSION['success'] = 'BIENVENUE ' . $login . ' : vous êtes connecté';
            }
        }
        else {
            $this->unlog();
        }
    }
    //ajout user / delete user.... / page profil
}