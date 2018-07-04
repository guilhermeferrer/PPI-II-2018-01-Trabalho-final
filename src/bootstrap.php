<?php

namespace pedidoanotado;

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use pedidoanotado\Util\Sessao;


$sessao = new Sessao();
$sessao->start();


//$sessao->add("Usuario", 'Chris');
//$sessao->del();

include 'rotas.php';

//Variavel responsavel por criador o escopo da requisição
$request = Request::createFromGlobals();

//Requisição da rota para o tratamento
$contexto = new RequestContext();
$contexto->fromRequest($request);

//Retorno da requisição
$response = Response::create();

 $matcher = new UrlMatcher($rotas, $contexto);
 
$loader = new FilesystemLoader(__DIR__ . '/View');
$environment = new Environment($loader);

//$environment->addGlobal('dir', $dir);

try {        
    
    $atributos = $matcher->match($contexto->getPathInfo());   
    
    $controller = $atributos['_controller'];
    $method = $atributos['method'];    
    
    if (isset($atributos['suffix']))
        $parametros = $atributos['suffix'];
    else
        $parametros = '';
    
    $obj = new $controller($response, $request, $environment, $sessao);    
    $obj->$method($parametros);
    
} catch (ResourceNotFoundException $ex) {
    //$response->setContent('Not found fde', Response::HTTP_NOT_FOUND);
    $response->setContent("404");
}

$response->send();