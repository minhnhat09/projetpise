-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 30 Juin 2019 à 14:20
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ttart`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `pseudo`, `mdp`, `mail`, `statut`) VALUES
(3, 'dsds', 'giÃ df', 'vtgiang2903@gmail.com', 0),
(4, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(5, 'dsd', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(6, 'dsd', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(7, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(8, 'giang', 'psm20162017', 'giang@jfidjf.fr', 0),
(9, 'giang', 'psm20162017', 'giang@jfidjf.fr', 0),
(10, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(11, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(12, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(13, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(14, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(15, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(16, 'giang', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(17, 'toto', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(18, 'tata', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(19, 'titi', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(20, 'test', 'psm20162017', 'vtgiang2903@gmail.com', 0),
(21, 'test100', '29031991', 'test@gmail.com', 0),
(22, 'pise', 'admin', 'vtgiang2903@gmail.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre`
--

CREATE TABLE `oeuvre` (
  `ID_Oeuvre` int(11) NOT NULL,
  `Nom_Oeuvre` varchar(255) NOT NULL,
  `Cat_Oeuvre` text NOT NULL,
  `Taille` varchar(255) NOT NULL,
  `Prix` float NOT NULL,
  `Artiste` text NOT NULL,
  `Img_Oeuvre` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvre`
--

INSERT INTO `oeuvre` (`ID_Oeuvre`, `Nom_Oeuvre`, `Cat_Oeuvre`, `Taille`, `Prix`, `Artiste`, `Img_Oeuvre`) VALUES
(1, 'hfudhfuhd', 'Peinture', '35 x 35 cm', 5, 'Anne Baudequin', 'img/1.jpg'),
(2, 'Fish', 'Peinture', '21 x 24 cm', 15, 'Mike Dupont', 'img/fish.jpg'),
(4, 'Printemps', 'Sculpture', '50 x 50 cm', 50, 'Sophie Mevel', 'img/1.jpg'),
(5, 'test', 'Sculpture', 'test', 100000000, 'test', 'img/1.jpg'),
(6, 'test2', 'Photographie', 'test2', 5000, 'test2', 'img/2.jpg'),
(7, 'Fish', 'Peinture', '21 x 24 cm', 15, 'dhfuqfhudqhfu', 'img/fish.jpg'),
(8, 'Printemps', 'Sculpture', '50 x 50 cm', 50, 'Sophie Mevel', 'img/1.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD PRIMARY KEY (`ID_Oeuvre`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  MODIFY `ID_Oeuvre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
