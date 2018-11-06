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
    <a href="index.php?action=goChapter&amp;id=1"><h3 class="col-lg-12">Lien vers le dernier chapitre"</h3></a>
    <a href="index.php?action=goChapterList&amp;id=1"><h3 class="col-lg-12">Lien vers la liste des chapitres"</a>
    <h3 class="col-lg-12">Essaie de Bootstrap / template.php"</h3>
    <div class="row">
        <img class="col-lg-8 col-lg-offset-2" src='public/image/open-book.png' alt="Livre ancien ouvert"/>
    </div>
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