<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */

ob_start(); ?>
<div class="content col-lg-12">
    <h1>BILLET SIMPLE POUR L'ALASKA</h1>
    <div class="chapter col-lg-12">
    <?php while ($data= $this->_oneChapter->fetch()) { ?>
        <h2>Chapitre : <?= htmlspecialchars($data['numberChapter']) ?>
            </br><span class="extractTitle"><?= htmlspecialchars($data['title']) ?></span>
            </br><span class="extractSubTitle">publié le <?= $data['creation_date_fr'] ?></span>
        </h2>
        <p><?= nl2br($data['content']) ?> <br/></p>
    </div>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] != '') { ?>
        <div class="postComment col-lg-12">
            <form action="index.php?action=addComment&amp;idChapter=<?= $data['id'] ?>" method="post">
                <fieldset id="fieldsetLoginForm">
                    <legend>Bonjour <?= $_SESSION['login'] ?>, poster un commentaire :</legend>
                    <div>
                        <label for="comment">Commentaire</label><br/>
                        <textarea id="commentTextarea" name="comment" required></textarea>
                    </div>
                    <div>
                        <button type="submit">Poster le commentaire</button>
                    </div>
                </fieldset>
            </form>
        </div>
    <?php } else { ?>
        <div class="postComment col-lg-12">
            <h3>Connectez-vous pour poster un commentaire :</h3>
            <a href="index.php?action=login"><button>Connexion au site</button></a>
        </div>
    <?php }
    }
    $this->_oneChapter->closeCursor();?>
    <div class="comments col-lg-12">
        <h2>Commentaires :</h2>
        <?php if ($this->_commentsChapterList->rowCount() == 0) {?>
            <div class="oneComment">
                <p class="bottom">Pas de commentaires pour le moment, soyez le premier !</p>
            </div>
        <?php }
            while ($data= $this->_commentsChapterList->fetch()) {?>
                <div class="oneComment">
                    <h4>
                        Posté par <em><?= htmlspecialchars($data['login']) ?></em>
                        , le <?= $data['comment_date_fr'] ?>
                    </h4>
                    <p>
                        <?= nl2br(htmlspecialchars($data['comment'])) ?> <br />
                    </p>
                    <ul class="menuComment bottom">
                        <li class="like" class="leftLi"><?= $data['nbLike'] ?></li>
                        <li class="likeButton"><a href="index.php?action=likeComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id'] ?>"><i class="far fa-thumbs-up"></i></a></li>
                        <li class="dislike"><?= $data['nbDislike'] ?></li>
                        <li class="dislikeButton"><a href="index.php?action=unlikeComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id']?> "><i class="far fa-thumbs-down"></i></a></li>
                        <?php if ($data['signaled'] == 0) {?>
                            <li class="signaledButton rightLi"><a href="index.php?action=signaledComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id'] ?>"><i class="fas fa-door-closed">&nbspsignaler</i></a></li>
                        <?php } else if ($data['signaled'] == 1 && $data['manualApprove'] == 0) {?>
                        <li class="signaled rightLi"><i class="fas fa-door-closed">&nbspCommentaire signalé, en attente de modération</i></li>
                        <?php }  else if ($data['signaled'] == 1 && $data['manualApprove'] == 1) {?>
                        <li class="approve rightLi"><i class="fas fa-check">&nbspCommentaire approuvé suite à signalement</i></li>
                    <?php } ?>
                    </ul>
                </div>
        <?php }?>
    </div>
</div>
<?php
$this->_commentsChapterList->closeCursor();
$content = ob_get_clean(); ?>
<?php require('./view/frontend/template.php'); ?>