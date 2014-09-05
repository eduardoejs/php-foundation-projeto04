<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
    error_reporting(E_ALL | E_STRICT);
    date_default_timezone_set('America/Sao_Paulo');

    session_start();
    require_once('../funcoes/database.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Área Restrita</title>
<link href="../css/style.css" type="text/css" rel="stylesheet" />
<link href="../css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="../css/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="row-fluid" id="admin">
        <h1 class="text-center">Área do Administrador</h1>
    </div>

    <div class="container">
        <?php
            if(isset($_POST['acessar'])){
                $login = $_POST['login'];
                $senha = $_POST['senha'];

                if(!$login or !$senha){
                    echo '<div class="alert alert-warning text-center"><h2>Atenção</h2><h3>Você deve preencher todos os campos para a autenticação!</h3></div>';
                }else{

                    /*Retorno os dados do usuário no banco de dados e comparo com o que foi informado no
                    momento do login.
                        Se tudo estiver Ok será criada a Session e o acesso será liberado ao usuário
                    */
                    $dados = getUsuarioDB($login, 'usuarios');
                    $senhaIsValid = password_verify($senha,$dados['senha']);

                    if($senhaIsValid and $dados['usuario'] == $login){
                        $_SESSION['logado'] = 1;
                        $_SESSION['usuario'] = $login;
                        header('Location: restrito/index.php');
                    }else{
                        $_SESSION['logado'] = 0;
                        echo '<div class="alert alert-danger text-center"><h2>Falha na Autenticação</h2><h3>Usuário ou senha inválida!</h3></div>';
                    }
                }
            }
        ?>
    </div>

    <div class="container-fluid" id="login">
        <form class="form-inline container-fluid" method="post" action="index.php">
            <div class="control-group">
                <label for="inputLogin">Usuário:</label>
                <input type="text" id="inputLogin" placeholder="Usuário" class="input-xlarge" name="login">
            </div>
            <div class="control-group">
                <label for="inputPassword">Senha:</label>
                <input type="password" id="inputPassword" placeholder="Senha" class="input-xlarge" name="senha">
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary" name="acessar"><i class="icon-lock icon-white"></i> Acessar</button>
                    <a href="../home" class="btn btn-warning"><i class="icon-home icon-white"></i> Voltar</a>
                </div>
            </div>
        </form>
    </div>

<?php require_once('../paginas/footer.php')?>