<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 21/11/2018
 * Time: 19:56
 */
namespace Handler\utils;

trait CleanArgument
{
    public function getCleanArgument($name)
    {
        if (isset($_GET[$name])) {
            if (!empty(($cleanGet = trim(htmlspecialchars($_GET[$name]))))) {
                return $cleanGet;
            }
        } else if (isset($_POST[$name])) {
            if (!empty(($cleanGet = trim(htmlspecialchars($_POST[$name]))))) {
                return $cleanGet;
            }
        }
        $_SESSION['error'] = "Erreur interne : paramètre manquant ou vide";
        return null;
    }
}

trait IsConnected
{
    public function isConnected () {
        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                return true;
        }
        return false;
    }
}