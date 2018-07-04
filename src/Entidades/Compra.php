<?php

namespace pedidoanotado\Entidades;

class Compra {

    /** @var  Produto Description */
    private $produtos = array();
    private $data;
    private $loja;
    private $total;

    function __construct() {
        
    }

    function getProdutos() {
        return $this->produtos;
    }

    function getData() {
        return $this->data;
    }

    function setProdutos(Produto $produto) {
        array_push($this->produtos, $produto);
    }

    function setData($data) {
        $this->data = $data;
    }

    function getLoja() {
        return $this->loja;
    }

    function setLoja($loja) {
        $this->loja = $loja;
    }
    function getTotal() {
        return $this->total;
    }

    function setTotal($total) {
        $this->total = $total;
    }    
    
    function getTotalCompra() {
        $total = 0;
        foreach ($this->produtos as $produto) {
            $total = $total + ($produto->getPreco() * $produto->getQuantidade());
        }
        return $total;
    }

    function addProdutoVerificaQuantidade(Produto $novoProduto) {
        $cont = 0;
        foreach ($this->produtos as $produto) {
            if ($novoProduto->getCodigo() == $produto->getCodigo()) {
                $produto->setQuantidade($produto->getQuantidade() + $novoProduto->getQuantidade());
                break;
            }
            $cont++;
        }
        if ($cont === sizeof($this->produtos)) {
            $this->setProdutos($novoProduto);
        }
        $this->setTotal($this->getTotalCompra());
    }
    
    function setQuantidade($codigo, $quantidade) {
        $total = 0;
        foreach ($this->produtos as &$produto) {
            if($produto->getCodigo() == $codigo){
                $produto->setQuantidade($quantidade);
            }            
        }
        return $total;
    }
}