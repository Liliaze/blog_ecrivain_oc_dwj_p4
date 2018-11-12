<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */
ob_start(); ?>
    <h1>LISTE DES EPISODES DE "AMBIVALENCE"</h1>
    <h2>Découvrez les derniers épisodes du plus récent au plus ancien</h2>
    <?php while ($data= $this->_chapterList->fetch()) {?>
        <div class="extractChapter">
            <h3>
                <span class="extractTitle"><?= "Episode ".htmlspecialchars($data['id']). " : " . htmlspecialchars($data['title']) ?></span>
                </br>
                <span class="extractSubTitle">publié le <?= $data['creation_date_fr'] ?></span>
            </h3>
            <br />
            <p>
                <?= substr(nl2br(htmlspecialchars($data['content'])), 0, 255);  ?>
                <br/>
            </p>
            <p class="readMore">
                <a class="readMore" href="index.php?action=goChapter&amp;idChapter=<?=htmlspecialchars($data['id'])?>"
                <br/>Lire plus...</a>
             </p>
         </div>
    <?php }?>
    <h4><a href="index.php?action=goChapter&amp;idChapter=1"><h3>Lien vers le premier chapitre : </a></h4>
<?php
$this->_chapterList->closeCursor();
$content = ob_get_clean();
require('./view/frontend/template.php'); ?>