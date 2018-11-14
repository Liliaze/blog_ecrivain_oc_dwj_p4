<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 05/11/2018
 * Time: 12:43
 */
ob_start();
?>
    <div id="home">
        <h1>AMBIVALENCE</h1>
        <img src="public/image/ambivalenceCover.jpg">
        <h2>Extrait du dernier épisode :</h2>
        <div >
          <?php while ($data= $this->_lastChapter->fetch()) {?>
            <div class="extractChapter">
                <h3>
                    <span class="extractTitle"><?= "Episode ".$data['numberChapter']. " : " . $data['title'] ?></span>
                    </br>
                    <span class="extractSubTitle">publié le <?= $data['creation_date_fr'] ?></span>
                </h3>
                <p>
                    <?= substr(nl2br($data['content']), 0, 255);  ?>
                    <br/>
                </p>
                <p class="readMore">
                    <a class="readMore" href="index.php?action=goChapter&amp;idChapter=<?=$data['id']?>"
                    <br/>Lire plus...</a>
                </p>
                <br />
            </div>
            <?php }
              $this->_lastChapter->closeCursor();?>
        </div>
    </div>
<?php
$content = ob_get_clean();
require('template.php'); ?>