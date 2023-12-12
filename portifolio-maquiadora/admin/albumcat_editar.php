<?php
@session_start();
if ($_SESSION['LOGADO'] == FALSE) {
    @header('location:login.php');
    exit;
}
require_once '../class/Albumcat.php';
$id = intval($_GET['id']);
$edit = new Albumcat();
$edit->setId($id);
$edit->getAlbumcat();
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
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Editar Album</h2>
                </div>
                <div class="panel-body text-muted">
                    <div class="col-md-8">
                        <form  method="post" enctype="multipart/form-data" action="albumcat_fn.php?acao=atualizar">
                            <div class="form-horizontal well well-sm">
                                <label for="albumcat_nome">Categoria</label>
                                <input type="text" class="form-control" id="albumcat_nome"  name="albumcat_nome"  placeholder="Informe a categoria" value="<?= $edit->albumcat_nome ?>">
                                <input type="hidden" id="albumcat_id" name="albumcat_id" value="<?= $edit->albumcat_id ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>   
        <script src="../js/main.js"></script>
        <script>$('#categoria').addClass('active');</script>
    </body>
</html>
</body>
</html>

