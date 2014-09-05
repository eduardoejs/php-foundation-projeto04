<?php

    /*Estabelece a conexão com o banco de dados*/
    function conectar(){
        try {
            include('config.php');

            $pdo = new \PDO($dsn.";dbname={$dbname}", $usuario, $senha, $opcoes);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Erro: Código: {$e->getCode()}: Mensagem: {$e->getMessage()}");
        }
        return $pdo;
    }

    /*Busca o conteúdo da pagina requisitada no banco de dados*/
    function buscarConteudo($tabela, $pagina){
        try{
            $sql = "Select * from {$tabela} where pagina = :pagina";

            $pdo = conectar();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue("pagina", $pagina);
            $stmt->execute();

            $conteudo = $stmt->fetch(PDO::FETCH_ASSOC);

        }catch (\PDOException $e){
            die("Erro: Código: {$e->getCode()}: Mensagem: {$e->getMessage()}");
        }
        return $conteudo;
    }

    /*Realiza a busca da palavra chave no conteúdo da página salva no banco de dados*/
    function buscarPalavra($palavra, $tabela){
        try{
            if (!empty($palavra)){
                $sql = "Select * from {$tabela} where conteudo_pagina like :palavra;";

                $pdo = conectar();
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue("palavra", "%{$palavra}%");
                $stmt->execute();

                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            else
                $resultados = [];
        } catch(\PDOException $e){
            die("Erro: Código: {$e->getCode()}: Mensagem: {$e->getMessage()}");
        }

        if(count($resultados) > 0){

            echo '<div class="alert alert-info">'.
                    '<button type="button" class="close" data-dismiss="alert">x</button>'.
                    '<h2 class="text-center">Resultados encontrados:</h2>'.
                    '<h4>A pesquisa pela palava "'.$palavra.'" retornou os seguintes resultados:</h4><br/>';

                    foreach($resultados as $pagina){
                        echo '<a href='.$pagina["pagina"].'>'.$pagina["titulo_pagina"].'</a><br/>';
                    }

            echo '</div>';
        }elseif(empty($palavra)){
            print "<div class=\"alert alert-danger\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
                    <h2 class=\"text-center\">Resultado da pesquisa:</h2>
                    <h2><strong>Você precisa informar uma palavra-chave para a busca!</strong></h2>
                  </div>";
        }
        else{
            print "<div class=\"alert alert-warning\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
                    <h2 class=\"text-center\">Resultado da pesquisa:</h2>
                    <h2>Não foram encontradas páginas com a palavra \"<strong>$palavra</strong>\"</h2>
                  </div>";
        }
    }

    /*Retorna os dados do usuário no banco de dados*/
    function getUsuarioDB($usuario, $tabela){
        try{
            $sql = "Select * from $tabela ";

            if(!empty($usuario))
                $sql .= " where usuario = :login";

            $sql .= ';';

            $pdo = conectar();
            $stmt = $pdo->prepare($sql);

            if(!empty($usuario))
                $stmt->bindValue("login", $usuario);

            $stmt->execute();

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        }catch (\PDOException $e){
            die("Erro: Código: {$e->getCode()}: Mensagem: {$e->getMessage()}");
        }
        return $dados;
    }

    /*Retorna os dados da tabela passada como parâmetro*/
    function listarTabela($tabela){
        try{
            $sql = "Select * from {$tabela}";
            $pdo = conectar();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            die("Erro: Código: {$e->getCode()}: Mensagem: {$e->getMessage()}");
        }
        return $dados;
    }

    /*Retorna dados da tabela de acordo com o ID fornecido*/
    function getDadosPagina($tabela, $id){
        try{
            $pdo = conectar();
            $sql = "Select * from {$tabela} where id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue("id", $id);
            $stmt->execute();
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            die("Erro: Código: {$e->getCode()}: Mensagem: {$e->getMessage()}");
        }
        return $dados;
    }

    /*Realiza a alteração dos dados da página cadastrada no banco*/
    function alterarPagina($tabela, $id, $titulo, $conteudo){
        try{
            $pdo = conectar();
            $sql = "Update {$tabela} set titulo_pagina=:titulo, conteudo_pagina=:conteudo where id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue("id", $id);
            $stmt->bindValue("titulo", $titulo);
            $stmt->bindValue("conteudo", $conteudo);
            $stmt->execute();
            $flag = true;
        }catch (\PDOException $e){
            die("Erro: Código: {$e->getCode()}: Mensagem: {$e->getMessage()}");
        }
        return $flag;
    }
?>