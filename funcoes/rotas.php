<?php

function validar_rota() {

    $url = parse_url("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
    $path = $url['path'];
    $path = explode('/',$path);

    $rota = $path[1];

    $rotas_sistema = ["home", "empresa", "produtos", "servicos", "contato", "busca", "404"];

    if(empty($rota)){
        return $conteudo = buscarConteudo('paginas', 'home');
    }elseif(isset($rota) and !in_array($rota, $rotas_sistema)){
        http_response_code(404);
        return $conteudo = buscarConteudo('paginas', '404');
    }elseif($rota == 'busca'){
        include('paginas/search.php');
    }elseif($rota == 'contato'){
        include('paginas/contato.php');
    }else{
        return $conteudo = buscarConteudo('paginas', $rota);
    }
}
?>