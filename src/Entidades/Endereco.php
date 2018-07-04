<?php

namespace pedidoanotado\Entidades;

use Symfony\Component\HttpFoundation\Request;

/*cep, logradouro, numero, complemento, bairro, cidade, uf*/
class Endereco {
    private $nome;
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $referencia;
    private $bairro;
    private $cidade; 
    private $uf;
    
    function __construct(Request $contexto) {
        $this->cep = $contexto->get('cep');
        $this->nome = $contexto->get('nome');
        $this->logradouro = $contexto->get('logradouro');
        $this->numero = $contexto->get('numero');
        if($contexto->get('complemento')==null){
            $this->complemento = "";
        }else{
            $this->complemento = $contexto->get('complemento');        }  
        $this->referencia = $contexto->get('referencia');
        $this->bairro = $contexto->get('bairro');
        $this->cidade = $contexto->get('cidade');
        $this->uf = $contexto->get('uf');
    }
    function getNome() {
        return $this->nome;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

        function getCep() {
        return $this->cep;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }
}
