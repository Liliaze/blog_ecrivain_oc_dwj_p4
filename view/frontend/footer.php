<footer>
    <em><a href="index.php?action=home">Accueil</a></em>
    </br>
    <em><a href="index.php?action=login">Connexion au site</a></em>
    </br>
    <em><a href="index.php?action=legal">Mentions Légales</a></em>
    </br>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
    <em><a href="index.php?action=admin&amp;ac=log">Administration du site</a></em>
    <?php } ?>
</footer>