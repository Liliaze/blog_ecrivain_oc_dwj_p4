<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 14:16
 */
require_once('model/ChapterManager.php');

class ChapterController {
    private $_chapterData;
    private $_oneChapter;
    private $_chapterList;

    public function __construct() {
        $this->_chapterData = new ChapterManager();
        $this->updateChapterList();
        $this->_oneChapter = $this->_chapterData->getChapter(1);
    }
    public function updateChapterList() {
        $this->_chapterList = $this->_chapterData->getChapterList();
    }
    public function setOneChapter($idChapter) {
        $this->_oneChapter = $this->_chapterData->getChapter($idChapter);
    }
    public function displayChapter($idChapter)
    {
        $this->setOneChapter($idChapter);
        require('view/frontend/chapter.php');
    }
    public function displayChapterList()
    {
        require('view/frontend/chapterList.php');
    }
}