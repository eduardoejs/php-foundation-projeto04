<?php
error_reporting(E_ALL);
ini_set("display_errors", true);
error_reporting(E_ALL | E_STRICT);

date_default_timezone_set('America/Sao_Paulo');

session_start();

require_once('../../funcoes/session.php');
require_once('../../funcoes/database.php');

if(!validarSession()){
    header('Location: ../index.php');
}

//verifica se foi passado o ID via GET
if(isset($_GET['id'])){
    $id = addslashes($_GET['id']);

    $resultado = getDadosPagina('paginas', $id);
}

//verifica se houve um POST no formulário e realiza a alteração dos dados
if(isset($_POST['alterar'])){
    $id = addslashes($_POST['id']);
    $titulo = addslashes($_POST['titulo']);
    $conteudo = addslashes($_POST['editor1']);

    $isUpdate = alterarPagina('paginas', $id, $titulo, $conteudo);
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

    <?php if(count($resultado) > 1 and !isset($_POST['alterar'])):  ?>

    <form method="post" action="" class="form-horizontal">
        <fieldset>
            <legend>Alteração de registro:</legend>
            <input type="hidden" name="id" value="<?php echo $resultado['id'];?>">
            <div class="control-group">
                <label class="control-label" for="lbRota">Rota:</label>
                <div class="controls">
                    <input class="input-block-level" id="disabledInput" type="text" placeholder="Rota" disabled value="<?php if(count($resultado)>0){echo $resultado['pagina'];}else{echo '';}?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="lbTitulo">Título:</label>
                <div class="controls">
                    <input type="text" id="txTitulo" placeholder="Título" name="titulo" class="input-block-level" value="<?php if(count($resultado)>0){echo $resultado['titulo_pagina'];}else{echo '';}?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="lbConteudo">Conteúdo:</label>
                <div class="controls">
                    <textarea id="editor1" name="editor1"><?php if(count($resultado)>0){echo $resultado['conteudo_pagina'];}else{echo '';}?></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="alterar" class="btn btn-primary"><i class="icon-ok icon-white"></i> Gravar</button>
                    <a href="index.php" class="btn"><i class="icon-remove-sign"></i> Cancelar</a>
                </div>
            </div>
        </fieldset>
    </form>

    <?php elseif(isset($_POST['alterar']) and $isUpdate): ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h2>Sucesso!</h2>
            <h3>O registro com ID [ <?php echo $id;?> ] foi alterado com sucesso!</h3>
            <a href="index.php" class="btn btn-success"><i class="icon-ok icon-white"></i> Ok, entendi</a>
        </div>

    <?php else: ?>
        <div class="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h2>Atenção!</h2>
                <h3>O ID informado não é válido!</h3>
                <a href="index.php" class="btn btn-warning"><i class="icon-arrow-left icon-white"></i> Voltar para página anterior</a>
              </div>

    <?php endif;?>
</div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script>CKEDITOR.replace( 'editor1' );</script>
</body>
</html>
