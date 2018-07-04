<?php

namespace pedidoanotado\Modelos;

use pedidoanotado\Util\Conexao;
use pedidoanotado\Entidades\Cliente;
use PDO;

class ModeloCliente {

    function __construct() {
        
    }

    function listarProdutos() {

        try {
            $sql = 'select * from produtos';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function verificaEmailCpf($email, $cpf){
        try {
            $sql = 'select * from cliente where cpf = :cpf or email = :email';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cpf', $cpf);
            $p_sql->bindValue(':email', $email);
            if ($p_sql->execute()) {
                return $p_sql->fetchAll();
            }            
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function buscarCadastro($cpf){
        try {
            $sql = 'select * from cliente where cpf = :cpf';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cpf', $cpf);
            if ($p_sql->execute()) {
                return $p_sql->fetchAll();
            }            
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }    

    function cadastrarCliente(Cliente $cliente) {

        try {
            $sql = 'insert into cliente (nome, cpf, senha, email, celular, telefone) values(:nome, :cpf, :senha, :email, :celular, :telefone)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $cliente->getNome());
            $p_sql->bindValue(':cpf', $cliente->getCpf());
            $p_sql->bindValue(':senha', $cliente->getSenha());
            $p_sql->bindValue(':email', $cliente->getEmail());
            $p_sql->bindValue(':celular', $cliente->getCelular());
            $p_sql->bindValue(':telefone', $cliente->getTelefone());
            
            if ($p_sql->execute()){
                //return Conexao::getInstancia()->lastInsertId();
                return $p_sql->rowCount();
            }else{
                return null;
            }      
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
        function alterarCliente(Cliente $cliente) {
        try {
            $sql = 'update cliente set nome = :nome, email = :email, celular = :celular, telefone = :telefone where cpf = :cpf';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $cliente->getNome());
            $p_sql->bindValue(':cpf', $cliente->getCpf());
            $p_sql->bindValue(':email', $cliente->getEmail());
            $p_sql->bindValue(':celular', $cliente->getCelular());
            $p_sql->bindValue(':telefone', $cliente->getTelefone());
            
            if ($p_sql->execute()){
                return $p_sql->rowCount();
            }else{
                return null;
            }      
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

}
