
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="public/css/style-lg.css" rel="stylesheet">
    <link media="all and (max-width: 768px)" href="public/css/style-little_screen.css" rel="stylesheet">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=2ajf9vx4rr90q9n1ws6szrajzywfiwsyyc7m4l6camx77iur"></script>
    <script>
        tinymce.init({
        selector: '#newArticle'
        });
    </script>
    <title>Jean Forteroche</title>
</head>
<body class="col-lg-12 col-md-12 col-xs-12">
    <?php require('view/frontend/alert.php'); ?>
    <?php require('view/frontend/header.php'); ?>
    <div id="content" class="col-lg-12 col-md-12 col-xs-12"><br/>
        <?= $alert?>
        <?= $content?>
    </div>
    <script src="public/js/formAddComment.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <?php require('view/frontend/footer.php'); ?>
</body>
</html>