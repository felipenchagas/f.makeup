<?php
/*
 * @App     Dream Gallery 2.0
 * @Author  Rafael Clares <falecom@phpstaff.com.br> 
 * @Web     www.phpstaff.com.br
 */
require_once './class/Slide.php';
$slide = new Slide();
$slide->getImagens();
//$slide->bd->paginate(6); //6 é o numero de itens por página
$slide->getImagens();
$k = -1;
if (!isset($slide->bd->data [0]))
    exit;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.0/paper/bootstrap.min.css" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <title>Patti Makeup Portfolio</title>
        <style>
            .carousel-inner img{
                margin: 0 !important;
                padding: 0  !important;
            }
            .carousel-control.left{
                background: none !important;
                color:#000000 !important;
                margin-top: 15% !important;
                left: -5px !important;
            }
            .carousel-control.right{
                background: none !important;
                color:#000000 !important;
                margin-top: 15% !important;
                right: -5px !important;
            }          
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <!-- Indicators -->
                <div id="carousel-slide" class="carousel slide " data-ride="carousel">
                    <div class="carousel-inner min-slide">
                        <?php foreach ($slide->bd->data as $img): ?>
                            <div class="item <?= ($k++ == 0) ? 'active' : ''; ?>">
                                <img  src="fotos/slide/<?= $img->slide_foto ?>"  class="img-responsive" />
                            </div>
                        <?php endforeach; ?>
                    </div>                   
                    <a class="left carousel-control" href="#carousel-slide" role="button" data-slide="prev">
                        <span class="fa fa-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-slide" role="button" data-slide="next">
                        <span class="fa fa-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>     
        <script src="js/main.js"></script>
        <script>$('#slide').addClass('custom-active');</script>
    </body>
</html>
