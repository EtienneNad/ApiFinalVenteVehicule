-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 03 mai 2023 à 20:40
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

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `motdepasse` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `motdepasse`, `cle`) VALUES
(9, 'LewisN12', '$2y$10$yJzq1MKiqBu8zIegwyi4heTCZWmRPzLgGXx02BFYqxbTVhjz3MSwu', 'test_tyWP'),
(10, 'louis', '$2y$10$EWW0JEjiYB3jy.lSKpZebeqYctWKlDVDg8Y9DgNudrt9OFBzocgv6', 'bG91aXNuYWQ='),
(11, 'louis', '$2y$10$RcZmXu/30J9UDw2RZEl2HecAqreiq1UBgY2zJkDOTCW1sFbZ.S/92', 'dXNlcm5hbWU6bG91aXNtb3RkZXBhc3NlOm5hZA=='),
(12, 'lewis', '$2y$10$cMqUi3JYm4t1JoD9pgtBqO5KvFBcM0v67vyeKXy4ZT1PDNDb3WTri', 'dXNlcm5hbWU6bGV3aXNtb3RkZXBhc3NlOmxvdWlz'),
(13, 'lewis', '$2y$10$lAshoNSKa18Dqlt7n9uCo.5uxdUqVr5LnadVuG6mVPQmibwom4TBm', 'dXNlcm5hbWU6bGV3aXNtb3RkZXBhc3NlOmxvdWlz'),
(14, 'lewis', '$2y$10$kO9uFRprC7wIOj1a70LfC.6E/vNyH6XomAJGy8LM.TdK0EAA9GxOW', 'dXNlcm5hbWU6bGV3aXMgbW90ZGVwYXNzZTpsb3Vpcw==');

-- --------------------------------------------------------

--
-- Structure de la table `ventevehicule`
--

CREATE TABLE `ventevehicule` (
  `id` int(11) NOT NULL,
  `marque` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `models` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix` decimal(20,2) NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom_vendeur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `courriel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventevehicule`
--

INSERT INTO `ventevehicule` (`id`, `marque`, `models`, `prix`, `description`, `image_url`, `nom_vendeur`, `adresse`, `ville`, `courriel`, `no_telephone`) VALUES
(2, 'louis', 'nad', '2.75', 'yo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHlv2i6VLOdfvfjCiJ-0-q_ZdaKU54JZAmS6YRpgzMPvrsl-6hgnNohVmuuA&usqp=CAc', 'Étienne Nadeau', '14 rue bélanger', 'lorierville', 'ttot@gmail.com', '819-806-9152'),
(7, 'test', 'tet', '11.34', 'tes', 'https://www.referenseo.com/wp-content/uploads/2019/03/image-attractive.jpg', 'tet', 'tert', 'vi', 'enadeau550@gmail.com', '819-758-8421'),
(8, 'test', 'test', '0.00', 'test', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Test-Logo.svg/783px-Test-Logo.svg.png', 'test', 'test', 'test', 'test@test.ca', '000-000-0000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ventevehicule`
--
ALTER TABLE `ventevehicule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `ventevehicule`
--
ALTER TABLE `ventevehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
