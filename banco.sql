-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Jun-2016 às 23:08
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.20

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
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcoes`
--

INSERT INTO `funcoes` (`id`, `descricao`, `empresa`, `usado`, `created_at`, `updated_at`) VALUES
(1, 'Vendedor', 1, 'S', '2016-06-14 20:31:45', '2016-06-14 21:20:00'),
(8, 'Gerente de Vendas', 1, 'N', '2016-06-15 01:31:08', '2016-06-15 01:31:08');

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
(11, 1, 'Excluiu a função de usuário (id: 9,  descrição : teste 2) ', '2016-06-15 01:58:30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `tipopessoa` varchar(1) NOT NULL DEFAULT 'F',
  `CPF_CNPJ` varchar(30) NOT NULL DEFAULT '',
  `site` varchar(200) NOT NULL DEFAULT '',
  `dtnascimento` timestamp NULL DEFAULT NULL,
  `empresa` int(11) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL DEFAULT 'user.png',
  `grupo_acesso` int(11) DEFAULT NULL,
  `email` varchar(200) NOT NULL DEFAULT '',
  `admin` varchar(1) NOT NULL DEFAULT 'N',
  `logado` varchar(1) NOT NULL DEFAULT 'N',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `tipopessoa`, `CPF_CNPJ`, `site`, `dtnascimento`, `empresa`, `senha`, `foto`, `grupo_acesso`, `email`, `admin`, `logado`, `updated_at`, `created_at`) VALUES
(1, 'Marcus Vinicius Bassalobre de Assis', 'F', '', '', NULL, 1, '2578d734ff3c868c2ad68fa698d76730', 'user.png', NULL, 'marcusv.bda@icloud.com', 'S', 'S', '2016-06-15 01:33:36', NULL),
(2, 'Driely da Silva Aoyama', 'F', '', '', '1993-09-05 03:00:00', 1, 'bee708867517a4563227ee6c2e9173e7', 'user.png', NULL, 'driely.aoayama@gmail.com', 'N', 'N', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
