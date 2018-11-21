<footer>
    <div class="contentFooter row">
        <div id="contact1" class="col-lg-4 col-md-4 col-xs-12">
            Adresse :<br/>
            Jean Forteroche<br/>
            Maison des éditions Imagin'R<br/>
            30 Allée de la Haute Vue<br/>
            07002 MAJORQUE
        </div>
        <div id="linkMenu" class="col-lg-4 col-md-4 col-xs-12">
            <a href="index.php?action=home">Accueil</a><br/>
            <a href="index.php?action=login">Connexion au site</a><br/>
            <a href="index.php?action=legal">Mentions Légales</a><br/>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
                <a href="index.php?action=admin_home">Administration du site</a>
            <?php } ?>
        </div>
        <div id="contact2" class="col-lg-4 col-md-4 col-xs-12">
            Tel: 06.01.02.03.04.05<br/>
            Mail : jean.forteroche@gmail.com<br/>
            Facebook : Jean-Forteroche<br/>
            Twitter : JFALASKA<br/>
            Instagram : JeanForteroche_Alaska
        </div>
    </div>
</footer>