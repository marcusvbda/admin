-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Fev-2017 às 19:21
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
  `modulo_id` int(11) NOT NULL,
  `POST` varchar(1) NOT NULL DEFAULT 'N',
  `PUT` varchar(1) NOT NULL DEFAULT 'N',
  `GET` varchar(1) NOT NULL DEFAULT 'N',
  `DELETE` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_acesso`
--

CREATE TABLE `grupo_acesso` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `excluido` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `modulo` varchar(50) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `habilitado` varchar(1) NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `redes`
--

CREATE TABLE `redes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `redes_empresas`
--

CREATE TABLE `redes_empresas` (
  `id` int(11) NOT NULL,
  `rede` int(11) NOT NULL,
  `serie_empresa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `config_grupo_acesso`
--
ALTER TABLE `config_grupo_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grupos_acesso_idx` (`grupo_acesso_id`),
  ADD KEY `fk_conf_modulo_idx` (`modulo_id`);

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
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `grupo_acesso`
--
ALTER TABLE `grupo_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `config_grupo_acesso`
--
ALTER TABLE `config_grupo_acesso`
  ADD CONSTRAINT `fk_conf_modulo` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupos_acesso` FOREIGN KEY (`grupo_acesso_id`) REFERENCES `grupo_acesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_grupo_acesso_usuario` FOREIGN KEY (`grupo_acesso_id`) REFERENCES `grupo_acesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
