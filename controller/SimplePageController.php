<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 14:16
 */
class SimplePageController
{
    public function sayWelcome()
    {
        require('view/frontend/home.php');
    }
    public function displayAuthorPage()
    {
        require('view/frontend/author.php');
    }
    public function displayContactPage() {
        require('view/frontend/contact.php');
    }

}