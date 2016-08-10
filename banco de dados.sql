-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Ago-2016 às 22:30
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
-- Estrutura da tabela `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `numero_desktop` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `excluido` varchar(1) DEFAULT 'N',
  `empresa` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes_gerais`
--

CREATE TABLE `configuracoes_gerais` (
  `id` int(11) NOT NULL,
  `email_adm` varchar(200) DEFAULT NULL,
  `porta_email_adm` int(11) DEFAULT NULL,
  `smtp_email_adm` varchar(200) DEFAULT NULL,
  `senha_email_adm` varchar(200) DEFAULT NULL,
  `autentica_email_adm` varchar(1) DEFAULT 'S',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `configuracoes_gerais`
--

INSERT INTO `configuracoes_gerais` (`id`, `email_adm`, `porta_email_adm`, `smtp_email_adm`, `senha_email_adm`, `autentica_email_adm`, `created_at`, `updated_at`) VALUES
(1, 'marcusv.bda@icloud.com', 587, 'smtp.mail.me.com', 'V1n1c1u5', 'S', NULL, NULL);

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
(9, 'teste', 1, 'N', 'S', '2016-06-15 20:46:55', '2016-06-16 01:46:55'),
(10, 'Gerente', 1, 'N', 'N', '2016-07-28 12:36:02', '2016-07-28 12:36:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `importacoes`
--

CREATE TABLE `importacoes` (
  `id` int(11) NOT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `importado` varchar(1) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `tempo_execucao` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `id_remetente` int(11) DEFAULT NULL,
  `mensagem` varchar(500) DEFAULT NULL,
  `id_destinatario` int(11) DEFAULT NULL,
  `lido` varchar(1) NOT NULL DEFAULT 'N',
  `dt_envio` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `id_remetente`, `mensagem`, `id_destinatario`, `lido`, `dt_envio`) VALUES
(1, 1, 'teste', 8, 'N', '2016-07-28 18:46:09'),
(2, 1, 'opabao', 8, 'N', '2016-07-28 18:48:57'),
(3, 1, 'teste', 8, 'N', '2016-07-28 18:51:47'),
(4, 1, 'pp', 8, 'N', '2016-07-28 18:57:57'),
(5, 1, 'teste', 8, 'N', '2016-07-28 18:58:42'),
(6, 8, 'teste para vinicius', 1, 'N', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `codigo_desktop` int(11) DEFAULT NULL,
  `codigobarras` varchar(100) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `nomefantasia` varchar(100) DEFAULT NULL,
  `unidade` varchar(10) DEFAULT NULL,
  `unidadeconversao` int(11) DEFAULT NULL,
  `codigo_st` int(11) DEFAULT NULL,
  `codigo_grupoproduto` int(11) DEFAULT NULL,
  `codigo_produtosefaz` varchar(50) DEFAULT NULL,
  `codigo_tipoproduto` int(11) DEFAULT NULL,
  `codigo_nbmsh` varchar(50) DEFAULT NULL,
  `ultimavenda` datetime DEFAULT NULL,
  `aliquotaicms` int(11) DEFAULT NULL,
  `aliquotaipi` int(11) DEFAULT NULL,
  `aliquotaiss` int(11) DEFAULT NULL,
  `estoque` float DEFAULT NULL,
  `estoqueregulador` float DEFAULT NULL,
  `precovenda` float DEFAULT NULL,
  `ultimocusto` float DEFAULT NULL,
  `precocompra` float DEFAULT NULL,
  `excluido` varchar(1) DEFAULT NULL,
  `entradas` varchar(50) DEFAULT NULL,
  `saidas` varchar(50) DEFAULT NULL,
  `custoatual` float DEFAULT NULL,
  `datacustoatual` date DEFAULT NULL,
  `calculapis` varchar(50) DEFAULT NULL,
  `calculacofins` varchar(50) DEFAULT NULL,
  `alteracaogrupo` varchar(50) DEFAULT NULL,
  `codigofabricante` varchar(50) DEFAULT NULL,
  `ultimacompra` date DEFAULT NULL,
  `icmsoutros` int(11) DEFAULT NULL,
  `acesso_contacredito` varchar(50) DEFAULT NULL,
  `acesso_contadebito` varchar(50) DEFAULT NULL,
  `tipoproduto` varchar(50) DEFAULT NULL,
  `bloquearvendaestoquezerado` varchar(50) DEFAULT NULL,
  `comissionado` varchar(50) DEFAULT NULL,
  `arredondamentotruncamento` varchar(50) DEFAULT NULL,
  `producaopropria` varchar(50) DEFAULT NULL,
  `codigoestendido` varchar(50) DEFAULT NULL,
  `codigotiposervico` varchar(50) DEFAULT NULL,
  `codigobarrasestendido` varchar(50) DEFAULT NULL,
  `codigonaturezareceita` varchar(50) DEFAULT NULL,
  `codigoanp` varchar(50) DEFAULT NULL,
  `codigo_stentrada` varchar(50) DEFAULT NULL,
  `unidadeentrada` varchar(50) NOT NULL,
  `codigo_sap` varchar(50) NOT NULL,
  `codigo_cest` varchar(50) NOT NULL,
  `md5` varchar(100) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT NULL,
  `dataatualizacao` timestamp NULL DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `empresa` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'usuarios', 'relatorio de todos usuários', 1, 'select * from usuarios\nwhere empresa=1 and excluido=''N''', '[{"label":"Usuário","classe":"col-md-6","tipo":"text","nome":"usuario","maximo":"100"}]', 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tanque`
--

CREATE TABLE `tanque` (
  `id` int(11) NOT NULL,
  `id_desktop` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `numero_empresa_desktop` int(11) NOT NULL,
  `capacidade` float DEFAULT NULL,
  `volumeatual` float DEFAULT NULL,
  `numero_produto` int(11) DEFAULT NULL,
  `numero_empresa` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Vinicius Bassalobre de Assis', 'F', '406.145.898-19', '1992-04-08 03:00:00', 1, '2578d734ff3c868c2ad68fa698d76730', 'uploads/fotos_profile/empresa_1/usuario_1/Screenshot_4.png', NULL, 'S', 'marcusv.bda@icloud.com', 'S', 'N', '2016-07-19 17:53:49', NULL),
(2, 'Driely da silva aoyama', 'F', '', '1993-09-05 03:00:00', 1, 'bee708867517a4563227ee6c2e9173e7', 'uploads/fotos_profile/user.png', NULL, 'N', 'driely@hotmail.com', 'S', 'S', '2016-07-11 18:09:49', NULL),
(4, 'nayla', 'F', '', '0000-00-00 00:00:00', 1, '5ca3049442f0c6e643ad75f68ac9a6bf', 'uploads/fotos_profile/user.png', NULL, 'N', 'nayla@email.com.br', 'N', 'S', '2016-07-11 18:06:16', '2016-06-21 18:17:12'),
(5, 'teste', 'F', '', '0000-00-00 00:00:00', 1, '781e5e245d69b566979b86e28d23f2c781e5e245d69b566979b86e28d23f2c7', 'uploads/fotos_profile/user.png', NULL, 'N', 'teste@email.com', 'N', 'S', '2016-07-19 17:54:03', '2016-07-11 18:07:55'),
(6, 'driely', 'F', '', '0000-00-00 00:00:00', 1, '781e5e245d69b566979b86e28d23f2c781e5e245d69b566979b86e28d23f2c7', 'uploads/fotos_profile/user.png', NULL, 'N', 'driely@email.com', 'N', 'S', '2016-07-19 18:01:25', '2016-07-19 18:00:43'),
(7, 'driely', 'F', '', '0000-00-00 00:00:00', 1, '781e5e245d69b566979b86e28d23f2c781e5e245d69b566979b86e28d23f2c7', 'uploads/fotos_profile/user.png', NULL, 'N', 'driely@email.com', 'N', 'S', '2016-07-19 18:02:40', '2016-07-19 18:01:41'),
(8, 'Driely da Silva Aoyama', 'F', '', '0000-00-00 00:00:00', 1, '781e5e245d69b566979b86e28d23f2c781e5e245d69b566979b86e28d23f2c7', 'uploads/fotos_profile/empresa_1/usuario_8/Screenshot_3.jpg', NULL, 'N', 'driely@email.com', 'N', 'N', '2016-07-28 12:39:35', '2016-07-19 18:02:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracoes_gerais`
--
ALTER TABLE `configuracoes_gerais`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `importacoes`
--
ALTER TABLE `importacoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relatorio_customizado`
--
ALTER TABLE `relatorio_customizado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanque`
--
ALTER TABLE `tanque`
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
-- AUTO_INCREMENT for table `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `configuracoes_gerais`
--
ALTER TABLE `configuracoes_gerais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `funcoes`
--
ALTER TABLE `funcoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `importacoes`
--
ALTER TABLE `importacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `relatorio_customizado`
--
ALTER TABLE `relatorio_customizado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tanque`
--
ALTER TABLE `tanque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
