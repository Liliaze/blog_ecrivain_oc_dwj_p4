<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
?>
    <h1 class="col-lg-8">Vous êtes sur la page ADMIN !!!!!!! CONGRATULATION</h1>
<?php
$intro = ob_get_clean();
ob_start();
$part1 = ob_get_clean();
ob_start();
$part2 = ob_get_clean();
require('./view/frontend/template.php'); ?>