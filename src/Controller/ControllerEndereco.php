<?php

namespace pedidoanotado\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use pedidoanotado\Entidades\Cliente;
use pedidoanotado\Modelos\ModeloCliente;
use pedidoanotado\Entidades\Endereco;
use pedidoanotado\Modelos\ModeloEndereco;
use pedidoanotado\Util\Sessao;
use \pedidoanotado\Entidades\Loja;

class ControllerEndereco {

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
        if ($this->sessao->existe('cpf'))
            return $this->response->setContent($this->twig->render('cadastro-endereco.twig'));
        else {
            $destino = '/login';
            $redirecionar = new RedirectResponse($destino);
            $redirecionar->send();
        }
    }

    public function showAlterarEndereco($id_endereco) {
        if ($this->sessao->existe('cpf')) {
            $modeloEndereco = new ModeloEndereco();
            $endereco = $modeloEndereco->buscarEndereco($id_endereco);
            if (sizeof($endereco) > 0) {
                return $this->response->setContent($this->twig->render('alterar-endereco.twig', ["endereco" => $endereco[0]]));
            }
        } else {
            $destino = '/login';
            $redirecionar = new RedirectResponse($destino);
            $redirecionar->send();
        }
    }

    public function cadastrarEnderecoCliente() {
        $endereco = new Endereco($this->contexto);

        $modeloEndereco = new ModeloEndereco();
        if ($modeloEndereco->cadastrarEndereco($endereco, "id_cliente", $this->sessao->get("cpf"))) {
            $destino = '/user-address';
            $redirecionar = new RedirectResponse($destino);
            $redirecionar->send();
        }
    }

    public function alterarEnderecoCliente() {
        $endereco = new Endereco($this->contexto);
        $id_endereco = $this->contexto->get('id_endereco');
                
        $modeloEndereco = new ModeloEndereco();
        if ($r = $modeloEndereco->alterarEndereco($endereco, $id_endereco)) {
            $destino = '/user-address';
            $redirecionar = new RedirectResponse($destino);
            $redirecionar->send();
        }
    }
    public function alterarEnderecoLoja() {
        $endereco = new Endereco($this->contexto);
        $id_endereco = $this->contexto->get('id_endereco');        
                
        $modeloEndereco = new ModeloEndereco();
        if ($r = $modeloEndereco->alterarEndereco($endereco, $id_endereco)) {
            echo("Alterado com sucesso");
        } else {
            echo "Não alterado";
        }
    }

}
