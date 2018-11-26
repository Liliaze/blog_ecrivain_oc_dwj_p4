<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
$this->isAdmin();
ob_start();
?>
    <h1 class="col-lg-12">Vous êtes sur la page d'administration du site !</h1>
    <h2>Les derniers commentaires signalés :</h2>

    <?php if ($this->_commentsSignaledList->rowCount() == 0) { ?>
        <h3 id="noSignaledComment"> " AUCUN ARTICLE SIGNALE POUR LE MOMENT, VOUS POUVEZ ECRIRE TRANQUILLEMENT " </h3>
    <?php }
    else {
        while ($data = $this->_commentsSignaledList->fetch()) { ?>
            <div class="extractChapter">
                <div>
                    <span class="adminCommentLogin">Posté par <?= htmlspecialchars($data['login']) ?>
                        , le <?= $data['comment_date_fr'] ?></span>
                    <span class="adminCommentChapter"></br>sur le chapitre n°<?= $data['numberChapter'] ?>
                        : <?= $data['title'] ?></span>
                    <span class="adminCommentContent"></br><?= nl2br(htmlspecialchars($data['comment'])) ?></span>
                    <span class="adminCommentLike"></br> Aimé <?= htmlspecialchars($data['nbLike']) ?>
                        fois et détesté <?= htmlspecialchars($data['nbDislike']) ?> fois.</span>
                </div>
                <div class="buttonModify">
                     <!--<a class="modify"
                       href="index.php?action=admin&amp;ac=modifyComment&amp;idComment=<?= htmlspecialchars($data['id']) ?>">modifier</a> -->
                    <a href="index.php?action=admin_manualApprove&amp;idComment=<?= htmlspecialchars($data['id']) ?>">approuver</a>
                    <a href="index.php?action=admin_deleteComment&amp;idComment=<?= htmlspecialchars($data['id']) ?>"
                       onclick="return confirm('Etes vous sûre de vouloir supprimer ce commentaire ?')">supprimer</a>
                </div>
                </br>
            </div>
        <?php }
    }
        $this->_commentsSignaledList->closeCursor();
?>
    <div class="figureAdmin col-lg-12">
        <a href="index.php?action=admin_new" >
            <figure >
                <img id="plume" src="public/image/plume_ecrivian.png" alt="plume d'écrivain à l'encre">
                <figcaption>Rédiger un nouvel épisode</figcaption>
            </figure>
        </a>
        <a href="index.php?action=admin_commentCheck">
            <figure >
                <img id="commentChecking" src="public/image/commentaire.png" alt="symbole discussion entre 2 personnes">
                <figcaption>Gérer les commentaires</figcaption>
            </figure>
        </a>
    </div>
    <h2>Liste des épisodes :</h2>
    <?php while ($data= $this->_chapterList->fetch()) {?>
        <div class="extractChapter">
            <div>
                <p class="adminTitleChapter"><?= "Episode ".htmlspecialchars($data['numberChapter']). " : " . $data['title'] ?></p>
                <p class="adminExtractChapter"><?= substr(nl2br($data['content']), 0, 250);  ?> ...</p>
                <p class="adminDateChapter">créé le <?= $data['creation_date_fr']?>, mis à jour le <?= $data['update_date_fr'] ?></p>
            </div>
            <div class="buttonModify">
                <a class="modify" href="index.php?action=admin_modifyChapter&amp;idChapter=<?=htmlspecialchars($data['id'])?>">modifier</a>
                <?php if ($data['published'] == 0) {?>
                <a href="index.php?action=admin_publish&amp;idChapter=<?=htmlspecialchars($data['id'])?>">publier</a>
                <?php } else if ($data['published'] == 1) {?>
                <a href="index.php?action=admin_unPublish&amp;idChapter=<?=htmlspecialchars($data['id'])?>">dépublier</a>
                <?php }?>
                <a href="index.php?action=admin_deleteChapter&amp;idChapter=<?=htmlspecialchars($data['id']) ?>" onclick="return confirm('Etes vous sûre de vouloir supprimer ce chapitre ?')">supprimer</a>
            </div>
            <br/>
        </div>
    <?php }
    $this->_chapterList->closeCursor();?>
    <br/>
    <a href="index.php?action=logout"><button>Déconnexion</button></a>

<?php
$content = ob_get_clean();
require('./view/frontend/template.php'); ?>