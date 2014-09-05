<?php
    /* Ativa as diretivas para exibição de avisos e erros que o sistema está tendo */
    error_reporting(E_ALL);
    ini_set("display_errors", true);
    error_reporting(E_ALL | E_STRICT);

    date_default_timezone_set('America/Sao_Paulo');

    require_once('funcoes/database.php');
    require_once('funcoes/rotas.php');
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="pt-BR">
<!--<![endif]-->
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Foundation: Projeto 4</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/bootstrap.js"></script>
</head>

<body>

<!--[if lt IE 7]>
<p class="chromeframe">Você está usando um brower desatualizado. <a href="http://browsehappy.com/">Atualize seu browser</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">instale Google Chrome Frame</a> para melhor visualizar este site.</p>
<![endif]-->

<!-- Início da barra de navegação -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Projeto 04</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="home" title="Página inicial"><i class="icon-home icon-white" ></i> Home</a></li>
                    <li><a href="empresa" title="Empresa"><i class="icon-briefcase icon-white" ></i> Empresa</a></li>
                    <li><a href="produtos" title="Produtos"><i class="icon-th-large icon-white" ></i> Produtos</a></li>
                    <li><a href="servicos" title="Serviços"><i class="icon-th-list icon-white" ></i> Serviços</a></li>
                    <li><a href="contato" title="Contatos"><i class="icon-tag icon-white" ></i> Contato</a></li>
                    <form class="navbar-search pull-left" method="post" action="busca" name="busca">
                        <input type="text" class="search-query" placeholder="Buscar palavra-chave" name="palavra">
                    </form>
                </ul>
                <ul class="nav navbar-nav col-md-1 admin">
                    <li><a href="admin/index.php"><i class="icon-lock icon-white" ></i> Admin</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Fim da barra de navegação -->