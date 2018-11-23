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
    public function getCleanArgument($name, $optionHTML)
    {
        $cleanGet = null;
        if (isset($_GET[$name])) {
            if ($optionHTML)
                $cleanGet = trim(htmlspecialchars($_GET[$name]));
            else
                $cleanGet = trim($_GET[$name]);

        } else if (isset($_POST[$name])) {
            if ($optionHTML)
                $cleanGet = trim(htmlspecialchars($_POST[$name]));
            else
                $cleanGet = trim($_POST[$name]);
        }
        if (strlen($cleanGet) < 0)
            $_SESSION['error'] = "Erreur interne : paramètre manquant ou vide";
        return $cleanGet;
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