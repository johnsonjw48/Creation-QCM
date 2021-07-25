-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 31 mars 2021 à 11:21
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ilci_qcm`
--

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `statut` set('prof','eleve') NOT NULL,
  `mail` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`,`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `statut`, `mail`, `login`, `mdp`) VALUES
(1, 'Dupond', 'eleve', 'rou07@ddd.df', 'ilci', '$2y$10$wZ6s9mTwRNvua6kZIy8VxewaVguhDjPlsyJM4XYDVd2o/33ykahki'),
(2, 'Tata', 'prof', 'ja@fdfdf.fr', 'ilci2', '$2y$10$9sLILB3Denxa6nXHHddM6egLim5MyS1yFNllFx/02oSW/RNS/chZi');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(40) NOT NULL,
  `question` varchar(60) NOT NULL,
  `auteur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auteur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `theme`, `question`, `auteur`) VALUES
(1, 'test', 'html', 2),
(2, 'informatique', 'Langage de programmation', 2),
(3, 'informatique', 'Javascript ?', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reponse` varchar(50) NOT NULL,
  `marqueur` tinyint(1) NOT NULL,
  `question` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_question` (`question`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `reponse`, `marqueur`, `question`) VALUES
(1, 'br', 1, 1),
(2, 'echo', 0, 1),
(3, 'php', 0, 1),
(4, 'HTML', 0, 2),
(5, 'ORACLE', 0, 2),
(6, 'JAVA', 1, 2),
(7, 'console.log', 1, 3),
(8, 'var_dump', 0, 3),
(9, '<table>', 0, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `personne` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`question`) REFERENCES `question` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
