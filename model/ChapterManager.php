<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 23:13
 */

require_once('model/Manager.php');

class ChapterManager extends Manager
{
    public function getChapterList()
    {
        $chapter = $this->_db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapter ORDER BY id DESC ');
        return $chapter;
    }
    public function getChapter($postId)
    {
        $chapter = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapter WHERE id=?');
        $chapter->execute(array($postId));
        return $chapter;
    }

}