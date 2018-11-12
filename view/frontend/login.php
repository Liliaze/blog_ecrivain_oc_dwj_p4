<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
?>
    <h1>Poster des commentaires ?</h1>
    <h2>Identifiez-vous</h2>
    <div id="divForm">
        <form action="index.php?action=validUser" id="loginForm" method="post">
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
<div id="welcomeUser">
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] != '') {?>
    <p>Bonjour, <?=$_SESSION['login'] ?> vous pouvez dès à présent poster des commentaires</p>
        <a href="index.php?action=unlog"><button>Déconnexion</button></a>
    <?php } else { ?>
    <p>Bonjour nous ne vous reconnaissons pas, merci de vous identifier</p>
    <?php } ?>
</div>
<?php $content = ob_get_clean();
require('template.php'); ?>