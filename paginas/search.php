<div id="conteudo">
    <div class="container text-center">
        <?php
            if(isset($_POST['palavra'])){
                buscarPalavra(addslashes($_POST['palavra']), 'paginas');
            }

        ?>
    </div>
</div>