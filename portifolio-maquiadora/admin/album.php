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
                <form class="form-horizontal">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div>
                                <h2 class="panel-title" style="font-family: 'Oswald', sans-serif;">Álbuns cadastrados</h2>
                            </div>
                        </div>
                        <div class="panel-body text-muted">
                            <p class="text-right">
                                <a class="btn btn-primary" href="album_novo.php">
                                    <i class="fa fa-plus-circle"></i> 
                                    Cadastrar novo
                                </a>
                            </p>
                            <table class="table table-striped">
                                <tr>
                                    <th>Nome do Álbum</th>
                                    <th>Categoria do Álbum</th>
                                    <th width="140"><i class="fa fa-cog"></i> Ações&nbsp;</th>
                                </tr>
                                <?php
                                require_once '../class/Album.php';
                                $album = new Album();
                                $album->bd->url = "album.php";
                                $album->bd->paginate(8);
                                $album->getAlbumByAlbumcat();

                                if ($album->bd->data >= 1) {
                                    foreach ($album->bd->data as $c) {
                                        echo "<tr>";
                                        echo "<td style=\"vertical-align: middle\">$c->album_nome</td>";
                                        echo "<td style=\"vertical-align: middle\">$c->albumcat_nome</td>";
                                        echo "<td>";
                                        echo "<a class=\"btn  btn-primary\" href=\"album_editar.php?id=$c->album_id\"><i class=\"fa fa-edit\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Alterar Álbum\"></i></a> ";
                                        echo "<button type=\"button\" class=\"btn  btn-danger btn-remove\" data-url=\"album_fn.php?acao=remover&id=$c->album_id\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Remover Álbum\"><i class=\"fa fa-trash\"></i></button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div> 

        <div class="modal fade" id="ModalRemove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                        <h4 class="modal-title text-danger" id="myModalLabel">Remover Registro</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Atenção!</h4>
                        <p>
                            Você está prestes à excluir um registro de forma permanente.<br />
                            Deseja realmente executar este procedimento?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btn-confirm-remove"><i class="fa fa-check"></i> Remover</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container"><?= $album->bd->link ?></div>  
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>     
        <script src="../js/main.js"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('#album').addClass('active');
                $('.btn-remove').on('click', function () {
                    var url = $(this).attr('data-url');
                    $('#ModalRemove').modal('show');
                    $('#btn-confirm-remove').on('click', function () {
                        window.location = url;
                    });
                });
            });
        </script>        
    </body>
</html>

