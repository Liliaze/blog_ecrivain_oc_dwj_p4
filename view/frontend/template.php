<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="public/css/style-lg.css" rel="stylesheet">
    <title>Jean Forteroche Blog</title>
</head>
<body class="col-lg-12">
    <?php require('view/frontend/header.php'); ?>
    <div id="intro"class="col-lg-12">
        <?= $intro ?>
    </div>
    <div id="part1"class="col-lg-12">
        <?= $part1 ?>
    </div>
    <div id="part2"class="col-lg-12">
        <?= $part2 ?>
    </div>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <?php require('view/frontend/footer.php'); ?>
</body>
</html>