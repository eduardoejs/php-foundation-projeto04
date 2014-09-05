<?php

//valida se o usuário está logado
function validarSession(){
    if(isset($_SESSION['logado']) and $_SESSION['logado'] == 1){
        return true;
    }else{
        return false;
    }
}