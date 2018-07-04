<?php

namespace pedidoanotado\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use pedidoanotado\Entidades\Cliente;
use pedidoanotado\Modelos\ModeloCliente;
use pedidoanotado\Modelos\ModeloLoja;
use pedidoanotado\Modelos\ModeloEndereco;
use pedidoanotado\Util\Sessao;
use \pedidoanotado\Entidades\Loja;

class ControllerCadastro {

    private $response;
    private $contexto;
    private $twig;
    private $sessao;

    public function __construct(Response $response, Request $contexto, Environment $twig, Sessao $sessao) {
        $this->response = $response;
        $this->contexto = $contexto;
        $this->twig = $twig;
        $this->sessao = $sessao;
    }

    public function show() {
        return $this->response->setContent($this->twig->render('cadastro.twig'));
    }

    public function showCadastroLoja() {
        return $this->response->setContent($this->twig->render('cadastro-loja.twig'));
    }

    public function cadastroUsuario() {
        $nome = $this->contexto->get('nome');
        $cpf = $this->contexto->get('cpf');
        $senha = $this->contexto->get('senha');
        $senha2 = $this->contexto->get('senha2');
        $email = $this->contexto->get('email');
        $telefone = $this->contexto->get('telefone');
        $celular = $this->contexto->get('celular');

        if ($senha == $senha2) {
            $modeloCliente = new ModeloCliente();
            if ($busca = $modeloCliente->verificaEmailCpf($email, $cpf)) {
                if ($busca[0]["email"] == $email) {
                    echo "Email já cadastrado!";
                } else if ($busca[0]["cpf"] == $cpf) {
                    echo "Cpf já cadastrado";
                }
            } else {
                $cliente = new Cliente($this->contexto);
                $modeloCliente = new ModeloCliente();
                if ($id = $modeloCliente->cadastrarCliente($cliente)) {
                    $this->sessao->add("cpf", $cpf);
                    echo "<script>window.location.href = '/user-home';</script>";
                } else
                    echo "erro na inserção";
            }
        }else {
            echo "Senhas divergentes";
        }
    }

    public function criarLoja() {
        $loja = new Loja($this->contexto);

        $modeloLoja = new ModeloLoja();
        if ($modeloLoja->cadastrarLoja($loja)) {
            $modeloEndereco = new ModeloEndereco();
            if ($modeloEndereco->cadastrarEndereco($loja->getEndereco(), "id_loja", $loja->getCnpj())) {
                echo("Inserido com sucesso");
            } else {
                "Erro ao inserir Endereço";
            }
        } else {
            echo "Erro ao inserir loja";
        }
    }

    public function cadastrarLoja() {
        $senha = $this->contexto->get('senha');
        $senha2 = $this->contexto->get('senha2');

        $loja = new Loja($this->contexto);

        if ($senha == $senha2) {
            $modeloLoja = new ModeloLoja();
            if ($busca = $modeloLoja->verificaEmailCnpj($loja->getEmail(), $loja->getCnpj())) {
                if ($busca[0]["email"] == $loja->getEmail()) {
                    echo "Email já cadastrado!";
                } else if ($busca[0]["cnpj"] == $loja->getCnpj()) {
                    echo "Cnpj já cadastrado";
                }
            } else {
                if ($modeloLoja->cadastrarLoja($loja)) {
                    $modeloEndereco = new ModeloEndereco();
                    if ($modeloEndereco->cadastrarEndereco($loja->getEndereco(), "id_loja", $loja->getCnpj())) {
                        $this->sessao->add("cnpj", $loja->getCnpj());
                        echo "<script>window.location.href = '/shop-home';</script>";
                    } else {
                        "Erro ao inserir Endereço";
                    }
                } else {
                    echo "Erro ao inserir loja";
                }
            }
        } else {
            echo "Senhas divergentes";
        }
    }

}

/*
        $nome = $this->contexto->get('nome');
        $senha = $this->contexto->get('senha');
        $email = $this->contexto->get('email');
        $cnpj = $this->contexto->get('cnpj'); 
        $celular = $this->contexto->get('celular'); 
        $telefone = $this->contexto->get('telefone');         
        $razaoSocial = $this->contexto->get('razao-social');  
        $nomeFantasia = $this->contexto->get('nome-fantasia');  
*/