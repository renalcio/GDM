-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Maio-2015 às 03:10
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `GDM`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Acesso`
--

CREATE TABLE IF NOT EXISTS `Acesso` (
  `AcessoId` int(11) NOT NULL AUTO_INCREMENT,
  `AplicacaoId` int(11) NOT NULL DEFAULT '0',
  `PerfilId` int(11) NOT NULL DEFAULT '0',
  `MenuId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`AcessoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Menu`
--

CREATE TABLE IF NOT EXISTS `Menu` (
  `MenuId` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Icone` varchar(70) COLLATE utf8_bin DEFAULT NULL,
  `Pai` int(11) NOT NULL DEFAULT '0',
  `AplicacaoId` int(255) NOT NULL,
  `Posicao` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MenuId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `Menu`
--

INSERT INTO `Menu` (`MenuId`, `Titulo`, `Url`, `Icone`, `Pai`, `AplicacaoId`, `Posicao`) VALUES
(1, 'Início', 'home/', 'fa-home', 0, 1, 0),
(2, 'Painel de Controle', '', 'fa-dashboard', 0, 1, 1),
(3, 'Configurações', '', 'fa-gear', 2, 1, 0),
(4, 'Menu', '', 'fa-indent', 2, 1, 1),
(5, 'Aplicação Atual', 'menu/cadastro/', '', 4, 1, 0),
(6, 'Todas as Aplicações', 'menu/', '', 4, 1, 1),
(7, 'Cadastros', '', 'fa-edit', 0, 1, 2),
(8, 'Aplicações', '', ' fa-th-large', 7, 1, 0),
(9, 'Pessoas', '', 'fa-users', 7, 1, 1),
(10, 'Pessoas', 'pessoa/', '', 9, 1, 0),
(11, 'Perfís', 'perfil/', '', 9, 1, 1),
(12, 'Usuarios', 'usuario/', '', 9, 1, 2),
(13, 'Vínculo de Usuários', 'usuarioaplicacao/', '', 9, 1, 3),
(15, 'Nichos', 'nicho/', '', 8, 1, 1),
(16, 'Início', 'home/', 'fa-home', 0, 3, 0),
(17, 'Mídia', '', 'fa-headphones', 0, 3, 1),
(18, 'Artistas', 'artista/', 'fa-star', 17, 3, 0),
(19, 'Músicas', 'musica/', 'fa-music', 17, 3, 1),
(20, 'Site', '', 'fa-cloud', 0, 3, 2),
(21, 'Destaques', 'SiteDestaque/', 'fa-thumb-tack', 20, 3, 0),
(22, 'Menu do Site', 'MenuSite/', 'fa-indent', 20, 3, 1),
(23, 'Ranking', 'RankingSite/', 'fa-trophy', 20, 3, 2),
(24, 'Usuários', '', 'fa-users', 0, 3, 3),
(25, 'Aplicações', 'Aplicacao/', '', 8, 1, 0),
(26, 'Sites', 'site/', '', 8, 1, 2),
(27, 'Notificações', 'Notificacao/', 'fa-bell-o', 2, 1, 2),
(28, 'Início', 'Home', 'fa-home', 0, 4, 0),
(29, 'Cadastros', '', 'fa-edit ', 0, 4, 1),
(30, 'Alunos', 'Aluno/', ' fa-user', 29, 4, 0),
(31, 'Aulas', 'Aula/', 'fa-paste', 29, 4, 1),
(32, 'Cursos', 'Curso/', ' fa-sitemap', 29, 4, 2),
(33, 'Escolas', 'Escola/', 'fa-building-o', 29, 4, 3),
(34, 'Matérias', 'Materia/', 'fa-book', 29, 4, 4),
(35, 'Professores', 'Professor/', 'fa-user', 29, 4, 5),
(36, 'Turmas', 'Turma/', 'fa-users', 29, 4, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Permissao`
--

CREATE TABLE IF NOT EXISTS `Permissao` (
  `PermissaoId` int(11) NOT NULL AUTO_INCREMENT,
  `MenuId` int(11) NOT NULL DEFAULT '0',
  `AplicacaoId` int(11) NOT NULL DEFAULT '0',
  `PerfilId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PermissaoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=105 ;

--
-- Extraindo dados da tabela `Permissao`
--

INSERT INTO `Permissao` (`PermissaoId`, `MenuId`, `AplicacaoId`, `PerfilId`) VALUES
(19, 1, 1, 2),
(20, 2, 1, 2),
(26, 8, 1, 2),
(27, 10, 1, 2),
(28, 9, 1, 2),
(29, 11, 1, 2),
(30, 12, 1, 2),
(31, 13, 1, 2),
(33, 1, 1, 1),
(34, 2, 1, 1),
(35, 3, 1, 1),
(37, 5, 1, 1),
(38, 6, 1, 1),
(39, 7, 1, 1),
(40, 8, 1, 1),
(41, 9, 1, 1),
(42, 10, 1, 1),
(43, 11, 1, 1),
(44, 12, 1, 1),
(45, 13, 1, 1),
(48, 4, 1, 1),
(49, 15, 1, 1),
(53, 3, 1, 2),
(54, 4, 1, 2),
(55, 5, 1, 2),
(56, 6, 1, 2),
(57, 7, 1, 2),
(58, 15, 1, 2),
(59, 16, 3, 10),
(60, 17, 3, 10),
(61, 18, 3, 10),
(62, 19, 3, 10),
(63, 21, 3, 10),
(64, 20, 3, 10),
(65, 23, 3, 10),
(66, 24, 3, 10),
(67, 22, 3, 10),
(68, 25, 1, 2),
(69, 26, 1, 2),
(70, 25, 1, 1),
(71, 26, 1, 1),
(72, 27, 1, 1),
(87, 28, 4, 14),
(88, 29, 4, 14),
(89, 30, 4, 14),
(90, 31, 4, 14),
(91, 32, 4, 14),
(92, 33, 4, 14),
(93, 34, 4, 14),
(94, 35, 4, 14),
(95, 36, 4, 14),
(96, 28, 4, 15),
(97, 29, 4, 15),
(98, 30, 4, 15),
(99, 31, 4, 15),
(100, 32, 4, 15),
(101, 33, 4, 15),
(102, 34, 4, 15),
(103, 35, 4, 15),
(104, 36, 4, 15);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
