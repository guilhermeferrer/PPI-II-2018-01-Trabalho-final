<?php

namespace pedidoanotado\Modelos;

use pedidoanotado\Util\Conexao;
use pedidoanotado\Entidades\Endereco;
use PDO;

class ModeloEndereco {

    function __construct() {
        
    }

    function cadastrarEndereco(Endereco $endereco, $tipo = "id_cliente", $valor) {

        try {
            $sql = "insert into endereco ({$tipo}, nome, cep, logradouro, referencia, numero, complemento, bairro, cidade, uf) values(:valor, :nome, :cep, :logradouro, :referencia, :numero, :complemento, :bairro, :cidade, :uf)";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':valor', $valor);
            $p_sql->bindValue(':nome', $endereco->getNome());
            $p_sql->bindValue(':cep', $endereco->getCep());
            $p_sql->bindValue(':logradouro', $endereco->getLogradouro());
            $p_sql->bindValue(':referencia', $endereco->getReferencia());
            $p_sql->bindValue(':numero', $endereco->getNumero());
            $p_sql->bindValue(':complemento', $endereco->getComplemento());
            $p_sql->bindValue(':bairro', $endereco->getBairro());
            $p_sql->bindValue(':cidade', $endereco->getCidade());
            $p_sql->bindValue(':uf', $endereco->getUf());

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

    public function buscarEnderecos($cpf) {
        try {
            $sql = 'select * from endereco where id_cliente = :cpf';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cpf', $cpf);
            if ($p_sql->execute()) {
                return $p_sql->fetchAll();
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function buscarEndereco($id_endereco) {
        try {
            $sql = 'select * from endereco where id_endereco = :id_endereco';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id_endereco', $id_endereco);
            if ($p_sql->execute()) {
                return $p_sql->fetchAll();
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function alterarEndereco(Endereco $endereco, $id_endereco) {
        try {
            $sql = "update endereco set  nome = :nome, cep = :cep, logradouro = :logradouro, logradouro = :logradouro, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, uf = :uf where id_endereco = :id_endereco";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id_endereco', $id_endereco);
            $p_sql->bindValue(':nome', $endereco->getNome());
            $p_sql->bindValue(':cep', $endereco->getCep());
            $p_sql->bindValue(':logradouro', $endereco->getLogradouro());
            $p_sql->bindValue(':referencia', $endereco->getReferencia());
            $p_sql->bindValue(':numero', $endereco->getNumero());
            $p_sql->bindValue(':complemento', $endereco->getComplemento());
            $p_sql->bindValue(':bairro', $endereco->getBairro());
            $p_sql->bindValue(':cidade', $endereco->getCidade());
            $p_sql->bindValue(':uf', $endereco->getUf());
           
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
    
    public function getEndereco($cnpj) {
        try {
            $sql = 'select * from endereco where id_loja = :id_loja';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id_loja', $cnpj);
            if ($p_sql->execute()) {
                return $p_sql->fetchAll();
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
}