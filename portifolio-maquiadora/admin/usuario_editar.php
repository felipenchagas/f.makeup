<?php
@session_start();
if ($_SESSION['LOGADO'] == FALSE) {
    @header('location:login.php');
    exit;
}
require_once '../class/Usuario.php';
$id = intval($_GET['id']);
$edit = new Usuario();
$edit->setId($id);
$edit->getUsuario();
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
            <form class="form-horizontal" method="post" action="usuario_fn.php?acao=atualizar&id=<?= $edit->usuario_id ?>">
                <div class="rows">    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div>
                                <h2 class="panel-title" style="font-family: 'Oswald', sans-serif;">Atualizar Usuário</h2>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="letras">
                                <div class="col-md-8">
                                    <div class="form-group well well-sm">
                                        <label for="usuario_nome" class="text-primary" >Nome</label>
                                        <input type="text" class="form-control" id="usuario_nome"  name="usuario_nome" placeholder="Nome" value="<?= $edit->usuario_nome ?>">
                                    </div>  

                                    <div class="form-group well well-sm">
                                        <label for="usuario_email" class="text-primary">Email</label>
                                        <input type="text" class="form-control" id="usuario_email"  name="usuario_email" placeholder="Email" value="<?= $edit->usuario_email ?>">
                                    </div>                    

                                    <div class="form-group well well-sm">
                                        <label for="usuario_login" class="text-primary">Login</label>
                                        <input type="text" class="form-control" id="usuario_login"  name="usuario_login" placeholder="Login" value="<?= $edit->usuario_login ?>">
                                    </div>
                                    <div class="form-group well well-sm">
                                        <label for="usuario_senha" class="text-primary">Senha</label>
                                        <input type="password" class="form-control" id="usuario_senha"  name="usuario_senha" placeholder="Senha">
                                    </div>

                                    <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Atualizar</button>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </form>
        </div>
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>     
        <script src="../js/main.js"></script>
        <script>$('#user').addClass('active');</script>
        <?php
        if (isset($_GET['ok'])) {
            ?>
            <script>
                $('.panel-title').html('Projeto atualizado com sucesso!');
                $('.panel')
                        .removeClass('panel-default')
                        .addClass('panel-success');
                setTimeout(function () {
                    $('.panel')
                            .removeClass('panel-success')
                            .addClass('panel-default');
                    $('.panel-title').html('Editar Projeto');
                }, 2000)
            </script>            
            <?php
        }

        if (isset($_GET['erro'])) {
            ?>
            <script>
                $('.panel-title').html('Erro ao atualizar: Upload');
                $('.panel')
                        .removeClass('panel-default')
                        .addClass('panel-danger');
                setTimeout(function () {
                    $('.panel')
                            .removeClass('panel-danger')
                            .addClass('panel-default');
                    $('.panel-title').html('Editar Projeto');
                }, 100000)
            </script>            
            <?php
        }
        ?>
    </body>
</html>
