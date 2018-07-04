-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 04-Jul-2018 às 19:58
-- Versão do servidor: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pedidoanotado`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(18) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cpf`, `nome`, `email`, `telefone`, `celular`, `senha`) VALUES
('131.002.446-48', 'Guilherme', '123@123.c', '(12) 3123-1132', '(13) 31213-2223', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `total` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_loja` varchar(50) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  UNIQUE KEY `id_compra` (`id_compra`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`id_compra`, `total`, `status`, `id_loja`, `id_pedido`) VALUES
(25, 135, 3, '12123321', 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id_endereco` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_loja` varchar(50) DEFAULT NULL,
  `id_cliente` varchar(50) DEFAULT NULL,
  `cep` varchar(50) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  UNIQUE KEY `id_endereco` (`id_endereco`),
  KEY `id_loja` (`id_loja`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `id_loja`, `id_cliente`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `nome`, `referencia`) VALUES
(10, '122222', NULL, '38600-000', '2132132231', 123321, '12332132', '21313231', 'Paracatu', 'MG', 'Guilherme', NULL),
(15, '12123321', NULL, '12312-312', '21333221', 312321, '123321321', '213231321', '12332132', 'MG', 'Teste', NULL),
(14, NULL, '131.002.446-48', '123321321', '123312132', 123, 'Isso ai', 'Bela vista', 'Paracatu', 'MG', 'Guilherme', '12312');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja`
--

DROP TABLE IF EXISTS `loja`;
CREATE TABLE IF NOT EXISTS `loja` (
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cnpj` varchar(18) NOT NULL,
  `razao_social` varchar(50) DEFAULT NULL,
  `nome_fantasia` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cnpj`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja`
--

INSERT INTO `loja` (`nome`, `email`, `cnpj`, `razao_social`, `nome_fantasia`, `celular`, `telefone`, `senha`, `tag`) VALUES
('Guilherme', 'guilherme@123.com', '122222', '231231', '12312123', '(23) 31213-2131', '(13) 1223-2132', NULL, 'guilherme'),
('Teste', 'Teste@Teste', '12123321', '231213312', '312312312', '(32) 13213-2311', '(12) 3312-1223', '123', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `total` float DEFAULT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  `id_cliente` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  UNIQUE KEY `id_pedido` (`id_pedido`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_endereco` (`id_endereco`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `total`, `id_endereco`, `id_cliente`, `data`) VALUES
(27, 135, 3, '131.002.446-48', '2018-07-04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `codigo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_loja` varchar(50) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `preco` double DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  UNIQUE KEY `codigo` (`codigo`),
  KEY `id_loja` (`id_loja`)
) ENGINE=MyISAM AUTO_INCREMENT=12312312133 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo`, `id_loja`, `nome`, `preco`, `descricao`, `imagem`) VALUES
(123, '122222', 'Tomate', 123, 'Esse produto Ã© um Tomate', 'Ã­ndice.jpg'),
(1234213, '12123321', 'Tomate', 123, '132321321', 'Ã­ndice.jpg'),
(21321231, '12123321', 'Batata', 12, 'Batata', 'batata-frita.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_compra`
--

DROP TABLE IF EXISTS `produto_compra`;
CREATE TABLE IF NOT EXISTS `produto_compra` (
  `id_produto_compra` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_compra` varchar(50) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  UNIQUE KEY `id_produto_compra` (`id_produto_compra`),
  KEY `id_compra` (`id_compra`),
  KEY `codigo` (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto_compra`
--

INSERT INTO `produto_compra` (`id_produto_compra`, `id_compra`, `codigo`, `quantidade`) VALUES
(28, '25', '1234213', 1),
(29, '25', '21321231', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
