<?php
    $conteudo = validar_rota();
?>

<div id="conteudo">
    <div class="container text-center">
        <?php
            if (http_response_code() == 404){
                echo '<div class="alert alert-warning">'.
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'.
                    '<h1 class="text-center">'.$conteudo['titulo_pagina'].'</h1>'.
                    '<h2 class="text-center">'.$conteudo['conteudo_pagina'].'</h2>'.
                  '</div>';
            }
            else{
                print "<h1>{$conteudo['titulo_pagina']}</h1>";
                print "<p>{$conteudo['conteudo_pagina']}</p>";
            }
        ?>
    </div>
</div>