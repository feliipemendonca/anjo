-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 23-Dez-2018 às 13:16
-- Versão do servidor: 10.2.17-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u305588326_facil`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_aluno`
--

CREATE TABLE `tb_aluno` (
  `idtb_aluno` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `orgao` varchar(45) DEFAULT NULL,
  `profissao` varchar(100) DEFAULT NULL,
  `tipo_sangue` varchar(45) DEFAULT NULL,
  `data` varchar(10) DEFAULT NULL,
  `data_cadastro` varchar(45) DEFAULT NULL,
  `tb_curso_idtb_curso` int(11) DEFAULT NULL,
  `tb_sexo_idtb_sexo` int(11) NOT NULL,
  `tb_escolaridade_idtb_escolaridade` int(11) NOT NULL,
  `tb_contato_idtb_contato` int(11) NOT NULL,
  `tb_login_idtb_login` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_aluno`
--

INSERT INTO `tb_aluno` (`idtb_aluno`, `nome`, `cpf`, `rg`, `orgao`, `profissao`, `tipo_sangue`, `data`, `data_cadastro`, `tb_curso_idtb_curso`, `tb_sexo_idtb_sexo`, `tb_escolaridade_idtb_escolaridade`, `tb_contato_idtb_contato`, `tb_login_idtb_login`) VALUES
(1, 'Aluno de teste', '111.111.111-11', '111.111.111', 'itep', 'Profissão de teste', 'a+', '01-12-18', '25-08-18', 1, 1, 4, 2, 3),
(2, 'Aluno de teste Aluno', '222.222.222-22', '222.222.222', 'iter', 'Naos tenho', 'a+', '13-08-18', '25-08-18', 1, 1, 6, 3, 4),
(3, 'jose felipe silva de mendonca', '104.343.844-02', '002.612.396', 'itep', 'Programdor', '', '29-08-94', '25-08-18', 1, 1, 7, 4, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_biblioteca`
--

CREATE TABLE `tb_biblioteca` (
  `id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `arquivo` varchar(250) NOT NULL,
  `dt_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_contato`
--

CREATE TABLE `tb_contato` (
  `idtb_contato` int(11) NOT NULL,
  `telefone1` varchar(45) DEFAULT NULL,
  `telefone2` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_contato`
--

INSERT INTO `tb_contato` (`idtb_contato`, `telefone1`, `telefone2`) VALUES
(1, '(11) 1 1111-1111', '(11) 1111-1111'),
(2, '(22) 9 2222-2222', '(22) 2222-2222'),
(3, '(33) 9 3333-3333', '(33) 3333-3333'),
(4, '(84) 9 9919-5634', ''),
(5, '(99) 8 6889-8685', '(89) 8984-9797'),
(6, '84999195634', '(98) 9898-9898');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_contato_empresa`
--

CREATE TABLE `tb_contato_empresa` (
  `idtb_contato_empresa` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `responsavel` varchar(45) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `vaga` varchar(45) DEFAULT NULL,
  `mensagem` varchar(45) DEFAULT NULL,
  `tb_contato_idtb_contato` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curso`
--

CREATE TABLE `tb_curso` (
  `idtb_curso` int(11) NOT NULL,
  `curso` varchar(60) NOT NULL,
  `sobre` varchar(1000) NOT NULL,
  `alvo` varchar(500) NOT NULL,
  `carga` varchar(45) NOT NULL,
  `mercado` varchar(1000) NOT NULL,
  `valor` varchar(45) NOT NULL,
  `img` varchar(45) DEFAULT NULL,
  `ativa` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_curso`
--

INSERT INTO `tb_curso` (`idtb_curso`, `curso`, `sobre`, `alvo`, `carga`, `mercado`, `valor`, `img`, `ativa`) VALUES
(1, 'Curso de teste', 'sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cu', 'Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste ', '45', 'Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho, Mercado de trabalho', '452,23', 'a327e3cf5984f3800405e908edd0e3dd.jpg', 1),
(2, 'Curso de tests 09', 'sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cu', 'Publy', '665', 'Xnxjxnxkxodkdkdossk jdjdjf jcjdjcjc', '599,98', '69d74e0e64ec6f61bd143c2257fc82d8.png', 1),
(8, 'curso de teste5265628629', 'sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cu', 'Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste ', '45', 'Publico de teste Publico de teste Publico de teste Publico de teste Publico Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de tde teste Publico de teste Publico de teste Publico de teste ', '452,23', 'fd8994aa4a34c45b1ca2a32be7883764.jpg', 1),
(6, 'Curso de teste 565', 'sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cu', 'Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste ', '45', 'Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de t', '452,23', '6efe88e364925b709e6493332f868d7c.jpg', 1),
(7, 'curso de teste 65556562', 'sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cusobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o curso, sobre o cu', 'Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste ', '45', 'Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de teste Publico de t', '452,23', 'ca4c2896a0e1cc201068d1651020eff1.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dado_adm`
--

CREATE TABLE `tb_dado_adm` (
  `idtb_dado_adm` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `tb_login_idtb_login` int(11) DEFAULT NULL,
  `tb_contato_idtb_contato` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_depoimento`
--

CREATE TABLE `tb_depoimento` (
  `idtb_depoimento` int(11) NOT NULL,
  `depoimento` varchar(250) DEFAULT NULL,
  `tb_aluno_idtb_aluno` int(11) NOT NULL,
  `tb_aluno_tb_curso_idtb_curso` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dia_letivo`
--

CREATE TABLE `tb_dia_letivo` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_endereco`
--

CREATE TABLE `tb_endereco` (
  `idtb_endereco` int(11) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `tb_aluno_idtb_aluno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_endereco`
--

INSERT INTO `tb_endereco` (`idtb_endereco`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `estado`, `tb_aluno_idtb_aluno`) VALUES
(1, '59173-000', 'Endereço de teste', '123', 'bairro de teste', 'cidade de teste', 'es', 1),
(2, '59173-000', 'rua maria felix barbosa', '144', 'novo paraiso', 'goianinha', 'ri', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_escolaridade`
--

CREATE TABLE `tb_escolaridade` (
  `idtb_escolaridade` int(11) NOT NULL,
  `nivel` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_escolaridade`
--

INSERT INTO `tb_escolaridade` (`idtb_escolaridade`, `nivel`) VALUES
(1, 'Ensino Fudamental Cursando'),
(2, 'Ensino Fundamental Completo'),
(3, 'Ensino Fundamental Incompleto'),
(4, 'Ensino Medio Cursando'),
(5, 'Ensino Medio Incompleto'),
(6, 'Ensino Medio Completo'),
(7, 'Ensino Superior Cursando'),
(8, 'Ensino Superior Incompleto'),
(9, 'Ensino Superior Completo'),
(10, 'Pos Graduado'),
(11, 'Cursando Pos Graducao'),
(12, 'Mestrado'),
(13, 'Cursando Mestrado'),
(14, 'Cursando Tecnico'),
(15, 'Tecnico Completo'),
(16, 'Tecnico Incompleto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_galeria`
--

CREATE TABLE `tb_galeria` (
  `idtb_galeria` int(11) NOT NULL,
  `img` varchar(45) NOT NULL,
  `tb_curso_idtb_curso` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_gp_biblioteca`
--

CREATE TABLE `tb_gp_biblioteca` (
  `id` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` varchar(480) DEFAULT NULL,
  `pasta` varchar(50) DEFAULT NULL,
  `icone` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_login`
--

CREATE TABLE `tb_login` (
  `idtb_login` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `tipo` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_login`
--

INSERT INTO `tb_login` (`idtb_login`, `email`, `senha`, `tipo`) VALUES
(1, 'adm@adm.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1),
(2, 'prof@prof.com', 'adcd7048512e64b48da55b027577886ee5a36350', 2),
(3, 'aluno@aluno.com', 'adcd7048512e64b48da55b027577886ee5a36350', 3),
(4, 'aluno@aluno.com.br', 'adcd7048512e64b48da55b027577886ee5a36350', 3),
(5, 'felipe.programer@gmail.com', 'de4e71862b5af76f79d1e6713b36002e2be3f916', 3),
(6, 'p@p.br', 'adcd7048512e64b48da55b027577886ee5a36350', 2),
(7, 'programer@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_material`
--

CREATE TABLE `tb_material` (
  `idtb_material` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `tb_curso_idtb_curso` int(11) NOT NULL,
  `tb_professor_idtb_professor` int(11) NOT NULL,
  `tb_turma_idtb_turma` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_modulo`
--

CREATE TABLE `tb_modulo` (
  `idtb_modulo` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `carga` varchar(45) DEFAULT NULL,
  `tb_curso_idtb_curso` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_msg`
--

CREATE TABLE `tb_msg` (
  `idtb_msg` int(11) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `contato` varchar(45) NOT NULL,
  `data` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_msg`
--

INSERT INTO `tb_msg` (`idtb_msg`, `msg`, `nome`, `contato`, `data`) VALUES
(1, 'mensagem de contato', 'nome De contato', 'contato@contato.com', '13-10-18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_notas`
--

CREATE TABLE `tb_notas` (
  `id` int(11) NOT NULL,
  `id_turma_aluno` int(11) NOT NULL,
  `nota1` float(4,2) DEFAULT NULL,
  `envio_nota1` date DEFAULT NULL,
  `nota2` float(4,2) DEFAULT NULL,
  `envio_nota2` date DEFAULT NULL,
  `nota3` float(4,2) DEFAULT NULL,
  `envio_nota3` date DEFAULT NULL,
  `nota4` float(4,2) DEFAULT NULL,
  `envio_nota4` date DEFAULT NULL,
  `nota5` float(3,2) DEFAULT NULL,
  `envio_nota5` date DEFAULT NULL,
  `nota6` float(3,2) DEFAULT NULL,
  `envio_nota6` date DEFAULT NULL,
  `nota7` float(3,2) DEFAULT NULL,
  `envio_nota7` date DEFAULT NULL,
  `nota8` float(3,2) DEFAULT NULL,
  `envio_nota8` date DEFAULT NULL,
  `nota9` float(3,2) DEFAULT NULL,
  `envio_nota9` date DEFAULT NULL,
  `nota10` float(3,2) DEFAULT NULL,
  `envio_nota10` date DEFAULT NULL,
  `nota11` float(3,2) DEFAULT NULL,
  `envio_nota11` date DEFAULT NULL,
  `nota12` float(3,2) DEFAULT NULL,
  `envio_nota12` date DEFAULT NULL,
  `nota13` float(3,2) DEFAULT NULL,
  `envio_nota13` date DEFAULT NULL,
  `nota14` float(3,2) DEFAULT NULL,
  `envio_nota14` date DEFAULT NULL,
  `nota15` float(3,2) DEFAULT NULL,
  `envio_nota15` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pagamento`
--

CREATE TABLE `tb_pagamento` (
  `idtb_pagamento` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_pagamento`
--

INSERT INTO `tb_pagamento` (`idtb_pagamento`, `status`, `descricao`) VALUES
(1, 'Aguardando Pagamento', 'o comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma informação sobre o pagamento.'),
(2, 'Pagamento em Analise', 'o comprador optou por pagar com um cartão de crédito e o PagSeguro está analisando o risco da transação.'),
(3, 'Pagamento Aprovado', ' a transação foi paga pelo comprador e o PagSeguro já recebeu uma confirmação da instituição financeira responsável pelo processamento.'),
(4, 'Disponivel', 'a transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.'),
(5, 'Em disputa', 'o comprador, dentro do prazo de liberação da transação, abriu uma disputa'),
(6, 'Devolvida', 'o valor da transação foi devolvido para o comprador'),
(7, 'Cancelada', 'a transação foi cancelada sem ter sido finalizada.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_presenca`
--

CREATE TABLE `tb_presenca` (
  `id` int(11) NOT NULL,
  `id_data` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `alunos_id` varchar(680) NOT NULL,
  `presencas` varchar(380) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_professor`
--

CREATE TABLE `tb_professor` (
  `idtb_professor` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `formacao` varchar(45) DEFAULT NULL,
  `instituicao` varchar(45) DEFAULT NULL,
  `ano` varchar(45) DEFAULT NULL,
  `sobre` varchar(1000) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `tb_contato_idtb_contato` int(11) NOT NULL,
  `tb_login_idtb_login` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_professor`
--

INSERT INTO `tb_professor` (`idtb_professor`, `nome`, `rg`, `cpf`, `formacao`, `instituicao`, `ano`, `sobre`, `img`, `tb_contato_idtb_contato`, `tb_login_idtb_login`) VALUES
(1, 'Professor de teste', '111.111.111', '111.111.111-11', NULL, NULL, NULL, NULL, NULL, 1, 2),
(2, 'Professor Alfredo', '866.689.064', '689.898.896-46', NULL, NULL, NULL, NULL, NULL, 5, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_renova`
--

CREATE TABLE `tb_renova` (
  `idtb_renova` int(11) NOT NULL,
  `data` varchar(45) DEFAULT NULL,
  `tb_aluno_idtb_aluno` int(11) NOT NULL,
  `tb_curso_idtb_curso` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_requisito`
--

CREATE TABLE `tb_requisito` (
  `idtb_requisito` int(11) NOT NULL,
  `requisito` varchar(250) NOT NULL,
  `tb_curso_idtb_curso` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_requisito`
--

INSERT INTO `tb_requisito` (`idtb_requisito`, `requisito`, `tb_curso_idtb_curso`) VALUES
(2, 'fdskjf ldsjf ldsjfkdsjfÃ§ lsdjfld fjsdlfjdslfdfj mdljfdsjfldjflds; djf sdjflsdjflÃ§dfdskjf ldsjf ldsjfkdsjfÃ§ lsdjfld fjsdlfjdslfdfj mdljfdsjfldjflds; djf sdjflsdjflÃ§dfdskjf ldsjf ldsjfkdsjfÃ§ lsdjfld fjsdlfjdslfdfj mdljfdsjfldjflds; djf sdjflsdjflÃ', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_servico`
--

CREATE TABLE `tb_servico` (
  `idtb_servico` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_servico`
--

INSERT INTO `tb_servico` (`idtb_servico`, `nome`, `descricao`, `img`) VALUES
(3, 'Professor de teste', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute i Lorem ', 'bdba32962d359f6daf1953e3828ba025.png'),
(4, 'Alunod ete', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute i Lorem ', '9ae08c42d65cfe8a77de6769ced82bdb.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sexo`
--

CREATE TABLE `tb_sexo` (
  `idtb_sexo` int(11) NOT NULL,
  `sexo` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_sexo`
--

INSERT INTO `tb_sexo` (`idtb_sexo`, `sexo`) VALUES
(1, 'masculino'),
(2, 'feminino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_solicitacao`
--

CREATE TABLE `tb_solicitacao` (
  `idtb_solicitacao` int(11) NOT NULL,
  `contato` varchar(20) NOT NULL,
  `servico` varchar(45) NOT NULL,
  `empresa` varchar(45) NOT NULL,
  `cnpj` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mensagem` varchar(500) NOT NULL,
  `cargo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_solicitacao`
--

INSERT INTO `tb_solicitacao` (`idtb_solicitacao`, `contato`, `servico`, `empresa`, `cnpj`, `nome`, `email`, `mensagem`, `cargo`) VALUES
(1, '(84) 1 1111-1111', 'Curso de teste', 'Emprese de Teste', '11.111.111/1111-11', 'Resposável de Teste', 'email@teste.com', 'Olá, desejo investir em minha empresa com o curso: Curso de teste: Curso de teste', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_transacao`
--

CREATE TABLE `tb_transacao` (
  `idtb_transacao` int(11) NOT NULL,
  `codigo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idtb_aluno` int(11) DEFAULT NULL,
  `data` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_transacao`
--

INSERT INTO `tb_transacao` (`idtb_transacao`, `codigo`, `status`, `idtb_aluno`, `data`) VALUES
(1, NULL, '2', 1, '2018201820182018-AugAug-SatSatUTC0202:0808:01'),
(2, NULL, '1', 3, '2018201820182018-AugAug-SatSatUTC0303:0808:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_turma`
--

CREATE TABLE `tb_turma` (
  `idtb_turma` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `data` varchar(45) DEFAULT NULL,
  `vagas` varchar(45) DEFAULT NULL,
  `ativa` varchar(45) DEFAULT NULL,
  `dia` varchar(45) DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `tb_curso_idtb_curso` int(11) NOT NULL,
  `tb_professor_idtb_professor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_turma`
--

INSERT INTO `tb_turma` (`idtb_turma`, `nome`, `cep`, `endereco`, `bairro`, `numero`, `cidade`, `complemento`, `data`, `vagas`, `ativa`, `dia`, `hora`, `tb_curso_idtb_curso`, `tb_professor_idtb_professor`) VALUES
(4, 'Curso de teste', '59173-000', 'EndereÃ§o de teste', 'ljsldkjflsdkfj', '22222', 'cidade de teste', '', '10-10-2018', '2', '1', 'Segundas e terÃ§as', '18h as 19h', 1, 1),
(3, 'Curso de teste 45', '59173-000', 'rua maria felix barbosa', 'NÃ£o sei', '95634', 'goianinha', '', '10-10-2018', '2', '1', 'Segundas e terÃ§as', '18h as 19h', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_turma_aluno`
--

CREATE TABLE `tb_turma_aluno` (
  `idtb_turma_aluno` int(11) NOT NULL,
  `tb_aluno_idtb_aluno` int(11) NOT NULL,
  `tb_turma_idtb_turma` int(11) NOT NULL,
  `tb_curso_idtb_curso` int(11) NOT NULL,
  `tb_pagamento_idtb_pagamento` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_turma_aluno`
--

INSERT INTO `tb_turma_aluno` (`idtb_turma_aluno`, `tb_aluno_idtb_aluno`, `tb_turma_idtb_turma`, `tb_curso_idtb_curso`, `tb_pagamento_idtb_pagamento`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 1, 1, 3),
(3, 3, 1, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aluno`
--
ALTER TABLE `tb_aluno`
  ADD PRIMARY KEY (`idtb_aluno`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `rg` (`rg`),
  ADD KEY `fk_tb_aluno_tb_sexo1_idx` (`tb_sexo_idtb_sexo`),
  ADD KEY `fk_tb_aluno_tb_escolaridade1_idx` (`tb_escolaridade_idtb_escolaridade`),
  ADD KEY `fk_tb_aluno_tb_contato1_idx` (`tb_contato_idtb_contato`),
  ADD KEY `fk_tb_aluno_tb_login1_idx` (`tb_login_idtb_login`),
  ADD KEY `tb_aluno_tb_curso` (`tb_curso_idtb_curso`);

--
-- Indexes for table `tb_biblioteca`
--
ALTER TABLE `tb_biblioteca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `arquivo` (`arquivo`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `arquivo_2` (`arquivo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indexes for table `tb_contato`
--
ALTER TABLE `tb_contato`
  ADD PRIMARY KEY (`idtb_contato`),
  ADD UNIQUE KEY `telefone1` (`telefone1`);

--
-- Indexes for table `tb_contato_empresa`
--
ALTER TABLE `tb_contato_empresa`
  ADD PRIMARY KEY (`idtb_contato_empresa`,`tb_contato_idtb_contato`),
  ADD KEY `fk_tb_contato_empresa_tb_contato1_idx` (`tb_contato_idtb_contato`);

--
-- Indexes for table `tb_curso`
--
ALTER TABLE `tb_curso`
  ADD PRIMARY KEY (`idtb_curso`);

--
-- Indexes for table `tb_dado_adm`
--
ALTER TABLE `tb_dado_adm`
  ADD PRIMARY KEY (`idtb_dado_adm`),
  ADD KEY `fk_tb_dado_adm_tb_adm1` (`tb_login_idtb_login`),
  ADD KEY `fk_tb_dado_adm_tb_contato1` (`tb_contato_idtb_contato`);

--
-- Indexes for table `tb_depoimento`
--
ALTER TABLE `tb_depoimento`
  ADD PRIMARY KEY (`idtb_depoimento`),
  ADD KEY `fk_tb_depoimento_tb_aluno1` (`tb_aluno_idtb_aluno`);

--
-- Indexes for table `tb_dia_letivo`
--
ALTER TABLE `tb_dia_letivo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_endereco`
--
ALTER TABLE `tb_endereco`
  ADD PRIMARY KEY (`idtb_endereco`),
  ADD KEY `fk_tb_endereco_tb_aluno1` (`tb_aluno_idtb_aluno`);

--
-- Indexes for table `tb_escolaridade`
--
ALTER TABLE `tb_escolaridade`
  ADD PRIMARY KEY (`idtb_escolaridade`);

--
-- Indexes for table `tb_galeria`
--
ALTER TABLE `tb_galeria`
  ADD PRIMARY KEY (`idtb_galeria`);

--
-- Indexes for table `tb_gp_biblioteca`
--
ALTER TABLE `tb_gp_biblioteca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_gp_biblioteca_ibfk_1` (`id_turma`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`idtb_login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_material`
--
ALTER TABLE `tb_material`
  ADD PRIMARY KEY (`idtb_material`),
  ADD KEY `fk_tb_material_tb_curso1` (`tb_curso_idtb_curso`),
  ADD KEY `fk_tb_material_tb_professor1` (`tb_professor_idtb_professor`),
  ADD KEY `fk_tb_material_tb_turma1` (`tb_turma_idtb_turma`);

--
-- Indexes for table `tb_modulo`
--
ALTER TABLE `tb_modulo`
  ADD PRIMARY KEY (`idtb_modulo`),
  ADD KEY `fk_tb_modulo_tb_curso1` (`tb_curso_idtb_curso`);

--
-- Indexes for table `tb_msg`
--
ALTER TABLE `tb_msg`
  ADD PRIMARY KEY (`idtb_msg`);

--
-- Indexes for table `tb_notas`
--
ALTER TABLE `tb_notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_notas_ibfk_1` (`id_turma_aluno`);

--
-- Indexes for table `tb_pagamento`
--
ALTER TABLE `tb_pagamento`
  ADD PRIMARY KEY (`idtb_pagamento`);

--
-- Indexes for table `tb_presenca`
--
ALTER TABLE `tb_presenca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_presenca_ibfk_1` (`id_data`),
  ADD KEY `tb_presenca_ibfk_2` (`id_turma`);

--
-- Indexes for table `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD PRIMARY KEY (`idtb_professor`),
  ADD KEY `fk_tb_professor_tb_contato1` (`tb_contato_idtb_contato`),
  ADD KEY `fk_tb_professor_tb_login1` (`tb_login_idtb_login`);

--
-- Indexes for table `tb_renova`
--
ALTER TABLE `tb_renova`
  ADD PRIMARY KEY (`idtb_renova`);

--
-- Indexes for table `tb_requisito`
--
ALTER TABLE `tb_requisito`
  ADD PRIMARY KEY (`idtb_requisito`);

--
-- Indexes for table `tb_servico`
--
ALTER TABLE `tb_servico`
  ADD PRIMARY KEY (`idtb_servico`);

--
-- Indexes for table `tb_sexo`
--
ALTER TABLE `tb_sexo`
  ADD PRIMARY KEY (`idtb_sexo`);

--
-- Indexes for table `tb_solicitacao`
--
ALTER TABLE `tb_solicitacao`
  ADD PRIMARY KEY (`idtb_solicitacao`);

--
-- Indexes for table `tb_transacao`
--
ALTER TABLE `tb_transacao`
  ADD PRIMARY KEY (`idtb_transacao`),
  ADD KEY `fk_tb_aluno` (`idtb_aluno`);

--
-- Indexes for table `tb_turma`
--
ALTER TABLE `tb_turma`
  ADD PRIMARY KEY (`idtb_turma`),
  ADD KEY `fk_tb_turma_tb_curso1` (`tb_curso_idtb_curso`),
  ADD KEY `fk_tb_turma_tb_professor1` (`tb_professor_idtb_professor`);

--
-- Indexes for table `tb_turma_aluno`
--
ALTER TABLE `tb_turma_aluno`
  ADD PRIMARY KEY (`idtb_turma_aluno`),
  ADD KEY `fk_tb_turma_aluno_tb_aluno1` (`tb_aluno_idtb_aluno`),
  ADD KEY `fk_tb_turma_aluno_tb_curso1` (`tb_curso_idtb_curso`),
  ADD KEY `fk_tb_turma_aluno_tb_turma1` (`tb_turma_idtb_turma`),
  ADD KEY `tb_turma_aluno_ibfk_1` (`tb_pagamento_idtb_pagamento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_aluno`
--
ALTER TABLE `tb_aluno`
  MODIFY `idtb_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_biblioteca`
--
ALTER TABLE `tb_biblioteca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_contato`
--
ALTER TABLE `tb_contato`
  MODIFY `idtb_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_contato_empresa`
--
ALTER TABLE `tb_contato_empresa`
  MODIFY `idtb_contato_empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_curso`
--
ALTER TABLE `tb_curso`
  MODIFY `idtb_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_dia_letivo`
--
ALTER TABLE `tb_dia_letivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_endereco`
--
ALTER TABLE `tb_endereco`
  MODIFY `idtb_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_escolaridade`
--
ALTER TABLE `tb_escolaridade`
  MODIFY `idtb_escolaridade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_galeria`
--
ALTER TABLE `tb_galeria`
  MODIFY `idtb_galeria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_gp_biblioteca`
--
ALTER TABLE `tb_gp_biblioteca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `idtb_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_material`
--
ALTER TABLE `tb_material`
  MODIFY `idtb_material` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_modulo`
--
ALTER TABLE `tb_modulo`
  MODIFY `idtb_modulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_msg`
--
ALTER TABLE `tb_msg`
  MODIFY `idtb_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_notas`
--
ALTER TABLE `tb_notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pagamento`
--
ALTER TABLE `tb_pagamento`
  MODIFY `idtb_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_presenca`
--
ALTER TABLE `tb_presenca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_professor`
--
ALTER TABLE `tb_professor`
  MODIFY `idtb_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_renova`
--
ALTER TABLE `tb_renova`
  MODIFY `idtb_renova` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_requisito`
--
ALTER TABLE `tb_requisito`
  MODIFY `idtb_requisito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_servico`
--
ALTER TABLE `tb_servico`
  MODIFY `idtb_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_sexo`
--
ALTER TABLE `tb_sexo`
  MODIFY `idtb_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_solicitacao`
--
ALTER TABLE `tb_solicitacao`
  MODIFY `idtb_solicitacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transacao`
--
ALTER TABLE `tb_transacao`
  MODIFY `idtb_transacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_turma`
--
ALTER TABLE `tb_turma`
  MODIFY `idtb_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_turma_aluno`
--
ALTER TABLE `tb_turma_aluno`
  MODIFY `idtb_turma_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
