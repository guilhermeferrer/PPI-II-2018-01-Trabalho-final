<?php

namespace pedidoanotado\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use pedidoanotado\Util\Sessao;
use \pedidoanotado\Entidades\Produto;
use pedidoanotado\Modelos\ModeloProduto;

class ControllerProduto {

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

    public function showNovoProduto() {
        if ($this->sessao->existe('cnpj'))
            return $this->response->setContent($this->twig->render('shop-product-new.twig'));
        else {
            $destino = '/login-loja';
            $redirecionar = new RedirectResponse($destino);
            $redirecionar->send();
        }
    }

    public function criarProduto() {
        $nome = $this->contexto->get('nome');
        $preco = $this->contexto->get('preco');
        $codigo = $this->contexto->get('codigo');
        $descricao = $this->contexto->get('descricao');
        $imagem = $this->contexto->files->get('imagem');

        $target_file = __DIR__ . '/../../public/img-banco/' . $imagem->getClientOriginalName();
        $temp_file = $_FILES["imagem"]["tmp_name"];
        if (move_uploaded_file($temp_file, $target_file)) {
            $produto = new Produto($nome, $codigo, $preco, $descricao);
            $produto->setImagens($imagem->getClientOriginalName());
            $modeloProduto = new ModeloProduto();
            if ($id = $modeloProduto->cadastrarProduto($produto, $this->sessao->get('cnpj')))
                echo "Produto adicionado com sucesso";
            else
                echo "Erro ao inserir produto";
        }else {
            echo "Error";
        }
    }

    public function alterarProduto() {
        $nome = $this->contexto->get('nome');
        $preco = $this->contexto->get('preco');
        $codigo = $this->contexto->get('codigo');
        $descricao = $this->contexto->get('descricao');
        $imagem = $this->contexto->files->get('imagem');

        $target_file = __DIR__ . '/../../public/img-banco/' . $imagem->getClientOriginalName();
        $temp_file = $_FILES["imagem"]["tmp_name"];

        $modeloProduto = new ModeloProduto();
        $produto = new Produto($nome, $codigo, $preco, $descricao);

        if (!empty($this->contexto->files->get('imagem'))) {
            $target_file = __DIR__ . '/../../public/img-banco/' . $imagem->getClientOriginalName();
            if (file_exists($target_file)) {
                $modeloProduto->alterarProduto($produto);                
                if ($modeloProduto->alterarImagemProduto($codigo, $imagem->getClientOriginalName())> 0) {
                    echo "Produto alterado com sucesso!";
                } else {
                    echo "Produto não alterado!";
                }
            } else {
                if ($modeloProduto->alterarProduto($produto) > 0) {
                    if (move_uploaded_file($temp_file, $target_file)) {
                        if ($modeloProduto->alterarImagemProduto($codigo, $imagem->getClientOriginalName()) > 0) {
                            echo "Produto alterado com sucesso!";
                        } else {
                            echo "Produto não alterado!";
                        }
                    }
                }
            }
        } else {
            if ($modeloProduto->alterarProduto($produto) > 0) {
                echo "Produto alterado com sucesso!";
            } else {
                echo "Produto não alterado!";
            }
        }
    }

}
