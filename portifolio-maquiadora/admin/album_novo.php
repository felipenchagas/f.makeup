<?php
@session_start();
if ($_SESSION['LOGADO'] == FALSE) {
    @header('location:login.php');
    exit;
}
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
            <div class="rows">
                <form name="demoFiler" id="demoFiler" enctype="multipart/form-data" method="post"
                      action="album_fn.php?acao=incluir">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">Cadastrar Álbum </h2>
                        </div>
                        <div class="panel-body text-muted">
                            <?php
                            require_once '../class/Albumcat.php';
                            $msg = ('Precisa ter uma categoria cadastrada');
                            $cat = new Albumcat();
                            $cat->getAlbumcats();
                            ?>
                            <div class="form-group well well-sm">
                                <label>Categoria do Álbum</label>
                                <select required class="form-control" id="album_albumcat" name="album_albumcat">
                                    <option value="">Selecione a categoria...</option>
                                    <?php
                                    if ($cat->bd->data >= 1) {
                                        foreach ($cat->bd->data as $c) {
                                            ?> 
                                            <option value="<?= $c->albumcat_id ?>"><?= $c->albumcat_nome ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="x">Cadastrar nova categoria...</option> 
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div> 
                            <div class="form-group well well-sm">
                                <label for="album_nome">Nome do Álbum</label>
                                <input type="text" class="form-control" id="album_nome"  name="album_nome" required="" placeholder="">
                            </div>
                            <div class="form-group well well-sm">
                                <label for="album_nome">Efeito do Álbum</label>
				<select name="album_fx" id="album_fx">
					<option value="">Nenhum</option>
					<option value="randomrot">Random Rot</option>
					<option value="fan">Fan</option>
					<option value="coverflow">Cover Flow</option>
					<option value="queue">Queue</option>
					<option value="spread">Spread</option>
					<option value="fanout">Fan Out</option>
					<option value="sideslide">Slides Slide</option>
					<option value="sidegrid">Side Grid</option>
					<option value="bouncygrid">Bouncy Grid</option>
					<option value="previewgrid">Preview GRid</option>
					<option value="cornergrid">Corner Grid</option>
					<option value="leaflet">Leaf Let</option>
					<option value="vertspread">Vert Spread</option>
					<option value="vertelastic">Vert Elastic</option>
				</select>
                            </div>
                            <button type="submit"  value="Confirmar" onclick="confirmar()" class="btn btn-primary">Cadastrar e Enviar Fotos >>></button>
                        </div>
                    </div>
                </form>
                <div class="progressBar">
                    <div class="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>  
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>   
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript">
    $('#album').addClass('active');
    $('#album_albumcat').on('change', function () {
        if ($('#album_albumcat option:selected').val() === 'x') {
            window.location = 'albumcat.php';
            return false;
        }
    });
</script>
</body>
</html>

