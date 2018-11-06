<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */

ob_start(); ?>
    <h1 class="col-lg-8">LE tout dernier chapitre !!!</h1>
    <h2 class="col-lg-6">Découvrez le dès sa sortie"</h2>
<?php $intro = ob_get_clean();
ob_start();
while ($data= $this->_oneChapter->fetch())
{
    ?>
    <div class="chapter">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="index.php?action=goComment&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
             <em><a href="index.php?action=goHome&amp;id=<?= $data['id'] ?>">Retour à l'accueil</a></em>
        </p>
    </div>
    <?php
}
$this->_oneChapter->closeCursor();
?>
<?php $part1 = ob_get_clean(); ?>
<?php $part2 = "vide"; ?>
<?php require('./view/frontend/template.php'); ?>