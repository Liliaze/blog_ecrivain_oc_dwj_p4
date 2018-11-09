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
    public function displayAdminPage($login, $mdp) {

        $this->_user = $this->_userManager->checkUser($login, $mdp);
        if ($this->_user == false)
            return;
        if ($this->_user >= 1)
            $this->_admin = $this->_userManager->getStatus($login);
        if ($this->_admin == 1)
            require('view/admin/admin.php');
    }
    public function checkClassicUser($login, $mdp) {
        $this->_user = $this->_userManager->checkUser($login, $mdp);
        echo $this->_user;
        return $this->_user;
    }
}