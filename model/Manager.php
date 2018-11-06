<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 22:10
 */

class Manager
{
    protected $_db;

    public function __construct()
    {
        $this->_db = new PDO('mysql:host=localhost;dbname=p4;charset=utf8', 'root', '');
    }
    protected function getDB()
    {
        return $this->_db;
    }
    /*
    function __destruct() {
        print "\nDestruction de " . $this->name . "\n";
    }
    */
}