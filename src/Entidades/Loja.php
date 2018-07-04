<?php

namespace pedidoanotado\Entidades;

use Symfony\Component\HttpFoundation\Request;

/* nome, email, senha, cnpj, razao-social, nome-fantasia,
  celular, telefone, cep, logradouro, numero, complemento, bairro, cidade, uf */

class Loja extends Usuario {

    private $cnpj;
    private $razaoSocial;
    private $nomeFantasia;
    
    /** @var  Produto Description*/
    private $produtos = array();
    
    private $compras = array(); 

    public function Loja() {
        
    }

    function __construct(Request $contexto) {
        parent::__construct($contexto);
        $this->cnpj = $contexto->get('cnpj');
        $this->razaoSocial = $contexto->get('razao-social');
        $this->nomeFantasia = $contexto->get('nome-fantasia');
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getRazaoSocial() {
        return $this->razaoSocial;
    }

    function getNomeFantasia() {
        return $this->nomeFantasia;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setRazaoSocial($razaoSocial) {
        $this->razaoSocial = $razaoSocial;
    }

    function setNomeFantasia($nomeFantasia) {
        $this->nomeFantasia = $nomeFantasia;
    }
    function getName() {
        return "Loja";
    }
}