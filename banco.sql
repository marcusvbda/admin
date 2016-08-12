-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Ago-2016 às 20:27
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

--
-- Extraindo dados da tabela `importacoes`
--

INSERT INTO `importacoes` (`id`, `arquivo`, `importado`, `usuario`, `empresa`, `tempo_execucao`, `created_at`, `updated_at`) VALUES
(1, '20160810085850001.json', 'S', 1, 1, 0.000720024, '2016-08-11 13:21:40', '2016-08-11 13:21:40'),
(2, '20160811090310001(1).json', 'S', 1, 1, 0.0003438, '2016-08-11 13:23:22', '2016-08-11 13:23:22'),
(3, '20160811090310001(1).json', 'S', 1, 1, 0.000877142, '2016-08-11 13:23:58', '2016-08-11 13:23:58'),
(4, '20160811090310001(1).json', 'S', 1, 1, 0.000511169, '2016-08-11 13:23:59', '2016-08-11 13:23:59'),
(5, '20160811090310001(1).json', 'S', 1, 1, 0.000533819, '2016-08-11 13:24:08', '2016-08-11 13:24:08'),
(6, '20160811090310001(1).json', 'S', 1, 1, 0.000847101, '2016-08-11 13:49:21', '2016-08-11 13:49:21'),
(7, '20160811090310001(1).json', 'S', 1, 1, 0.00048089, '2016-08-11 14:39:35', '2016-08-11 14:39:35'),
(8, '20160811090310001(1).json', 'S', 1, 1, 0.193734, '2016-08-11 14:41:24', '2016-08-11 14:41:24'),
(9, '20160811090310001(1).json', 'S', 1, 1, 0.161154, '2016-08-11 14:43:58', '2016-08-11 14:43:58'),
(10, '20160811090310001(1).json', 'S', 1, 1, 0.17617, '2016-08-11 14:46:31', '2016-08-11 14:46:31'),
(11, '20160811090310001(1).json', 'N', 1, 1, 0.112305, '2016-08-11 14:47:27', '2016-08-11 14:47:27'),
(12, '20160811090310001(1).json', 'N', 1, 1, 0.00175595, '2016-08-11 14:55:22', '2016-08-11 14:55:22'),
(13, '20160811090310001(1).json', 'N', 1, 1, 0.00187492, '2016-08-11 14:55:37', '2016-08-11 14:55:37'),
(14, '20160811090310001(1).json', 'N', 1, 1, 0.00201797, '2016-08-11 14:56:18', '2016-08-11 14:56:18'),
(15, '20160811090310001(1).json', 'N', 1, 1, 0.00212693, '2016-08-11 14:56:45', '2016-08-11 14:56:45'),
(16, '20160811090310001(1).json', 'N', 1, 1, 0.0640931, '2016-08-11 15:03:34', '2016-08-11 15:03:34'),
(17, '20160811090310001(1).json', 'N', 1, 1, 0.0386469, '2016-08-11 15:04:33', '2016-08-11 15:04:33'),
(18, '20160811090310001(1).json', 'N', 1, 1, 0.00217414, '2016-08-11 15:05:59', '2016-08-11 15:05:59'),
(19, '20160811090310001(1).json', 'N', 1, 1, 0.00304699, '2016-08-11 15:06:19', '2016-08-11 15:06:19'),
(20, '20160811090310001(1).json', 'N', 1, 1, 0.00180507, '2016-08-11 15:07:44', '2016-08-11 15:07:44'),
(21, '20160811090310001(1).json', 'N', 1, 1, 0.00233793, '2016-08-11 15:11:06', '2016-08-11 15:11:06'),
(22, '20160811090310001(1).json', 'S', 1, 1, 0.000496864, '2016-08-11 15:11:14', '2016-08-11 15:11:14'),
(23, '20160811090310001(1).json', 'S', 1, 1, 0.000469923, '2016-08-11 15:11:47', '2016-08-11 15:11:47'),
(24, '20160811090310001(1).json', 'S', 1, 1, 0.00157714, '2016-08-11 15:12:02', '2016-08-11 15:12:02'),
(25, '20160811090310001(1).json', 'S', 1, 1, 0.000702143, '2016-08-11 15:12:20', '2016-08-11 15:12:20'),
(26, '20160811090310001(1).json', 'S', 1, 1, 0.0015049, '2016-08-11 15:14:56', '2016-08-11 15:14:56'),
(27, '20160811090310001(1).json', 'S', 1, 1, 0.00132918, '2016-08-11 15:15:32', '2016-08-11 15:15:32'),
(28, '20160811090310001(1).json', 'S', 1, 1, 0.000808001, '2016-08-11 15:15:39', '2016-08-11 15:15:39'),
(29, '20160811090310001(1).json', 'S', 1, 1, 0.00125599, '2016-08-11 15:16:24', '2016-08-11 15:16:24'),
(30, '20160811090310001(1).json', 'S', 1, 1, 0.00049901, '2016-08-11 15:16:37', '2016-08-11 15:16:37'),
(31, '20160811090310001(1).json', 'S', 1, 1, 0.000492811, '2016-08-11 15:16:38', '2016-08-11 15:16:38'),
(32, '20160811090310001(1).json', 'S', 1, 1, 0.00118804, '2016-08-11 15:17:30', '2016-08-11 15:17:30'),
(33, '20160811090310001(1).json', 'S', 1, 1, 0.00139403, '2016-08-11 15:18:00', '2016-08-11 15:18:00'),
(34, '20160811090310001(1).json', 'S', 1, 1, 0.00099802, '2016-08-11 15:18:59', '2016-08-11 15:18:59'),
(35, '20160811090310001(1).json', 'S', 1, 1, 0.00106716, '2016-08-11 15:19:00', '2016-08-11 15:19:00'),
(36, '20160811090310001(1).json', 'S', 1, 1, 0.00115299, '2016-08-11 15:19:10', '2016-08-11 15:19:10'),
(37, '20160811090310001(1).json', 'S', 1, 1, 0.000809908, '2016-08-11 15:22:04', '2016-08-11 15:22:04'),
(38, '20160811090310001(1).json', 'S', 1, 1, 0.000477076, '2016-08-11 15:22:31', '2016-08-11 15:22:31'),
(39, '20160811090310001(1).json', 'S', 1, 1, 0.0036521, '2016-08-11 15:23:55', '2016-08-11 15:23:55'),
(40, '20160811090310001(1).json', 'S', 1, 1, 0.197367, '2016-08-11 15:24:35', '2016-08-11 15:24:35'),
(41, '20160811090310001(1).json', 'S', 1, 1, 0.050813, '2016-08-11 15:24:51', '2016-08-11 15:24:51'),
(42, '20160811090310001(1).json', 'S', 1, 1, 0.0600832, '2016-08-11 15:25:08', '2016-08-11 15:25:08'),
(43, '20160811090310001(1).json', 'N', 1, 1, 0.00174189, '2016-08-11 17:27:51', '2016-08-11 17:27:51'),
(44, '20160811090310001(1).json', 'N', 1, 1, 0.00186205, '2016-08-11 17:27:55', '2016-08-11 17:27:55'),
(45, '20160811090310001(1).json', 'N', 1, 1, 0.0585878, '2016-08-11 17:39:59', '2016-08-11 17:39:59'),
(46, '20160811090310001(1).json', 'N', 1, 1, 0.205152, '2016-08-11 17:40:38', '2016-08-11 17:40:38'),
(47, '20160811090310001(1).json', 'N', 1, 1, 0.00324011, '2016-08-11 17:41:15', '2016-08-11 17:41:15'),
(48, '20160811090310001(1).json', 'N', 1, 1, 0.00272202, '2016-08-11 17:41:16', '2016-08-11 17:41:16'),
(49, '20160811090310001(1).json', 'N', 1, 1, 0.00283289, '2016-08-11 17:41:17', '2016-08-11 17:41:17'),
(50, '20160811090310001(1).json', 'N', 1, 1, 0.00371099, '2016-08-11 17:42:00', '2016-08-11 17:42:00'),
(51, '20160811090310001(1).json', 'N', 1, 1, 0.00278592, '2016-08-11 17:42:26', '2016-08-11 17:42:26'),
(52, '20160811090310001(1).json', 'N', 1, 1, 0.0174921, '2016-08-11 17:42:49', '2016-08-11 17:42:49'),
(53, '20160811090310001(1).json', 'N', 1, 1, 0.053381, '2016-08-11 17:43:24', '2016-08-11 17:43:24'),
(54, '20160811090310001(1).json', 'N', 1, 1, 0.00266409, '2016-08-11 17:43:25', '2016-08-11 17:43:25'),
(55, '20160811090310001(1).json', 'N', 1, 1, 0.00289202, '2016-08-11 17:43:36', '2016-08-11 17:43:36'),
(56, '20160811090310001(1).json', 'N', 1, 1, 0.311985, '2016-08-11 17:46:00', '2016-08-11 17:46:00'),
(57, '20160811090310001(1).json', 'N', 1, 1, 0.002882, '2016-08-11 17:47:07', '2016-08-11 17:47:07'),
(58, '20160811090310001(1).json', 'N', 1, 1, 0.00273299, '2016-08-11 17:48:22', '2016-08-11 17:48:22'),
(59, '20160811090310001(1).json', 'N', 1, 1, 0.00256419, '2016-08-11 17:48:33', '2016-08-11 17:48:33'),
(60, '20160811090310001(1).json', 'S', 1, 1, 0.214667, '2016-08-11 18:18:06', '2016-08-11 18:18:06'),
(61, '20160811090310001(1).json', 'S', 1, 1, 0.423059, '2016-08-11 18:25:57', '2016-08-11 18:25:57'),
(62, '20160811090310001(1).json', 'S', 1, 1, 0.0851891, '2016-08-11 18:26:27', '2016-08-11 18:26:27');

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
  `unidadeentrada` varchar(50) DEFAULT NULL,
  `codigo_sap` varchar(50) DEFAULT NULL,
  `codigo_cest` varchar(50) DEFAULT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
