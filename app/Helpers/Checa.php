<?php


class Checa {
     public static function checaNome($nome){
        if(!preg_match('/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/', $nome)):
            return true;
        else:
            return false;
        endif;
    }

    public static function checaEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            return true;
        else:
            return false;
        endif;
    }
}