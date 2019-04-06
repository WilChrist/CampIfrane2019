-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 15 Juillet 2017 à 11:04
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `campdete2017`
--

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `sexe` varchar(10) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `nombre_de_participation` int(3) DEFAULT NULL,
  `type_participant` varchar(15) DEFAULT NULL,
  `theme` varchar(15) DEFAULT NULL,
  `timing` varchar(15) DEFAULT NULL,
  `repos` varchar(15) DEFAULT NULL,
  `louange` varchar(15) DEFAULT NULL,
  `priere` varchar(15) DEFAULT NULL,
  `nourriture` varchar(15) DEFAULT NULL,
  `enseigement` varchar(15) DEFAULT NULL,
  `atelier` varchar(15) DEFAULT NULL,
  `engagement` varchar(15) DEFAULT NULL,
  `aimepas` text,
  `proposition` text,
  `projet` text,
  `organisation` varchar(15) DEFAULT NULL,
  `comission` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evaluation`
--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
