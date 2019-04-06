-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Mar 11 Juillet 2017 à 18:28
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `campdete2017`
--

-- --------------------------------------------------------

--
-- Structure de la table `Participants`
--

CREATE TABLE IF NOT EXISTS `Participants` (
  `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `noms_et_prenoms` varchar(250) NOT NULL,
  `villes` varchar(100) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `phone` int(11) NOT NULL,
  `nombre_de_participation` tinyint(4) NOT NULL,
  `date_inscription` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE1` (`email`),
  UNIQUE KEY `UNIQUE2` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Participants` ADD `nationalite` VARCHAR(100) NOT NULL AFTER `date_inscription`; 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
