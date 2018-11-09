<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */
ob_start();
?>
    <h1 class="col-lg-8">Bienvenue sur mon blog</h1>
    <h2 class="col-lg-6">Découvrez le dernier épisode de "Un nouveau départ"</h2>
<?php
$intro = ob_get_clean();
ob_start();
?>
    <h3 class="col-lg-12">Extrait du dernier chapitre :"</h3>
    <div class="row">
      <?php while ($data= $this->_lastChapter->fetch()) {?>
    <div class="lastChapter">
        <h3>
            <em><?= htmlspecialchars($data['id']). ":" . htmlspecialchars($data['title']) ?></em>
            <br />
            créé le <?= $data['creation_date_fr'] ?>
        </h3>
        <p>
            <?= substr(nl2br(htmlspecialchars($data['content'])), 0, 255);  ?>
            <a class="readMore" href="index.php?action=goChapter&amp;idChapter=<?=htmlspecialchars($data['id'])?>">
            <br/>Lire plus..."</a>
            <br/>
        </p>
        <br />
    </div>
    <?php }
      $this->_lastChapter->closeCursor();?>
    </div>
    <h4><a href="index.php?action=goChapter&amp;idChapter=1"><h3 class="col-lg-12">Lien vers le premier chapitre"</a></h4>
    <h4><a href="index.php?action=goChapterList&amp;id=1"><h3 class="col-lg-12">Lien vers la liste des chapitres"</a></h4>
<?php
$part1 = ob_get_clean();
ob_start();
for ($i = 0; $i < 3; $i++) {
?>
        <img class="col-lg-4" src='public/image/open-book.png' alt="Livre ancien ouvert"/>
<?php
}
$part2 = ob_get_clean();
require('template.php'); ?>