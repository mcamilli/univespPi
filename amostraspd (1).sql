-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Set-2021 às 21:35
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `amostraspd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `CodAdmin` int(11) NOT NULL,
  `RazaoSocialAdm` varchar(100) NOT NULL,
  `NomeFantasiaAdm` varchar(100) DEFAULT NULL,
  `CNPjAdm` varchar(16) NOT NULL,
  `EmailAdm` varchar(100) NOT NULL,
  `TelefoneAdm` varchar(16) NOT NULL,
  `SiglaAdm` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`CodAdmin`, `RazaoSocialAdm`, `NomeFantasiaAdm`, `CNPjAdm`, `EmailAdm`, `TelefoneAdm`, `SiglaAdm`) VALUES
(1, 'Leonardo Nazario de Moraes LTDA', 'Leonardo N Moraes', '01680058170', 'empresa@empresa.com', '14981334222', 'LNM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `amostra`
--

CREATE TABLE `amostra` (
  `CodAmostra` int(11) NOT NULL,
  `NomeAmostra` varchar(100) NOT NULL,
  `LoteProduto` varchar(40) DEFAULT NULL,
  `DataFabricacao` date DEFAULT NULL,
  `PrincipioAtivo` varchar(100) DEFAULT NULL,
  `FormCentesimal` varchar(40) DEFAULT NULL,
  `ConcetracaoAtivo` varchar(40) DEFAULT NULL,
  `QtdAmostra` varchar(40) DEFAULT NULL,
  `Armazenamento` varchar(100) DEFAULT NULL,
  `ResponsavelEnvio` varchar(100) DEFAULT NULL,
  `ObsAmostra` varchar(255) DEFAULT NULL,
  `DataCadastro` datetime DEFAULT NULL,
  `DataRecebido` datetime DEFAULT NULL,
  `CodCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `amostra`
--

INSERT INTO `amostra` (`CodAmostra`, `NomeAmostra`, `LoteProduto`, `DataFabricacao`, `PrincipioAtivo`, `FormCentesimal`, `ConcetracaoAtivo`, `QtdAmostra`, `Armazenamento`, `ResponsavelEnvio`, `ObsAmostra`, `DataCadastro`, `DataRecebido`, `CodCliente`) VALUES
(9, 'Amostra de tecido tratada com nano partículas de prata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(19, 'plastico tratado como prata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(20, 'Detergente virucida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(21, 'Sabonete antibacteriano amônia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(22, 'Sistema de ar com tratamento virucida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(23, 'Tecido virucida 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(24, 'Amostra tecido virucida 5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(25, 'Copo virucida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `CodCliente` int(11) NOT NULL,
  `RazaoSocial` varchar(100) NOT NULL,
  `NomeFantasia` varchar(100) DEFAULT NULL,
  `CNPj` varchar(16) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Endereco` varchar(100) DEFAULT NULL,
  `Numero` varchar(16) DEFAULT NULL,
  `Cidade` varchar(40) DEFAULT NULL,
  `Estado` varchar(40) DEFAULT NULL,
  `Pais` varchar(40) DEFAULT NULL,
  `CEP` varchar(16) DEFAULT NULL,
  `Telefone1` varchar(16) DEFAULT NULL,
  `Telefone2` varchar(16) DEFAULT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Senha` varchar(32) NOT NULL,
  `Observacao` varchar(255) DEFAULT NULL,
  `DataCadastro` date DEFAULT NULL,
  `CodAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`CodCliente`, `RazaoSocial`, `NomeFantasia`, `CNPj`, `Email`, `Endereco`, `Numero`, `Cidade`, `Estado`, `Pais`, `CEP`, `Telefone1`, `Telefone2`, `Usuario`, `Senha`, `Observacao`, `DataCadastro`, `CodAdmin`) VALUES
(2, 'THERMO FISHER SCIENTIFIC BRASIL INSTRUMENTOS DE PROCESSO LTDA', 'Thermo Fisher', '9287895000161', 'thermo.fisher@thermo.com', 'Rua das Tulipas', '33', 'São Paulo', 'São Paulo', 'Brasil', '5346000', '14981334222', '14981334222', 'thermo.fisher', 'e10adc3949ba59abbe56e057f20f883e', 'solicita sempre testes', '2021-09-19', 1),
(3, 'PROMEGA BIOTECNOLOGIA DO BRASIL LTDA', 'PROMEGA', '11302982829', 'promega.biotec@promega.com', 'Rua carajas', '23', 'Rio de Janeiro', 'Rio de Janeiro', 'Brasil', '1306400', '14981334255', '14981334266', 'promega.biotec', 'e10adc3949ba59abbe56e057f20f883e', 'biotec', '2021-09-23', 1),
(5, 'Sigma Aldrich LTDA', 'Sigma', '12349876', 'sigma.aldrich@sigma.com', 'Av. Marechal Rondom', '234', 'Botucatu', 'SP', 'Brasil', '18609-500', '14981334222', '', 'sigma.aldrich', 'e10adc3949ba59abbe56e057f20f883e', 'vendas', '2024-09-21', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecoadm`
--

CREATE TABLE `enderecoadm` (
  `CodEndereco` int(11) NOT NULL,
  `NomeEnderecoAdm` varchar(20) NOT NULL,
  `TipoEnderecoAdm` varchar(8) NOT NULL,
  `EnderecoAdm1` varchar(100) NOT NULL,
  `EnderecoAdm2` varchar(100) DEFAULT NULL,
  `NumeroAdm` varchar(10) NOT NULL,
  `CidadeAdm` varchar(40) NOT NULL,
  `EstadoAdm` varchar(40) NOT NULL,
  `PaisAdm` varchar(40) NOT NULL,
  `CepAdm` varchar(16) NOT NULL,
  `CodAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `enderecoadm`
--

INSERT INTO `enderecoadm` (`CodEndereco`, `NomeEnderecoAdm`, `TipoEnderecoAdm`, `EnderecoAdm1`, `EnderecoAdm2`, `NumeroAdm`, `CidadeAdm`, `EstadoAdm`, `PaisAdm`, `CepAdm`, `CodAdmin`) VALUES
(1, 'Hospital', 'Entrega', 'Rua Manoel da Silva', 'ao lado zilo gas', '53', 'Botucatu', 'São Paulo', 'Brasil', '18609500', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `exame`
--

CREATE TABLE `exame` (
  `CodExame` int(11) NOT NULL,
  `NumeroContrato` varchar(10) NOT NULL,
  `Concentracao` varchar(20) DEFAULT NULL,
  `TempoExposicao` varchar(50) DEFAULT NULL,
  `ExameFinalizado` datetime DEFAULT NULL,
  `ExameIniciado` datetime DEFAULT NULL,
  `Observacao` varchar(255) DEFAULT NULL,
  `CodAmostra` int(11) NOT NULL,
  `CodMetodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `exame`
--

INSERT INTO `exame` (`CodExame`, `NumeroContrato`, `Concentracao`, `TempoExposicao`, `ExameFinalizado`, `ExameIniciado`, `Observacao`, `CodAmostra`, `CodMetodo`) VALUES
(4, '1232_21', '20mg/mL', '30 minutos', '2021-09-27 15:06:44', '2021-09-27 15:05:25', 'Triplicata', 20, 29),
(5, '234_21', '50mg/mL', '50 min', '2021-09-27 15:06:55', '2021-09-27 15:06:11', 'realizar em triplicata', 21, 29),
(6, '1232_21', '10mg/mL', '20 min', NULL, NULL, '', 22, 29),
(7, '1012_21', '10mg/mL', '20 min', NULL, NULL, 'obs', 23, 28),
(8, '324524', '10mg/mL', '50 min', '2021-09-27 19:37:48', '2021-09-27 19:37:30', 'observação', 24, 28),
(9, 'dfasds', '20mg/mL', '30 minutos', NULL, '2021-09-28 11:54:52', 'obs', 25, 29);

-- --------------------------------------------------------

--
-- Estrutura da tabela `metodo`
--

CREATE TABLE `metodo` (
  `CodMetodo` int(11) NOT NULL,
  `NomeMet` varchar(255) NOT NULL,
  `ObsMet` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `metodo`
--

INSERT INTO `metodo` (`CodMetodo`, `NomeMet`, `ObsMet`) VALUES
(28, 'Textil - Determination of antiviral activity of textile products - ISO 18184', 'metodo iso 18184'),
(29, 'Measurement of antiviral activity on plastics and other non-porous surfaces - ISO 21702', 'Metodo iso 21702');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarioadm`
--

CREATE TABLE `usuarioadm` (
  `CodLogin` int(11) NOT NULL,
  `NomeU` varchar(100) NOT NULL,
  `Cpf` char(11) NOT NULL,
  `EmailU` varchar(100) NOT NULL,
  `SenhaU` varchar(32) NOT NULL,
  `Permissao` int(11) NOT NULL,
  `CodAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarioadm`
--

INSERT INTO `usuarioadm` (`CodLogin`, `NomeU`, `Cpf`, `EmailU`, `SenhaU`, `Permissao`, `CodAdmin`) VALUES
(1, 'Leonardo Nazario de Moraes', '', 'leonardo.nazario@unesp.br', 'e10adc3949ba59abbe56e057f20f883e', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`CodAdmin`);

--
-- Índices para tabela `amostra`
--
ALTER TABLE `amostra`
  ADD PRIMARY KEY (`CodAmostra`),
  ADD KEY `CodCliente` (`CodCliente`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CodCliente`),
  ADD KEY `CodAdmin` (`CodAdmin`);

--
-- Índices para tabela `enderecoadm`
--
ALTER TABLE `enderecoadm`
  ADD PRIMARY KEY (`CodEndereco`),
  ADD KEY `CodAdmin` (`CodAdmin`);

--
-- Índices para tabela `exame`
--
ALTER TABLE `exame`
  ADD PRIMARY KEY (`CodExame`),
  ADD KEY `CodAmostra` (`CodAmostra`),
  ADD KEY `CodMetodo` (`CodMetodo`);

--
-- Índices para tabela `metodo`
--
ALTER TABLE `metodo`
  ADD PRIMARY KEY (`CodMetodo`);

--
-- Índices para tabela `usuarioadm`
--
ALTER TABLE `usuarioadm`
  ADD PRIMARY KEY (`CodLogin`),
  ADD KEY `CodAdmin` (`CodAdmin`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `CodAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `amostra`
--
ALTER TABLE `amostra`
  MODIFY `CodAmostra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `CodCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `enderecoadm`
--
ALTER TABLE `enderecoadm`
  MODIFY `CodEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `exame`
--
ALTER TABLE `exame`
  MODIFY `CodExame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `metodo`
--
ALTER TABLE `metodo`
  MODIFY `CodMetodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `usuarioadm`
--
ALTER TABLE `usuarioadm`
  MODIFY `CodLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `amostra`
--
ALTER TABLE `amostra`
  ADD CONSTRAINT `amostra_ibfk_1` FOREIGN KEY (`CodCliente`) REFERENCES `cliente` (`CodCliente`);

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`CodAdmin`) REFERENCES `administrador` (`CodAdmin`);

--
-- Limitadores para a tabela `enderecoadm`
--
ALTER TABLE `enderecoadm`
  ADD CONSTRAINT `enderecoadm_ibfk_1` FOREIGN KEY (`CodAdmin`) REFERENCES `administrador` (`CodAdmin`);

--
-- Limitadores para a tabela `exame`
--
ALTER TABLE `exame`
  ADD CONSTRAINT `exame_ibfk_1` FOREIGN KEY (`CodAmostra`) REFERENCES `amostra` (`CodAmostra`),
  ADD CONSTRAINT `exame_ibfk_2` FOREIGN KEY (`CodMetodo`) REFERENCES `metodo` (`CodMetodo`);

--
-- Limitadores para a tabela `usuarioadm`
--
ALTER TABLE `usuarioadm`
  ADD CONSTRAINT `usuarioadm_ibfk_1` FOREIGN KEY (`CodAdmin`) REFERENCES `administrador` (`CodAdmin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
