-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Fev-2017 às 21:41
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_admin_usuarios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_grupo_acesso`
--

CREATE TABLE `config_grupo_acesso` (
  `id` int(11) NOT NULL,
  `grupo_acesso_id` int(11) NOT NULL,
  `modulo` varchar(50) NOT NULL,
  `POST` varchar(1) NOT NULL DEFAULT 'N',
  `PUT` varchar(1) NOT NULL DEFAULT 'N',
  `GET` varchar(1) NOT NULL DEFAULT 'N',
  `DELETE` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `config_grupo_acesso`
--

INSERT INTO `config_grupo_acesso` (`id`, `grupo_acesso_id`, `modulo`, `POST`, `PUT`, `GET`, `DELETE`) VALUES
(1, 1, 'grupos_acesso', 'S', 'S', 'S', 'S'),
(2, 1, 'usuarios', 'S', 'S', 'S', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `serie` varchar(15) DEFAULT NULL,
  `razao` varchar(200) DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `inscricao_municipal` varchar(50) DEFAULT NULL,
  `inscricao_estadual` varchar(50) DEFAULT NULL,
  `CNPJ_CPF` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `serie`, `razao`, `nome`, `inscricao_municipal`, `inscricao_estadual`, `CNPJ_CPF`, `updated_at`, `created_at`) VALUES
(1, '00001', 'empresa admin', 'empresa admin', '0000000000', '0000000000', '0000000000', NULL, NULL),
(2, '01589', 'empresa 2', 'empresa 2', '00000000', '00000000', '000000001', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_acesso`
--

CREATE TABLE `grupo_acesso` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `excluido` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo_acesso`
--

INSERT INTO `grupo_acesso` (`id`, `descricao`, `excluido`) VALUES
(1, 'Administrador', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `redes`
--

CREATE TABLE `redes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `redes`
--

INSERT INTO `redes` (`id`, `nome`) VALUES
(1, 'Rede inventada para Teste ltda');

-- --------------------------------------------------------

--
-- Estrutura da tabela `redes_empresas`
--

CREATE TABLE `redes_empresas` (
  `id` int(11) NOT NULL,
  `rede` int(11) NOT NULL,
  `serie_empresa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `redes_empresas`
--

INSERT INTO `redes_empresas` (`id`, `rede`, `serie_empresa`) VALUES
(1, 1, '00001'),
(2, 1, '01589');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `grupo_acesso_id` int(11) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `empresa_selecionada` varchar(1000) DEFAULT NULL,
  `senha` varchar(200) NOT NULL DEFAULT '781e5e245d69b566979b86e28d23f2c781e5e245d69b566979b86e28d23f2c7	',
  `logado` varchar(1) NOT NULL DEFAULT 'N',
  `excluido` varchar(1) NOT NULL DEFAULT 'N',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `grupo_acesso_id`, `sexo`, `empresa`, `empresa_selecionada`, `senha`, `logado`, `excluido`, `updated_at`, `created_at`) VALUES
(1, 'Vinicius Bassalobre', 'root', 1, 'M', '00001', '00001,', '7b24afc8bc80e548d66c4e7ff72171c5', 'S', 'N', '2017-02-08 18:47:02', NULL),
(20, 'teste', 'teste', 1, 'M', '00001', NULL, '698dc19d489c4e4db73e28a713eab07b', 'N', 'S', '2017-02-08 20:34:52', NULL),
(21, 'teste', 'teste', 1, 'M', '00001', NULL, '698dc19d489c4e4db73e28a713eab07b', 'N', 'S', '2017-02-08 20:40:34', NULL),
(22, 'teste', 'teste2', 1, 'M', '00001', NULL, '698dc19d489c4e4db73e28a713eab07b', 'N', 'S', '2017-02-08 20:40:37', NULL),
(23, 'teste', 'teste3', 1, 'M', '00001', NULL, '698dc19d489c4e4db73e28a713eab07b', 'N', 'S', '2017-02-08 20:40:41', NULL),
(24, 'teste', 'teste43', 1, 'M', '00001', NULL, '698dc19d489c4e4db73e28a713eab07b', 'N', 'S', '2017-02-08 20:40:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config_grupo_acesso`
--
ALTER TABLE `config_grupo_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grupos_acesso_idx` (`grupo_acesso_id`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serie` (`serie`);

--
-- Indexes for table `grupo_acesso`
--
ALTER TABLE `grupo_acesso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redes_empresas`
--
ALTER TABLE `redes_empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grupo_acesso_usuario_idx` (`grupo_acesso_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config_grupo_acesso`
--
ALTER TABLE `config_grupo_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grupo_acesso`
--
ALTER TABLE `grupo_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `config_grupo_acesso`
--
ALTER TABLE `config_grupo_acesso`
  ADD CONSTRAINT `fk_grupos_acesso` FOREIGN KEY (`grupo_acesso_id`) REFERENCES `grupo_acesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_grupo_acesso_usuario` FOREIGN KEY (`grupo_acesso_id`) REFERENCES `grupo_acesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
