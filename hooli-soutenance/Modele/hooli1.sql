-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2017 at 06:14 PM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hooli`
--

-- --------------------------------------------------------

--
-- Table structure for table `actionneurs`
--

CREATE TABLE IF NOT EXISTS `actionneurs` (
  `id` int(11) NOT NULL,
  `type` varchar(256) NOT NULL,
  `date_installation` date NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `batterie` int(11) NOT NULL,
  `fonction` varchar(256) NOT NULL,
  `id_pieces` int(11) NOT NULL,
  `id_utilisateurs` int(11) NOT NULL,
  `id_fonction` int(11) NOT NULL,
  `valeur_voulue` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actionneurs`
--

INSERT INTO `actionneurs` (`id`, `type`, `date_installation`, `etat`, `batterie`, `fonction`, `id_pieces`, `id_utilisateurs`, `id_fonction`, `valeur_voulue`) VALUES
(1, 'temperature', '0000-00-00', 0, 0, '', 1, 2, 0, 0),
(2, 'lumiere', '0000-00-00', 0, 0, '', 2, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `capteur`
--

CREATE TABLE IF NOT EXISTS `capteur` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `unite` varchar(255) NOT NULL,
  `date_installation` date NOT NULL,
  `tps_actualisation` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `seuil_critique` int(11) NOT NULL,
  `fonction` int(11) NOT NULL,
  `mode` varchar(256) NOT NULL,
  `id_fonction` int(11) NOT NULL,
  `id_piece` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capteur`
--

INSERT INTO `capteur` (`id`, `type`, `nom`, `numero`, `unite`, `date_installation`, `tps_actualisation`, `debit`, `etat`, `seuil_critique`, `fonction`, `mode`, `id_fonction`, `id_piece`) VALUES
(16, 'Humidite', 'HumiditeSalon', 4, '%', '0000-00-00', 0, 0, 0, 0, 0, '', 0, 0),
(18, 'Lumiere', 'LumiereSalon', 5, '', '0000-00-00', 0, 0, 0, 0, 0, '', 0, 0),
(20, 'Temperature', 'TempSalon', 3, 'C', '0000-00-00', 0, 0, 0, 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `donnee_recue`
--

CREATE TABLE IF NOT EXISTS `donnee_recue` (
  `id` int(11) NOT NULL,
  `trame` int(1) NOT NULL,
  `objet` int(4) NOT NULL,
  `requete` int(1) NOT NULL,
  `type_capteur` int(1) NOT NULL,
  `numero_capteur` int(2) NOT NULL,
  `valeur` varchar(4) NOT NULL,
  `tim` int(4) NOT NULL,
  `chk` int(2) NOT NULL,
  `date_recep` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donnee_recue`
--

INSERT INTO `donnee_recue` (`id`, `trame`, `objet`, `requete`, `type_capteur`, `numero_capteur`, `valeur`, `tim`, `chk`, `date_recep`) VALUES
(1, 1, 2, 1, 4, 1, '0049', 123, 0, '2017-01-01 12:34:56'),
(2, 1, 2, 1, 4, 1, '0048', 124, 0, '2017-01-02 12:34:56'),
(3, 1, 2, 1, 4, 1, '0065', 125, 0, '2017-01-03 12:34:56'),
(4, 1, 2, 1, 4, 1, '0080', 126, 0, '2017-01-04 12:34:56'),
(5, 1, 2, 1, 4, 1, '0075', 127, 0, '2017-01-05 12:34:56'),
(6, 1, 2, 1, 4, 1, '0056', 128, 0, '2017-01-06 12:34:56'),
(7, 1, 2, 1, 4, 1, '0034', 129, 0, '2017-01-07 12:34:56'),
(8, 1, 2, 1, 4, 1, '0051', 130, 0, '2017-01-08 12:34:56'),
(9, 1, 2, 1, 5, 1, '1111', 131, 0, '2017-01-09 10:10:10'),
(10, 1, 2, 1, 5, 1, '0000', 132, 0, '2017-01-09 10:40:35'),
(11, 1, 2, 1, 4, 1, '0049', 133, 0, '2017-01-09 12:34:56'),
(12, 1, 2, 1, 5, 1, '1111', 134, 0, '2017-01-09 18:32:12'),
(13, 1, 2, 1, 5, 1, '0000', 135, 0, '2017-01-09 20:20:07'),
(14, 1, 2, 1, 5, 1, '1111', 136, 0, '2017-01-10 06:35:58'),
(15, 1, 2, 1, 5, 1, '0000', 137, 0, '2017-01-10 06:50:21'),
(16, 1, 2, 1, 5, 1, '1111', 138, 0, '2017-01-10 07:15:56'),
(17, 1, 2, 1, 5, 1, '0000', 139, 0, '2017-01-10 07:20:32'),
(18, 1, 2, 1, 4, 1, '0050', 140, 0, '2017-01-10 12:34:56'),
(19, 1, 2, 1, 5, 1, '1111', 141, 0, '2017-01-10 19:01:45'),
(20, 1, 2, 1, 5, 1, '0000', 142, 0, '2017-01-10 20:22:14'),
(21, 1, 2, 1, 5, 1, '1111', 143, 0, '2017-01-11 06:35:48'),
(22, 1, 2, 1, 5, 1, '0000', 144, 0, '2017-01-11 06:58:10'),
(23, 1, 2, 1, 4, 1, '0060', 145, 0, '2017-01-11 12:34:56'),
(24, 1, 2, 1, 5, 1, '1111', 146, 0, '2017-01-11 19:15:43'),
(25, 1, 2, 1, 5, 1, '0000', 147, 0, '2017-01-11 21:30:14'),
(26, 1, 2, 1, 5, 1, '1111', 148, 0, '2017-01-12 07:25:23'),
(27, 1, 2, 1, 4, 1, '0070', 149, 0, '2017-01-12 12:34:56'),
(28, 1, 2, 1, 5, 1, '0000', 150, 0, '2017-01-12 20:27:19'),
(29, 1, 2, 1, 5, 1, '1111', 151, 0, '2017-01-13 06:35:48'),
(30, 1, 2, 1, 5, 1, '0000', 152, 0, '2017-01-13 06:55:47'),
(31, 1, 2, 1, 4, 1, '0080', 153, 0, '2017-01-13 12:34:56'),
(32, 1, 2, 1, 5, 1, '1111', 154, 0, '2017-01-13 17:15:12'),
(33, 1, 2, 1, 5, 1, '0000', 155, 0, '2017-01-13 19:31:57'),
(34, 1, 1, 1, 3, 1, '0195', 156, 0, '2017-01-14 00:00:00'),
(35, 1, 1, 1, 4, 1, '0047', 157, 0, '2017-01-14 00:11:22'),
(36, 1, 1, 1, 3, 2, '0160', 158, 0, '2017-01-14 00:30:23'),
(37, 1, 1, 1, 3, 1, '0196', 159, 0, '2017-01-14 01:00:00'),
(38, 1, 1, 1, 4, 1, '0047', 160, 0, '2017-01-14 01:11:22'),
(39, 1, 1, 1, 3, 2, '0160', 161, 0, '2017-01-14 01:30:23'),
(40, 1, 1, 1, 3, 1, '0195', 162, 0, '2017-01-14 02:00:00'),
(41, 1, 1, 1, 4, 1, '0048', 163, 0, '2017-01-14 02:11:22'),
(42, 1, 1, 1, 3, 2, '0160', 164, 0, '2017-01-14 02:30:23'),
(43, 1, 1, 1, 3, 1, '0195', 165, 0, '2017-01-14 03:00:00'),
(44, 1, 1, 1, 4, 1, '0047', 166, 0, '2017-01-14 03:11:22'),
(45, 1, 1, 1, 3, 2, '0160', 167, 0, '2017-01-14 03:30:23'),
(46, 1, 1, 1, 3, 1, '0196', 168, 0, '2017-01-14 04:00:00'),
(47, 1, 1, 1, 4, 1, '0047', 169, 0, '2017-01-14 04:11:22'),
(48, 1, 1, 1, 3, 2, '0160', 170, 0, '2017-01-14 04:30:23'),
(49, 1, 1, 1, 3, 1, '0197', 171, 0, '2017-01-14 05:00:00'),
(50, 1, 1, 1, 4, 1, '0049', 172, 0, '2017-01-14 05:11:22'),
(51, 1, 1, 1, 3, 2, '0160', 173, 0, '2017-01-14 05:30:23'),
(52, 1, 1, 1, 3, 1, '0196', 174, 0, '2017-01-14 06:00:00'),
(53, 1, 1, 1, 4, 1, '0051', 175, 0, '2017-01-14 06:11:22'),
(54, 1, 1, 1, 3, 2, '0160', 176, 0, '2017-01-14 06:30:23'),
(55, 1, 1, 1, 3, 1, '0195', 177, 0, '2017-01-14 07:00:00'),
(56, 1, 1, 1, 4, 1, '0050', 178, 0, '2017-01-14 07:11:22'),
(57, 1, 1, 1, 3, 2, '0160', 179, 0, '2017-01-14 07:30:23'),
(58, 1, 1, 1, 3, 1, '0196', 180, 0, '2017-01-14 08:00:00'),
(59, 1, 1, 1, 4, 1, '0050', 181, 0, '2017-01-14 08:11:22'),
(60, 1, 1, 1, 3, 2, '0161', 182, 0, '2017-01-14 08:30:23'),
(61, 1, 2, 1, 5, 1, '1111', 183, 0, '2017-01-14 08:58:01'),
(62, 1, 1, 1, 3, 1, '0196', 184, 0, '2017-01-14 09:00:00'),
(63, 1, 1, 1, 4, 1, '0075', 185, 0, '2017-01-14 09:11:22'),
(64, 1, 1, 1, 3, 2, '0162', 186, 0, '2017-01-14 09:30:23'),
(65, 1, 1, 1, 3, 1, '0173', 187, 0, '2017-01-14 10:00:00'),
(66, 1, 2, 1, 5, 1, '0000', 188, 0, '2017-01-14 10:05:19'),
(67, 1, 1, 1, 4, 1, '0080', 189, 0, '2017-01-14 10:11:22'),
(68, 1, 1, 1, 3, 2, '0163', 190, 0, '2017-01-14 10:30:23'),
(69, 1, 1, 1, 3, 1, '0182', 191, 0, '2017-01-14 11:00:00'),
(70, 1, 1, 1, 4, 1, '0070', 192, 0, '2017-01-14 11:11:22'),
(71, 1, 1, 1, 3, 2, '0164', 193, 0, '2017-01-14 11:30:23'),
(72, 1, 1, 1, 3, 1, '0191', 194, 0, '2017-01-14 12:00:00'),
(73, 1, 1, 1, 4, 1, '0061', 195, 0, '2017-01-14 12:11:22'),
(74, 1, 1, 1, 3, 2, '0165', 196, 0, '2017-01-14 12:30:23'),
(75, 1, 2, 1, 5, 1, '1111', 197, 0, '2017-01-14 12:30:35'),
(76, 1, 2, 1, 4, 1, '0092', 198, 0, '2017-01-14 12:34:56'),
(77, 1, 1, 1, 3, 1, '0193', 199, 0, '2017-01-14 13:00:00'),
(78, 1, 1, 1, 4, 1, '0053', 200, 0, '2017-01-14 13:11:22'),
(79, 1, 2, 1, 5, 1, '0000', 201, 0, '2017-01-14 13:30:18'),
(80, 1, 1, 1, 3, 2, '0165', 202, 0, '2017-01-14 13:30:23'),
(81, 1, 1, 1, 3, 1, '0193', 203, 0, '2017-01-14 14:00:00'),
(82, 1, 1, 1, 4, 1, '0052', 204, 0, '2017-01-14 14:11:22'),
(83, 1, 1, 1, 3, 2, '0165', 205, 0, '2017-01-14 14:30:23'),
(84, 1, 1, 1, 3, 1, '0193', 206, 0, '2017-01-14 15:00:00'),
(85, 1, 1, 1, 4, 1, '0049', 207, 0, '2017-01-14 15:11:22'),
(86, 1, 1, 1, 3, 2, '0158', 208, 0, '2017-01-14 15:30:23'),
(87, 1, 1, 1, 3, 1, '0193', 209, 0, '2017-01-14 16:00:00'),
(88, 1, 1, 1, 4, 1, '0049', 210, 0, '2017-01-14 16:11:22'),
(89, 1, 1, 1, 3, 2, '0163', 211, 0, '2017-01-14 16:30:23'),
(90, 1, 1, 1, 3, 1, '0193', 212, 0, '2017-01-14 17:00:00'),
(91, 1, 1, 1, 4, 1, '0048', 213, 0, '2017-01-14 17:11:22'),
(92, 1, 1, 1, 3, 2, '0172', 214, 0, '2017-01-14 17:30:23'),
(93, 1, 1, 1, 3, 1, '0194', 215, 0, '2017-01-14 18:00:00'),
(94, 1, 1, 1, 4, 1, '0042', 216, 0, '2017-01-14 18:11:22'),
(95, 1, 1, 1, 3, 2, '0175', 217, 0, '2017-01-14 18:30:23'),
(96, 1, 1, 1, 3, 1, '0194', 218, 0, '2017-01-14 19:00:00'),
(97, 1, 1, 1, 4, 1, '0041', 219, 0, '2017-01-14 19:11:22'),
(98, 1, 1, 1, 3, 2, '0179', 220, 0, '2017-01-14 19:30:23'),
(99, 1, 1, 1, 3, 1, '0192', 221, 0, '2017-01-14 20:00:00'),
(100, 1, 1, 1, 4, 1, '0040', 222, 0, '2017-01-14 20:11:22'),
(101, 1, 1, 1, 3, 2, '0179', 223, 0, '2017-01-14 20:30:23'),
(102, 1, 1, 1, 3, 1, '0193', 224, 0, '2017-01-14 21:00:00'),
(103, 1, 2, 1, 5, 1, '1111', 225, 0, '2017-01-14 21:07:09'),
(104, 1, 1, 1, 4, 1, '0040', 226, 0, '2017-01-14 21:11:22'),
(105, 1, 1, 1, 3, 2, '0183', 227, 0, '2017-01-14 21:30:23'),
(106, 1, 1, 1, 3, 1, '0195', 228, 0, '2017-01-14 22:00:00'),
(107, 1, 1, 1, 4, 1, '0040', 229, 0, '2017-01-14 22:11:22'),
(108, 1, 1, 1, 3, 2, '0185', 230, 0, '2017-01-14 22:30:23'),
(109, 1, 1, 1, 3, 1, '0194', 231, 0, '2017-01-14 23:00:00'),
(110, 1, 1, 1, 4, 1, '0041', 232, 0, '2017-01-14 23:11:22'),
(111, 1, 1, 1, 3, 2, '0191', 233, 0, '2017-01-14 23:30:23'),
(112, 1, 1, 1, 3, 1, '0201', 234, 0, '2017-01-15 00:00:00'),
(113, 1, 1, 1, 4, 1, '0042', 235, 0, '2017-01-15 00:11:22'),
(114, 1, 1, 1, 3, 2, '0191', 236, 0, '2017-01-15 00:30:23'),
(115, 1, 1, 1, 3, 1, '0203', 237, 0, '2017-01-15 01:00:00'),
(116, 1, 1, 1, 4, 1, '0092', 238, 0, '2017-01-15 01:11:22'),
(117, 1, 2, 1, 5, 1, '0000', 239, 0, '2017-01-15 01:23:45'),
(118, 1, 1, 1, 3, 2, '0192', 240, 0, '2017-01-15 01:30:23'),
(119, 1, 1, 1, 3, 1, '0199', 241, 0, '2017-01-15 02:00:00'),
(120, 1, 1, 1, 4, 1, '0090', 242, 0, '2017-01-15 02:11:22'),
(121, 1, 1, 1, 3, 2, '0193', 243, 0, '2017-01-15 02:30:23'),
(122, 1, 1, 1, 3, 1, '0197', 244, 0, '2017-01-15 03:00:00'),
(123, 1, 1, 1, 4, 1, '0086', 245, 0, '2017-01-15 03:11:22'),
(124, 1, 1, 1, 3, 2, '0192', 246, 0, '2017-01-15 03:30:23'),
(125, 1, 1, 1, 3, 1, '0196', 247, 0, '2017-01-15 04:00:00'),
(126, 1, 1, 1, 4, 1, '0075', 248, 0, '2017-01-15 04:11:22'),
(127, 1, 1, 1, 3, 2, '0192', 249, 0, '2017-01-15 04:30:23'),
(128, 1, 1, 1, 3, 1, '0195', 250, 0, '2017-01-15 05:00:00'),
(129, 1, 1, 1, 4, 1, '0065', 251, 0, '2017-01-15 05:11:22'),
(130, 1, 1, 1, 3, 2, '0192', 252, 0, '2017-01-15 05:30:23'),
(131, 1, 1, 1, 3, 1, '0194', 253, 0, '2017-01-15 06:00:00'),
(132, 1, 1, 1, 4, 1, '0060', 254, 0, '2017-01-15 06:11:22'),
(133, 1, 1, 1, 3, 2, '0192', 255, 0, '2017-01-15 06:30:23'),
(134, 1, 1, 1, 3, 1, '0194', 256, 0, '2017-01-15 07:00:00'),
(135, 1, 1, 1, 4, 1, '0058', 257, 0, '2017-01-15 07:11:22'),
(136, 1, 1, 1, 3, 2, '0193', 258, 0, '2017-01-15 07:30:23'),
(137, 1, 1, 1, 3, 1, '0194', 259, 0, '2017-01-15 08:00:00'),
(138, 1, 1, 1, 4, 1, '0057', 260, 0, '2017-01-15 08:11:22'),
(139, 1, 1, 1, 3, 2, '0193', 261, 0, '2017-01-15 08:30:23'),
(140, 1, 1, 1, 3, 1, '0193', 262, 0, '2017-01-15 09:00:00'),
(141, 1, 1, 1, 4, 1, '0057', 263, 0, '2017-01-15 09:11:22'),
(142, 1, 1, 1, 3, 2, '0194', 264, 0, '2017-01-15 09:30:23'),
(143, 1, 1, 1, 3, 1, '0194', 265, 0, '2017-01-15 10:00:00'),
(144, 1, 1, 1, 4, 1, '0058', 266, 0, '2017-01-15 10:11:22'),
(145, 1, 1, 1, 3, 2, '0192', 267, 0, '2017-01-15 10:30:23'),
(146, 1, 1, 1, 3, 1, '0194', 268, 0, '2017-01-15 11:00:00'),
(147, 1, 1, 1, 4, 1, '0069', 269, 0, '2017-01-15 11:11:22'),
(148, 1, 1, 1, 3, 2, '0173', 270, 0, '2017-01-15 11:30:23'),
(149, 1, 2, 1, 5, 1, '1111', 271, 0, '2017-01-15 11:48:15'),
(150, 1, 1, 1, 3, 1, '0163', 272, 0, '2017-01-15 12:00:00'),
(151, 1, 1, 1, 4, 1, '0070', 273, 0, '2017-01-15 12:11:22'),
(152, 1, 1, 1, 3, 2, '0181', 274, 0, '2017-01-15 12:30:23'),
(153, 1, 2, 1, 4, 1, '0075', 275, 0, '2017-01-15 12:34:56'),
(154, 1, 1, 1, 3, 1, '0175', 276, 0, '2017-01-15 13:00:00'),
(155, 1, 1, 1, 4, 1, '0050', 277, 0, '2017-01-15 13:11:22'),
(156, 1, 2, 1, 5, 1, '0000', 278, 0, '2017-01-15 13:15:17'),
(157, 1, 1, 1, 3, 2, '0183', 279, 0, '2017-01-15 13:30:23'),
(158, 1, 1, 1, 3, 1, '0188', 280, 0, '2017-01-15 14:00:00'),
(159, 1, 1, 1, 4, 1, '0049', 281, 0, '2017-01-15 14:11:22'),
(160, 1, 1, 1, 3, 2, '0192', 282, 0, '2017-01-15 14:30:23'),
(161, 1, 1, 1, 3, 1, '0193', 283, 0, '2017-01-15 15:00:00'),
(162, 1, 1, 1, 4, 1, '0051', 284, 0, '2017-01-15 15:11:22'),
(163, 1, 1, 1, 3, 2, '0191', 285, 0, '2017-01-15 15:30:23'),
(164, 1, 1, 1, 3, 1, '0194', 286, 0, '2017-01-15 16:00:00'),
(165, 1, 1, 1, 4, 1, '0053', 287, 0, '2017-01-15 16:11:22'),
(166, 1, 1, 1, 3, 2, '0170', 288, 0, '2017-01-15 16:30:23'),
(167, 1, 1, 1, 3, 1, '0193', 289, 0, '2017-01-15 17:00:00'),
(168, 1, 1, 1, 4, 1, '0052', 290, 0, '2017-01-15 17:11:22'),
(169, 1, 1, 1, 3, 2, '0168', 291, 0, '2017-01-15 17:30:23'),
(170, 1, 1, 1, 3, 1, '0193', 292, 0, '2017-01-15 18:00:00'),
(171, 1, 1, 1, 4, 1, '0050', 293, 0, '2017-01-15 18:11:22'),
(172, 1, 1, 1, 3, 2, '0163', 294, 0, '2017-01-15 18:30:23'),
(173, 1, 1, 1, 3, 1, '0193', 295, 0, '2017-01-15 19:00:00'),
(174, 1, 1, 1, 4, 1, '0051', 296, 0, '2017-01-15 19:11:22'),
(175, 1, 2, 1, 5, 1, '1111', 297, 0, '2017-01-15 19:19:19'),
(176, 1, 1, 1, 3, 2, '0162', 298, 0, '2017-01-15 19:30:23'),
(177, 1, 1, 1, 3, 1, '0189', 299, 0, '2017-01-15 20:00:00'),
(178, 1, 1, 1, 4, 1, '0051', 300, 0, '2017-01-15 20:11:22'),
(179, 1, 1, 1, 3, 2, '0162', 301, 0, '2017-01-15 20:30:23'),
(180, 1, 2, 1, 5, 1, '0000', 302, 0, '2017-01-15 20:31:18'),
(181, 1, 1, 1, 3, 1, '0193', 303, 0, '2017-01-15 21:00:00'),
(182, 1, 1, 1, 4, 1, '0049', 304, 0, '2017-01-15 21:11:22'),
(183, 1, 1, 1, 3, 2, '0161', 305, 0, '2017-01-15 21:30:23'),
(184, 1, 1, 1, 3, 1, '0193', 306, 0, '2017-01-15 22:00:00'),
(185, 1, 1, 1, 4, 1, '0050', 307, 0, '2017-01-15 22:11:22'),
(186, 1, 1, 1, 3, 2, '0161', 308, 0, '2017-01-15 22:30:23'),
(187, 1, 1, 1, 3, 1, '0194', 309, 0, '2017-01-15 23:00:00'),
(188, 1, 1, 1, 4, 1, '0051', 310, 0, '2017-01-15 23:11:22'),
(189, 1, 1, 1, 3, 2, '0160', 311, 0, '2017-01-15 23:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE IF NOT EXISTS `fonction` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maison`
--

CREATE TABLE IF NOT EXISTS `maison` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_pieces` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modes`
--

CREATE TABLE IF NOT EXISTS `modes` (
  `id` int(11) NOT NULL,
  `id_utilisateurs` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_piece_1` int(11) NOT NULL,
  `id_piece_2` int(11) NOT NULL,
  `id_piece_3` int(11) NOT NULL,
  `id_piece_4` int(11) NOT NULL,
  `id_piece_5` int(11) NOT NULL,
  `temperature` int(11) NOT NULL,
  `lumiere` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modes`
--

INSERT INTO `modes` (`id`, `id_utilisateurs`, `nom`, `id_piece_1`, `id_piece_2`, `id_piece_3`, `id_piece_4`, `id_piece_5`, `temperature`, `lumiere`) VALUES
(1, 2, 'Jour', 1, 4, 0, 0, 0, 16, 1),
(2, 2, 'Nuit', 1, 3, 0, 0, 0, 12, 0),
(3, 2, 'economie', 2, 4, 3, 0, 0, 12, 1),
(4, 80, 'Test1', 0, 0, 0, 0, 0, 15, 0),
(5, 80, 'Test2', 0, 0, 0, 0, 0, 95, 1),
(6, 80, 'erthj', 0, 0, 0, 0, 0, 15, 0),
(8, 2, 'Test', 0, 0, 0, 0, 0, 35, 0),
(9, 2, 'Vacances', 0, 0, 0, 0, 0, 95, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pieces`
--

CREATE TABLE IF NOT EXISTS `pieces` (
  `id` int(11) NOT NULL,
  `id_utilisateurs` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pieces`
--

INSERT INTO `pieces` (`id`, `id_utilisateurs`, `nom`) VALUES
(1, 2, 'Salon'),
(2, 2, 'Salle de bain'),
(3, 2, 'Cuisine'),
(4, 2, 'Chambre'),
(5, 80, 'Salon'),
(6, 80, 'Chambre');

-- --------------------------------------------------------

--
-- Table structure for table `table_option`
--

CREATE TABLE IF NOT EXISTS `table_option` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `valeur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `rue` varchar(255) NOT NULL,
  `numero_rue` int(11) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `typecompte` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `nom`, `prenom`, `date_naissance`, `rue`, `numero_rue`, `ville`, `code_postal`, `telephone`, `mail`, `password`, `typecompte`) VALUES
(2, 'isep', 'ndc', 'ndl', '1141-12-11', 'isep', 28, 'paris', 75006, '0101010101', 'tutu@free.fr', '827ccb0eea8a706c4c34a16891f84e7b', 'membre'),
(79, 'elise29854', 'papa', 'Miss', '1141-12-11', 'rue', 1, 'Tro', 55, '01', 'admin@hooli.fr', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(80, 'yingru', 'Chan', 'Yingru', '1996-09-15', 'Avenue ISEP', 1, 'Paris', 75000, '0124635978', 'yingru@free.fr', '827ccb0eea8a706c4c34a16891f84e7b', 'membre'),
(81, 'backup', '', '', '0000-00-00', '', 0, '', 0, '', 'backup@free.fr', '827ccb0eea8a706c4c34a16891f84e7b', 'membre');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actionneurs`
--
ALTER TABLE `actionneurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capteur`
--
ALTER TABLE `capteur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donnee_recue`
--
ALTER TABLE `donnee_recue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maison`
--
ALTER TABLE `maison`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indexes for table `modes`
--
ALTER TABLE `modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pieces`
--
ALTER TABLE `pieces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_option`
--
ALTER TABLE `table_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actionneurs`
--
ALTER TABLE `actionneurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `capteur`
--
ALTER TABLE `capteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `donnee_recue`
--
ALTER TABLE `donnee_recue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maison`
--
ALTER TABLE `maison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modes`
--
ALTER TABLE `modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pieces`
--
ALTER TABLE `pieces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `table_option`
--
ALTER TABLE `table_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;