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

class ControllerLoja {

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

    public function showShopHome() {
        if ($this->sessao->existe("cnpj")) {
            $cnpj = $this->sessao->get("cnpj");
            $modeloLoja = new ModeloLoja();
            $pedidos = $modeloLoja->getComprasLojaStatus0($cnpj , 0);
            if (sizeof($pedidos) > 0) {
                return $this->response->setContent($this->twig->render('shop-home.twig', ["pedidos" => $pedidos]));
            } else {
                return $this->response->setContent($this->twig->render('shop-home.twig', ["mensagem" => "Não há produtos", "status" => 0]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login-shop');
            $redirecionar->send();
        }
    }
    public function showShopHomePreparo() {
        if ($this->sessao->existe("cnpj")) {
            $cnpj = $this->sessao->get("cnpj");
            $modeloLoja = new ModeloLoja();
            $pedidos = $modeloLoja->getComprasLojaStatus0($cnpj , 1);
            if (sizeof($pedidos) > 0) {
                return $this->response->setContent($this->twig->render('shop-home.twig', ["pedidos" => $pedidos]));
            } else {
                return $this->response->setContent($this->twig->render('shop-home.twig', ["mensagem" => "Não há produtos", "status" => 0]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login-shop');
            $redirecionar->send();
        }
    }
    public function showShopHomeEntrega() {
        if ($this->sessao->existe("cnpj")) {
            $cnpj = $this->sessao->get("cnpj");
            $modeloLoja = new ModeloLoja();
            $pedidos = $modeloLoja->getComprasLojaStatus0($cnpj , 2);
            if (sizeof($pedidos) > 0) {
                return $this->response->setContent($this->twig->render('shop-home.twig', ["pedidos" => $pedidos]));
            } else {
                return $this->response->setContent($this->twig->render('shop-home.twig', ["mensagem" => "Não há produtos", "status" => 0]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login-shop');
            $redirecionar->send();
        }
    }
    
    
    public function showShopPedidosStatus(){
        $status = $this->contexto->get("status");
        
        if ($this->sessao->existe("cnpj")) {
            $cnpj = $this->sessao->get("cnpj");
            $modeloLoja = new ModeloLoja();
            $pedidos = $modeloLoja->getComprasLojaStatus0($cnpj , $status);
            if (sizeof($pedidos) > 0) {
                return $this->response->setContent($this->twig->render('shop-pedidos-status.twig', ["pedidos" => $pedidos]));
            } else {
                return $this->response->setContent($this->twig->render('not-found-box.twig', ["mensagem" => "Não há produtos"]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login-shop');
            $redirecionar->send();
        }
    }

    public function showShopAccount() {
        if ($this->sessao->existe("cnpj")) {
            $cnpj = $this->sessao->get("cnpj");
            $modeloLoja = new ModeloLoja();
            $loja = $modeloLoja->getLoja($cnpj);

            if (sizeof($loja) > 0) {
                return $this->response->setContent($this->twig->render('shop-account.twig', ["loja" => $loja[0]]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login-shop');
            $redirecionar->send();
        }
    }
    
    public function showShopAddress() {
        if ($this->sessao->existe("cnpj")) {
            $cnpj = $this->sessao->get("cnpj");
            $modeloEndereco = new ModeloEndereco();
            $endereco = $modeloEndereco->getEndereco($cnpj);

            if (sizeof($endereco) > 0) {
                return $this->response->setContent($this->twig->render('shop-address.twig', ["endereco" => $endereco[0]]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login-shop');
            $redirecionar->send();
        }
    }
    

    public function mostrarLojas() {
        if ($this->sessao->existe("cep")) {
            if ($this->contexto->get("cep")) {
                if ($this->contexto->get("cep") == $this->sessao->get("cep")) {
                    $cep = $this->contexto->get("cep");
                } else {
                    $cep = $this->contexto->get("cep");
                }
            } else {
                $cep = $this->sessao->get("cep");
            }
        } else {
            $cep = $this->contexto->get("cep");
            $this->sessao->add("cep", $cep);
        }
        $modeloLoja = new ModeloLoja();
        $lojas = $modeloLoja->buscarLojas($cep);
        if (sizeof($lojas) > 0) {
            return $this->response->setContent($this->twig->render('lojas.twig', ["lojas" => $lojas]));
        } else {
            return $this->response->setContent($this->twig->render('lojas.twig', ["mensagem" => "Não há lojas nesse CEP!", "status" => 0]));
        }
    }

    public function mostrarProdutosLoja($cnpj){
        $modeloProduto = new ModeloProduto();
        $produtos = $modeloProduto->mostrarProdutosLoja($cnpj);
        if (sizeof($produtos) > 0) {
            return $this->response->setContent($this->twig->render('produtos-loja.twig', ["produtos" => $produtos]));
        } else {
            return $this->response->setContent($this->twig->render('produtos-loja.twig', ["mensagem" => "Não há produtos!", "status" => 0]));
        }
    }
    
    public function mostrarProdutos(){
        $cnpj = $this->sessao->get("cnpj");
        $modeloProduto = new ModeloProduto();
        $produtos = $modeloProduto->mostrarProdutos($cnpj);
        if (sizeof($produtos) > 0) {
            return $this->response->setContent($this->twig->render('shop-product-home.twig', ["produtos" => $produtos]));
        } else {
            return $this->response->setContent($this->twig->render('shop-product-home.twig', ["produtos" => $produtos]));
        }
    }
    
    public function alterarLoja(){
        $loja = new Loja($this->contexto);
        $loja->setCnpj($this->sessao->get('cnpj'));
        $modeloLoja = new ModeloLoja();
        if ($modeloLoja->alterarLoja($loja)){
            echo "Alterado com sucesso!";
        } else{
            echo "Não alterado";
        }
    }
    public function showAlterarProduto($codigo) {
        if ($this->sessao->existe("cnpj")) {
            $cnpj = $this->sessao->get("cnpj");
            $modeloProduto = new ModeloProduto();
            $produto = $modeloProduto->getProduto($codigo);

            if (sizeof($produto) > 0) {
                return $this->response->setContent($this->twig->render('shop-product-update.twig', ["produto" => $produto[0]]));
            }
        } else {
            $redirecionar = new RedirectResponse('/login-shop');
            $redirecionar->send();
        }
    }
    public function shopPedidoMudarStatus() {
        $status = $this->contexto->get("status");
        $id = $this->contexto->get("id");
        
        $modeloLoja = new ModeloLoja();
        if($modeloLoja->alterarStatus($status, $id) > 0){
            echo $status-1;
        }       
    }
}