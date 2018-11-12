<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
?>
    <h1>Contactez-moi</h1>
    <form action="authentificationComment" method="post">
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
<?php $content = ob_get_clean();
require('template.php'); ?>