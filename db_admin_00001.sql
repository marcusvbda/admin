-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Fev-2017 às 19:22
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_admin_00001`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `abastecimentos`
--

CREATE TABLE `abastecimentos` (
  `sequencia` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `numero_empresa` int(11) DEFAULT NULL,
  `id_bomba` int(11) DEFAULT NULL,
  `id_caixa` int(11) DEFAULT NULL,
  `totaldinheiro` double DEFAULT NULL,
  `totallitros` double DEFAULT NULL,
  `precounitario` double DEFAULT NULL,
  `tempoabastecimento` varchar(10) DEFAULT NULL,
  `dataabastecimento` date DEFAULT NULL,
  `horaabastecimento` varchar(5) DEFAULT NULL,
  `encerrantereal` double DEFAULT NULL,
  `inserido` char(1) DEFAULT NULL,
  `pendente` char(1) DEFAULT NULL,
  `registro` int(11) DEFAULT NULL,
  `id_dadosfaturamento` int(11) DEFAULT NULL,
  `numero_funcionario` int(11) DEFAULT NULL,
  `tag` varchar(30) DEFAULT NULL,
  `encerranteinicial` double DEFAULT NULL,
  `md5` varchar(128) DEFAULT NULL,
  `leitura` varchar(82) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bancos`
--

CREATE TABLE `bancos` (
  `sequencia` int(11) NOT NULL,
  `numero` char(5) DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bomba`
--

CREATE TABLE `bomba` (
  `sequencia` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `pulsos` int(11) DEFAULT NULL,
  `digitos` int(11) DEFAULT NULL,
  `encerranteatual` double DEFAULT NULL,
  `id_ilha` int(11) DEFAULT NULL,
  `id_tanque` int(11) DEFAULT NULL,
  `numero_empresa` int(11) DEFAULT NULL,
  `id_preco` int(11) DEFAULT NULL,
  `ponto` int(11) DEFAULT NULL,
  `posicao` int(11) DEFAULT NULL,
  `canal` int(11) DEFAULT NULL,
  `bomba` int(11) DEFAULT NULL,
  `protocolo` int(11) DEFAULT NULL,
  `status` char(2) DEFAULT NULL,
  `serie` varchar(30) DEFAULT NULL,
  `fabricante` varchar(30) DEFAULT NULL,
  `modelo` varchar(30) DEFAULT NULL,
  `tipomedicao` char(1) DEFAULT NULL,
  `lacres` blob,
  `encerrantestatus` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `sequencia` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `numero_ilha` int(11) DEFAULT NULL,
  `nome_ilha` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `dataabertura` date DEFAULT NULL,
  `horaabertura` char(5) DEFAULT NULL,
  `datafechamento` date DEFAULT NULL,
  `horafechamento` char(5) DEFAULT NULL,
  `numero_funcionario` int(11) DEFAULT NULL,
  `nome_funcionario` varchar(50) DEFAULT NULL,
  `valorinicial` double DEFAULT NULL,
  `situacao` varchar(50) DEFAULT NULL,
  `numero_empresa` int(11) DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `usuarioexclusao` varchar(20) DEFAULT NULL,
  `datacadastro` date DEFAULT NULL,
  `dataexclusao` date DEFAULT NULL,
  `selecionado` char(1) DEFAULT NULL,
  `processook` char(1) DEFAULT NULL,
  `ultimalinha` int(11) DEFAULT NULL,
  `observacoesadicionais` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `sequencia` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cnpj` char(18) DEFAULT NULL,
  `inscricaoestadual` char(18) DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `tipopessoa` char(1) DEFAULT NULL,
  `numero_grupo` int(11) DEFAULT NULL,
  `razaosocial` varchar(50) DEFAULT NULL,
  `contato2` varchar(50) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `matriz` char(1) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `mesclado` char(1) DEFAULT NULL,
  `numero_grupofaturamento` int(11) DEFAULT NULL,
  `inscricaomunicipal` char(18) DEFAULT NULL,
  `msgnotafiscal` varchar(100) DEFAULT NULL,
  `msgboleto` varchar(100) DEFAULT NULL,
  `alteracaogrupo` char(1) DEFAULT NULL,
  `imprimirboleto` char(1) DEFAULT NULL,
  `imprimirnotafiscal` char(1) DEFAULT NULL,
  `boletoindividual` char(1) DEFAULT NULL,
  `numero_condpgto` int(11) DEFAULT NULL,
  `regiao_atendimento` int(11) DEFAULT NULL,
  `acesso_contacredito` varchar(20) DEFAULT NULL,
  `acesso_contadebito` varchar(20) DEFAULT NULL,
  `id_limitechequeemitente` int(11) DEFAULT NULL,
  `id_limitechequeportador` int(11) DEFAULT NULL,
  `id_limitecredito` int(11) DEFAULT NULL,
  `id_limitecartafrete` int(11) DEFAULT NULL,
  `id_limitevalemotorista` int(11) DEFAULT NULL,
  `limiteproduto` char(1) DEFAULT NULL,
  `observacaofrentecaixa` blob,
  `notareferenteobrigatoria` char(1) DEFAULT NULL,
  `liberaalteracaodadoscupom` char(1) DEFAULT NULL,
  `tipospagamentosliberados` varchar(15) DEFAULT NULL,
  `camposadicionaiscupom` varchar(15) DEFAULT NULL,
  `condicaopagamentovenda` int(11) DEFAULT NULL,
  `mensagemnotareferente` varchar(300) DEFAULT NULL,
  `mensagemcupomfiscal` varchar(300) DEFAULT NULL,
  `imagem` blob,
  `solicitarequisicao` char(1) DEFAULT NULL,
  `numero_classenegociacao` int(11) DEFAULT NULL,
  `bloqueado` char(1) DEFAULT NULL,
  `aceitavalemotorista` char(1) DEFAULT NULL,
  `dataultimavenda` date DEFAULT NULL,
  `codigoretaguarda` int(11) DEFAULT NULL,
  `bloqueioautomatico` char(6) DEFAULT NULL,
  `tipobloqueioantecipado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `condicaopagamento`
--

CREATE TABLE `condicaopagamento` (
  `sequencia` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `numeroparcelas` int(11) DEFAULT NULL,
  `diasprazo` int(11) DEFAULT NULL,
  `solicitavencimento` char(1) DEFAULT NULL,
  `vencimentofixo` int(11) DEFAULT NULL,
  `intervalovencimento` int(11) DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `primeiravista` char(1) DEFAULT NULL,
  `solicitavalores` char(1) DEFAULT NULL,
  `tipojuros` char(1) DEFAULT NULL,
  `valorjurosdiario` double DEFAULT NULL,
  `valorjurosmulta` double DEFAULT NULL,
  `assumecondicaocupom` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadosfaturamento`
--

CREATE TABLE `dadosfaturamento` (
  `sequencia` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `numero_empresacliente` int(11) DEFAULT NULL,
  `numero_cliente` int(11) DEFAULT NULL,
  `numero_empresaproduto` int(11) DEFAULT NULL,
  `numero_produto` int(11) DEFAULT NULL,
  `valorproduto` double DEFAULT NULL,
  `descontoacres` double DEFAULT NULL,
  `valordescontoacres` double DEFAULT NULL,
  `gerarcomissao` char(1) DEFAULT NULL,
  `datanegociacao` varchar(15) DEFAULT NULL,
  `fixodescontoacres` double DEFAULT NULL,
  `ultimanegociacao` varchar(15) DEFAULT NULL,
  `valornegociacao` double DEFAULT NULL,
  `tipo_grupo` char(1) DEFAULT NULL,
  `numero_condpgto` int(11) DEFAULT NULL,
  `valorunitario` double DEFAULT NULL,
  `quantidade` double DEFAULT NULL,
  `imprimirnotafiscal` char(1) DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `numero_empresafuncionario` int(11) DEFAULT NULL,
  `numero_funcionario` int(11) DEFAULT NULL,
  `numero_empresale` int(11) DEFAULT NULL,
  `numero_localestoque` int(11) DEFAULT NULL,
  `km` int(11) DEFAULT NULL,
  `motorista` varchar(20) DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `numeronota` int(11) DEFAULT NULL,
  `ecf` int(11) DEFAULT NULL,
  `emissao` varchar(15) DEFAULT NULL,
  `vencimento` varchar(15) DEFAULT NULL,
  `turno` int(11) DEFAULT NULL,
  `numeropedido` int(11) DEFAULT NULL,
  `descricao_produto` varchar(50) DEFAULT NULL,
  `indicenota` int(11) DEFAULT NULL,
  `hora` char(5) DEFAULT NULL,
  `numero_grupoproduto` int(11) DEFAULT NULL,
  `situacao` char(2) DEFAULT NULL,
  `id_caixa` int(11) DEFAULT NULL,
  `id_bomba` int(11) DEFAULT NULL,
  `recebido` char(1) DEFAULT NULL,
  `acesso_subconta` varchar(20) DEFAULT NULL,
  `tiponota` int(11) DEFAULT NULL,
  `numerorequisicao` int(11) DEFAULT NULL,
  `usuariocancelamento` varchar(20) DEFAULT NULL,
  `datacancelamento` varchar(15) DEFAULT NULL,
  `usuariolancamento` varchar(20) DEFAULT NULL,
  `datalancamento` varchar(15) DEFAULT NULL,
  `usuarioselecao` varchar(20) DEFAULT NULL,
  `nome_cliente` varchar(50) DEFAULT NULL,
  `valordesconto` double DEFAULT NULL,
  `valoracrescimo` double DEFAULT NULL,
  `cnpjcpfcliente` varchar(18) DEFAULT NULL,
  `enderecocliente` varchar(100) DEFAULT NULL,
  `valordescontocupom` double DEFAULT NULL,
  `valoracrescimocupom` double DEFAULT NULL,
  `valortotalcupom` double DEFAULT NULL,
  `motivocancelamento` blob,
  `id_veiculo` int(11) DEFAULT NULL,
  `id_motorista` int(11) DEFAULT NULL,
  `aliquota` double DEFAULT NULL,
  `codigo_st` char(6) DEFAULT NULL,
  `ccf` int(11) DEFAULT NULL,
  `ordemaplicacaodesconto` char(1) DEFAULT NULL,
  `iecliente` char(18) DEFAULT NULL,
  `serie` char(3) DEFAULT NULL,
  `subserie` char(3) DEFAULT NULL,
  `md5` varchar(128) DEFAULT NULL,
  `mediakm` double DEFAULT NULL,
  `numeronfref` int(11) DEFAULT NULL,
  `serienfref` char(3) DEFAULT NULL,
  `emissaonfref` varchar(15) DEFAULT NULL,
  `id_abastecimento` int(11) DEFAULT NULL,
  `sincro` char(1) DEFAULT NULL,
  `valortotaltributos` double DEFAULT NULL,
  `chv_cfe` char(44) DEFAULT NULL,
  `chv_cfecanc` char(44) DEFAULT NULL,
  `qcod` blob,
  `observacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `sequencia` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `inscricaoestadual` varchar(18) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `usuariocadastro` int(11) DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `datacadastro` date DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `tipopessoa` char(1) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `numero_funcao` int(11) DEFAULT NULL,
  `dataadmissao` date DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `numero_previsao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gruposprodutos`
--

CREATE TABLE `gruposprodutos` (
  `sequencia` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `codigo_st` char(5) DEFAULT NULL,
  `aliquota_icms` double DEFAULT NULL,
  `aliquota_ipi` double DEFAULT NULL,
  `aliquota_iss` double DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `calcula_pis` char(1) DEFAULT NULL,
  `calcula_cofins` char(1) DEFAULT NULL,
  `acesso_subconta` varchar(20) DEFAULT NULL,
  `sincro` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `qtde_registros` int(11) DEFAULT NULL,
  `qtde_inserts` int(11) DEFAULT NULL,
  `qtde_updates` int(11) DEFAULT NULL,
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
  `descricao` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencaocaixa`
--

CREATE TABLE `manutencaocaixa` (
  `sequencia` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `id_caixa` int(11) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `datalancamento` date DEFAULT NULL,
  `hora` char(5) DEFAULT NULL,
  `numero_funcionario` int(11) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `numero_empresa` int(11) DEFAULT NULL,
  `usuariolancamento` varchar(20) DEFAULT NULL,
  `usuarioexclusao` varchar(20) DEFAULT NULL,
  `dataexclusao` date DEFAULT NULL,
  `nome_funcionario` varchar(50) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `numerolinha` int(11) DEFAULT NULL,
  `classificacao` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
  `classificacao` varchar(50) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `parametro` varchar(20) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `porcentagem_grupo`
--

CREATE TABLE `porcentagem_grupo` (
  `id` int(11) NOT NULL,
  `grupo` varchar(50) DEFAULT NULL,
  `porcentagem` float DEFAULT NULL,
  `importacao_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `sequencia` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `codigobarras` varchar(20) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `nomefantasia` varchar(100) DEFAULT NULL,
  `unidade` varchar(6) DEFAULT NULL,
  `unidadeconversao` double DEFAULT NULL,
  `codigo_st` char(6) DEFAULT NULL,
  `codigo_grupoproduto` int(11) DEFAULT NULL,
  `codigo_produtosefaz` varchar(6) DEFAULT NULL,
  `codigo_tipoproduto` int(11) DEFAULT NULL,
  `codigo_nbmsh` varchar(8) DEFAULT NULL,
  `datacadastro` date DEFAULT NULL,
  `dataatualizacao` date DEFAULT NULL,
  `ultimavenda` date DEFAULT NULL,
  `aliquotaicms` double DEFAULT NULL,
  `aliquotaipi` double DEFAULT NULL,
  `aliquotaiss` double DEFAULT NULL,
  `estoque` double DEFAULT NULL,
  `estoqueregulador` double DEFAULT NULL,
  `precovenda` double DEFAULT NULL,
  `ultimocusto` double DEFAULT NULL,
  `precocompra` double DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `entradas` char(1) DEFAULT NULL,
  `saidas` char(1) DEFAULT NULL,
  `custoatual` double DEFAULT NULL,
  `datacustoatual` date DEFAULT NULL,
  `calculapis` char(1) DEFAULT NULL,
  `calculacofins` char(1) DEFAULT NULL,
  `alteracaogrupo` char(1) DEFAULT NULL,
  `codigofabricante` varchar(50) DEFAULT NULL,
  `ultimacompra` date DEFAULT NULL,
  `icmsoutros` double DEFAULT NULL,
  `acesso_contacredito` varchar(20) DEFAULT NULL,
  `acesso_contadebito` varchar(20) DEFAULT NULL,
  `tipoproduto` char(1) DEFAULT NULL,
  `bloquearvendaestoquezerado` char(1) DEFAULT NULL,
  `comissionado` char(1) DEFAULT NULL,
  `arredondamentotruncamento` char(1) DEFAULT NULL,
  `producaopropria` char(1) DEFAULT NULL,
  `codigoestendido` varchar(30) DEFAULT NULL,
  `codigotiposervico` char(8) DEFAULT NULL,
  `md5` varchar(128) DEFAULT NULL,
  `codigobarrasestendido` blob,
  `codigonaturezareceita` varchar(10) DEFAULT NULL,
  `codigoanp` varchar(30) DEFAULT NULL,
  `codigo_stentrada` char(6) DEFAULT NULL,
  `unidadeentrada` varchar(6) DEFAULT NULL,
  `codigo_sap` varchar(12) DEFAULT NULL,
  `sincro` char(1) DEFAULT NULL,
  `codigo_cest` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_empresa`
--

CREATE TABLE `produto_empresa` (
  `sequencia` int(11) NOT NULL,
  `numero_empresa` int(11) DEFAULT NULL,
  `codigo_produto` int(11) DEFAULT NULL,
  `codigopista` char(6) DEFAULT NULL,
  `codigosequencial` int(11) DEFAULT NULL,
  `aliquotaicms` double DEFAULT NULL,
  `aliquotaiss` double DEFAULT NULL,
  `vendafrentecaixa` char(1) DEFAULT NULL,
  `aliquotaicmsreduzida` double DEFAULT NULL,
  `codigoticket` varchar(30) DEFAULT NULL,
  `md5` varchar(128) DEFAULT NULL,
  `aliquotapis` double DEFAULT NULL,
  `aliquotacofins` double DEFAULT NULL,
  `cstpis` char(6) DEFAULT NULL,
  `cstcofins` char(6) DEFAULT NULL,
  `valorunitariobcicmsst` double DEFAULT NULL,
  `csosnentrada` char(6) DEFAULT NULL,
  `csosnsaida` char(6) DEFAULT NULL,
  `cstpisentrada` char(6) DEFAULT NULL,
  `cstcofinsentrada` char(6) DEFAULT NULL,
  `sincro` char(1) DEFAULT NULL,
  `mvast` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacoestributarias`
--

CREATE TABLE `situacoestributarias` (
  `sequencia` int(11) NOT NULL,
  `codigo` char(6) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `sincro` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tanque`
--

CREATE TABLE `tanque` (
  `sequencia` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `capacidade` double DEFAULT NULL,
  `volumeatual` double DEFAULT NULL,
  `numero_produto` int(11) DEFAULT NULL,
  `numero_empresa` int(11) DEFAULT NULL,
  `id_sincro` int(11) DEFAULT NULL,
  `sincro` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposprodutos`
--

CREATE TABLE `tiposprodutos` (
  `sequencia` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `excluido` char(1) DEFAULT NULL,
  `entradas` char(1) DEFAULT NULL,
  `saidas` char(1) DEFAULT NULL,
  `acesso_subconta` varchar(20) DEFAULT NULL,
  `sincro` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `feito` varchar(1) NOT NULL DEFAULT 'N',
  `excluido` varchar(1) NOT NULL DEFAULT 'N',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abastecimentos`
--
ALTER TABLE `abastecimentos`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_ABASTECIMENTOS_id` (`id`),
  ADD KEY `id_caixa` (`id_caixa`);

--
-- Indexes for table `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_sequencia_BANCOS` (`sequencia`),
  ADD KEY `idx_BANCOS_numero` (`numero`);

--
-- Indexes for table `bomba`
--
ALTER TABLE `bomba`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_BOMBA_id` (`id`),
  ADD KEY `idx_BOMBA_numero_empresa` (`numero_empresa`);

--
-- Indexes for table `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_sequencia_CAIXA` (`sequencia`),
  ADD KEY `idx_CAIXA_id` (`id`),
  ADD KEY `idx_CAIXA_numero_empresa` (`numero_empresa`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_sequencia_CLIENTES` (`sequencia`),
  ADD KEY `idx_CLIENTES_numero` (`numero`);

--
-- Indexes for table `condicaopagamento`
--
ALTER TABLE `condicaopagamento`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_sequencia_CONDICAOPAGAMENTO` (`sequencia`),
  ADD KEY `idx_CONDICAOPAGAMENTO_codigo` (`codigo`);

--
-- Indexes for table `dadosfaturamento`
--
ALTER TABLE `dadosfaturamento`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_ID_CAIXA` (`id_caixa`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_sequencia_FUNCIONARIOS` (`sequencia`),
  ADD KEY `idx_FUNCIONARIOS_numero` (`numero`);

--
-- Indexes for table `gruposprodutos`
--
ALTER TABLE `gruposprodutos`
  ADD PRIMARY KEY (`sequencia`);

--
-- Indexes for table `importacoes`
--
ALTER TABLE `importacoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manutencaocaixa`
--
ALTER TABLE `manutencaocaixa`
  ADD PRIMARY KEY (`sequencia`),
  ADD KEY `idx_sequencia_MANUTENCAOCAIXA` (`sequencia`),
  ADD KEY `idx_MANUTENCAOCAIXA_id` (`id`),
  ADD KEY `idx_MANUTENCAOCAIXA_id_caixa` (`id_caixa`),
  ADD KEY `idx_MANUTENCAOCAIXA_numero_empresa` (`numero_empresa`);

--
-- Indexes for table `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `porcentagem_grupo`
--
ALTER TABLE `porcentagem_grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`sequencia`);

--
-- Indexes for table `produto_empresa`
--
ALTER TABLE `produto_empresa`
  ADD PRIMARY KEY (`sequencia`);

--
-- Indexes for table `situacoestributarias`
--
ALTER TABLE `situacoestributarias`
  ADD PRIMARY KEY (`sequencia`);

--
-- Indexes for table `tanque`
--
ALTER TABLE `tanque`
  ADD PRIMARY KEY (`sequencia`);

--
-- Indexes for table `tiposprodutos`
--
ALTER TABLE `tiposprodutos`
  ADD PRIMARY KEY (`sequencia`);

--
-- Indexes for table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abastecimentos`
--
ALTER TABLE `abastecimentos`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84722;
--
-- AUTO_INCREMENT for table `bancos`
--
ALTER TABLE `bancos`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bomba`
--
ALTER TABLE `bomba`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `caixa`
--
ALTER TABLE `caixa`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=529;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `condicaopagamento`
--
ALTER TABLE `condicaopagamento`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `dadosfaturamento`
--
ALTER TABLE `dadosfaturamento`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92297;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `gruposprodutos`
--
ALTER TABLE `gruposprodutos`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `importacoes`
--
ALTER TABLE `importacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `manutencaocaixa`
--
ALTER TABLE `manutencaocaixa`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2299;
--
-- AUTO_INCREMENT for table `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `porcentagem_grupo`
--
ALTER TABLE `porcentagem_grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;
--
-- AUTO_INCREMENT for table `produto_empresa`
--
ALTER TABLE `produto_empresa`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;
--
-- AUTO_INCREMENT for table `situacoestributarias`
--
ALTER TABLE `situacoestributarias`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tanque`
--
ALTER TABLE `tanque`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tiposprodutos`
--
ALTER TABLE `tiposprodutos`
  MODIFY `sequencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
