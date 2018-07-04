<?php

namespace pedidoanotado\Modelos;

use pedidoanotado\Util\Conexao;
use pedidoanotado\Entidades\Loja;
use pedidoanotado\Entidades\Carrinho;
use pedidoanotado\Entidades\Compra;
use pedidoanotado\Entidades\Produto;
use PDO;

class ModeloCompra {

    function __construct() {
        
    }

    public function criarPedido(Carrinho $carrinho, $data, $endereco) {
        try {
            $sql = 'insert into pedido(total, id_endereco, id_cliente, data) values(:total , :id_endereco, :id_cliente, :data)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':total', $carrinho->getTotal());
            $p_sql->bindValue(':id_cliente', $carrinho->getCliente());
            $p_sql->bindValue(':data', $data);
            $p_sql->bindValue(':id_endereco', $endereco);

            if ($p_sql->execute()) {
                $this->criarCompra($carrinho->getCompras(), Conexao::getInstancia()->lastInsertId());
                //return Conexao::getInstancia()->lastInsertId();
                return $p_sql->rowCount();
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function criarCompra($compras, $id_pedido) {

        foreach ($compras as $compra) {
            try {
                $sql = 'insert into compra(total, status, id_loja, id_pedido) values(:total, :status, :id_loja, :id_pedido)';
                $p_sql = Conexao::getInstancia()->prepare($sql);
                $p_sql->bindValue(':total', $compra->getTotal());
                $p_sql->bindValue(':status', 0);
                $p_sql->bindValue(':id_loja', $compra->getLoja());
                $p_sql->bindValue(':id_pedido', $id_pedido);


                if ($p_sql->execute()) {
                    $this->criarProdutoCompra($compra->getProdutos(), Conexao::getInstancia()->lastInsertId());                    
                } 
            } catch (Exception $ex) {
                return 'deu erro na conexão:' . $ex;
            }
        }
        return;
    }

    public function criarProdutoCompra($produtos, $id_compra) {
        
        foreach ($produtos as $produto) {   
            
            try {
                $sql = 'insert into produto_compra(quantidade, codigo, id_compra) values(:quantidade, :codigo, :id_compra)';
                $p_sql = Conexao::getInstancia()->prepare($sql);
                $p_sql->bindValue(':quantidade', $produto->getQuantidade());
                $p_sql->bindValue(':id_compra', $id_compra);
                $p_sql->bindValue(':codigo', $produto->getCodigo());

                $p_sql->execute();
                
            } catch (Exception $ex) {
                return 'deu erro na conexão:' . $ex;
            }
        }
        return;
    }
}