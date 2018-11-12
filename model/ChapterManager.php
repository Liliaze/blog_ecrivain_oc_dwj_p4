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
        $chapter = $this->_db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, nbLike, nbDislike FROM chapter ORDER BY id DESC ');
        return $chapter;
    }
    public function getChapter($postId)
    {
        $chapter = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapter WHERE id=?');
        $chapter->execute(array($postId));
        return $chapter;
    }
    public function getLastChapter()
    {
        $lastChapter = $this->_db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapter ORDER BY id DESC LIMIT 1');
        return $lastChapter;
    }
    public function addChapter($title, $content, $status)
    {
        $newChapter = $this->_db->prepare('INSERT INTO chapter(title, content, creationDate, updateDate, published, deleted) VALUES(?, ?, NOW(), NOW(), ?, 0)');
        $affectedLines = $newChapter->execute(array($title, $content, $status));
        echo "ligne new chapter : ".$affectedLines;
        return $affectedLines;
    }
    public function lightDeleteChapter($id)
    {
        $newChapter = $this->_db->prepare('UPDATE chapter SET published=0, deleted=0 WHERE id=?');
        $updateLines = $newChapter->execute(array($id));
        echo "retour lightDelete : ".$updateLines;
        return $updateLines;
    }
    public function deleteDefinitivelyChapter($id)
    {
        $newChapter = $this->_db->prepare('DELETE FROM chapter WHERE id=?');
        $deletedLines = $newChapter->execute(array($id));
        echo "retour ligne supprimé chapter : ".$deletedLines;
        return $deletedLines;
    }
}