-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 04:24 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `donationsdesk`
--
CREATE DATABASE IF NOT EXISTS `DonationsDesk` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `DonationsDesk`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `Accounts`;
CREATE TABLE IF NOT EXISTS `Accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` int(1) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `username` text NOT NULL,
  `password` text NOT NULL,
  `first-name` tinytext NOT NULL,
  `last-name` tinytext NOT NULL,
  `email` varchar(256) NOT NULL,
  `email_code` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `Accounts` (`id`, `role`, `active`, `username`, `password`, `first-name`, `last-name`, `email`, `email_code`) VALUES
(1, 1, 1, 'Administrador', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ismael', 'Ortiz', 'iortiz@asesoresfinancierospr.org ', ''),
(2, 0, 0, 'User', '5f4dcc3b5aa765d61d8327deb882cf99', 'Some', 'User', 'someone@hotmail.com', ''),
(3, 0, 0, 'jorge.pabon', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jorge', 'Pabon', 'pianistapr@hotmail.com', 'f3f5ffa3ad8918e8ea9e741473f1e1df');

-- --------------------------------------------------------

--
-- Table structure for table `campaign-donations`
--

DROP TABLE IF EXISTS `Campaign-Donations`;
CREATE TABLE IF NOT EXISTS `Campaign-Donations` (
  `camp-id` double NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `donor-email` text NOT NULL,
  `donor-name` text,
  `transaction-id` text NOT NULL,
  `receiver` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campaign-donations`
--

INSERT INTO `Campaign-Donations` (`camp-id`, `amount`, `date`, `donor-email`, `donor-name`, `transaction-id`, `receiver`) VALUES
(11, 1.7, '2014-11-07', 'ilich84@gmail.com', 'SandboxTest Account', '4DP32191H8681045F', 'pianistapr@hotmail.com'),
(10, 5, '2014-10-19', 'pianistapr@hotmail.com', 'Envia Dinero', '86702469LC715633R', 'pianistapr@hotmail.com'),
(10, 25, '2014-10-19', 'pianistapr@hotmail.com', 'Envia Dinero', '6FS44881X1224772Y', 'pianistapr@hotmail.com'),
(10, 14, '2014-10-20', 'pianistapr@hotmail.com', 'Envia Dinero', '444672135S0715050', 'pianistapr@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `Campaigns`;
CREATE TABLE IF NOT EXISTS `Campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign-logo` varchar(200) NOT NULL DEFAULT 'uploads/campaign-logos/0.png',
  `username` text,
  `goal` double NOT NULL DEFAULT '0',
  `donated` double NOT NULL DEFAULT '0',
  `end` date NOT NULL,
  `info` text NOT NULL,
  `category` text NOT NULL,
  `paypal` varchar(200) NOT NULL DEFAULT 'pianistapr@hotmail.com',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `Campaigns` (`id`, `campaign-logo`, `username`, `goal`, `donated`, `end`, `info`, `category`, `paypal`) VALUES
(20, 'uploads/campaign-logos/money.png', 'test', 50, 25, '2025-10-27', 'Campaign to test changes.', 'Economic Development', 'pianistapr@hotmail.com'),
(14, 'uploads/campaign-logos/baseball.png', 'test', 150, 148, '2025-12-31', 'Another Sport campaign.', 'Children', 'pianistapr@hotmail.com'),
(12, 'uploads/campaign-logos/basket.png', 'test', 50, 150, '2024-12-25', 'A Sport campaign', 'Sports', 'pianistapr@hotmail.com'),
(13, 'uploads/campaign-logos/NSA.jpg', 'test', 15000, 13, '2024-10-31', 'Support the Federal Government to secure the freedoms that we enjoy.  This is a test campaign that will likely exceed the amount of space available in the tile that is shown in the Campaigns section of the website.', 'Federal', 'pianistapr@hotmail.com'),
(10, 'uploads/campaign-logos/pc.png', 'test', 2000, 72, '2026-10-25', 'A Technology Campaign.', 'Technology', 'pianistapr@hotmail.com'),
(11, 'uploads/campaign-logos/DE.jpg', 'test', 150, 1.7, '2026-12-05', 'An Educational campaign.', 'Education', 'pianistapr@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `fbadmins`
--

DROP TABLE IF EXISTS `FBAdmins`;
CREATE TABLE IF NOT EXISTS `FBAdmins` (
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fbadmins`
--

INSERT INTO `FBAdmins` (`name`) VALUES
('553471953');

-- --------------------------------------------------------

--
-- Table structure for table `osfl`
--

DROP TABLE IF EXISTS `OSFL`;
CREATE TABLE IF NOT EXISTS `OSFL` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `contact-first` tinytext NOT NULL,
  `contact-last` tinytext NOT NULL,
  `contact-email` tinytext NOT NULL,
  `phone` tinytext NOT NULL,
  `bank-account` tinytext,
  `paypal` tinytext,
  `organization-name` text NOT NULL,
  `logo` varchar(200) NOT NULL DEFAULT 'uploads/logos/0.png',
  `physical-address` text NOT NULL,
  `postal-address` text NOT NULL,
  `municipality` tinytext NOT NULL,
  `zip` tinytext NOT NULL,
  `inc-date` date NOT NULL,
  `pic1` varchar(200) NOT NULL DEFAULT 'uploads/pictures/0.png',
  `pic2` varchar(200) NOT NULL DEFAULT 'uploads/pictures/0.png',
  `pic3` varchar(200) NOT NULL DEFAULT 'uploads/pictures/0.png',
  `foundations` text,
  `category` text NOT NULL,
  `vision` text NOT NULL,
  `mission` text NOT NULL,
  `services` text NOT NULL,
  `projections` text,
  `target` text NOT NULL,
  `impact` tinytext NOT NULL,
  `website` text,
  `youtube` text,
  `facebook` text,
  `gps` text,
  `twitter` text,
  `good-standing` varchar(200) NOT NULL DEFAULT 'uploads/documents/0.pdf',
  `state-inscription` varchar(200) NOT NULL DEFAULT 'uploads/documents/0.pdf',
  `essn` tinytext NOT NULL,
  `990` varchar(200) NOT NULL DEFAULT 'uploads/documents/0.pdf',
  `audit` varchar(200) NOT NULL DEFAULT 'uploads/documents/0.pdf',
  `state-exemption` varchar(200) NOT NULL DEFAULT 'uploads/documents/0.pdf',
  `federal-exemption` varchar(200) NOT NULL DEFAULT 'uploads/documents/0.pdf',
  `active` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `osfl`
--

INSERT INTO `OSFL` (`id`, `username`, `contact-first`, `contact-last`, `contact-email`, `phone`, `bank-account`, `paypal`, `organization-name`, `logo`, `physical-address`, `postal-address`, `municipality`, `zip`, `inc-date`, `pic1`, `pic2`, `pic3`, `foundations`, `category`, `vision`, `mission`, `services`, `projections`, `target`, `impact`, `website`, `youtube`, `facebook`, `gps`, `twitter`, `good-standing`, `state-inscription`, `essn`, `990`, `audit`, `state-exemption`, `federal-exemption`, `active`, `rating`) VALUES
(1, 'logos', 'Someone', 'Helpful', 'info@domain.com', '787-746-3845', 'First Bank #1104526584', 'pianistapr@hotmail.com', 'Academia Cristiana Logos de Yaveh', 'uploads/logos/1.png', 'Carretera de Caguas a San Lorenzo\n#183 José Mercado, Calle Washington\nV-37 Km 1.5', 'PO BOX 1234', 'Caguas', '00726', '2001-11-12', 'uploads/pictures/Office1.jpg', 'uploads/pictures/Office2.jpg', 'uploads/pictures/Office3.jpg', 'Fundación Angel Ramos', 'Education', 'La visión educativa es de estimular la creatividad innata en los estudiantes y se expresen creativamente a través del arte, la música y el lenguaje.', 'La misión es de proveer a niños y niñas un ambiente de aprendizaje, rico en experiencias cognoscitivas, socio-emocionales, espirituales y sicomotoras.', '', '', 'Children', '', 'https://localhost', 'https://localhost', 'http://www.facebook.com/iclogoscaguas', '18.223043,-66.016995', 'https://localhost', 'uploads/documents/0.pdf', 'uploads/documents/0.pdf', '00-0000000', 'uploads/documents/0.pdf', 'uploads/documents/0.pdf', 'uploads/documents/0.pdf', 'uploads/documents/0.pdf', 1, 5),
(2, 'aasmc', 'Someone', 'Helpful', 'info@domain.com', '787-780-5770', 'Banco Popular #1204526584', 'pianistapr@hotmail.com', 'Academia Santa Maria del Camino', 'uploads/logos/2.gif', '9R3H + W2X, Calle Esteban Cruz', 'PO BOX 1234', 'Bayamón', '00956', '1995-01-01', 'uploads/pictures/Office1.jpg', 'uploads/pictures/Office2.jpg', 'uploads/pictures/Office3.jpg', 'Fondos Unidos', 'Education', '', 'Centro educativo con filosofía religiosa, encaminada a mantener la excelencia académica y la catolicidad genuina en nuestra comunidad como principal objetivo. Tiene como prioridad ayudar al niño, así como al adolescente en todas las áreas de crecimiento, fomentando los valores positivos y el desarrollo de los mega conceptos de la fe (Vida, Amor, Justicia y Paz) que nos ayudan en su crecimiento integral.', '', NULL, 'Children', '', 'https://localhost', 'https://localhost', 'https://localhost', NULL, 'https://localhost', 'uploads/documents/test.pdf', 'uploads/documents/0.pdf', '', 'uploads/documents/test-1.pdf', 'uploads/documents/test-2.pdf', 'uploads/documents/test-3.pdf', 'uploads/documents/test-4.pdf', 1, 5),
(3, 'culebra', 'Someone', 'Helpful', '', '787-742-0259', NULL, NULL, 'Asociación Educativa Pro desarrollo Humano Culebra, Inc.', 'uploads/logos/4.jpg', 'Calle Escudero #93', 'PO BOX 1234', 'Culebra', '00775', '1995-01-01', 'uploads/pictures/Office1.jpg', 'uploads/pictures/Office2.jpg', 'uploads/pictures/Office3.jpg', 'Fundación Banco Popular', 'Education', '', 'Serve children with special needs in the community. Provide these services and specialists for children with various conditions.', '', NULL, '', '', 'https://localhost', 'https://localhost', 'https://localhost', NULL, 'https://localhost', 'uploads/documents/test.pdf', 'uploads/documents/0.pdf', '', 'uploads/documents/test-1.pdf', 'uploads/documents/test-2.pdf', 'uploads/documents/test-3.pdf', 'uploads/documents/test-4.pdf', 1, 3),
(4, 'aspr', 'Someone', 'Helpful', 'info@domain.com', '787-273-1878', NULL, NULL, 'Accion Social Puerto Rico', 'uploads/logos/3.jpg', 'Carr 19 Km 0.3 \n\nBo.Monacillos', 'PO BOX 1234', 'San Juan', '00926', '1982-01-01', 'uploads/pictures/Office1.jpg', 'uploads/pictures/Office2.jpg', 'uploads/pictures/Office3.jpg', 'Fundación Banco Popular,Fondos Unidos', 'Humanitarian Aid', '', 'Acción Social promueve, educa y mejora la calidad de vida de personas con escasos recursos economicos, sociales y de salud a través de sus Programas Innovadores.', '', NULL, '', '', 'https://localhost', 'https://localhost', 'https://localhost', NULL, 'https://localhost', 'uploads/documents/test.pdf', 'uploads/documents/0.pdf', '', 'uploads/documents/test-1.pdf', 'uploads/documents/test-2.pdf', 'uploads/documents/test-3.pdf', 'uploads/documents/test-4.pdf', 1, 4),
(5, 'test', 'Lyan', 'Lugo', 'info@domain.com', '787-550-4449', 'Banco Santander de PR\r\nAcct # 0123456789', 'pianistapr@hotmail.com', 'Acres, Inc.', 'uploads/logos/5.png', 'Carr Desconocida Km 0.5 Bo. Desconocido', 'PO BOX 1234', 'San Juan', '00926', '2014-04-05', 'uploads/pictures/Office1.jpg', 'uploads/pictures/Office2.jpg', 'uploads/pictures/Office3.jpg', 'Fundación Angel Ramos', 'Human Rights', 'Una Vision de prueba.', 'Una Mision de Embuste.', 'Algunos Servicios Provistos.', 'Conquistar el mundo.', 'Micro-enterprises', '1-10', 'http://www.facebook.com/jlpcpr', 'https://www.youtube.com/channel/UCouU8cN72qgAaoQMME8B9ow', 'http://www.facebook.com/jlpcpr', '18.349491,-66.138658', 'http://twitter.com/PianistaPR', 'uploads/documents/TEST-14.pdf', 'uploads/documents/0.pdf', '', 'uploads/documents/0.pdf', 'uploads/documents/0.pdf', 'uploads/documents/0.pdf', 'uploads/documents/0.pdf', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `osfl-donations`
--

DROP TABLE IF EXISTS `OSFL-Donations`;
CREATE TABLE IF NOT EXISTS `OSFL-Donations` (
  `org-id` double NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `donor-email` text NOT NULL,
  `donor-name` text,
  `transaction-id` text NOT NULL,
  `receiver` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `osfl-donations`
--

INSERT INTO `OSFL-Donations` (`org-id`, `amount`, `date`, `donor-email`, `donor-name`, `transaction-id`, `receiver`) VALUES
(5, 3, '2014-10-19', 'pianistapr@hotmail.com', 'Envia Dinero', '2G529783LH011161D', 'pianistapr@hotmail.com'),
(5, 42, '2014-10-19', 'pianistapr@hotmail.com', 'Envia Dinero', '26A53615WS791804C', 'pianistapr@hotmail.com'),
(5, 12, '2014-10-19', 'pianistapr@hotmail.com', 'Envia Dinero', '3B649298WX2451056', 'pianistapr@hotmail.com'),
(5, 1.7, '2014-11-07', 'ilich84@gmail.com', 'SandboxTest Account', '330349245F0483053', 'webjmps@outlook.com'),
(1, 25, '2014-10-19', 'pianistapr@hotmail.com', 'Envia Dinero', '68T97769NG104482A', 'info@colegiosdepr.com'),
(5, 234, '2014-10-19', 'pianistapr@hotmail.com', 'Envia Dinero', '87187557B58815443', 'pianistapr@hotmail.com'),
(5, 250, '2014-10-19', 'pianistapr@hotmail.com', 'Envia Dinero', '14576311HJ484120A', 'pianistapr@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `Ratings`;
CREATE TABLE IF NOT EXISTS `Ratings` (
  `id` int(11) NOT NULL DEFAULT '0',
  `r1` int(11) NOT NULL DEFAULT '0',
  `r2` int(11) NOT NULL DEFAULT '0',
  `r3` int(11) NOT NULL DEFAULT '0',
  `r4` int(11) NOT NULL DEFAULT '0',
  `r5` int(11) NOT NULL DEFAULT '0',
  `r6` int(11) NOT NULL DEFAULT '0',
  `r7` int(11) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `email` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings`
--

INSERT INTO `Ratings` (`id`, `r1`, `r2`, `r3`, `r4`, `r5`, `r6`, `r7`, `name`, `email`) VALUES
(1, 5, 4, 3, 4, 5, 4, 3, 'Diana Perez', 'diana.perez@domain.com'),
(2, 3, 4, 3, 4, 3, 4, 3, 'Someboody Somewhere', 'someboody.somewhere@domain.com'),
(3, 4, 4, 4, 4, 1, 4, 2, 'Daniela Romo', 'daniela.romo@domain.com'),
(4, 2, 3, 2, 4, 3, 5, 1, 'Edgar Vivar', 'edgar.vivar@domain.com'),
(5, 5, 5, 5, 5, 5, 5, 5, 'Ricky Martin', 'ricky.martin@domain.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
