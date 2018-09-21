-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 18 Septembre 2018 à 20:16
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `parking`
--

-- --------------------------------------------------------

--
-- Structure de la table `attente`
--

CREATE TABLE IF NOT EXISTS `attente` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id Attente',
  `date` date NOT NULL COMMENT 'date attente',
  `id_pe` int(11) unsigned NOT NULL COMMENT 'id Personne',
  PRIMARY KEY (`id`),
  KEY `fk_pe` (`id_pe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Personne',
  `nom` varchar(255) NOT NULL COMMENT 'nom',
  `prenom` varchar(255) NOT NULL COMMENT 'prenom',
  `mail` varchar(255) NOT NULL COMMENT 'mail',
  `password` varchar(30) DEFAULT NULL COMMENT 'mot de passe',
  `statut` int(11) unsigned NOT NULL COMMENT 'statut',
  PRIMARY KEY (`id`),
  KEY `fk_st` (`statut`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `prenom`, `mail`, `password`, `statut`) VALUES
(1, 'BOUNABI', 'Arslane', 'arslanebounabi@hotmail.fr', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(4) NOT NULL,
  `etage` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id_pe` int(11) unsigned NOT NULL,
  `id_pl` int(11) unsigned NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id_pe`,`id_pl`),
  KEY `fk_pl_res` (`id_pl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE IF NOT EXISTS `statut` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Statut',
  `libelle` varchar(255) NOT NULL COMMENT 'libelle',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`id`, `libelle`) VALUES
(1, 'Non inscrit');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `attente`
--
ALTER TABLE `attente`
  ADD CONSTRAINT `fk_pe` FOREIGN KEY (`id_pe`) REFERENCES `personne` (`id`);

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `fk_st` FOREIGN KEY (`statut`) REFERENCES `statut` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_pe_res` FOREIGN KEY (`id_pe`) REFERENCES `personne` (`id`),
  ADD CONSTRAINT `fk_pl_res` FOREIGN KEY (`id_pl`) REFERENCES `place` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
