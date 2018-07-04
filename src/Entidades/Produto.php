<?php

namespace pedidoanotado\Entidades;


class Produto {
    
    private $nome;
    private $codigo;
    private $preco;
    private $descricao;
    private $quantidade;
    private $loja;
    private $imagens;
    
    function __construct($nome, $codigo, $preco, $descricao= null, $quantidade = null, $loja = null) {
        $this->nome = $nome;
        $this->codigo = $codigo;
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->quantidade = $quantidade;
        $this->loja = $loja;
    }
    function getNome() {
        return $this->nome;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getPreco() {
        return $this->preco;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    function getImagens() {
        return $this->imagens;
    }

    function setImagens($imagen) {
        $this->imagens = $imagen;
    }
    function getQuantidade() {
        return $this->quantidade;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    function getLoja() {
        return $this->loja;
    }

    function setLoja($loja) {
        $this->loja = $loja;
    }
}