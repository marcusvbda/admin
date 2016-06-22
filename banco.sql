-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Jun-2016 às 05:02
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vendas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
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

INSERT INTO `empresas` (`id`, `razao`, `nome`, `inscricao_municipal`, `inscricao_estadual`, `CNPJ_CPF`, `updated_at`, `created_at`) VALUES
(1, 'empresa admin', 'empresa admin', '0000000000', '0000000000', '0000000000', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcoes`
--

CREATE TABLE `funcoes` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `empresa` int(11) NOT NULL,
  `usado` varchar(1) NOT NULL DEFAULT 'N',
  `excluido` varchar(1) NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcoes`
--

INSERT INTO `funcoes` (`id`, `descricao`, `empresa`, `usado`, `excluido`, `created_at`, `updated_at`) VALUES
(1, 'Vendedor', 1, 'S', 'N', '2016-06-14 20:31:45', '2016-06-14 21:20:00'),
(8, 'teste', 1, 'N', 'S', '2016-06-15 14:34:15', '2016-06-15 19:34:15'),
(9, 'teste', 1, 'N', 'S', '2016-06-15 20:46:55', '2016-06-16 01:46:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `descricao` varchar(500) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`id`, `usuario`, `descricao`, `created_at`, `updated_at`) VALUES
(2, 1, 'Alterou a função de usuário (id: 6) de(Gerente de vendas) para(Gerente de vendas teste)', '2016-06-15 01:30:13', NULL),
(3, 1, 'Excluiu a função de usuário (id: 6,  descrição : Gerente de vendas teste) ', '2016-06-15 01:30:13', NULL),
(4, 1, 'Cadastrou a função de usuário id() descricao() ', '2016-06-15 01:30:13', NULL),
(5, 1, 'Excluiu a função de usuário (id: 7,  descrição : teste) ', '2016-06-15 01:30:18', NULL),
(7, 1, 'Saiu do sistema', '2016-06-15 01:33:26', NULL),
(8, 1, 'Entrou do sistema', '2016-06-15 01:33:36', NULL),
(9, 1, 'Cadastrou a função de usuário descricao(teste)', '2016-06-15 01:58:05', NULL),
(10, 1, 'Alterou a função de usuário (id: 9) de(teste) para(teste 2)', '2016-06-15 01:58:26', NULL),
(11, 1, 'Excluiu a função de usuário (id: 9,  descrição : teste 2) ', '2016-06-15 01:58:30', NULL),
(12, 1, 'Saiu do sistema', '2016-06-15 18:22:21', NULL),
(13, 1, 'Entrou do sistema', '2016-06-15 18:22:31', NULL),
(15, 1, 'Alterou a função de usuário (id: 8) de(Gerente de Vendas) para(teste)', '2016-06-15 19:34:10', NULL),
(16, 1, 'Excluiu a função de usuário id(8), descrição(teste) ', '2016-06-15 19:34:14', NULL),
(17, 1, 'Saiu do sistema', '2016-06-16 00:14:38', NULL),
(18, 1, 'Entrou do sistema', '2016-06-16 00:14:46', NULL),
(19, 1, 'Saiu do sistema', '2016-06-16 00:15:21', NULL),
(20, 1, 'Entrou do sistema', '2016-06-16 00:15:40', NULL),
(21, 1, 'Saiu do sistema', '2016-06-16 00:49:36', NULL),
(22, 1, 'Entrou do sistema', '2016-06-16 00:49:44', NULL),
(23, 1, 'Saiu do sistema', '2016-06-16 00:49:52', NULL),
(24, 1, 'Entrou do sistema', '2016-06-16 00:50:05', NULL),
(25, 1, 'Saiu do sistema', '2016-06-16 01:00:49', NULL),
(26, 1, 'Entrou do sistema', '2016-06-16 01:01:03', NULL),
(27, 1, 'Saiu do sistema', '2016-06-16 01:01:22', NULL),
(28, 1, 'Entrou do sistema', '2016-06-16 01:01:40', NULL),
(29, 1, 'Cadastrou a função de usuário descricao(teste)', '2016-06-16 01:46:51', NULL),
(30, 1, 'Excluiu a função de usuário id(9), descrição(teste) ', '2016-06-16 01:46:55', NULL),
(31, 1, 'Saiu do sistema', '2016-06-16 18:37:00', NULL),
(32, 1, 'Entrou do sistema', '2016-06-16 18:37:11', NULL),
(33, 1, 'Saiu do sistema', '2016-06-16 18:50:27', NULL),
(34, 1, 'Entrou do sistema', '2016-06-16 18:50:55', NULL),
(35, 1, 'Entrou do sistema', '2016-06-16 19:15:22', NULL),
(36, 1, 'Entrou do sistema', '2016-06-16 19:16:42', NULL),
(37, 1, 'Saiu do sistema', '2016-06-16 19:17:02', NULL),
(38, 1, 'Entrou do sistema', '2016-06-16 19:17:06', NULL),
(39, 1, 'Saiu do sistema', '2016-06-16 19:17:31', NULL),
(40, 1, 'Entrou do sistema', '2016-06-16 19:19:03', NULL),
(41, 1, 'Alterou a foto do perfil', '2016-06-16 19:21:14', NULL),
(42, 1, 'Alterou a foto do perfil', '2016-06-16 19:47:24', NULL),
(43, 1, 'Alterou a foto do perfil', '2016-06-16 19:47:34', NULL),
(44, 1, 'Saiu do sistema', '2016-06-16 20:23:38', NULL),
(45, 1, 'Entrou do sistema', '2016-06-17 16:45:25', NULL),
(46, 1, 'Saiu do sistema', '2016-06-17 17:58:56', NULL),
(47, 1, 'Entrou do sistema', '2016-06-17 17:59:06', NULL),
(48, 1, 'Excluiu usuário id(3), nome(Nayla) ', '2016-06-21 18:12:24', NULL),
(49, 1, 'Excluiu usuário id(4), nome(nayla) ', '2016-06-21 18:17:43', NULL),
(50, 1, 'Excluiu usuário id(7), nome(nayala) ', '2016-06-21 18:20:41', NULL),
(51, 1, 'Saiu do sistema', '2016-06-21 18:20:54', NULL),
(52, 4, 'Entrou do sistema', '2016-06-21 18:22:25', NULL),
(53, 1, 'Entrou do sistema', '2016-06-21 18:28:45', NULL),
(54, 1, 'Saiu do sistema', '2016-06-21 18:28:49', NULL),
(55, 4, 'Entrou do sistema', '2016-06-21 20:13:09', NULL),
(56, 4, 'Saiu do sistema', '2016-06-21 20:13:49', NULL),
(57, 1, 'Entrou do sistema', '2016-06-21 20:13:58', NULL),
(58, 1, 'Saiu do sistema', '2016-06-21 20:14:36', NULL),
(59, 4, 'Entrou do sistema', '2016-06-21 20:14:45', NULL),
(60, 4, 'Saiu do sistema', '2016-06-21 20:15:05', NULL),
(61, 1, 'Entrou do sistema', '2016-06-21 20:15:22', NULL),
(62, 1, 'Saiu do sistema', '2016-06-21 20:27:05', NULL),
(63, 1, 'Entrou do sistema', '2016-06-22 02:34:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio_customizado`
--

CREATE TABLE `relatorio_customizado` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `empresa` int(11) NOT NULL,
  `query` text NOT NULL,
  `formulario` text NOT NULL,
  `excluido` varchar(1) NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `relatorio_customizado`
--

INSERT INTO `relatorio_customizado` (`id`, `nome`, `descricao`, `empresa`, `query`, `formulario`, `excluido`, `created_at`, `updated_at`) VALUES
(1, 'usuarios', 'relatorio de todos usuários', 1, 'select * from usuarios\r\nwhere excluido=''N''', '', 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `tipopessoa` varchar(1) NOT NULL DEFAULT 'F',
  `CPF_CNPJ` varchar(30) DEFAULT NULL,
  `dtnascimento` timestamp NULL DEFAULT NULL,
  `empresa` int(11) NOT NULL,
  `senha` varchar(200) NOT NULL DEFAULT '781e5e245d69b566979b86e28d23f2c781e5e245d69b566979b86e28d23f2c7',
  `foto` varchar(200) NOT NULL DEFAULT 'uploads/fotos_profile/user.png',
  `grupo_acesso` int(11) DEFAULT NULL,
  `admin` varchar(1) NOT NULL DEFAULT 'N',
  `email` varchar(200) NOT NULL,
  `logado` varchar(1) NOT NULL DEFAULT 'N',
  `excluido` varchar(1) NOT NULL DEFAULT 'N',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `tipopessoa`, `CPF_CNPJ`, `dtnascimento`, `empresa`, `senha`, `foto`, `grupo_acesso`, `admin`, `email`, `logado`, `excluido`, `updated_at`, `created_at`) VALUES
(1, 'Vinicius Bassalobre de Assis', 'F', '406.145.898-19', '1992-04-08 03:00:00', 1, '2578d734ff3c868c2ad68fa698d76730', 'uploads/fotos_profile/empresa_1/usuario_1/Screenshot_4.png', NULL, 'S', 'marcusv.bda@icloud.com', 'S', 'N', '2016-06-22 02:34:59', NULL),
(2, 'Driely da silva aoyama', 'F', '', '1993-09-05 03:00:00', 1, 'bee708867517a4563227ee6c2e9173e7', 'uploads/fotos_profile/user.png', NULL, 'N', 'driely@hotmail.com', 'N', 'N', '2016-06-21 17:55:46', NULL),
(4, 'nayla', 'F', '', '0000-00-00 00:00:00', 1, '5ca3049442f0c6e643ad75f68ac9a6bf', 'uploads/fotos_profile/user.png', NULL, 'N', 'nayla@email.com.br', 'N', 'N', '2016-06-21 20:15:05', '2016-06-21 18:17:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funcoes`
--
ALTER TABLE `funcoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relatorio_customizado`
--
ALTER TABLE `relatorio_customizado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `funcoes`
--
ALTER TABLE `funcoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `relatorio_customizado`
--
ALTER TABLE `relatorio_customizado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
