<?php

namespace pedidoanotado\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use pedidoanotado\Modelos\ModeloLoja;
use pedidoanotado\Modelos\ModeloCompra;
use pedidoanotado\Util\Sessao;
use \pedidoanotado\Entidades\Loja;
use \pedidoanotado\Entidades\Produto;
use \pedidoanotado\Entidades\Compra;
use \pedidoanotado\Entidades\Carrinho;

class ControllerCompra {

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

    public function showCarrinho() {
        $carrinho = $this->sessao->get("carrinho");
        if (isset($carrinho) && !empty($carrinho)) {
            $compras = $this->sessao->get("carrinho")->getCompras();
            return $this->response->setContent($this->twig->render('carrinho.twig', ["carrinho" => $carrinho->getCompras()]));
        } else {
           return $this->response->setContent($this->twig->render('carrinho.twig', ["mensagem" => "Não há produtos no carrinho", "status" => 0]));
        }
    }

    public function adicionarCarrinho() {
        $nome = $this->contexto->get('nome');
        $preco = $this->contexto->get('preco');
        $quantidade = $this->contexto->get('quantidade');
        $codigo = $this->contexto->get('codigo');
        $imagem = $this->contexto->get('imagem');
        $loja = $this->contexto->get('id_loja');
        $produto = new Produto($nome, $codigo, $preco, null, $quantidade, $loja);
        $produto->setImagens($imagem);
        
        $carrinho = null;        
        if ($this->sessao->existe("carrinho")) {
            $carrinho = $this->sessao->get("carrinho");
        } else {
            $carrinho = new Carrinho();
        }
        $carrinho->addProduto($produto);
        $this->sessao->add("carrinho", $carrinho);       
        
        $destino = '/carrinho';
        $redirecionar = new RedirectResponse($destino);
        $redirecionar->send();
    }

    public function limparCarrinho() {
        $this->sessao->rem("carrinho");
    }
    public function realizarCompra(){
        $data = date("Y-m-d");
        if ($this->sessao->existe('cpf')){
            $carrinho = $this->sessao->get("carrinho");
            $carrinho->setCliente($this->sessao->get("cpf"));
            $modeloCompra = new ModeloCompra();            
            if($id = $modeloCompra->criarPedido($carrinho, $data, 3)){
                $this->sessao->rem("carrinho");
                echo "<script>window.location.href = '/user-home';</script>";
            }else{
                echo "Ocorreu um erro durante a compra";
            }
        }else {            
            echo "<script>window.location.href = '/login';</script>";
        }
    }
    public function trocarQuantidade() {
        $quantidade = $this->contexto->get("quantidade");
        $codigo = $this->contexto->get("codigo");
        
        $produto = new Produto("", $codigo, "");
        $produto->setQuantidade($quantidade);
        if ($this->sessao->existe("carrinho")) {
            $carrinho = $this->sessao->get("carrinho");
            $compras = $carrinho->getCompra();
            foreach ($compras as &$compra){
                $compra->setQuantidade($codigo, $quantidade);
            }
        }         
    }
}