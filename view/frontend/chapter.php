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

        <div class="linkOtherChapter">
            <div class="linkOtherChapterLeft">
            <?php if ($this->_previousIdChapter != null) { ?>
                <a href="index.php?action=chapter&amp;idChapter=<?= $this->_previousIdChapter ?>"><button><i class="fas fa-angle-double-left"></i>&nbspCHAPITRE&nbspPRECEDENT</button></a>
            <?php } ?>
            </div>
            <div class="linkOtherChapterRight">
            <?php if ($this->_nextIdChapter != null) { ?>
                <a href="index.php?action=chapter&amp;idChapter=<?= $this->_nextIdChapter?>"><button><i class="fas fa-angle-double-right"></i>&nbspCHAPITRE&nbspSUIVANT</button></a>
            <?php } ?>
            </div>
        </div>

        <p><?= nl2br(strip_tags($data['content'], '<p><a>')) ?> <br/></p>

        <div class="linkOtherChapter">
            <div class="linkOtherChapterLeft">
                <?php if ($this->_previousIdChapter != null) { ?>
                    <a href="index.php?action=chapter&amp;idChapter=<?= $this->_previousIdChapter ?>"><button><i class="fas fa-angle-double-left"></i>&nbspCHAPITRE&nbspPRECEDENT</button></a>
                <?php } ?>
            </div>
            <div class="linkOtherChapterRight">
                <?php if ($this->_nextIdChapter != null) { ?>
                    <a href="index.php?action=chapter&amp;idChapter=<?= $this->_nextIdChapter?>"><button><i class="fas fa-angle-double-right"></i>&nbspCHAPITRE&nbspSUIVANT</button></a>
                <?php } ?>
            </div>
        </div>

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
                            <li class="like leftLi"><?= $data['nbLike'] ?></li>
                            <li class="myLikeButton"><a href="index.php?action=likeComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id'] ?>"><i class="far fa-thumbs-up"></i></a></li>
                            <li class="dislike"><?= $data['nbDislike'] ?></li>
                            <li class="dislikeButton"><a href="index.php?action=unlikeComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id']?> "><i class="far fa-thumbs-down"></i></a></li>
                            <?php if ($data['signaled'] == 0) {?>
                                <li class="signaledButton rightLi"><a href="index.php?action=signaledComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id'] ?>"><i class="fas fa-door-closed">&nbspsignaler</i></a></li>
                            <?php } else if ($data['signaled'] == 1 && $data['manualApprove'] == 0) {?>
                            <li class="signaled rightLi"><i class="fas fa-question">&nbsp;Signalé</i></li>
                            <?php }  else if ($data['signaled'] == 1 && $data['manualApprove'] == 1) {?>
                            <li class="approve rightLi"><i class="fas fa-check">&nbsp;Approuvé</i></li>
                        <?php } ?>
                        </ul>
                    </div>
            <?php }?>
            <div class="linkOtherChapter">
                <div class="linkOtherChapterLeft">
                    <?php if ($this->_previousIdChapter != null) { ?>
                        <a href="index.php?action=chapter&amp;idChapter=<?= $this->_previousIdChapter ?>"><button><i class="fas fa-angle-double-left"></i>&nbspCHAPITRE&nbspPRECEDENT</button></a>
                    <?php } ?>
                </div>
                <div class="linkOtherChapterRight">
                    <?php if ($this->_nextIdChapter != null) { ?>
                        <a href="index.php?action=chapter&amp;idChapter=<?= $this->_nextIdChapter?>"><button><i class="fas fa-angle-double-right"></i>&nbspCHAPITRE&nbspSUIVANT</button></a>
                    <?php } ?>
                </div>
            </div>
        <?php  } ?>
    </div>
</div>
<?php
$this->_commentsChapterList->closeCursor();
$content = ob_get_clean(); ?>
<?php require('./view/frontend/template.php'); ?>