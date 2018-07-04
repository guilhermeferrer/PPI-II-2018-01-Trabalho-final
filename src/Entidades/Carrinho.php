<?php

namespace pedidoanotado\Entidades;

use \pedidoanotado\Util\Sessao;
use pedidoanotado\Entidades\Compra;
use pedidoanotado\Entidades\Produto;

class Carrinho {

    /** @var  Compra Description */
    private $compras = array();
    private $cliente;

    function __construct() {
        
    }
    
    function getCliente() {
        return $this->cliente;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    
    public function getTotal() {
        $total = 0;
        foreach ($this->compras as $compra) {
            $total += $compra->getTotal();
        }
        return $total;
    }

    public function addProduto(Produto $produto) {
        $cont = 0;
        foreach ($this->compras as $compra) {
            if ($compra->getLoja() == $produto->getLoja()) {
                $compra->addProdutoVerificaQuantidade($produto);
                break;
            }
            $cont++;
        }
        if ($cont === sizeof($this->compras)) {
                $this->addNewCompra($produto);
            }
    }

    public function getCompras() {
        return $this->compras;
    }

    private function addNewCompra(Produto $produto) {
        $compra = new Compra();
        $compra->addProdutoVerificaQuantidade($produto);
        $compra->setLoja($produto->getLoja());
        array_push($this->compras, $compra);
    }

}
