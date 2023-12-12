<?php
/*
 * @App     Dream Gallery 2.0
 * @Author  Rafael Clares <falecom@phpstaff.com.br> 
 * @Web     www.phpstaff.com.br
 */
@session_start();
if ($_SESSION['LOGADO'] == FALSE) {
    @header('location:login.php');
    exit;
}
require_once '../class/Usuario.php';
$u = new Usuario();
$u->getUsuario();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once 'header.php'; ?>   
    </head> 
    <body>
        <div class="nav navbar-inverse">
            <?php require_once 'menu.php'; ?>       
        </div>
        <br />


        <h2 class="well well-sm  text-center"> <i class="fa fa-bolt"></i> ACESSO RÁPIDO</h2>
        <br/><br/><br/><br/>
        <div class="container">
            <div class="col-md-12">


                <div class="col-md-4">
                    <a href="album_novo.php" class="btn btn-lg btn-primary" 
                       data-toggle="tooltip" data-placement="top"
                       title="CRIAR NOVO ÁLBUM">
                        <i class="fa fa-camera"></i> NOVO ÁLBUM
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="albumcat.php" class="btn btn-lg btn-primary" 
                       data-toggle="tooltip" data-placement="top"
                       title="GERENCIAR CATEGORIAS">
                        <i class="fa fa-folder"></i> NOVA CATEGORIA
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="albumcat.php" class="btn btn-lg btn-primary" 
                       data-toggle="tooltip" data-placement="top"
                       title="GERENCIAR SLIDESHOW">
                        <i class="fa fa-exchange"></i> NOVO SLIDESHOW
                    </a>
                </div>
            </div>
            <script src="../js/jquery-1.11.1.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>       
            <script src="../js/main.js"></script>
            <script>
                $('#home').addClass('active');
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>

    </body>
</html>
