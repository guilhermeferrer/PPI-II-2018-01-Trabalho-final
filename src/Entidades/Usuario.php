<?php

namespace pedidoanotado\Entidades;

use Symfony\Component\HttpFoundation\Request;

abstract class Usuario {
    private $nome;
    private $senha;
    private $email;
    private $telefone;
    private $celular;
    
     /** @var  Endereco Description*/
    private $endereco;
    
    function __construct(Request $contexto) {
        $this->nome = $contexto->get('nome');
        $this->senha = $contexto->get('senha');
        $this->email = $contexto->get('email');
        $this->telefone = $contexto->get('telefone');
        $this->celular = $contexto->get('celular'); 
        $this->endereco = new Endereco($contexto);
    }
    function getNome() {
        return $this->nome;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCelular() {
        return $this->celular;
    }

    function getEndereco(): Endereco {
        return $this->endereco;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setEndereco(Endereco $endereco) {
        $this->endereco = $endereco;
    }
}
