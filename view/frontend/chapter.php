<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */

ob_start(); ?>
    <h1 class="col-lg-8" xmlns="http://www.w3.org/1999/html">L'AMBIVALENCE !!!</h1>
<?php $intro = ob_get_clean();
ob_start();
while ($data= $this->_oneChapter->fetch())  { ?>
    <div class="chapter col-lg-12">
        <h2 class="col-lg-12">Chapitre : <?= htmlspecialchars($data['id']) ?></h2>
        <h3 class="col-lg-12">
            <em><?= htmlspecialchars($data['title']) ?></em>
            le <?= $data['creation_date_fr'] ?>
        </h3>

        <p class="col-lg-10">
            <?= nl2br(htmlspecialchars($data['content'])) ?> <br />
        </p>
    </div>
    <div class="col-lg-12">
        <form action="index.php?action=addComment&amp;idChapter=<?= $data['id'] ?>" method="post">
            <div>
                <label for="author">Login</label><br />
                <input type="text" id="loginComment" name="login" />
            </div>
            <div>
                <label for="mdp">Mot de passe</label><br />
                <input type="text" id="mdpComment" name="mdp" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="commentTextarea" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
    </div>
    <?php
}
$this->_oneChapter->closeCursor();
?>
<?php $part1 = ob_get_clean();
ob_start();?>
    <div class="comments col-lg-12">
        <h2 class="col-lg-12">Commentaires :</h2>

<?php if ($this->_commentsChapterList->rowCount() == 0) {?> Pas de commentaires <?php }
    while ($data= $this->_commentsChapterList->fetch()) {?>
        <h4 class="col-lg-12">
            Posté par <em><?= htmlspecialchars($data['login']) ?></em>
            , le <?= $data['comment_date_fr'] ?>
        </h4>

        <p class="col-lg-12">
            <?= nl2br(htmlspecialchars($data['comment'])) ?> <br />
        </p>
    </div>
<?php
}
$this->_commentsChapterList->closeCursor();
$part2 = ob_get_clean(); ?>
<?php require('./view/frontend/template.php'); ?>