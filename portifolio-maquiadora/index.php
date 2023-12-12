<?php
/*
 * @App     Dream Gallery 2.0
 * @Author  Rafael Clares <falecom@phpstaff.com.br> 
 * @Web     www.phpstaff.com.br
 */
require_once './class/Foto.php';
require_once 'class/Album.php';
$album = new Album ();
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
        <link href="plugins/stack/css/component.css" rel="stylesheet" type="text/css">
        <link href="css/main.css" rel="stylesheet" type="text/css">	
        <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title>Galeria Patti Makeup Portfolio</title>
    </head>
    <body>
        <?php require_once 'menu.php'; ?>

	<!-- SLIDESHOW - -->
        <?php require_once 'slide.inc.php'; ?>

        <div class="container">
            <?php
            if (isset($_GET['categoria'])) :
                $cat_id = intval($_GET['categoria']);
                $album->bd->url = "index.php?categoria=$cat_id";
                $album->bd->paginate(12);     //12 é o numero de itens por página              
                $album->getAlbumByCat($cat_id);
            else:
                $album->bd->url = "index.php";
                $album->bd->paginate(12);  //12 é o numero de itens por página                              
                $album->getAlbuns();
            endif;
            if ($album->bd->data >= 1):
                foreach ($album->bd->data as $a):
			if (isset($_GET['fx'])) {
			    if (isset($fx_list[intval($_GET['fx'])])) {
				$a->album_fx = $fx_list[intval($_GET['fx'])];
			    }
			    $a->album_fx = $_GET['fx'];
			}

                    $foto = new Foto();
                    $pg = 4;
                    if ($a->album_fx == 'coverflow' || $a->album_fx == 'sideslide' || $a->album_fx == 'peekaboo') {
                        $pg = 3;
                    }
                    if ($a->album_fx == ''  ){
                        $pg = 1;
                    }
                    $foto->getFotosHome($a->album_id,$pg);
                    if (isset($foto->bd->data[0])) :
                        $tfoto = count($foto->bd->data);
                        ?>
                        <div class="col-md-3 col-xs-12 col-sm-12 album-d">
                            <section>
                                <figure class="stack stack-<?= $a->album_fx ?> <?= ($tfoto >= 2) ? 'for-active' : 'no-active'; ?>" id="<?= $a->album_id ?>">
                                    <?php
                                    foreach ($foto->bd->data as $f):
                                        if (isset($f->foto_url)):
                                            if (!file_exists("fotos/$f->foto_url")):
                                                $f->foto_url = "nopic.jpg";
                                            endif;
                                        else:
                                            $f->foto_url = "nopic.jpg";
                                        endif;
                                        ?>

                                        <img src="thumb.php?w=600&h=500&zc=1&src=fotos/<?= $f->foto_url ?>" 
                                             class=" img-responsive" style="max-height:500px;" />

                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </figure>
                            <h1> <?= $a->album_nome ?></h1>
                        </section>
                    </div>

                    <?php
                endforeach;
            endif;
            ?>
        </div>
        <div class="container"><?= $album->bd->link ?></div>
		
		<?php require_once 'footer.php'; ?>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="plugins/stack/js/classie.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            window.onload = function () {
                setTimeout(function () {
                    $('.for-active').addClass('active');
                }, 900);
                setTimeout(function () {
                    $('.for-active').removeClass('active');
	    	    // comente a linha acima de desejar que o efeito fique fixo ao 
		    // invés de aparece apenas quando passa o mouse
                }, 2000);
            }
            $('.for-active').hover(
                    function () {
                        $(this).addClass('active')
                    },
                    function () {
                        $(this).removeClass('active')
                    }
            );
            $('figure').on('click', function () {
                window.location = 'album.php?id=' + $(this).attr('id');
            });         
            $('.efx').on('click', function () {
                window.location = 'index.php?fx=' + $(this).attr('id') + '#album-set';
            });
        </script>
    </body>
</html>
