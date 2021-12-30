<?php

spl_autoload_register(function($classe){
    //listando os diretorios para buscar classes
    $diretorios = [
        'Libraries',
        'Helpers'
    ];
    //Percorrer os diretorios em busca das classes e verifica se existe
    foreach($diretorios as $diretorio):
        $arquivo = __DIR__.DIRECTORY_SEPARATOR.$diretorio.DIRECTORY_SEPARATOR.$classe.'.php';
        if(file_exists( $arquivo)):
            require_once $arquivo;
        endif;
    endforeach;
});