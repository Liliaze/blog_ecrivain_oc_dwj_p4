
<header>
    <ul class="col-lg-12 col-md-12 col-xs-12" id="menu">
        <li class="button_left col-lg-1 col-md-2 col-xs-12"><a href="index.php?action=home"><i class="fas fa-home">&nbsp;Accueil</i></a></li>
        <li class="button_left col-lg-1 col-md-2 col-xs-12"><a href="index.php?action=chapterList"><i class="fas fa-book-reader">&nbsp;Chapitres</i></a></li>
        <li class="button_left col-lg-1 col-md-2 col-xs-12"><a href="index.php?action=author"><i class="fas fa-user-alt">&nbsp;L'auteur</i></a></li>
        <?php if (isset($_SESSION['id']) && $_SESSION['id']  == ''  || !isset($_SESSION['login'])) {?>
        <li class="button_right col-lg-offset-7 col-md-offset-0 col-lg-1 col-md-2 col-xs-12"><a href="index.php?action=login"><i class="fas fa-unlock-alt">&nbsp;Connexion</i></a></li>
        <?php } else {?>
        <li class="button_right col-lg-offset-7 col-md-offset-0 col-lg-1 col-md-2 col-xs-12"><a href="index.php?action=logout"><i class="fas fa-unlock-alt">&nbsp;Déconnexion</i></a></li>
        <?php } ?>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {?>
        <li class="button_right col-lg-1 col-md-2 col-xs-12"><a href="index.php?action=admin_home"><i class="fas fa-hammer">&nbsp;Admin</i></a></li>
        <?php } ?>
    </ul>
</header>