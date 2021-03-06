-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20-Abr-2015 às 22:24
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

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
  `AlunoId` int(11) NOT NULL AUTO_INCREMENT,
  `PessoaId` int(11) NOT NULL,
  `TurmaId` int(11) NOT NULL,
  `ChaveRegistro` varchar(255) COLLATE utf8_bin NOT NULL,
  `Registrado` tinyint(4) NOT NULL DEFAULT '0',
  `Representante` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`AlunoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

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
  `AulaId` int(11) NOT NULL AUTO_INCREMENT,
  `MateriaId` int(11) NOT NULL,
  `TurmaId` int(11) NOT NULL,
  `ProfessorId` int(11) NOT NULL,
  `Data` varchar(100) COLLATE utf8_bin NOT NULL,
  `HoraDe` varchar(50) COLLATE utf8_bin NOT NULL,
  `HoraAte` varchar(50) COLLATE utf8_bin NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Conteudo` text COLLATE utf8_bin NOT NULL,
  `Sala` varchar(30) COLLATE utf8_bin NOT NULL,
  `PessoaId` int(11) NOT NULL,
  PRIMARY KEY (`AulaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `AulaArquivo`
--

CREATE TABLE IF NOT EXISTS `AulaArquivo` (
  `AulaArquivoId` int(11) NOT NULL AUTO_INCREMENT,
  `AulaId` int(11) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Url` varchar(255) COLLATE utf8_bin NOT NULL,
  `PessoaId` int(11) NOT NULL,
  PRIMARY KEY (`AulaArquivoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Avaliacao`
--

CREATE TABLE IF NOT EXISTS `Avaliacao` (
  `AvaliacaoId` int(11) NOT NULL AUTO_INCREMENT,
  `MateriaId` int(11) NOT NULL,
  `TurmaId` int(11) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Data` varchar(255) COLLATE utf8_bin NOT NULL,
  `DataCadastro` bigint(20) NOT NULL,
  `Peso` int(11) NOT NULL,
  `Descricao` text COLLATE utf8_bin NOT NULL,
  `Trabalho` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`AvaliacaoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `CanalSocial`
--

CREATE TABLE IF NOT EXISTS `CanalSocial` (
  `CanalSocialId` int(11) NOT NULL AUTO_INCREMENT,
  `TurmaId` int(11) NOT NULL,
  `Tipo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Url` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CanalSocialId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Curso`
--

CREATE TABLE IF NOT EXISTS `Curso` (
  `CursoId` int(11) NOT NULL AUTO_INCREMENT,
  `EscolaId` int(11) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CursoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Escola`
--

CREATE TABLE IF NOT EXISTS `Escola` (
  `EscolaId` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Endereco` varchar(255) COLLATE utf8_bin NOT NULL,
  `Telefone` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(255) COLLATE utf8_bin NOT NULL,
  `Site` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`EscolaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Materia`
--

CREATE TABLE IF NOT EXISTS `Materia` (
  `MateriaId` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MateriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `MateriaCurso`
--

CREATE TABLE IF NOT EXISTS `MateriaCurso` (
  `MateriaCursoId` int(11) NOT NULL AUTO_INCREMENT,
  `MateriaId` int(11) NOT NULL,
  `CursoId` int(11) NOT NULL,
  `DiaSemana` varchar(255) COLLATE utf8_bin NOT NULL,
  `HoraDe` varchar(50) COLLATE utf8_bin NOT NULL,
  `HoraAte` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MateriaCursoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Professor`
--

CREATE TABLE IF NOT EXISTS `Professor` (
  `ProfessorId` int(11) NOT NULL AUTO_INCREMENT,
  `PessoaId` int(11) NOT NULL,
  `ChaveRegistro` varchar(255) COLLATE utf8_bin NOT NULL,
  `Registrado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ProfessorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ProfessorMateria`
--

CREATE TABLE IF NOT EXISTS `ProfessorMateria` (
  `ProfessorMateriaId` int(11) NOT NULL AUTO_INCREMENT,
  `ProfessorId` int(11) NOT NULL,
  `MateriaId` int(11) NOT NULL,
  PRIMARY KEY (`ProfessorMateriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Turma`
--

CREATE TABLE IF NOT EXISTS `Turma` (
  `TurmaId` int(11) NOT NULL AUTO_INCREMENT,
  `CursoId` int(11) NOT NULL,
  `Ano` int(11) NOT NULL,
  `Semestre` int(11) NOT NULL,
  `Turno` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`TurmaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
