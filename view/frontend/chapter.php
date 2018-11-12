<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */

ob_start(); ?>
    <h1>AMBIVALENCE</h1>
    <div class="chapter col-lg-12">
    <?php while ($data= $this->_oneChapter->fetch())  { ?>
            <h2>Chapitre : <?= htmlspecialchars($data['id']) ?>
                </br><span class="extractTitle"><?= htmlspecialchars($data['title']) ?></span>
                </br><span class="extractSubTitle">publié le <?= $data['creation_date_fr'] ?></span>
            </h2>
            <p>
                <?= nl2br(htmlspecialchars($data['content'])) ?> <br />
            </p>
        </div>
        <div>
            <form action="index.php?action=addComment&amp;idChapter=<?= $data['id'] ?>" method="post">
                <div>
                    <label for="comment">Commentaire</label><br />
                    <textarea id="commentTextarea" name="comment"></textarea>
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>
            <?= $textError ?>
        </div>
    <?php }
    $this->_oneChapter->closeCursor();?>
    <div class="comments col-lg-12">
        <h2 class="col-lg-12">Commentaires :</h2>
        <?php if ($this->_commentsChapterList->rowCount() == 0) {?> Pas de commentaires <?php }
            while ($data= $this->_commentsChapterList->fetch()) {?>
                <h4>
                    Posté par <em><?= htmlspecialchars($data['login']) ?></em>
                    , le <?= $data['comment_date_fr'] ?>
                </h4>
                <p>
                    <?= nl2br(htmlspecialchars($data['comment'])) ?> <br />
                </p>
                <ul class="menuComment">
                    <li><button id="like"> <?= $data['nbLike'] ?></li>
                    <li><a href="index.php?action=likeComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id'] ?>"><button id="likeButton"><i class="far fa-thumbs-up"></i></button></a></li>
                    <li><button id="dislike"> <?= $data['nbDislike'] ?></li>
                    <li><a href="index.php?action=unlikeComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id']?> "><button id="dislikeButton"><i class="far fa-thumbs-down"></i></button></a></li>
                    <li><a href="index.php?action=signaledComment&amp;idChapter=<?= $data['idChapter'] ?>&amp;idComment=<?= $data['id'] ?>"><button id="signaled"><i class="fas fa-door-open"></i><?= $data['signaled']?> signaler</button></a></li>
                </ul>
        <?php }?>
    </div>
<?php
$this->_commentsChapterList->closeCursor();
$content = ob_get_clean(); ?>
<?php require('./view/frontend/template.php'); ?>