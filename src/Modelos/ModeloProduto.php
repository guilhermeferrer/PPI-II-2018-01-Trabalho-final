<?php

namespace pedidoanotado\Modelos;

use pedidoanotado\Util\Conexao;
use pedidoanotado\Entidades\Produto;
use PDO;

class ModeloProduto {

    function __construct() {
        
    }

    function cadastrarProduto(Produto $produto, $cnpj) {

        try {
            $sql = 'insert into produto (nome, codigo, preco, descricao, id_loja, imagem) values(:nome, :codigo, :preco, :descricao, :idLoja, :imagem)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $produto->getNome());
            $p_sql->bindValue(':codigo', $produto->getCodigo());
            $p_sql->bindValue(':preco', $produto->getPreco());
            $p_sql->bindValue(':descricao', $produto->getDescricao());
            $p_sql->bindValue(':imagem', $produto->getImagens());
            $p_sql->bindValue(':idLoja', $cnpj);
            
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
    public function mostrarProdutosLoja($tag) {
        try {
            $sql = 'select l.nome as nome_loja, l.cnpj, p.nome, p.preco, p.imagem, p.descricao,p.codigo from produto as p join loja as l on p.id_loja = l.cnpj and l.tag = :tag';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':tag', $tag);
            $p_sql->execute();
            
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    public function mostrarProdutos($cnpj) {
        try {
            $sql = 'select l.nome as nome_loja, l.cnpj, p.nome, p.preco, p.imagem, p.descricao,p.codigo from produto as p join loja as l on p.id_loja = l.cnpj and l.cnpj = :cnpj';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cnpj', $cnpj);
            $p_sql->execute();
            
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    public function getProduto($codigo) {
        try {
            $sql = 'select * from produto where codigo = :codigo';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':codigo', $codigo);
            $p_sql->execute();
            
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    
    public function alterarProduto(Produto $produto) {        
        try {
            $sql = 'update produto set nome = :nome, descricao = :descricao, preco = :preco where codigo = :codigo';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':codigo', $produto->getCodigo());
            $p_sql->bindValue(':nome', $produto->getNome());
            $p_sql->bindValue(':descricao', $produto->getDescricao());
            $p_sql->bindValue(':preco', $produto->getPreco());
            $p_sql->execute();
            
            return $p_sql->rowCount();
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    public function alterarImagemProduto($codigo, $imagem) {
        try {
            $sql = 'update produto set imagem = :imagem where codigo = :codigo';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':codigo', $codigo);
            $p_sql->bindValue(':imagem', $imagem);
            $p_sql->execute();
            
            return $p_sql->rowCount();
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
}