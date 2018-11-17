<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == '') {
    ?>
    <h1>Poster des commentaires ?</h1>
    <h2>Identifiez-vous</h2>
    <div id="divForm">
        <form action="index.php?action=validUserB" id="loginForm" method="post">
            <fieldset id="fieldsetLoginForm">
                <legend>Identification...</legend>
                <div>
                    <label for="login">Login</label><br/>
                    <input type="text" id="loginComment" name="login" required/>
                </div>
                <div>
                    <label for="mdp">Mot de passe</label><br/>
                    <input type="password" id="mdpComment" name="mdp" required/>
                </div>
                <div class="button">
                    <button type="submit">Connexion</button>
                </div>
            </fieldset>
        </form>
    </div>
    <div id="welcomeUser">
            <p>Bonjour nous ne vous reconnaissons pas, merci de vous identifier</p>
            <p>Première connexion ? <a href="index.php?action=register">Enregistrez-vous ici !</a></p>
    </div>
<?php
}
else { ?>
        <div id="welcomeUser">
            <?php if (isset($_SESSION['login'])) {?>
        <p>Bonjour, <?= $_SESSION['login'] ?> vous pouvez dès à présent poster des commentaires</p>

        <p>Ce n'est pas vous ? Vous pouvez vous déconnecter :</p>
        <a href="index.php?action=logout">
            <button>Déconnexion</button>
        </a>
        </div>
        <?php
    }
}
$content = ob_get_clean();
require('template.php'); ?>