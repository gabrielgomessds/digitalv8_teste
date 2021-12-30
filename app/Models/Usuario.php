<?php

class Usuario {
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function checarEmail($email){
        $this->db->query("SELECT email FROM usuarios WHERE email = :email");
        $this->db->bind(':email', $email);

        if($this->db->resultados()):
            return true;
        else:
            return false;
        endif;
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO usuarios(nome, sobrenome, endereco, email) VALUES (:nome, :sobrenome, :endereco, :email)");
        $this->db->bind('nome', $dados['nome']);
        $this->db->bind('sobrenome', $dados['sobrenome']);
        $this->db->bind('endereco', $dados['endereco']);
        $this->db->bind('email', $dados['email']);
       
        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }
    public function alterar($dados){
        $this->db->query("UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome, endereco = :endereco, email = :email WHERE id = :id");
        $this->db->bind('id', $dados['id']);
        $this->db->bind('nome', $dados['nome']);
        $this->db->bind('sobrenome', $dados['sobrenome']);
        $this->db->bind('endereco', $dados['endereco']);
        $this->db->bind('email', $dados['email']);
       
        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }
   
    public function deletar($id){
        $this->db->query("DELETE FROM usuarios WHERE id = :id");
        $this->db->bind('id', $id);
     
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function lerUsuarios(){
        $this->db->query("SELECT * FROM usuarios ORDER BY id DESC");
        return $this->db->resultados();
    }

    public function lerUsuarioPorId($id){
        $this->db->query("SELECT * FROM usuarios WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->resultado();
    }

    public function quantUsuario(){
        $this->db->query("SELECT * FROM usuarios");
        if($this->db->executa()){
            return $this->db->totalResultados();
        }else{
            return false;
        }
    }
}