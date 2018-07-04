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
use pedidoanotado\Modelos\ModeloProduto;
use pedidoanotado\Util\Sessao;
use \pedidoanotado\Entidades\Loja;

class ControllerCliente {

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

    public function showUserHome() {
        if ($this->sessao->existe("cpf")) {
            $cpf = $this->sessao->get("cpf");
            $modeloLoja = new ModeloLoja();
            $pedidos = $modeloLoja->mostrarPedidos($cpf);
            if (sizeof($pedidos) > 0) {
                return $this->response->setContent($this->twig->render('user-home.twig', ["pedidos" => $pedidos]));
            } else {
                return $this->response->setContent($this->twig->render('user-home.twig', ["mensagem" => "Não há pedidos", "status" => 0]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login');
            $redirecionar->send();
        }
    }

    public function showUserAccount() { 
        if ($this->sessao->existe("cpf")) {
            $cpf = $this->sessao->get("cpf");
            $modeloCliente = new ModeloCliente();
            $cadastro = $modeloCliente->buscarCadastro($cpf);
            if (sizeof($cadastro) > 0) {
                return $this->response->setContent($this->twig->render('user-account.twig', ["cadastro" => $cadastro[0]]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login');
            $redirecionar->send();
        }
    }

    public function showUserAddress() {
        if ($this->sessao->existe("cpf")) {
            $cpf = $this->sessao->get("cpf");
            $modeloEndereco = new ModeloEndereco();
            $enderecos = $modeloEndereco->buscarEnderecos($cpf);
            if (sizeof($enderecos) > 0) {
                return $this->response->setContent($this->twig->render('user-address.twig', ["enderecos" => $enderecos]));
            }else{
                return $this->response->setContent($this->twig->render('user-address.twig', ["enderecos" => $enderecos]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login');
            $redirecionar->send();
        }
    }

    public function mostrarPedidos() {
        if ($this->sessao->existe("cpf")) {
            $cpf = $this->sessao->get("cpf");
            $modeloLoja = new ModeloLoja();
            $pedidos = $modeloLoja->mostrarPedidos($cpf);
            if (sizeof($pedidos) > 0) {
                var_dump($pedidos);
                //return $this->response->setContent($this->twig->render('pedidos-loja.twig', ["pedidos" => $pedidos]));
            } else {
                echo "Não há pedidos";
            }
        } else {
            $redirecionar = new RedirectResponse('/login-loja');
            $redirecionar->send();
        }
    }

    public function alterarCliente() {
        
        $cliente = new Cliente($this->contexto);
        $cliente->setCpf($this->sessao->get('cpf'));
        $modeloCliente = new ModeloCliente();
        if ($modeloCliente->alterarCliente($cliente)){
            echo "Cadastro alterado com sucesso!";
        } else{
            echo "Não alterado";
        }
    }
}
