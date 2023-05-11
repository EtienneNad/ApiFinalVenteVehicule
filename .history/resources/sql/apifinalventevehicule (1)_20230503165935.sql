-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 03 mai 2023 à 20:59
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `apifinalventevehicule`
--
CREATE DATABASE IF NOT EXISTS `apifinalventevehicule` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `apifinalventevehicule`;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `motdepasse` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `cle` (`cle`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `motdepasse`, `cle`) VALUES
(1, 'lewis', '$2y$10$1ZM9h2d5zXELTc7/79she.UkJNB/A0jGm673d75TKIaaguuEJS9QS', 'dXNlcm5hbWU6bGV3aXMgbW90ZGVwYXNzZTpsZXdpcw==');

-- --------------------------------------------------------

--
-- Structure de la table `ventevehicule`
--

DROP TABLE IF EXISTS `ventevehicule`;
CREATE TABLE IF NOT EXISTS `ventevehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `models` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix` decimal(20,2) NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom_vendeur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `courriel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventevehicule`
--

INSERT INTO `ventevehicule` (`id`, `marque`, `models`, `prix`, `description`, `image_url`, `nom_vendeur`, `adresse`, `ville`, `courriel`, `no_telephone`) VALUES
(1, 'louis', 'nad', '2.75', 'yo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHlv2i6VLOdfvfjCiJ-0-q_ZdaKU54JZAmS6YRpgzMPvrsl-6hgnNohVmuuA&usqp=CAc', 'Étienne Nadeau', '14 rue bélanger', 'lorierville', 'ttot@gmail.com', '819-806-9152');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
