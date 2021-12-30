<?php

class Controller{
    //Criando class MOdel para acessar o modelo
    public function model($model){
        require_once '../app/Models/'.$model.'.php';
        return new $model;
    }


    //Criando class View para acessar as Views
    public function view($view, $dados = []){
        $arquivo = ('../app/Views/'.$view.'.php');
        if(file_exists($arquivo)):
            require_once $arquivo;
        else:
            die("O arquivo não existe!");
        endif;
    }
}