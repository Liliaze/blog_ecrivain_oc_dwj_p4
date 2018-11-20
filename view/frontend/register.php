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
                    <input type="text" id="loginRegister" name="login" value="<?=$login?>"/>
                </div>
                <div>
                    <label for="mdp">Mot de passe</label><br />
                    <input type="password" id="mdpRegister" name="mdp" value="<?=$mdp?>"//>
                </div>
                <div>
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="mailRegister" name="email" value="<?=$email?>"//>
                </div>
                <br/>
                <div class="button">
                    <button type="submit">Inscription et Connexion</button>
                </div>
            </fieldset>
        </form>
    </div>
<?php $content = ob_get_clean();
require('template.php'); ?>