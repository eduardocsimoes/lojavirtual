-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.17 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para loja
CREATE DATABASE IF NOT EXISTS `loja` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `loja`;

-- Copiando estrutura para tabela loja.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `senha` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela loja.admins: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `usuario`, `senha`) VALUES
	(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Copiando estrutura para tabela loja.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela loja.categorias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `titulo`) VALUES
	(1, 'Sapatos'),
	(2, 'Camisas'),
	(3, 'Calças'),
	(4, 'Bonés'),
	(9, 'Teste de categorias'),
	(10, 'Bermudas');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Copiando estrutura para tabela loja.pagamentos
CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela loja.pagamentos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
INSERT INTO `pagamentos` (`id`, `nome`) VALUES
	(1, 'Cortesia'),
	(2, 'Pagseguro'),
	(3, 'Paypal'),
	(4, 'Boleto'),
	(5, 'MoIP');
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;

-- Copiando estrutura para tabela loja.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `imagem` varchar(36) COLLATE utf8_bin DEFAULT '0',
  `quantidade` float NOT NULL DEFAULT '0',
  `preco` float NOT NULL DEFAULT '0',
  `descricao` text COLLATE utf8_bin,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela loja.produtos: ~51 rows (aproximadamente)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `id_categoria`, `nome`, `imagem`, `quantidade`, `preco`, `descricao`) VALUES
	(1, 1, 'Produto 1', 'sapatos.jpg', 100, 100, 'Descrição do produto 1'),
	(2, 1, 'Produto 2', '0ab2823e40a171cf58d58a2740dd5327.jpg', 250, 150, 'Descrição do produto 2'),
	(3, 2, 'Produto 3', 'camisa.jpg', 100, 175, 'Descrição do produto 3'),
	(4, 3, 'Produto 4', 'calça.jpg', 400, 105, 'Descrição do produto 4'),
	(5, 3, 'Produto 5', 'calça.jpg', 200, 100, 'Descrição do produto 5'),
	(6, 3, 'Produto 6', 'calça.jpg', 900, 300, 'Descrição do produto 6'),
	(7, 4, 'Produto 7', 'bone.jpg', 300, 300, 'Descrição do produto 7'),
	(8, 4, 'Produto 9', 'bone.jpg', 700, 100, 'Descrição do produto 9'),
	(9, 1, 'Produto 8', 'sapatos.jpg', 400, 100, 'Descrição do produto 8'),
	(10, 2, 'Produto 10', 'camisa.jpg', 100, 900, 'Descrição do produto 10'),
	(11, 2, 'Produto 11\r\n', 'camisa.jpg', 150, 400, 'Descrição do produto 11'),
	(12, 1, 'Produto 12', 'sapatos.jpg', 100, 100, 'Descrição do produto 12'),
	(13, 1, 'Produto 13', 'sapatos.jpg', 300, 75, 'Descrição do produto 13'),
	(14, 2, 'Produto 14', 'camisa.jpg', 100, 175, 'Descrição do produto 14'),
	(15, 3, 'Produto 15', 'calça.jpg', 400, 105, 'Descrição do produto 15'),
	(16, 3, 'Produto 16', 'calça.jpg', 200, 100, 'Descrição do produto 16'),
	(17, 3, 'Produto 17', 'calça.jpg', 900, 300, 'Descrição do produto 17'),
	(18, 4, 'Produto 18', 'bone.jpg', 300, 300, 'Descrição do produto 18'),
	(19, 4, 'Produto 19', 'bone.jpg', 700, 100, 'Descrição do produto 19'),
	(20, 1, 'Produto 20', 'sapatos.jpg', 400, 100, 'Descrição do produto 20'),
	(21, 2, 'Produto 21', 'camisa.jpg', 100, 900, 'Descrição do produto 21'),
	(22, 1, 'Produto 22', 'sapatos.jpg', 100, 100, 'Descrição do produto 22'),
	(23, 1, 'Produto 23', 'sapatos.jpg', 300, 75, 'Descrição do produto 23'),
	(24, 2, 'Produto 24', 'camisa.jpg', 100, 175, 'Descrição do produto 24'),
	(25, 3, 'Produto 25', 'calça.jpg', 400, 105, 'Descrição do produto 25'),
	(26, 3, 'Produto 26', 'calça.jpg', 200, 100, 'Descrição do produto 26'),
	(27, 3, 'Produto 27', 'calça.jpg', 900, 300, 'Descrição do produto 27'),
	(28, 4, 'Produto 28', 'bone.jpg', 300, 300, 'Descrição do produto 28'),
	(29, 4, 'Produto 29', 'bone.jpg', 700, 100, 'Descrição do produto 29'),
	(30, 1, 'Produto 30', 'sapatos.jpg', 400, 100, 'Descrição do produto 30'),
	(31, 2, 'Produto 31', 'camisa.jpg', 100, 900, 'Descrição do produto 31'),
	(32, 1, 'Produto 32', 'sapatos.jpg', 100, 100, 'Descrição do produto 32'),
	(33, 1, 'Produto 33', 'sapatos.jpg', 300, 75, 'Descrição do produto 33'),
	(34, 2, 'Produto 34', 'camisa.jpg', 100, 175, 'Descrição do produto 34'),
	(35, 3, 'Produto 35', 'calça.jpg', 400, 105, 'Descrição do produto 35'),
	(36, 3, 'Produto 36', 'calça.jpg', 200, 100, 'Descrição do produto 36'),
	(37, 3, 'Produto 37', 'calça.jpg', 900, 300, 'Descrição do produto 37'),
	(38, 4, 'Produto 38', 'bone.jpg', 300, 300, 'Descrição do produto 38'),
	(39, 4, 'Produto 39', 'bone.jpg', 700, 100, 'Descrição do produto 39'),
	(40, 1, 'Produto 40', 'sapatos.jpg', 400, 100, 'Descrição do produto 40'),
	(41, 2, 'Produto 41', 'camisa.jpg', 100, 900, 'Descrição do produto 41'),
	(42, 1, 'Produto 42', 'sapatos.jpg', 100, 100, 'Descrição do produto 42'),
	(43, 1, 'Produto 43', 'sapatos.jpg', 300, 75, 'Descrição do produto 43'),
	(44, 2, 'Produto 44', 'camisa.jpg', 100, 175, 'Descrição do produto 44'),
	(45, 3, 'Produto 45', 'calça.jpg', 400, 105, 'Descrição do produto 45'),
	(46, 3, 'Produto 46', 'calça.jpg', 200, 100, 'Descrição do produto 46'),
	(47, 3, 'Produto 47', 'calça.jpg', 900, 300, 'Descrição do produto 47'),
	(48, 4, 'Produto 48', 'bone.jpg', 300, 300, 'Descrição do produto 48'),
	(49, 4, 'Produto 49', 'bone.jpg', 700, 100, 'Descrição do produto 49'),
	(50, 1, 'Produto 50', 'sapatos.jpg', 400, 100, 'Descrição do produto 50'),
	(51, 2, 'Produto 51', 'camisa.jpg', 100, 900, 'Descrição do produto 51');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

-- Copiando estrutura para tabela loja.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `senha` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela loja.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
	(2, 'Eduardo Simoes', 'eduardocsimoes81@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
	(3, 'Amabile', 'amabilecsimoes@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela loja.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL DEFAULT '0',
  `valor` float NOT NULL DEFAULT '0',
  `endereco` text COLLATE utf8_bin,
  `forma_pg` int(11) NOT NULL DEFAULT '0',
  `status_pg` tinyint(4) NOT NULL DEFAULT '0',
  `pg_link` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela loja.vendas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` (`id`, `id_usuario`, `valor`, `endereco`, `forma_pg`, `status_pg`, `pg_link`) VALUES
	(3, 2, 0, 'Aracas', 1, 2, 'carrinho/obrigado'),
	(4, 2, 380, 'aracas vv', 1, 2, 'carrinho/obrigado'),
	(16, 2, 550, 'Rua', 2, 1, ''),
	(17, 2, 175, 'rta', 2, 1, '');
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;

-- Copiando estrutura para tabela loja.vendas_produtos
CREATE TABLE IF NOT EXISTS `vendas_produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_venda` int(11) NOT NULL DEFAULT '0',
  `id_produto` int(11) NOT NULL DEFAULT '0',
  `quantidade` float NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela loja.vendas_produtos: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `vendas_produtos` DISABLE KEYS */;
INSERT INTO `vendas_produtos` (`id`, `id_venda`, `id_produto`, `quantidade`) VALUES
	(1, 3, 10, 1),
	(2, 3, 12, 1),
	(3, 3, 15, 1),
	(4, 3, 49, 1),
	(5, 4, 1, 1),
	(6, 4, 3, 1),
	(7, 4, 4, 1),
	(17, 16, 2, 1),
	(18, 16, 6, 1),
	(19, 16, 14, 1),
	(20, 17, 2, 1),
	(21, 17, 5, 1);
/*!40000 ALTER TABLE `vendas_produtos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
