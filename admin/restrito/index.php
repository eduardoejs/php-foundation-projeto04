<?php
error_reporting(E_ALL);
ini_set("display_errors", true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Sao_Paulo');

session_start();
require_once('../../funcoes/session.php');
require_once('../../funcoes/database.php');

//se a session não for validada o usuario será redirecionado para a tela de login
if(!validarSession()){
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Administrador do site</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../css/main.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container-fluid">
        <h1>Área do Administrador</h1>
        <hr/>
        <div class="row-fluid">
            <div id="usuario">
                <h3 class="text-warning">Seja bem vindo: [ <?php echo $_SESSION['usuario']; ?> ] </h3>
            </div>
            <div id="logout">
                <a class="btn btn-inverse" href="logout.php"><i class="icon-off icon-white"></i> Sair do Sistema </a> </p>
            </div>
        </div>
        <hr/>
        <table class="table table-bordered table-striped">
            <caption class="text-left muted"><h4>Rotas | Páginas | Conteúdo cadastradas no sistema:</h4></caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rota</th>
                    <th>Título</th>
                    <th>Conteúdo</th>
                    <th>Operações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //exibe o conteúdo gravado no banco de dados
                    $paginasDB = listarTabela('paginas');

                    foreach($paginasDB as $dados){
                        echo "<tr><td>{$dados['id']}</td><td>{$dados['pagina']}</td><td>{$dados['titulo_pagina']}</td><td>{$dados['conteudo_pagina']}</td><td><a href='alterarDados.php?id={$dados['id']}' class='btn btn-info'><i class='icon-pencil icon-white'></i> Alterar</a> </td></tr>";
                    }
                ?>
            </tbody>

        </table>
    </div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
