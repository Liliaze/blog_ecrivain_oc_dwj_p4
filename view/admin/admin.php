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
        <button class="col-lg-offset-1 col-lg-2">Rédiger un nouvel épisode</button>
        <button class="col-lg-offset-2 col-lg-2">Modifier un épisode</button>
        <button class="col-lg-offset-2 col-lg-2">Gérer les commentaires</button>
    </div>
    <h2>Liste des épisodes</h2>
    <p>TO DO /: Lister ici les épisodes avec boutons pour modifier, publier, dépublier ou supprimer</p>
    <br/>
    <a href="index.php?action=unlog"><button>Déconnexion</button></a>

<?php
$content = ob_get_clean();
require('./view/frontend/template.php'); ?>