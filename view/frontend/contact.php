<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
?>
    <h1 class="col-lg-8">Vous souhaitez m'adresser personnellement une question ?</h1>
    <h2 class="col-lg-6">Contactez-moi</h2>
<?php
$intro = ob_get_clean();
ob_start();
?>
    <form action="" method="post">
          <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="user_name">
              </div>

          <div>
                <label for="courriel">Courriel :</label>
                <input type="email" id="courriel" name="user_email">
              </div>

          <div>
                <label for="message">Message :</label>
                <textarea id="message" name="user_message"></textarea>
              </div>
         
          <div class="button">
                <button type="submit">Envoyer le message</button>
              </div>
    </form>
<?php
$part1 = ob_get_clean();
ob_start();?>
<?php $part2 = ob_get_clean();
require('template.php'); ?>