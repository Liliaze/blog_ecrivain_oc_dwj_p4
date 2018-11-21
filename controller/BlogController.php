<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 14/11/2018
 * Time: 22:47
 */
class BlogController
{
    public function displayAuthorPage()
    {
        require('view/frontend/author.php');
    }
    public function displayLegalPage() {
        require('view/frontend/legal.php');
    }
}