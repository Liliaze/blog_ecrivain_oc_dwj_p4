<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 22:12
 */

require_once('model/Manager.php');

class UserManager extends Manager
{
    public function checkUser($login, $mdp) {
        $users = $this->_db->prepare('SELECT users.id, users.login, users.mdp, users.admin FROM users WHERE login=?');
        $users->execute(array($login));
        return $users;
    }
    public function registerUser($login, $mdp) {
        $users = $this->_db->prepare('INSERT INTO users(login, mdp, lastConnexion, admin) VALUES (?, ?, NOW(), 0)');
        $users->execute(array($login, $mdp));
        $_SESSION['success'] = "Vous êtes maintenant enregistré et connecté sur le site";
    }/*
    public function getStatus($login)
    {
        $users = $this->_db->prepare('SELECT users.admin FROM users WHERE login=?');
        $users->execute(array($login));
        if ($users->rowCount() != 1) {
            $_SESSION['error'] = "Erreur : identifiant inconnu";
            return false;
        }
        while ($data = $users->fetch()) {
            return $data['admin'];
        }
    }*/
}