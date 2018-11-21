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
    <h1>Gestion de l'ensemble des commentaires :</h1>
    <img id="commentChecking" src="public/image/commentaire.png" alt="symbole discussion entre 2 personnes">

    <?php if ($commentList->rowCount() == 0) { ?>
        <h3 id="noSignaledComment"> " AUCUN ARTICLE SIGNALE POUR LE MOMENT, VOUS POUVEZ ECRIRE TRANQUILLEMENT " </h3>
    <?php }
    else {
        while ($data = $commentList->fetch()) { ?>
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
                    <!-- <a class="modify" href="index.php?action=admin&amp;ac=modifyComment&amp;idComment=<?= htmlspecialchars($data['id']) ?>">modifier</a>-->
                    <?php if($data['manualApprove'] == 0) {?>
                    <a href="index.php?action=admin_manualApproveList&amp;idComment=<?= htmlspecialchars($data['id']) ?>">approuver</a>
                    <?php } ?>
                    <a href="index.php?action=admin_deleteCommentList&amp;idComment=<?= htmlspecialchars($data['id']) ?>"
                       onclick="return confirm('Etes vous sûre de vouloir supprimer ce commentaire ?')">supprimer</a>
                </div>
                </br>
            </div>
        <?php }
    }
        $commentList->closeCursor();
?>
    <a href="index.php?action=admin_home"><button>Retour à la gestion du site</button></a>
    <a href="index.php?action=logout"><button>Déconnexion</button></a>

<?php
$content = ob_get_clean();
require('./view/frontend/template.php'); ?>