<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 12/11/2018
 * Time: 15:44
 */
$alert = "";
if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
    ob_start();?>
    <div class="alert alert-success" role="alert">
        <strong><?=$_SESSION['success']?></strong>
    </div>
    <?php $alert = $alert.ob_get_clean();
    $_SESSION['success'] = '';
 }
if (isset($_SESSION['info']) && $_SESSION['info'] != '') {
    ob_start();?>
    <div class="alert alert-info" role="alert">
        <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
    </div>
    <?php $alert = $alert.ob_get_clean();
    $_SESSION['info'] = '';
 }
if (isset($_SESSION['warning']) && $_SESSION['warning'] != '') {
    ob_start();?>
    <div class="alert alert-warning" role="alert">
        <strong><?=$_SESSION['warning']?></strong>
    </div>
    <?php $alert = $alert.ob_get_clean();
    $_SESSION['warning'] = '';
 }
 if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
    ob_start();?>
    <div class="alert alert-danger" role="alert">
        <strong><?=$_SESSION['error']?></strong>
    </div>
     <?php $alert = $alert.ob_get_clean();
    $_SESSION['error'] = '';
 }
