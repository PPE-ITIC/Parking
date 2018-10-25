-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 25 Octobre 2018 à 14:44
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `attente`
--

INSERT INTO `attente` (`id`, `date`, `id_pe`) VALUES
(1, '2018-10-17', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Personne',
  `nom` varchar(255) NOT NULL COMMENT 'nom',
  `prenom` varchar(255) NOT NULL COMMENT 'prenom',
  `mail` varchar(255) NOT NULL COMMENT 'mail',
  `password` varchar(255) DEFAULT NULL COMMENT 'mot de passe',
  `is_admin` tinyint(1) NOT NULL,
  `id_s` int(11) unsigned NOT NULL COMMENT 'statut',
  PRIMARY KEY (`id`),
  KEY `fk_st` (`id_s`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `prenom`, `mail`, `password`, `is_admin`, `id_s`) VALUES
(1, 'BOUNABI', 'Arslane', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 3),
(2, 'ERARD-SANKA', 'StÃ©phane', 'stephane.erard@free.fr', '05d1e1c4d9c3b9e59424e2e572b4cfbe3e23b65a', 0, 3),
(3, 'ERARD-SANKA', 'Bob', 'bob.erard@free.fr', '7c3bd49c77a8eb43725a44c60c595c9181b6b084', 0, 2),
(4, 'ERARD-SANKA', 'Etienne', 'etienne.erard@free.fr', '7c3bd49c77a8eb43725a44c60c595c9181b6b084', 0, 2),
(5, 'ERARD-SANKA', 'Marina', 'marina.erard@free.fr', '05d1e1c4d9c3b9e59424e2e572b4cfbe3e23b65a', 0, 3),
(6, 'ERARD-SANKA', 'Shayna', 'shayna.erard@free.fr', '7c3bd49c77a8eb43725a44c60c595c9181b6b084', 0, 2),
(7, 'ERARD', 'Romain', 'romain.erard@free.fr', '05d1e1c4d9c3b9e59424e2e572b4cfbe3e23b65a', 0, 6),
(8, 'ERARD', 'Florent', 'florent.erard@free.fr', '05d1e1c4d9c3b9e59424e2e572b4cfbe3e23b65a', 0, 6),
(9, 'ERARD', 'Carole', 'carole.erard@free.fr', NULL, 0, 1),
(10, 'ERARD', 'Jean', 'jean.erard@free.fr', NULL, 0, 1),
(11, 'ERARD', 'Marie', 'marie.erard@free.fr', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(4) NOT NULL,
  `etage` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `place`
--

INSERT INTO `place` (`id`, `numero`, `etage`) VALUES
(1, '1A', 1),
(2, '1B', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `id_pe` int(11) unsigned NOT NULL,
  `id_pl` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pe` (`id_pe`),
  KEY `id_pl` (`id_pl`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`id`, `date_debut`, `date_fin`, `id_pe`, `id_pl`) VALUES
(1, '2018-10-01', '2018-10-05', 1, 1),
(2, '2018-10-08', '2018-10-11', 1, 2),
(3, '2018-10-08', '2018-10-11', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE IF NOT EXISTS `statut` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Statut',
  `libelle` varchar(255) NOT NULL COMMENT 'libelle',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`id`, `libelle`) VALUES
(1, 'Non inscrit'),
(2, 'Inscrit non validÃ©'),
(3, 'Inscrit validÃ©'),
(4, 'En attente de place'),
(5, 'PossÃ«de une place'),
(6, 'Inscription refusÃ©e');

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
  ADD CONSTRAINT `fk_st` FOREIGN KEY (`id_s`) REFERENCES `statut` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_pers_res` FOREIGN KEY (`id_pe`) REFERENCES `personne` (`id`),
  ADD CONSTRAINT `fk_place_res` FOREIGN KEY (`id_pl`) REFERENCES `place` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
