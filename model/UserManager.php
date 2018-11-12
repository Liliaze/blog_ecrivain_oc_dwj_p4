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
        $users = $this->_db->prepare('SELECT users.id, users.login, users.mdp FROM users WHERE login=?');
        $users->execute(array($login));
        if ($users->rowCount() != 1) {
            $_SESSION['error'] = "Erreur : identifiant inconnu, merci de vérifier vos données. Première connexion ? enregistrez-vous : ";
            return false;
        }
        while ($data = $users->fetch()) {
            if ($data['mdp'] !== $mdp) {
                $_SESSION['error'] = "Erreur : mauvais mot de passe";
            return false;
            }
            else {
                return $data['id'];
            }
        }
        return false;
    }
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
    }
}