
<header>
    <ul class="col-lg-12" id="menu">
        <li class="button_left col-lg-1"><a href="index.php?action=home"><i class="fas fa-home">&nbspAccueil</i></a></li>
        <li class="button_left col-lg-1"><a href="index.php?action=chapterList"><i class="fas fa-book-reader">&nbspChapitres</i></a></li>
        <li class="button_left col-lg-1"><a href="index.php?action=author"><i class="fas fa-user-alt">&nbspL'auteur</i></a></li>
        <?php if (isset($_SESSION['id']) && $_SESSION['id']  == '') {?>
        <li class="button_right col-lg-offset-6 col-lg-1"><a href="index.php?action=login"><i class="fas fa-unlock-alt">&nbspConnexion</i></a></li>
        <?php } else {?>
        <li class="button_right col-lg-offset-6 col-lg-1"><a href="index.php?action=logout"><i class="fas fa-unlock-alt">Déconnexion</i></a></li>
        <?php } ?>
        <li class="button_right col-lg-1"><a href="index.php?action=contact"><i class="fas fa-file-signature">&nbspContact</i></a></li>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {?>
        <li class="button_right col-lg-1"><a href="index.php?action=admin"><i class="fas fa-hammer">&nbspAdmin</i></a></li>
        <?php } ?>
    </ul>
</header>