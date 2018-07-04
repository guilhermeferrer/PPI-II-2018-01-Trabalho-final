<?php

namespace pedidoanotado\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use pedidoanotado\Entidades\Usuario;
use pedidoanotado\Modelos\ModeloLogin;
use pedidoanotado\Util\Sessao;

class ControllerLogin {

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
        if ($this->sessao->existe('cpf')) {
            $redirecionar = new RedirectResponse('/user-home');
            $redirecionar->send();
        } else {
            return $this->response->setContent($this->twig->render('login.twig'));
        }
    }

    public function showLojaLogin() {
        if ($this->sessao->existe('cnpj')) {
            $redirecionar = new RedirectResponse('/shop-home');
            $redirecionar->send();
        } else {
            return $this->response->setContent($this->twig->render('login-loja.twig'));
        }
    }

    public function login() {
        // validação
        $login = $this->contexto->get('login');
        $senha = $this->contexto->get('senha');

        // depois de validado
        $modeloLogin = new ModeloLogin();
        if ($id = $modeloLogin->login($login, $senha)) {
            $this->sessao->add("cpf", $login);
            echo "<script>window.location.href = '/user-home';</script>";
        } else
            echo "Erro no login";
    }

    public function loginLoja() {

        $login = $this->contexto->get('login');
        $senha = $this->contexto->get('senha');

        $modeloLogin = new ModeloLogin();
        if ($id = $modeloLogin->loginLoja($login, $senha)){
            $this->sessao->add("cnpj", $login);
            echo "<script>window.location.href = '/shop-home';</script>";
        }            
        else
            echo "Erro no login";
    }

    public function shopLogout() {
        $this->sessao->rem("cnpj");
        $redirecionar = new RedirectResponse('/');
        $redirecionar->send();
    }
    public function userLogout() {
        $this->sessao->rem("cpf");
        $redirecionar = new RedirectResponse('/');
        $redirecionar->send();
    }
}
