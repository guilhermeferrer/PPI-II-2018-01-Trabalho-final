<?php

namespace pedidoanotado\Entidades;

use Symfony\Component\HttpFoundation\Request;

class Cliente extends Usuario{
    
    private $cpf;
    
    function __construct(Request $contexto) {
        parent::__construct($contexto);
        $this->cpf = $contexto->get('cpf');
    }
    function getCpf() {
        return $this->cpf;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    function getName() {
        return "Cliente";
    }
}
