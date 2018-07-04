<?php

namespace pedidoanotado\Modelos;

use pedidoanotado\Modelos\ModeloEndereco;
use pedidoanotado\Util\Conexao;
use pedidoanotado\Entidades\Loja;
use PDO;

class ModeloLoja {

    private $modeloEndereco;

    function __construct() {
        
    }

    function cadastrarLoja(Loja $loja) {
        $tag = $this->getTag($loja->getNome());

        try {
            $sql = 'insert into loja (nome, email, senha, cnpj, razao_social, nome_fantasia, celular, telefone, tag) values(:nome, :email, :senha, :cnpj, :razao_social, :nome_fantasia, :celular, :telefone, :tag)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $loja->getNome());
            $p_sql->bindValue(':email', $loja->getEmail());
            $p_sql->bindValue(':senha', $loja->getSenha());
            $p_sql->bindValue(':cnpj', $loja->getCnpj());
            $p_sql->bindValue(':razao_social', $loja->getRazaoSocial());
            $p_sql->bindValue(':nome_fantasia', $loja->getNomeFantasia());
            $p_sql->bindValue(':celular', $loja->getCelular());
            $p_sql->bindValue(':telefone', $loja->getTelefone());
            $p_sql->bindValue(':tag', $tag);

            if ($p_sql->execute()) {
                //return Conexao::getInstancia()->lastInsertId();
                return $p_sql->rowCount();
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function buscarLojas($cep) {
        try {
            $sql = 'select * from loja as l join endereco as e on l.cnpj = e.id_loja and e.cep = :cep;';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cep', $cep);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function getData() {
        try {
            $sql = 'select * from loja;';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function mostrarPedidos($cpf) {
        try {
            $sql = 'select * from pedido where id_cliente = :cpf';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cpf', $cpf);

            if ($pedidos = $p_sql->execute()) {
                $pedidos = $p_sql->fetchAll();
                foreach ($pedidos as &$pedido) {
                    $pedido['compras'] = $this->getCompra($pedido);
                }
                return $pedidos;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function getCompra($pedido) {
        try {
            $sql = 'select * from compra where id_pedido = :id_pedido';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id_pedido', $pedido['id_pedido']);

            if ($compras = $p_sql->execute()) {
                $compras = $p_sql->fetchAll();
                foreach ($compras as &$compra) {
                    $compra['produtos'] = $this->getProdutos($compra);
                }
                return $compras;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function getComprasLoja($cnpj) {
        try {
            $sql = 'select * from compra where id_loja = :id_loja';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id_loja', $cnpj);

            if ($compras = $p_sql->execute()) {
                $compras = $p_sql->fetchAll();
                foreach ($compras as &$compra) {
                    $compra['produtos'] = $this->getProdutos($compra);
                }
                return $compras;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function getProdutos($compra) {
        try {
            $sql = 'select p.nome, p.codigo, p.imagem, pc.quantidade from produto_compra as pc join produto as p on pc.id_compra = :id_compra and pc.codigo = p.codigo';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id_compra', $compra['id_compra']);


            if ($produtos = $p_sql->execute()) {
                $produtos = $p_sql->fetchAll();
                return $produtos;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function verificaEmailCnpj($email, $cnpj) {
        try {
            $sql = 'select * from loja where cnpj = :cnpj or email = :email';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cnpj', $cnpj);
            $p_sql->bindValue(':email', $email);
            if ($p_sql->execute()) {
                return $p_sql->fetchAll();
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function getLoja($cnpj) {
        try {
            $sql = 'select * from loja where cnpj = :cnpj';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cnpj', $cnpj);
            if ($p_sql->execute()) {
                return $p_sql->fetchAll();
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    public function getTag($nome) {
        try {
            $controle = false;
            $nome = strtolower($nome);
            $tag = str_replace(" ", "-", $nome);
            $cont = 1;
            while ($controle != true) {
                $sql = 'select tag from loja where tag = :tag';
                $p_sql = Conexao::getInstancia()->prepare($sql);
                $p_sql->bindValue(':tag', $tag);
                if ($p_sql->execute()) {
                    $query = $p_sql->rowCount();
                    if ($query == 0) {
                        $controle = true;
                    } else {
                        $tag = $tag . '-' . $cont;
                        $cont++;
                    }
                }
            }
            return $tag;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function alterarLoja(Loja $loja) {
        try {
            $sql = 'update loja set nome = :nome, email = :email, celular = :celular,'
                    . ' telefone = :telefone, razao_social = :razao_social,'
                    . ' nome_fantasia = :nome_fantasia where cnpj = :cnpj';
            
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $loja->getNome());
            $p_sql->bindValue(':cnpj', $loja->getCnpj());
            $p_sql->bindValue(':email', $loja->getEmail());
            $p_sql->bindValue(':celular', $loja->getCelular());
            $p_sql->bindValue(':telefone', $loja->getTelefone());
            $p_sql->bindValue(':razao_social', $loja->getRazaoSocial());
            $p_sql->bindValue(':nome_fantasia', $loja->getNomeFantasia());

            if ($p_sql->execute()) {
                return $p_sql->rowCount();
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    
    public function getComprasLojaStatus0($cnpj, $status) {
        try {
            $sql = 'select * from compra where id_loja = :id_loja and status = :status';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id_loja', $cnpj);
            $p_sql->bindValue(':status', $status);

            if ($compras = $p_sql->execute()) {
                $compras = $p_sql->fetchAll();
                foreach ($compras as &$compra) {
                    $compra['produtos'] = $this->getProdutos($compra);
                }
                return $compras;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    
    public function alterarStatus($status, $id){
        try {
            $sql = 'update compra set status = :status where id_compra = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id', $id);
            $p_sql->bindValue(':status', $status);

            if ($p_sql->execute()) {
                return $p_sql->rowCount();
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
}