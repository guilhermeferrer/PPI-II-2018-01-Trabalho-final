<?php

namespace pedidoanotado\Modelos;

use pedidoanotado\Util\Conexao;
use pedidoanotado\Entidades\Usuario;
use PDO;

class ModeloLogin {

    function __construct() {
        
    }

    function login($login, $senha){
        try {
            $sql = 'select * from cliente where (cpf = :login or email = :login) and senha = :senha';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':login', $login);
            $p_sql->bindValue(':senha', $senha);
            if ($p_sql->execute()) {
                //return Conexao::getInstancia()->lastInsertId();
                return $p_sql->rowCount();
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    
    function loginLoja($login, $senha){
        try {
            $sql = 'select * from loja where (cnpj = :login or email = :login) and senha = :senha';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':login', $login);
            $p_sql->bindValue(':senha', $senha);
            if ($p_sql->execute()) {
                //return Conexao::getInstancia()->lastInsertId();
                return $p_sql->rowCount();
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
}