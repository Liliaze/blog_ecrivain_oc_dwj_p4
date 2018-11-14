<header>
    <ul class="col-lg-12" id="menu">
        <li class="button_left col-lg-1"><a href="index.php?action=goHome"><i class="fas fa-home">&nbspAccueil</i></a></li>
        <li class="button_left col-lg-1"><a href="index.php?action=goChapterList"><i class="fas fa-book-reader">&nbspChapitres</i></a></li>
        <li class="button_left col-lg-1"><a href="index.php?action=goAuthor"><i class="fas fa-user-alt">&nbspL'auteur</i></a></li>
        <li class="button_right col-lg-offset-6 col-lg-1"><a href="index.php?action=goLogin"><i class="fas fa-unlock-alt">&nbspConnexion</i></a></li>
        <li class="button_right col-lg-1"><a href="index.php?action=logout"><i class="fas fa-unlock-alt">Déconnexion</i></a></li>
        <li class="button_right col-lg-1"><a href="index.php?action=goContact"><i class="fas fa-file-signature">&nbspContact</i></a></li>
    </ul>
    <p id="welcomeMessage">Bonjour
        <?php if (isset($_SESSION['login']) && $_SESSION != ''){?>
            <?=$_SESSION['login']?>
        <?php
        }
        ?>
    </p>
</header>