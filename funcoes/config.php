<?php
    /* Variáveis para o PDO */
    $dsn     = 'mysql:host=localhost';
    $usuario = 'root';
    $senha   = 'root';
    $opcoes  = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];

    /*Variáveis auxiliares*/
    $dbname  = 'projeto04';
    $tabela  = 'paginas';
    $tabela_usuario = 'usuarios';
?>