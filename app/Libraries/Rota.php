<?php
/* 
    -> Classe Rota
    -> Cria as URL, carrega os controladores, métodos e parametros
    -> FORMATO URL controlador/metodo/parametro 
    -> URL amigavel

*/
class Rota {

    //Controlador recebe por padrão paginas
    private $controlador = 'Usuarios';
    private $metodo = 'index';
    private $parametro = [];

    public function __construct()
    {
       $url = $this->url() ? $url = $this->url() : [0];
       //Verificando se a URL existe. Pegando a primeira letra em maiuscula
       if(file_exists('../app/Controllers/'.ucwords($url[0]).'.php')):
            $this->controlador = ucwords($url[0]);
            unset($url[0]);
       endif;

       require_once '../app/Controllers/'.$this->controlador.'.php';
       $this->controlador = new $this->controlador;

       if(isset($url[1])):
        //verifica se o metodo existe
        if(method_exists($this->controlador, $url[1])):
            $this->metodo = $url[1];
            unset($url[1]);
        endif;
       endif;

       //Varificando se o parametro existe
       $this->parametro = $url ? array_values($url) : [];
       call_user_func_array([$this->controlador, $this->metodo], $this->parametro);
    }

    private function url(){
        //Recebendo a URL e filtrando ela
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        if(isset($url)):
            //Retirando os espaços da URL e vazio do final
            $url= trim(rtrim($url, '/'));
            //Dividindo a URL pela barra e transformando a string em array
            $url = explode('/', $url);
            //Retornando URL
            return $url;
        endif;
    }
}