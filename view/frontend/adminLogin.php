<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
?>
    <h1 class="col-lg-8">Vous êtes administrateur ?</h1>
    <h2 class="col-lg-6">Connectez-vous pour modifier le contenu du site</h2>
<?php
$intro = ob_get_clean();
ob_start();
?>
    <div id="divForm">
        <form action="index.php?action=goAdmin" id="loginForm" method="post">
            <fieldset id="fieldsetLoginForm">
                <legend>Identification...</legend>
                <div>
                    <label for="author">Login</label><br />
                    <input type="text" id="loginComment" name="login" />
                </div>
                <div>
                    <label for="mdp">Mot de passe</label><br />
                    <input type="text" id="mdpComment" name="mdp" />
                </div>
                <div class="button">
                    <button type="submit">Connexion</button>
                </div>
            </fieldset>
        </form>
    </div>
<?php
$part1 = ob_get_clean();
ob_start();?>
<div id="welcomeUser">
    <p>Bonjour merci de vous identifier pour administrer le site</p>
</div>
<?php $part2 = ob_get_clean();
require('template.php'); ?>