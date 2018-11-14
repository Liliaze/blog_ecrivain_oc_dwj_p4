<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
?>
    <h1 class="col-lg-12">Vous êtes sur la page ADMIN !!!!!!! CONGRATULATION</h1>
    <h2>Les derniers commentaires signalés :</h2>
    <p>TO DO /: Lister ici les commentaires signaler avec un bouton pour approuver malgrès tout ou supprimer</p>
    <div class="col-lg-12">
        <a href="index.php?action=admin&amp;ac=new"><button class="col-lg-offset-1 col-lg-2">Rédiger un nouvel épisode</button></a>
        <button class="col-lg-offset-2 col-lg-2">Modifier un épisode</button>
        <button class="col-lg-offset-2 col-lg-2">Gérer les commentaires</button>
    </div>
    <h2>Liste des épisodes</h2>
    <p>TO DO /: Lister ici les épisodes avec boutons pour modifier, publier, dépublier ou supprimer</p>
    <?php while ($data= $this->_chapterList->fetch()) {?>
        <div class="extractChapter">
            <div>
                <span class="adminTitleChapter"><?= "Episode ".htmlspecialchars($data['numberChapter']). " : " . $data['title'] ?></span>
                <span class="adminExtractChapter"></br><?=substr(nl2br($data['content']), 0, 50)." ...";  ?></span>
                <span class="adminDateChapter"></br>créé le <?= $data['creation_date_fr']?>, mis à jour le <?= $data['update_date_fr'] ?></span>
            </div>
            <div class="buttonModifyChapter">
                <a class="modify" href="index.php?action=admin&amp;ac=modify&amp;idChapter=<?=htmlspecialchars($data['id'])?>">modifier</a>
                <a href="index.php?action=admin&amp;ac=publish&amp;idChapter=<?=htmlspecialchars($data['id'])?>">publier</a>
                <a href="index.php?action=admin&amp;ac=unPublish&amp;idChapter=<?=htmlspecialchars($data['id'])?>">dépublier</a>
                <a href="index.php?action=admin&amp;ac=delete&amp;idChapter=<?=htmlspecialchars($data['id']) ?>" onclick="return confirm('Etes vous sûre de vouloir supprimer ce chapitre ?')">supprimer</a>
            </div>
            </br>
        </div>
    <?php }?>
    <br/>
    <a href="index.php?action=logout"><button>Déconnexion</button></a>

<?php
$content = ob_get_clean();
require('./view/frontend/template.php'); ?>