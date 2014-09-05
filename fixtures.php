<?php

error_reporting(E_ALL);
ini_set("display_errors", true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Sao_Paulo');

include('funcoes/config.php');

try{
    //Conexão PDO
    $pdo = new \PDO($dsn, $usuario, $senha, $opcoes);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Criando a Base de Dados
    $pdo->exec("DROP DATABASE IF EXISTS {$dbname}");
    $pdo->exec("CREATE DATABASE IF NOT EXISTS {$dbname}");
    $pdo->exec("use $dbname");
    print("Criado o banco de dados [{$dbname}]<br/>");

    //Criando a Tabela
    $pdo->exec("DROP TABLE IF EXISTS {$dbname}");
    $comando ="CREATE table {$tabela}(
                id INT( 10 ) AUTO_INCREMENT NOT NULL PRIMARY KEY,
                pagina VARCHAR( 50 ) NOT NULL,
                titulo_pagina TEXT NOT NULL,
                conteudo_pagina TEXT NOT NULL
            );";
    $pdo->exec($comando);
    print("Criada a tabela [{$tabela}]<br/>");

    //Preenchendo a tabela com dados
    $dados = array(
        "home" => ['pagina' =>'home', 'titulo' => 'Bem Vindo!', 'conteudo' => 'Página Principal do site. Conheça a nossa empresa!'],
        "empresa" => ['pagina' => 'empresa', 'titulo' => 'Nossa Empresa', 'conteudo' => 'Página da empresa XPTO'],
        "produtos" => ['pagina' => 'produtos', 'titulo' => 'Nossos Produtos', 'conteudo' => 'Conteúdo da página de produtos da empresa XPTO'],
        "servicos" => ['pagina' => 'servicos', 'titulo' => 'Nossos Serviços', 'conteudo' => 'Conteúdo da página de serviços da empresa'],
        "404" => ['pagina' => '404', 'titulo' => 'Página não encontrada! [404]', 'conteudo' => 'A página que você tentou acessar não existe!']
    );
    foreach($dados as $dado){
        $comando = "INSERT INTO {$tabela}(pagina, titulo_pagina, conteudo_pagina)
                    VALUES ('{$dado['pagina']}', '{$dado['titulo']}', '{$dado['conteudo']}');";
        $pdo->exec($comando);
    }
    print("Tabela [{$tabela}] preenchida com dados<br/>");

    //Criando a Tabela Usuarios
    $pdo->exec("DROP TABLE IF EXISTS {$tabela_usuario}");
    $comando ="CREATE table {$tabela_usuario}(
                id INT( 10 ) AUTO_INCREMENT NOT NULL PRIMARY KEY,
                usuario VARCHAR( 50 ) NOT NULL,
                senha varchar( 60 ) NOT NULL
            );";
    $pdo->exec($comando);
    print("Criada a tabela [{$tabela_usuario}]<br/>");

    //Preenchendo a tabela com dados
    $dados = array(
        "usuario1" => ['login' =>'admin', 'senha' => password_hash('admin123', PASSWORD_DEFAULT)]
    );
    foreach($dados as $dado){
        $comando = "INSERT INTO {$tabela_usuario}(usuario, senha)
                    VALUES ('{$dado['login']}', '{$dado['senha']}');";
        $pdo->exec($comando);
    }
    print("Tabela [{$tabela_usuario}] preenchida com dados<br/>");

} catch (PDOException $e) {
    die("Erro: Código: {$e->getCode()}: Mensagem: {$e->getMessage()}");
}