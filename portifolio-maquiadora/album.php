<?php
/*
 * @App     Dream Gallery 2.0
 * @Author  Rafael Clares <falecom@phpstaff.com.br> 
 * @Web     www.phpstaff.com.br
 */
require_once './class/Foto.php';
$album_id = intval($_GET['id']);
$foto = new Foto();
$foto->setAlbum("$album_id");

$foto->bd->url = "album.php?id=$album_id";
$foto->bd->paginate(12);   //12 é o numero de itens por página
$foto->getFotos();

$album_nome = $foto->foto_todos[0]->{'album_nome'};
$albumcat_nome = $foto->foto_todos[0]->{'albumcat_nome'};
$album_desc = $foto->foto_todos[0]->{'album_desc'};
$albumcat_id = $foto->foto_todos[0]->{'albumcat_id'};

$foto_capa = "";
if (isset($foto->bd->data[0])) :
    $foto_capa = $foto->bd->data[0]->{'foto_url'};
endif;
$baseURI = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') .
        (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') .
        (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] .
        (isset($_SERVER['HTTPS']) && $_SERVER['SERVER_PORT'] === 443 ||
               $_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT']))) .
        substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=$albumcat_nome?> - Meu Site</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <link rel="canonical" href="<?=$baseURI?>/album.php?id=<?=$album_id?>">
        <?php if($foto_capa != ""):?>
        <meta property="og:image" content="<?=$baseURI?>/fotos/<?=$foto_capa?>"/>
        <?php endif;?>
        <meta property="og:url" content="<?=$baseURI?>/album.php?id=<?=$album_id?>"/>
        <meta name="robots" content="all"/>
        <meta name="language" content="br"/>
        <meta name="robots" content="follow"/>
        <meta property="og:type" content="article"/>
        <meta property="og:description" content="<?=$albumcat_nome?>"/>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.0/paper/bootstrap.min.css" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="plugins/lightbox/css/lightbox.css" rel="stylesheet">            
    </head>
    <body>
        <?php require_once 'menu.php'; ?>
        <div class="container">
            <h4 style="padding-right: 15px; padding-left: 15px;">
                <?= $albumcat_nome ?> / <?= $album_nome ?>
                <span class="pull-right">
                    <a href="javascript:history.back();" class="btn btn-sm btn-primary">
		    <i class="fa fa-arrow-left"></i> voltar</a>
                </span>
            </h4>
	    <br/>
            <div id="image-set">
                <?php
                if (isset($foto->bd->data[0])) :
                    foreach ($foto->bd->data as $f):
                        if (isset($f->foto_url)):
                            if (!file_exists("fotos/$f->foto_url")):
                                $f->foto_url = "nopic.jpg";
                            endif;
                        else:
                            $f->foto_url = "nopic.jpg";
                        endif;
                        ?>
                        <div class="col-md-3 col-xs-12 col-sm-12">
                            <a  href="fotos/<?= $f->foto_url ?>" data-lightbox="example-set" 
                                data-title="<?= $f->foto_legenda ?>">
                                <img src="thumb.php?w=600&h=500&zc=1&src=fotos/<?= $f->foto_url ?>" 
                                     class="thumbnail img-responsive" style="max-height:500px;" />
                            </a>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
		      <div class="col-md-12"><?= stripslashes($album_desc) ?></div>
                <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='5390245'></div> 
                <script type="text/javascript"> var shr = document.createElement("script"); shr.setAttribute("data-cfasync", "false"); shr.src = "//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js"; shr.type = "text/javascript"; shr.async = "true"; shr.onload = shr.onreadystatechange = function() { var rs = this.readyState; if (rs && rs != "complete" && rs != "loaded") return; var site_id = "39e07923cec488add2e8c7d4263934e0"; try { Shareaholic.init(site_id); } catch (e) {console.log(e)} }; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(shr, s); </script>

                <div class="col-md-12">
                    <br >
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=375098389245172";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>

                    <div class="fb-comments" 
                        data-href="<?=$baseURI?>/album.php?id=<?=$album_id?>" 
                        data-width="1200" data-numposts="5" data-colorscheme="light">
                    </div>

                </div>

            </div>
        </div>
        <div class="container"><?= $foto->bd->link ?></div> 
        <?php require_once 'footer.php'; ?>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="plugins/lightbox/js/lightbox.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

