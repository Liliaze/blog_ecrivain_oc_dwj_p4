<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */
ob_start(); ?>
    <h1>UN BILLET SIMPLE POUR L'ALASKA</h1>
    <h4><a href="index.php?action=chapter&amp;idChapter=1">"""Lien vers le premier chapitre""" </a></h4>
    <h2>Liste des épisodes.</h2>
    <h3>Découvrez les derniers épisodes du plus récent au plus ancien :</h3>
    <?php while ($data= $this->_chapterList->fetch()) {
        if ($data['published'] == 1) { ?>
            <div class="extractChapter">
                <h4>
                    <span class="extractTitle"><?= "Episode ".htmlspecialchars($data['numberChapter']). " : " . $data['title'] ?></span>
                    </br>
                    <span class="extractSubTitle">publié le <?= $data['creation_date_fr'] ?></span>
                </h4>
                <br />
                <p>
                    <?= substr(nl2br($data['content']), 0, 255);  ?>
                    <br/>
                </p>
                <p class="readMore">
                    <a class="readMore" href="index.php?action=chapter&amp;idChapter=<?=htmlspecialchars($data['id'])?>"
                    <br/>Lire plus...</a>
                 </p>
             </div>
    <?php
        }
    }
$this->_chapterList->closeCursor();
$content = ob_get_clean();
require('./view/frontend/template.php'); ?>