<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
while ($data = $chapter->fetch())  {
?>
    <h1 class="col-lg-12">Création d'un nouvel article</h1>
    <form id= "formNewArticle" action="index.php?action=admin&amp;ac=save&amp;idChapter=<?=htmlspecialchars($data['id'])?>" method="post" class="col-lg-8 col-lg-offset-2">
        <div>
            <label for="numberArticle">Numéro de l'épisode</label><br />
            <input type="number" name="numberArticle" value="<?=$data['numberChapter']?>" />
        </div>
        <div>
            <label for="titleArticle">Titre de l'épisode</label><br />
            <input type="text" name="titleArticle" value="<?=$data['title']?>" />
        </div>
        <div>
            <label for="textArticle">Login</label><br />
            <textarea id="newArticle" name="textArticle"><?=$data['content']?></textarea>
        </div>
        <div>
            <button type="submit" form="formNewArticle" name="save" value="save">Enregistrer</button>
            <button type="submit" form="formNewArticle" name="save" value="publish">Publier</button>
            <button type="submit" form="formNewArticle" name="save" value="chapter">Publier et voir en ligne</button>
            <button type="submit" form="formNewArticle" name="save" value="admin">Retour à la gestion du site</button>
        </div>
    </form>
<?php }
$content = ob_get_clean();
require('./view/frontend/template.php'); ?>