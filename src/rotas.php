<?php

namespace pedidoanotado\Rotas;


use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$rotas = new RouteCollection();

//INDEX
$rotas->add('index', new Route('/',
        array('_controller' => 'pedidoanotado\Controller\ControllerIndex',
            "method" => 'show')));
$rotas->add('lojas', new Route('/lojas',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'mostrarLojas')));

//CLIENTE PAGES 
    $rotas->add('userHome', new Route('/user-home',
        array('_controller' => 'pedidoanotado\Controller\ControllerCliente',
            "method" => 'showUserHome')));
    $rotas->add('userAccount', new Route('/user-account',
        array('_controller' => 'pedidoanotado\Controller\ControllerCliente',
            "method" => 'showUserAccount')));
    $rotas->add('userAccountUpdate', new Route('/user-account-update',
        array('_controller' => 'pedidoanotado\Controller\ControllerCliente',
            "method" => 'alterarCliente')));
        $rotas->add('userAddress', new Route('/user-address',
        array('_controller' => 'pedidoanotado\Controller\ControllerCliente',
            "method" => 'showUserAddress')));
    $rotas->add('userLogout', new Route('/user-logout',
        array('_controller' => 'pedidoanotado\Controller\ControllerLogin',
            "method" => 'userLogout')));
    
//PAGINAS LOJA
        $rotas->add('shopHome', new Route('/shop-home',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'showShopHome')));
        $rotas->add('shopHomePreparo', new Route('/shop-home-preparo',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'showShopHomePreparo')));
        $rotas->add('shopHomeEntrega', new Route('/shop-home-entrega',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'showShopHomeEntrega')));
        $rotas->add('shopLogout', new Route('/shop-logout',
        array('_controller' => 'pedidoanotado\Controller\ControllerLogin',
            "method" => 'shopLogout')));
        $rotas->add('shopAccount', new Route('/shop-account',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'showShopAccount')));
        $rotas->add('shopAccountUpdate', new Route('/shop-account-update',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'alterarLoja')));
        $rotas->add('showShopAddress', new Route('/shop-address',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'showShopAddress')));
        $rotas->add('shopAddressUpdate', new Route('/shop-address-update',
        array('_controller' => 'pedidoanotado\Controller\ControllerEndereco',
            "method" => 'alterarEnderecoLoja')));
        $rotas->add('shopProductHome', new Route('/shop-products',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'mostrarProdutos')));
        $rotas->add('shopProductAdd', new Route('/shop-products/novo',
        array('_controller' => 'pedidoanotado\Controller\ControllerProduto',
            "method" => 'showNovoProduto')));
        $rotas->add('adicionarProduto', new Route('/shop-add-product',
        array('_controller' => 'pedidoanotado\Controller\ControllerProduto',
            "method" => 'criarProduto')));
        $rotas->add('showAlterarProduto', new Route('/shop-products/{suffix}',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'showAlterarProduto', "suffix" => '')));
        $rotas->add('alterarProduto', new Route('/shop-update-product',
        array('_controller' => 'pedidoanotado\Controller\ControllerProduto',
            "method" => 'alterarProduto')));
        $rotas->add('showShopPedidosStatus', new Route('/show-shop-pedidos-status',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'showShopPedidosStatus')));        
        $rotas->add('shopPedidoMudartatus', new Route('/shop-pedidos-mudar-status',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'shopPedidoMudarStatus')));
        
    
//CADASTRO CLIENTE 
$rotas->add('cadastroCliente', new Route('/cadastro',
        array('_controller' => 'pedidoanotado\Controller\ControllerCadastro',
            "method" => 'show')));
$rotas->add('acaoCadastrarCliente', new Route('/cadastro-usuario',
        array('_controller' => 'pedidoanotado\Controller\ControllerCadastro',
            "method" => 'cadastroUsuario')));

//LOGIN USUÁRIO
$rotas->add('loginCliente', new Route('/login',
        array('_controller' => 'pedidoanotado\Controller\ControllerLogin',
            "method" => 'show')));
$rotas->add('acaoLogarCliente', new Route('/logar',
        array('_controller' => 'pedidoanotado\Controller\ControllerLogin',
            "method" => 'login')));

//LOGIN LOJA
$rotas->add('loginLoja', new Route('/login-shop',
        array('_controller' => 'pedidoanotado\Controller\ControllerLogin',
            "method" => 'showLojaLogin')));
$rotas->add('acaoLogarLoja', new Route('/acao-logar-loja',
        array('_controller' => 'pedidoanotado\Controller\ControllerLogin',
            "method" => 'loginLoja')));

//CADASTRO LOJA
$rotas->add('cadastroLoja', new Route('/cadastrar-loja',
        array('_controller' => 'pedidoanotado\Controller\ControllerCadastro',
            "method" => 'showCadastroLoja')));
$rotas->add('acaoCadastrarLoja', new Route('/acao-cadastrar-loja',
        array('_controller' => 'pedidoanotado\Controller\ControllerCadastro',
            "method" => 'cadastrarLoja')));

//CADASTRO PRODUTO
$rotas->add('cadastroProduto', new Route('/cadastrar-produto',
        array('_controller' => 'pedidoanotado\Controller\ControllerProduto',
            "method" => 'show')));
$rotas->add('acaoCadastrarProduto', new Route('/cadastro-produto',
        array('_controller' => 'pedidoanotado\Controller\ControllerProduto',
            "method" => 'criarProduto')));

//CADASTRO ENDERECO
$rotas->add('cadastrarEndereco', new Route('/user-address/novo',
        array('_controller' => 'pedidoanotado\Controller\ControllerEndereco',
            "method" => 'show')));
$rotas->add('alterarEndereco', new Route('/user-address/{suffix}',
        array('_controller' => 'pedidoanotado\Controller\ControllerEndereco',
            "method" => 'showAlterarEndereco', "suffix" => '')));
$rotas->add('acaoCadastrarEndereco', new Route('/acao-cadastrar-endereco',
        array('_controller' => 'pedidoanotado\Controller\ControllerEndereco',
            "method" => 'cadastrarEnderecoCliente')));
            $rotas->add('acaoAlterarEndereco', new Route('/acao-alterar-endereco',
        array('_controller' => 'pedidoanotado\Controller\ControllerEndereco',
            "method" => 'alterarEnderecoCliente')));

//LOGOUT 
$rotas->add('logout', new Route('/sair',
        array('_controller' => 'pedidoanotado\Controller\ControllerLogin',
            "method" => 'logout')));

//MOSTRAR LOJA
$rotas->add('lojaProdutos', new Route('/loja/{suffix}',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'mostrarProdutosLoja', "suffix" => '')));
//CARRINHO 
$rotas->add('mostrar-carrinho', new Route('/carrinho',
        array('_controller' => 'pedidoanotado\Controller\ControllerCompra',
            "method" => 'showCarrinho')));
$rotas->add('acao-carrinho', new Route('/adicionar-carrinho',
        array('_controller' => 'pedidoanotado\Controller\ControllerCompra',
            "method" => 'adicionarCarrinho', "suffix" => '')));
$rotas->add('limpar-carrinho', new Route('/limpar-carrinho',
        array('_controller' => 'pedidoanotado\Controller\ControllerCompra',
            "method" => 'limparCarrinho')));
$rotas->add('acaoTrocarQuantidade', new Route('/acao-trocar-quantidade',
        array('_controller' => 'pedidoanotado\Controller\ControllerCompra',
            "method" => 'trocarQuantidade')));
//COMPRA
$rotas->add('acaoCompra', new Route('/carrinho/acao-compra',
        array('_controller' => 'pedidoanotado\Controller\ControllerCompra',
            "method" => 'realizarCompra')));
//Pedido
$rotas->add('pedidosLoja', new Route('/pedidos',
        array('_controller' => 'pedidoanotado\Controller\ControllerLoja',
            "method" => 'mostrarPedidos')));

return $rotas;