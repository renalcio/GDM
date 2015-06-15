-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Jun-2015 às 22:12
-- Versão do servidor: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ClassHub`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Aluno`
--

CREATE TABLE IF NOT EXISTS `Aluno` (
  `AlunoId` int(11) NOT NULL,
  `PessoaId` int(11) NOT NULL,
  `TurmaId` int(11) NOT NULL,
  `ChaveRegistro` varchar(255) COLLATE utf8_bin NOT NULL,
  `Registrado` tinyint(4) NOT NULL DEFAULT '0',
  `Representante` tinyint(4) NOT NULL DEFAULT '0',
  `EscolaId` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `Aluno`
--

INSERT INTO `Aluno` (`AlunoId`, `PessoaId`, `TurmaId`, `ChaveRegistro`, `Registrado`, `Representante`, `EscolaId`) VALUES
(1, 2, 1, '000000001', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `AlunoNota`
--

CREATE TABLE IF NOT EXISTS `AlunoNota` (
  `AlunoNotaId` int(11) NOT NULL,
  `AlunoId` int(11) NOT NULL,
  `AvaliacaoId` int(11) NOT NULL,
  `Nota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Aula`
--

CREATE TABLE IF NOT EXISTS `Aula` (
  `AulaId` int(11) NOT NULL,
  `MateriaId` int(11) NOT NULL,
  `TurmaId` int(11) NOT NULL,
  `ProfessorId` int(11) NOT NULL,
  `Data` varchar(100) COLLATE utf8_bin NOT NULL,
  `HoraDe` varchar(50) COLLATE utf8_bin NOT NULL,
  `HoraAte` varchar(50) COLLATE utf8_bin NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Conteudo` text COLLATE utf8_bin NOT NULL,
  `Sala` varchar(30) COLLATE utf8_bin NOT NULL,
  `AlunoId` int(11) DEFAULT NULL,
  `EscolaId` int(11) NOT NULL DEFAULT '0',
  `CursoId` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `Aula`
--

INSERT INTO `Aula` (`AulaId`, `MateriaId`, `TurmaId`, `ProfessorId`, `Data`, `HoraDe`, `HoraAte`, `Titulo`, `Conteudo`, `Sala`, `AlunoId`, `EscolaId`, `CursoId`) VALUES
(1, 2, 1, 1, '12/06/2015', '19:00', '20:40', 'Aula Teste', '<div style="text-align: left;"><span style="line-height: 1.42857143;">Aula TesteAula TesteAula TesteAula <font color="#f83a22">TesteAula TesteAula</font> TesteAula TesteAula TesteAula TesteAula TesteAula TesteAula TesteAula TesteAula TesteAula TesteAula TesteAula TesteAula Teste</span></div>', 'B2', 1, 1, 1),
(2, 2, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(3, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(4, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(5, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(6, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(7, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(8, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(9, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(10, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(11, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(12, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(13, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(14, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(15, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(16, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(17, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(18, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(19, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1),
(20, 1, 1, 1, '12/06/2015', '19:00', '20:40', 'Testando apenas', 'Teste Teste Teste', '17', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `AulaArquivo`
--

CREATE TABLE IF NOT EXISTS `AulaArquivo` (
  `AulaArquivoId` int(11) NOT NULL,
  `AulaId` int(11) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Url` varchar(255) COLLATE utf8_bin NOT NULL,
  `PessoaId` int(11) NOT NULL,
  `Tamanho` varchar(255) COLLATE utf8_bin DEFAULT '0 KB',
  `Tipo` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Avaliacao`
--

CREATE TABLE IF NOT EXISTS `Avaliacao` (
  `AvaliacaoId` int(11) NOT NULL,
  `MateriaId` int(11) NOT NULL,
  `TurmaId` int(11) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Data` varchar(255) COLLATE utf8_bin NOT NULL,
  `DataCadastro` bigint(20) NOT NULL,
  `Peso` int(11) NOT NULL,
  `Descricao` text COLLATE utf8_bin NOT NULL,
  `Trabalho` tinyint(1) NOT NULL DEFAULT '0',
  `EscolaId` int(11) NOT NULL,
  `CursoId` int(11) NOT NULL,
  `AlunoId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `Avaliacao`
--

INSERT INTO `Avaliacao` (`AvaliacaoId`, `MateriaId`, `TurmaId`, `Titulo`, `Data`, `DataCadastro`, `Peso`, `Descricao`, `Trabalho`, `EscolaId`, `CursoId`, `AlunoId`) VALUES
(1, 2, 1, 'Prova 2', '11/06/2015', 0, 0, '', 0, 1, 1, 0),
(2, 1, 1, 'Testando', '12/06/2015', 0, 0, '', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `CanalSocial`
--

CREATE TABLE IF NOT EXISTS `CanalSocial` (
  `CanalSocialId` int(11) NOT NULL,
  `TurmaId` int(11) NOT NULL,
  `Tipo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Url` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Curso`
--

CREATE TABLE IF NOT EXISTS `Curso` (
  `CursoId` int(11) NOT NULL,
  `EscolaId` int(11) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `Curso`
--

INSERT INTO `Curso` (`CursoId`, `EscolaId`, `Titulo`) VALUES
(1, 1, 'Jogos Digitais'),
(2, 1, 'Segurança da Informação'),
(3, 1, 'Logística');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Escola`
--

CREATE TABLE IF NOT EXISTS `Escola` (
  `EscolaId` int(11) NOT NULL,
  `Nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Endereco` varchar(255) COLLATE utf8_bin NOT NULL,
  `Telefone` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(255) COLLATE utf8_bin NOT NULL,
  `Site` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `Escola`
--

INSERT INTO `Escola` (`EscolaId`, `Nome`, `Endereco`, `Telefone`, `Email`, `Site`) VALUES
(1, 'Fatec Americana - Centro Paula Souza', 'Rua Emílio de Menezes - Vila Louricilda, Americana - SP', '(19) 3406-3297', 'academica@fatec.edu.br', 'www.fatec.edu.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Materia`
--

CREATE TABLE IF NOT EXISTS `Materia` (
  `MateriaId` int(11) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `Materia`
--

INSERT INTO `Materia` (`MateriaId`, `Titulo`) VALUES
(1, 'Matemática Discreta'),
(2, 'Programação 1'),
(3, 'Introdução a Jogos Digitais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `MateriaCurso`
--

CREATE TABLE IF NOT EXISTS `MateriaCurso` (
  `MateriaCursoId` int(11) NOT NULL,
  `MateriaId` int(11) NOT NULL,
  `CursoId` int(11) NOT NULL,
  `DiaSemana` varchar(255) COLLATE utf8_bin NOT NULL,
  `HoraDe` varchar(50) COLLATE utf8_bin NOT NULL,
  `HoraAte` varchar(50) COLLATE utf8_bin NOT NULL,
  `EscolaId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `MateriaCurso`
--

INSERT INTO `MateriaCurso` (`MateriaCursoId`, `MateriaId`, `CursoId`, `DiaSemana`, `HoraDe`, `HoraAte`, `EscolaId`) VALUES
(2, 1, 1, 'Segunda-feira', '20:50', '22:30', 1),
(4, 1, 1, 'Terça-feira', '20:50', '22:30', 1),
(5, 2, 1, 'Quarta-feira', '20:50', '22:30', 1),
(6, 2, 1, 'Quinta-feira', '19:00', '22:30', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Professor`
--

CREATE TABLE IF NOT EXISTS `Professor` (
  `ProfessorId` int(11) NOT NULL,
  `PessoaId` int(11) NOT NULL,
  `ChaveRegistro` varchar(255) COLLATE utf8_bin NOT NULL,
  `Registrado` tinyint(4) NOT NULL DEFAULT '0',
  `EscolaId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `Professor`
--

INSERT INTO `Professor` (`ProfessorId`, `PessoaId`, `ChaveRegistro`, `Registrado`, `EscolaId`) VALUES
(1, 3, '000000001', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ProfessorMateria`
--

CREATE TABLE IF NOT EXISTS `ProfessorMateria` (
  `ProfessorMateriaId` int(11) NOT NULL,
  `ProfessorId` int(11) NOT NULL,
  `MateriaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Turma`
--

CREATE TABLE IF NOT EXISTS `Turma` (
  `TurmaId` int(11) NOT NULL,
  `CursoId` int(11) NOT NULL,
  `Ano` int(11) NOT NULL,
  `Semestre` int(11) NOT NULL,
  `Turno` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `Turma`
--

INSERT INTO `Turma` (`TurmaId`, `CursoId`, `Ano`, `Semestre`, `Turno`) VALUES
(1, 1, 2015, 1, 'Noite');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Aluno`
--
ALTER TABLE `Aluno`
  ADD PRIMARY KEY (`AlunoId`);

--
-- Indexes for table `Aula`
--
ALTER TABLE `Aula`
  ADD PRIMARY KEY (`AulaId`);

--
-- Indexes for table `AulaArquivo`
--
ALTER TABLE `AulaArquivo`
  ADD PRIMARY KEY (`AulaArquivoId`);

--
-- Indexes for table `Avaliacao`
--
ALTER TABLE `Avaliacao`
  ADD PRIMARY KEY (`AvaliacaoId`);

--
-- Indexes for table `CanalSocial`
--
ALTER TABLE `CanalSocial`
  ADD PRIMARY KEY (`CanalSocialId`);

--
-- Indexes for table `Curso`
--
ALTER TABLE `Curso`
  ADD PRIMARY KEY (`CursoId`);

--
-- Indexes for table `Escola`
--
ALTER TABLE `Escola`
  ADD PRIMARY KEY (`EscolaId`);

--
-- Indexes for table `Materia`
--
ALTER TABLE `Materia`
  ADD PRIMARY KEY (`MateriaId`);

--
-- Indexes for table `MateriaCurso`
--
ALTER TABLE `MateriaCurso`
  ADD PRIMARY KEY (`MateriaCursoId`);

--
-- Indexes for table `Professor`
--
ALTER TABLE `Professor`
  ADD PRIMARY KEY (`ProfessorId`);

--
-- Indexes for table `ProfessorMateria`
--
ALTER TABLE `ProfessorMateria`
  ADD PRIMARY KEY (`ProfessorMateriaId`);

--
-- Indexes for table `Turma`
--
ALTER TABLE `Turma`
  ADD PRIMARY KEY (`TurmaId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Aluno`
--
ALTER TABLE `Aluno`
  MODIFY `AlunoId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Aula`
--
ALTER TABLE `Aula`
  MODIFY `AulaId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `AulaArquivo`
--
ALTER TABLE `AulaArquivo`
  MODIFY `AulaArquivoId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Avaliacao`
--
ALTER TABLE `Avaliacao`
  MODIFY `AvaliacaoId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `CanalSocial`
--
ALTER TABLE `CanalSocial`
  MODIFY `CanalSocialId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Curso`
--
ALTER TABLE `Curso`
  MODIFY `CursoId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Escola`
--
ALTER TABLE `Escola`
  MODIFY `EscolaId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Materia`
--
ALTER TABLE `Materia`
  MODIFY `MateriaId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `MateriaCurso`
--
ALTER TABLE `MateriaCurso`
  MODIFY `MateriaCursoId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Professor`
--
ALTER TABLE `Professor`
  MODIFY `ProfessorId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ProfessorMateria`
--
ALTER TABLE `ProfessorMateria`
  MODIFY `ProfessorMateriaId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Turma`
--
ALTER TABLE `Turma`
  MODIFY `TurmaId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
