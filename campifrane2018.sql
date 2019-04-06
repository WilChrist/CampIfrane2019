-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 08 avr. 2018 à 16:49
-- Version du serveur :  10.1.25-MariaDB
-- Version de PHP :  7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `campifrane2019`
--

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE `evaluation` (
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
  `telephone` int(11) DEFAULT NULL,
  `plateforme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Participants`
--

CREATE TABLE `Participants` (
  `id` int(3) UNSIGNED NOT NULL,
  `noms_et_prenoms` varchar(250) NOT NULL,
  `villes` varchar(100) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `phone` int(11) NOT NULL,
  `nombre_de_participation` tinyint(4) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `nationalite` varchar(100) NOT NULL,
  `frais_paye` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Participants`
--
ALTER TABLE `Participants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE1` (`email`),
  ADD UNIQUE KEY `UNIQUE2` (`phone`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Participants`
--
ALTER TABLE `Participants`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
