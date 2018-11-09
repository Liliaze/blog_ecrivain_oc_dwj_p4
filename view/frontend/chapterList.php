<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */
ob_start(); ?>
    <h1 class="col-lg-8">LISTE DES CHAPITRES !!!</h1>
    <h2 class="col-lg-6">Découvrez les derniers épisodes"</h2>
<?php $intro = ob_get_clean();
ob_start();
while ($data= $this->_chapterList->fetch())
{
    ?>
    <div class="chapter">
        <h3>
            <?= htmlspecialchars($data['id']). ":" . htmlspecialchars($data['title']) ?>
            <br />
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= substr(nl2br(htmlspecialchars($data['content'])), 0, 255);  ?>
            <a class="readMore" href="index.php?action=goChapter&amp;idChapter=<?=htmlspecialchars($data['id'])?>">Lire plus..."</a>
            <br />
        </p>
        <br />
    </div>
    <?php
}
$this->_chapterList->closeCursor();
?>
<?php $part1 = ob_get_clean(); ?>
<?php $part2 = "vide"; ?>
<?php require('./view/frontend/template.php'); ?>