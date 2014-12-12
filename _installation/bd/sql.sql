-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Dez-2014 às 21:44
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cdm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Aplicacao`
--

CREATE TABLE IF NOT EXISTS `Aplicacao` (
  `AplicacaoId` int(255) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Descricao` text CHARACTER SET latin1,
  `PessoaId` int(255) NOT NULL,
  `DataCriacao` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NichoId` int(255) NOT NULL,
  PRIMARY KEY (`AplicacaoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `Aplicacao`
--

INSERT INTO `Aplicacao` (`AplicacaoId`, `Titulo`, `Descricao`, `PessoaId`, `DataCriacao`, `NichoId`) VALUES
(1, 'GDM', 'Gerenciador de Dados Modular', 1, '0', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=142 ;

--
-- Extraindo dados da tabela `Menu`
--

INSERT INTO `Menu` (`MenuId`, `Titulo`, `Url`, `Icone`, `Pai`, `AplicacaoId`, `Posicao`) VALUES
(129, 'Home', '', 'fa-home', 0, 1, 0),
(130, 'Painel de Controle', '', 'fa-gears', 0, 1, 1),
(131, 'Configurações', 'painel/', 'fa-gear', 130, 1, 0),
(132, 'Menu', '', 'fa-th-list', 130, 1, 1),
(133, 'Aplicação Atual', 'menu/cadastro', '', 132, 1, 0),
(134, 'Todos os Menus', 'menu/', '', 132, 1, 1),
(135, 'Permissões de Acesso', 'permissoes/', 'fa-ban', 130, 1, 2),
(136, 'Cadastros', '', 'fa-edit', 0, 1, 2),
(137, 'Aplicações', 'apps/', 'fa-th-large', 136, 1, 0),
(138, 'Pessoas', '', 'fa-users', 136, 1, 1),
(139, 'Pessoas', 'pessoas/', '', 138, 1, 0),
(140, 'Usuarios', 'usuarios/', '', 138, 1, 1),
(141, 'Nicho', 'nicho', 'fa-sitemap', 136, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Nicho`
--

CREATE TABLE IF NOT EXISTS `Nicho` (
  `NichoId` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`NichoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `Nicho`
--

INSERT INTO `Nicho` (`NichoId`, `Titulo`) VALUES
(1, 'Desenvolvimento de Software');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Pais`
--

CREATE TABLE IF NOT EXISTS `Pais` (
  `PaisId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`PaisId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=253 ;

--
-- Extraindo dados da tabela `Pais`
--

INSERT INTO `Pais` (`PaisId`, `Nome`, `Name`) VALUES
(1, 'Afeganistão', 'Afghanistan'),
(2, 'Acrotíri e decelia', 'Akrotiri e dekélia'),
(3, 'áfrica do sul', 'South africa'),
(4, 'Albânia', 'Albania'),
(5, 'Alemanha', 'Germany'),
(6, 'American samoa', 'American samoa'),
(7, 'Andorra', 'Andorra'),
(8, 'Angola', 'Angola'),
(9, 'Anguilla', 'Anguilla'),
(10, 'Antígua e barbuda', 'Antigua and barbuda'),
(11, 'Antilhas neerlandesas', 'Netherlands antilles'),
(12, 'Arábia saudita', 'Saudi arabia'),
(13, 'Argélia', 'Algeria'),
(14, 'Argentina', 'Argentina'),
(15, 'Arménia', 'Armenia'),
(16, 'Aruba', 'Aruba'),
(17, 'Austrália', 'Australia'),
(18, 'áustria', 'Austria'),
(19, 'Azerbaijão', 'Azerbaijan'),
(20, 'Bahamas', 'Bahamas, the'),
(21, 'Bangladeche', 'Bangladesh'),
(22, 'Barbados', 'Barbados'),
(23, 'Barém', 'Bahrain'),
(24, 'Bassas da índia', 'Bassas da india'),
(25, 'Bélgica', 'Belgium'),
(26, 'Belize', 'Belize'),
(27, 'Benim', 'Benin'),
(28, 'Bermudas', 'Bermuda'),
(29, 'Bielorrússia', 'Belarus'),
(30, 'Bolívia', 'Bolivia'),
(31, 'Bósnia e herzegovina', 'Bosnia and herzegovina'),
(32, 'Botsuana', 'Botswana'),
(33, 'Brasil', 'Brazil'),
(34, 'Brunei darussalam', 'Brunei darussalam'),
(35, 'Bulgária', 'Bulgaria'),
(36, 'Burquina faso', 'Burkina faso'),
(37, 'Burundi', 'Burundi'),
(38, 'Butão', 'Bhutan'),
(39, 'Cabo verde', 'Cape verde'),
(40, 'Camarões', 'Cameroon'),
(41, 'Camboja', 'Cambodia'),
(42, 'Canadá', 'Canada'),
(43, 'Catar', 'Qatar'),
(44, 'Cazaquistão', 'Kazakhstan'),
(45, 'Centro-africana república', 'Central african republic'),
(46, 'Chade', 'Chad'),
(47, 'Chile', 'Chile'),
(48, 'China', 'China'),
(49, 'Chipre', 'Cyprus'),
(50, 'Colômbia', 'Colombia'),
(51, 'Comores', 'Comoros'),
(52, 'Congo', 'Congo'),
(53, 'Congo república democrática', 'Congo democratic republic'),
(54, 'Coreia do norte', 'Korea north'),
(55, 'Coreia do sul', 'Korea south'),
(56, 'Costa do marfim', 'Ivory coast'),
(57, 'Costa rica', 'Costa rica'),
(58, 'Croácia', 'Croatia'),
(59, 'Cuba', 'Cuba'),
(60, 'Dinamarca', 'Denmark'),
(61, 'Domínica', 'Dominica'),
(62, 'Egipto', 'Egypt'),
(63, 'Emirados árabes unidos', 'United arab emirates'),
(64, 'Equador', 'Ecuador'),
(65, 'Eritreia', 'Eritrea'),
(66, 'Eslováquia', 'Slovakia'),
(67, 'Eslovénia', 'Slovenia'),
(68, 'Espanha', 'Spain'),
(69, 'Estados unidos', 'United states'),
(70, 'Estónia', 'Estonia'),
(71, 'Etiópia', 'Ethiopia'),
(72, 'Faixa de gaza', 'Gaza strip'),
(73, 'Fiji', 'Fiji'),
(74, 'Filipinas', 'Philippines'),
(75, 'Finlândia', 'Finland'),
(76, 'França', 'France'),
(77, 'Gabão', 'Gabon'),
(78, 'Gâmbia', 'Gambia'),
(79, 'Gana', 'Ghana'),
(80, 'Geórgia', 'Georgia'),
(81, 'Gibraltar', 'Gibraltar'),
(82, 'Granada', 'Grenada'),
(83, 'Grécia', 'Greece'),
(84, 'Gronelândia', 'Greenland'),
(85, 'Guadalupe', 'Guadeloupe'),
(86, 'Guam', 'Guam'),
(87, 'Guatemala', 'Guatemala'),
(88, 'Guernsey', 'Guernsey'),
(89, 'Guiana', 'Guyana'),
(90, 'Guiana francesa', 'French guiana'),
(91, 'Guiné', 'Guinea'),
(92, 'Guiné equatorial', 'Equatorial guinea'),
(93, 'Guiné-bissau', 'Guinea-bissau'),
(94, 'Haiti', 'Haiti'),
(95, 'Honduras', 'Honduras'),
(96, 'Hong kong', 'Hong kong'),
(97, 'Hungria', 'Hungary'),
(98, 'Iémen', 'Yemen'),
(99, 'Ilha bouvet', 'Bouvet island'),
(100, 'Ilha christmas', 'Christmas island'),
(101, 'Ilha de clipperton', 'Clipperton island'),
(102, 'Ilha de joão da nova', 'Juan de nova island'),
(103, 'Ilha de man', 'Isle of man'),
(104, 'Ilha de navassa', 'Navassa island'),
(105, 'Ilha europa', 'Europa island'),
(106, 'Ilha norfolk', 'Norfolk island'),
(107, 'Ilha tromelin', 'Tromelin island'),
(108, 'Ilhas ashmore e cartier', 'Ashmore and cartier islands'),
(109, 'Ilhas caiman', 'Cayman islands'),
(110, 'Ilhas cocos (keeling)', 'Cocos (keeling) islands'),
(111, 'Ilhas cook', 'Cook islands'),
(112, 'Ilhas do mar de coral', 'Coral sea islands'),
(113, 'Ilhas falklands (ilhas malvinas)', 'Falkland islands (islas malvinas)'),
(114, 'Ilhas feroe', 'Faroe islands'),
(115, 'Ilhas geórgia do sul e sandwich do sul', 'South georgia and the south sandwich islands'),
(116, 'Ilhas marianas do norte', 'Northern mariana islands'),
(117, 'Ilhas marshall', 'Marshall islands'),
(118, 'Ilhas paracel', 'Paracel islands'),
(119, 'Ilhas pitcairn', 'Pitcairn islands'),
(120, 'Ilhas salomão', 'Solomon islands'),
(121, 'Ilhas spratly', 'Spratly islands'),
(122, 'Ilhas virgens americanas', 'United states virgin islands'),
(123, 'Ilhas virgens britânicas', 'British virgin islands'),
(124, 'índia', 'India'),
(125, 'Indonésia', 'Indonesia'),
(126, 'Irão', 'Iran'),
(127, 'Iraque', 'Iraq'),
(128, 'Irlanda', 'Ireland'),
(129, 'Islândia', 'Iceland'),
(130, 'Israel', 'Israel'),
(131, 'Itália', 'Italy'),
(132, 'Jamaica', 'Jamaica'),
(133, 'Jan mayen', 'Jan mayen'),
(134, 'Japão', 'Japan'),
(135, 'Jersey', 'Jersey'),
(136, 'Jibuti', 'Djibouti'),
(137, 'Jordânia', 'Jordan'),
(138, 'Kiribati', 'Kiribati'),
(139, 'Koweit', 'Kuwait'),
(140, 'Laos', 'Laos'),
(141, 'Lesoto', 'Lesotho'),
(142, 'Letónia', 'Latvia'),
(143, 'Líbano', 'Lebanon'),
(144, 'Libéria', 'Liberia'),
(145, 'Líbia', 'Libyan arab jamahiriya'),
(146, 'Listenstaine', 'Liechtenstein'),
(147, 'Lituânia', 'Lithuania'),
(148, 'Luxemburgo', 'Luxembourg'),
(149, 'Macau', 'Macao'),
(150, 'Macedónia', 'Macedonia'),
(151, 'Madagáscar', 'Madagascar'),
(152, 'Malásia', 'Malaysia'),
(153, 'Malavi', 'Malawi'),
(154, 'Maldivas', 'Maldives'),
(155, 'Mali', 'Mali'),
(156, 'Malta', 'Malta'),
(157, 'Marrocos', 'Morocco'),
(158, 'Martinica', 'Martinique'),
(159, 'Maurícia', 'Mauritius'),
(160, 'Mauritânia', 'Mauritania'),
(161, 'Mayotte', 'Mayotte'),
(162, 'México', 'Mexico'),
(163, 'Mianmar', 'Myanmar burma'),
(164, 'Micronésia', 'Micronesia'),
(165, 'Moçambique', 'Mozambique'),
(166, 'Moldávia', 'Moldova'),
(167, 'Mónaco', 'Monaco'),
(168, 'Mongólia', 'Mongolia'),
(169, 'Montenegro', 'Montenegro'),
(170, 'Montserrat', 'Montserrat'),
(171, 'Namíbia', 'Namibia'),
(172, 'Nauru', 'Nauru'),
(173, 'Nepal', 'Nepal'),
(174, 'Nicarágua', 'Nicaragua'),
(175, 'Níger', 'Niger'),
(176, 'Nigéria', 'Nigeria'),
(177, 'Niue', 'Niue'),
(178, 'Noruega', 'Norway'),
(179, 'Nova caledónia', 'New caledonia'),
(180, 'Nova zelândia', 'New zealand'),
(181, 'Omã', 'Oman'),
(182, 'Países baixos', 'Netherlands'),
(183, 'Palau', 'Palau'),
(184, 'Palestina', 'Palestine'),
(185, 'Panamá', 'Panama'),
(186, 'Papuásia-nova guiné', 'Papua new guinea'),
(187, 'Paquistão', 'Pakistan'),
(188, 'Paraguai', 'Paraguay'),
(189, 'Peru', 'Peru'),
(190, 'Polinésia francesa', 'French polynesia'),
(191, 'Polónia', 'Poland'),
(192, 'Porto rico', 'Puerto rico'),
(193, 'Portugal', 'Portugal'),
(194, 'Quénia', 'Kenya'),
(195, 'Quirguizistão', 'Kyrgyzstan'),
(196, 'Reino unido', 'United kingdom'),
(197, 'República checa', 'Czech republic'),
(198, 'República dominicana', 'Dominican republic'),
(199, 'Roménia', 'Romania'),
(200, 'Ruanda', 'Rwanda'),
(201, 'Rússia', 'Russian federation'),
(202, 'Sahara occidental', 'Western sahara'),
(203, 'Salvador', 'El salvador'),
(204, 'Samoa', 'Samoa'),
(205, 'Santa helena', 'Saint helena'),
(206, 'Santa lúcia', 'Saint lucia'),
(207, 'Santa sé', 'Holy see'),
(208, 'São cristóvão e neves', 'Saint kitts and nevis'),
(209, 'São marino', 'San marino'),
(210, 'São pedro e miquelão', 'Saint pierre and miquelon'),
(211, 'São tomé e príncipe', 'Sao tome and principe'),
(212, 'São vicente e granadinas', 'Saint vincent and the grenadines'),
(213, 'Seicheles', 'Seychelles'),
(214, 'Senegal', 'Senegal'),
(215, 'Serra leoa', 'Sierra leone'),
(216, 'Sérvia', 'Serbia'),
(217, 'Singapura', 'Singapore'),
(218, 'Síria', 'Syria'),
(219, 'Somália', 'Somalia'),
(220, 'Sri lanca', 'Sri lanka'),
(221, 'Suazilândia', 'Swaziland'),
(222, 'Sudão', 'Sudan'),
(223, 'Suécia', 'Sweden'),
(224, 'Suíça', 'Switzerland'),
(225, 'Suriname', 'Suriname'),
(226, 'Svalbard', 'Svalbard'),
(227, 'Tailândia', 'Thailand'),
(228, 'Taiwan', 'Taiwan'),
(229, 'Tajiquistão', 'Tajikistan'),
(230, 'Tanzânia', 'Tanzania'),
(231, 'Território britânico do oceano índico', 'British indian ocean territory'),
(232, 'Território das ilhas heard e mcdonald', 'Heard island and mcdonald islands'),
(233, 'Timor-leste', 'Timor-leste'),
(234, 'Togo', 'Togo'),
(235, 'Tokelau', 'Tokelau'),
(236, 'Tonga', 'Tonga'),
(237, 'Trindade e tobago', 'Trinidad and tobago'),
(238, 'Tunísia', 'Tunisia'),
(239, 'Turks e caicos', 'Turks and caicos islands'),
(240, 'Turquemenistão', 'Turkmenistan'),
(241, 'Turquia', 'Turkey'),
(242, 'Tuvalu', 'Tuvalu'),
(243, 'Ucrânia', 'Ukraine'),
(244, 'Uganda', 'Uganda'),
(245, 'Uruguai', 'Uruguay'),
(246, 'Usbequistão', 'Uzbekistan'),
(247, 'Vanuatu', 'Vanuatu'),
(248, 'Venezuela', 'Venezuela'),
(249, 'Vietname', 'Vietnam'),
(250, 'Wallis e futuna', 'Wallis and futuna'),
(251, 'Zâmbia', 'Zambia'),
(252, 'Zimbabué', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Perfil`
--

CREATE TABLE IF NOT EXISTS `Perfil` (
  `PerfilId` int(255) NOT NULL AUTO_INCREMENT,
  `AplicacaoId` int(255) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PerfilId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `Perfil`
--

INSERT INTO `Perfil` (`PerfilId`, `AplicacaoId`, `Titulo`, `Ativo`) VALUES
(1, 1, 'Root', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Pessoa`
--

CREATE TABLE IF NOT EXISTS `Pessoa` (
  `PessoaId` int(255) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Telefone` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Celular` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Observacao` text COLLATE utf8_bin,
  PRIMARY KEY (`PessoaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `Pessoa`
--

INSERT INTO `Pessoa` (`PessoaId`, `Nome`, `Email`, `Telefone`, `Celular`, `Observacao`) VALUES
(1, 'Administrador', 'admin@teste.com', '(19) 3883-6146', '(19) 9823-49306', 'Pessoa Jurídica Now'),
(2, 'Renalcio Carlos Vieira de Freitas Junior', 'r.carlos@live.com', '(19) 3883-6146', '(19) 9823-49306', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `PessoaEmpresa`
--

CREATE TABLE IF NOT EXISTS `PessoaEmpresa` (
  `PessoaEmpresaId` int(11) NOT NULL AUTO_INCREMENT,
  `PessoaId` int(11) NOT NULL,
  `EmpresaId` int(11) NOT NULL,
  `Apagado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`PessoaEmpresaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `PessoaEndereco`
--

CREATE TABLE IF NOT EXISTS `PessoaEndereco` (
  `PessoaId` int(11) NOT NULL,
  `Rua` varchar(255) COLLATE utf8_bin NOT NULL,
  `Numero` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `Bairro` varchar(100) COLLATE utf8_bin NOT NULL,
  `Cidade` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `EstadoId` int(11) DEFAULT NULL,
  `PaisId` int(11) DEFAULT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Apagado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PessoaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `PessoaFisica`
--

CREATE TABLE IF NOT EXISTS `PessoaFisica` (
  `CPF` varchar(50) COLLATE utf8_bin NOT NULL,
  `Nascimento` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `RG` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `EstadoCivil` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Nacionalidade` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `Sexo` varchar(50) COLLATE utf8_bin NOT NULL,
  `PessoaId` int(11) NOT NULL,
  PRIMARY KEY (`PessoaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `PessoaFisica`
--

INSERT INTO `PessoaFisica` (`CPF`, `Nascimento`, `RG`, `EstadoCivil`, `Nacionalidade`, `Sexo`, `PessoaId`) VALUES
('410.982.848-10', '24/03/1995', '424364268', 'Solteiro', 'Brasil', 'Masculíno', 1),
('41098284810', '24/03/1995', '424364268', 'Solteiro', 'Brasil', 'Masculíno', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `PessoaJuridica`
--

CREATE TABLE IF NOT EXISTS `PessoaJuridica` (
  `PessoaId` int(11) NOT NULL,
  `NomeFantasia` varchar(255) COLLATE utf8_bin NOT NULL,
  `IE` varchar(50) COLLATE utf8_bin NOT NULL,
  `IM` varchar(50) COLLATE utf8_bin NOT NULL,
  `CNPJ` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`PessoaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `PessoaJuridica`
--

INSERT INTO `PessoaJuridica` (`PessoaId`, `NomeFantasia`, `IE`, `IM`, `CNPJ`) VALUES
(1, 'Admin LTDA', '52215566936358', '23.544.353/5735-87', '23544353573587');

-- --------------------------------------------------------

--
-- Estrutura da tabela `RegraPerfil`
--

CREATE TABLE IF NOT EXISTS `RegraPerfil` (
  `RegraPerfilId` int(255) NOT NULL AUTO_INCREMENT,
  `PerfilId` int(255) NOT NULL,
  `Permitir` tinyint(1) NOT NULL DEFAULT '1',
  `MenuId` int(255) NOT NULL,
  `AplicacaoId` int(255) NOT NULL,
  PRIMARY KEY (`RegraPerfilId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `song`
--

CREATE TABLE IF NOT EXISTS `song` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` text COLLATE utf8_unicode_ci NOT NULL,
  `track` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Extraindo dados da tabela `song`
--

INSERT INTO `song` (`id`, `artist`, `track`, `link`) VALUES
(2, 'Jessy Lanza', 'Kathy Lee', 'http://vimeo.com/73455369'),
(3, 'The Orwells', 'In my Bed (live)', 'http://www.youtube.com/watch?v=8tA_2qCGnmE'),
(4, 'L''Orange & Stik Figa', 'Smoke Rings', 'https://www.youtube.com/watch?v=Q5teohMyGEY'),
(5, 'Labyrinth Ear', 'Navy Light', 'http://www.youtube.com/watch?v=a9qKkG7NDu0'),
(6, 'Bon Hiver', 'Wolves (Kill them with Colour Remix)', 'http://www.youtube.com/watch?v=5GXAL5mzmyw'),
(7, 'Detachments', 'Circles (Martyn Remix)', 'http://www.youtube.com/watch?v=UzS7Gvn7jJ0'),
(8, 'Dillon & Dirk von Loetzow', 'Tip Tapping (Live at ZDF Aufnahmezustand)', 'https://www.youtube.com/watch?v=hbrOLsgu000'),
(9, 'Dillon', 'Contact Us (Live at ZDF Aufnahmezustand)', 'https://www.youtube.com/watch?v=E6WqTL2Up3Y'),
(10, 'Tricky', 'Hey Love (Promo Edit)', 'http://www.youtube.com/watch?v=OIsCGdW49OQ'),
(11, 'Compuphonic', 'Sunset feat. Marques Toliver (DJ T. Remix)', 'http://www.youtube.com/watch?v=Ue5ZWSK9r00'),
(12, 'Ludovico Einaudi', 'Divenire (live @ Royal Albert Hall London)', 'http://www.youtube.com/watch?v=X1DRDcGlSsE'),
(13, 'Maxxi Soundsystem', 'Regrets we have no use for (Radio1 Rip)', 'https://soundcloud.com/maxxisoundsystem/maxxi-soundsystem-ft-name-one'),
(14, 'Beirut', 'Nantes (Fredo & Thang Remix)', 'https://www.youtube.com/watch?v=ojV3oMAgGgU'),
(15, 'Buku', 'All Deez', 'http://www.youtube.com/watch?v=R0bN9JRIqig'),
(16, 'Pilocka Krach', 'Wild Pete', 'http://www.youtube.com/watch?v=4wChP_BEJ4s'),
(17, 'Mount Kimbie', 'Here to stray (live at Pitchfork Music Festival Paris)', 'http://www.youtube.com/watch?v=jecgI-zEgIg'),
(18, 'Kool Savas', 'King of Rap (2012) / Ein Wunder', 'http://www.youtube.com/watch?v=mTqc6UTG1eY&hd=1'),
(19, 'Chaim feat. Meital De Razon', 'Love Rehab (Original Mix)', 'http://www.youtube.com/watch?v=MJT1BbNFiGs'),
(20, 'Emika', 'Searching', 'http://www.youtube.com/watch?v=oscuSiHfbwo'),
(21, 'Emika', 'Sing to me', 'http://www.youtube.com/watch?v=k9sDBZm8pgk'),
(22, 'George Fitzgerald', 'Thinking of You', 'http://www.youtube.com/watch?v=-14B8l49iKA'),
(23, 'Disclosure', 'You & Me (Flume Edit)', 'http://www.youtube.com/watch?v=OUkkaqSNduU'),
(24, 'Crystal Castles', 'Doe Deer', 'http://www.youtube.com/watch?v=zop0sWrKJnQ'),
(25, 'Tok Tok vs. Soffy O.', 'Missy Queens Gonna Die', 'http://www.youtube.com/watch?v=EN0Tnw5zy6w'),
(26, 'Fink', 'Maker (Synapson Remix)', 'http://www.youtube.com/watch?v=Dyd-cUkj4Nk'),
(27, 'Flight Facilities (ft. Christine Hoberg)', 'Clair De Lune', 'http://www.youtube.com/watch?v=Jcu1AHaTchM'),
(28, 'Karmon', 'Turning Point (Original Mix)', 'https://www.youtube.com/watch?v=-tB-zyLSPEo'),
(29, 'Shuttle Life', 'The Birds', 'http://www.youtube.com/watch?v=-I3m3cWDEtM'),
(30, 'SantÃ©', 'Homegirl (Rampa Mix)', 'http://www.youtube.com/watch?v=fnhMNOWxLYw');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `UsuarioId` int(255) NOT NULL AUTO_INCREMENT,
  `AplicacaoId` int(255) NOT NULL,
  `Login` varchar(255) COLLATE utf8_bin NOT NULL,
  `Senha` varchar(255) COLLATE utf8_bin NOT NULL,
  `PessoaId` int(255) NOT NULL,
  `Ativo` tinyint(1) NOT NULL DEFAULT '1',
  `Avatar` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`UsuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `Usuario`
--

INSERT INTO `Usuario` (`UsuarioId`, `AplicacaoId`, `Login`, `Senha`, `PessoaId`, `Ativo`, `Avatar`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `UsuarioPerfil`
--

CREATE TABLE IF NOT EXISTS `UsuarioPerfil` (
  `UsuarioPerfilId` int(255) NOT NULL AUTO_INCREMENT,
  `PerfilId` int(255) NOT NULL,
  `UsuarioId` int(255) NOT NULL,
  PRIMARY KEY (`UsuarioPerfilId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `UsuarioPerfil`
--

INSERT INTO `UsuarioPerfil` (`UsuarioPerfilId`, `PerfilId`, `UsuarioId`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Variaveis`
--

CREATE TABLE IF NOT EXISTS `Variaveis` (
  `VariavelId` int(255) NOT NULL AUTO_INCREMENT,
  `AplicacaoId` int(255) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Valor` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`VariavelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
