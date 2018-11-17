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
        $chapter = $this->_db->query('SELECT id, numberChapter, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS update_date_fr, published, nbLike, nbDislike FROM chapter ORDER BY id DESC ');
        return $chapter;
    }
    public function getChapter($postId)
    {
        $chapter = $this->_db->prepare('SELECT id, numberChapter, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS update_date_fr FROM chapter WHERE id=?');
        $chapter->execute(array($postId));
        return $chapter;
    }
    public function getLastPublishChapter()
    {
        $lastChapter = $this->_db->query('SELECT id, numberChapter, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS update_date_fr FROM chapter WHERE published=1 ORDER BY id DESC LIMIT 1');
        return $lastChapter;
    }
    public function getLastChapter()
{
    $lastChapter = $this->_db->query('SELECT id, numberChapter, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS update_date_fr FROM chapter ORDER BY id DESC LIMIT 1');
    return $lastChapter;
}
    public function newChapter($title, $number, $content)
    {
        ////TO-DO : corriger requete !!!!
        $newChapter = $this->_db->prepare('INSERT INTO chapter (title, numberChapter, content, creationDate, updateDate) VALUES(?, ?, ?, NOW(), NOW())');
        $newChapter->execute(array($title, $number, $content));
    }
    public function updateChapter($id, $number, $title, $content)
    {
        $newChapter = $this->_db->prepare('UPDATE chapter SET title=?, numberChapter=?, content=?, updateDate=NOW() WHERE id=?');
        $newChapter->execute(array($title, $number, $content, $id));
        return (($this->getChapter($id)));
    }
    public function publishChapter($id) {
        $newChapter = $this->_db->prepare('UPDATE chapter SET published=1, deleted=0, updateDate=NOW() WHERE id=?');
        $updateLines = $newChapter->execute(array($id));
        return $updateLines;
    }
    public function lightDeleteChapter($id)
    {
        $newChapter = $this->_db->prepare('UPDATE chapter SET published=0, deleted=0, updateDate=NOW() WHERE id=?');
        $updateLines = $newChapter->execute(array($id));
        echo "retour lightDelete : ".$updateLines;
        return $updateLines;
    }
    public function deleteDefinitivelyChapter($id)
    {
        $chapter = $this->_db->prepare('DELETE FROM chapter WHERE chapter.id=?');
        $chapter->execute(array($id));
        return $chapter;
    }
}