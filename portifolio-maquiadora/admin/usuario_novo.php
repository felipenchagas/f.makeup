<?php
@session_start();
if ($_SESSION['LOGADO'] == FALSE) {
    header('location:login.php');
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
                <form method="post" action="usuario_fn.php?acao=incluir">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div>
                                <h2 class="panel-title" style="font-family: 'Oswald', sans-serif;">Cadastrar Novo Usuário</h2>
                            </div>
                        </div>
                        <div class="panel-body text-muted">
                            <div class="col-md-8">
                                <div class="form-group well well-sm">
                                    <label for="usuario_nome">Nome</label>
                                    <input type="text" class="form-control" id="usuario_nome"  name="usuario_nome" required="" placeholder="Nome">
                                </div>  
                                <div class="form-group well well-sm"">
                                    <label for="usuario_email">Email</label>
                                    <input type="text" class="form-control" id="usuario_email"  name="usuario_email" required="" placeholder="Email">
                                </div>                    
                                <div class="form-group well well-sm">
                                    <label for="usuario_login">Login</label>
                                    <input type="text" class="form-control" id="usuario_login"  name="usuario_login" required="" placeholder="Login">
                                </div>
                                <div class="form-group well well-sm"">
                                    <label for="usuario_senha">Senha</label>
                                    <input type="password" class="form-control" id="usuario_senha"  name="usuario_senha" required="" placeholder="Senha">
                                </div>
                                <br/>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Cadastrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
        </div> 
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>     
        <script src="../js/main.js"></script>
        <script>$('#user').addClass('active');</script>
    </body>
</html>
