<?php

require_once "../db/db_connect.php";
require_once "parser.php";
require_once "../db/News.php";
$news = ((new News($db))->news);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="icons.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Fresh News</title>
</head>
<body>
<div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>Fresh News</strong>
        </a>
    </div>
</div>
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            if(!empty($news)):
                for ($i=0; $i<=2; $i++):?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?=$news[$i]['image']?>">
                            <div class="card-body">
                                <h2 class="card-text"><?=$news[$i]['heading']?></h2>
                                <p class="card-text"><?=$news[$i]['description']?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><?=$news[$i]['data']?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endfor;
            endif;
            ?>
        </div>
    </div>
</div>

</body>
</html>