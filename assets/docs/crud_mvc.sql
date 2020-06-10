-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for crud_mvc
DROP DATABASE IF EXISTS `crud_mvc`;
CREATE DATABASE IF NOT EXISTS `crud_mvc` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `crud_mvc`;

-- Dumping structure for table crud_mvc.endereco
DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `logradouro` text NOT NULL,
  `numero_endereco` varchar(100) NOT NULL,
  `complemento_endereco` mediumtext NOT NULL,
  `bairro` text NOT NULL,
  `cidade` text NOT NULL,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table crud_mvc.endereco: ~7 rows (approximately)
DELETE FROM `endereco`;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` (`id`, `id_usuario`, `cep`, `logradouro`, `numero_endereco`, `complemento_endereco`, `bairro`, `cidade`, `uf`) VALUES
	(8, 1, '04208000', 'Rua Silva Bueno', '444', 'Apto 13', 'Ipiranga', 'São Paulo', 'SP');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;

-- Dumping structure for table crud_mvc.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` text DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table crud_mvc.usuario: ~12 rows (approximately)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `email`, `usuario`, `senha`, `ativo`) VALUES
	(1, 'Bruno Nogueira', 'bmarquesn@gmail.com', 'bmarquesn', '1e908d0e5e5666d2832dcc5192c7478d', 1),
	(15, 'Usuário Teste', 'teste@teste.com.br', 'teste', 'a94dfa704f108e7feefd4635060202c9', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
