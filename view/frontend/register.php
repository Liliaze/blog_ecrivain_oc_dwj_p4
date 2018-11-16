<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
?>
    <h1>Première connexion ?</h1>
    <h2>Enregistrez-vous</h2>
    <div id="divForm">
        <form action="index.php?action=register" id="loginForm" method="post">
            <fieldset id="fieldsetLoginForm">
                <legend>Inscription...</legend>
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
<?php $content = ob_get_clean();
require('template.php'); ?>