<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */
ob_start();
?>
    <div class="col-lg-12" id="home">
        <h1 class="col-lg-12 col-md-12 col-xs-12" id="homeTitle">"BILLET SIMPLE POUR L'ALASKA"</h1>
        <img class="col-lg-8 col-lg-offset-2 col-lg-8 col-lg-offset-2 col-md-offset-2 col-md-8 col-xs-12" src="public/image/alaska.jpg" alt="cover of book, billet simple pour l'alaska, with an photo of Alaska">
        <h2 class="col-lg-12 col-md-12 col-xs-12">DECOUVREZ LE NOUVEAU ROMAN DE JEAN FORTEROCHE</h2>
        <h3 class="col-lg-12 col-md-12 col-xs-12">Publié épisode par épisode, voici le dernier chapitre publié :</h3>
        <div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" >
          <?php while ($data= $this->_lastChapter->fetch()) {?>
            <div class="extractChapter ">
                <h3>
                    <span class="extractTitle"><?= "Episode ".$data['numberChapter']. " : " . $data['title'] ?></span>
                    <br/>
                    <span class="extractSubTitle">publié le <?= $data['creation_date_fr'] ?></span>
                </h3>
                <p>
                    <?= substr($data['content'], 0, 400);  ?>
                    <br/>
                </p>
                <p class="readMore">
                    <a class="readMore" href="index.php?action=chapter&amp;idChapter=<?=$data['id']?>">
                    Lire plus...</a>
                </p>
                <br/>
            </div>
            <?php }
              $this->_lastChapter->closeCursor();?>
        </div>
    </div>
<?php
$content = ob_get_clean();
require('template.php'); ?>