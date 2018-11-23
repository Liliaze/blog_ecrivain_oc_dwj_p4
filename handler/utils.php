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
            if ((string)($cleanGet = trim(htmlspecialchars($_GET[$name]))) || $cleanGet == "0") {
                return $cleanGet;
            }
        } else if (isset($_POST[$name])) {
            if ((string)($cleanGet = trim(htmlspecialchars($_POST[$name]))) || $cleanGet == "0") {
                return $cleanGet;
            }
        }
        $_SESSION['info'] = "numéro article:".trim(htmlspecialchars($_POST[$name]))."-publiée";
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