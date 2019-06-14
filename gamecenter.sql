-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  ven. 14 juin 2019 à 13:10
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gamecenter`
--

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `games_ID` int(10) UNSIGNED NOT NULL,
  `games_name` varchar(48) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `games_year` smallint(5) UNSIGNED NOT NULL,
  `games_description` text NOT NULL,
  `games_genre_ID` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`games_ID`, `games_name`, `games_year`, `games_description`, `games_genre_ID`) VALUES
(1, 'Le retour de la vengeance de Popeye', 1985, 'Un super jeu où Popeye mange encore plus d\'épinards !!', 1),
(2, 'Les poneys de l\'espace', 1995, 'Un jeu où il faut gérer un empire galactique de poneys.', 2),
(3, 'Pong', 2002, 'La boule elle rebondit.', 3),
(4, 'Zelda IV', 2012, 'Il faut sauver la princesse.', 2),
(5, 'Zorro', 1996, 'Il est arrivé\" !!! Sans se presser.', 1),
(6, 'Baldur\'s Gate', 1995, 'Un jeu d\'aventure trop bien.', 1),
(8, 'The Hobbit', 1984, 'Un de mes premiers jeux', 1),
(11, 'WoW', 2002, 'Le meuporgue le plus connu du monde.', 11);

-- --------------------------------------------------------

--
-- Structure de la table `games_plateformes`
--

CREATE TABLE `games_plateformes` (
  `games_plateformes_games_ID` int(10) UNSIGNED NOT NULL,
  `games_plateformes_plateformes_ID` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `games_plateformes`
--

INSERT INTO `games_plateformes` (`games_plateformes_games_ID`, `games_plateformes_plateformes_ID`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 1),
(4, 1),
(4, 2),
(4, 3),
(5, 2),
(6, 1),
(6, 3),
(8, 4),
(11, 1),
(11, 2);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `genre_ID` tinyint(3) UNSIGNED NOT NULL,
  `genre_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `genre_description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`genre_ID`, `genre_name`, `genre_description`) VALUES
(1, 'Aventure', 'C\'est l\'aventure !'),
(2, 'Stratégie', 'C\'est un genre où il faut réfléchir.'),
(3, 'Arcade', 'Ce sont des jeux de réflexe, comme space invaders.'),
(7, 'FPS', 'Faut tuer des gens avec un gun.'),
(9, 'Jeu de hasard', 'Avec des dés, par exemple.'),
(11, 'MMORPG', 'aka MEUPORGUE');

-- --------------------------------------------------------

--
-- Structure de la table `plateformes`
--

CREATE TABLE `plateformes` (
  `plateformes_ID` tinyint(3) UNSIGNED NOT NULL,
  `plateformes_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `plateformes_description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `plateformes`
--

INSERT INTO `plateformes` (`plateformes_ID`, `plateformes_name`, `plateformes_description`) VALUES
(1, 'PC', 'bla'),
(2, 'MacOS', 'C\'est pas mal mais c\'est pas compatible.'),
(3, 'Xbox', 'youpi'),
(4, 'ZX Spectrum', 'Un vieux système des années 80.'),
(5, 'PDP-11', 'Un vieux système qui à l\'époque était super gros.'),
(6, 'Linux', 'Pour les vrais geeks.'),
(7, 'Commodore 64', 'Une plateforme vraiment oldschool.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`games_ID`);

--
-- Index pour la table `games_plateformes`
--
ALTER TABLE `games_plateformes`
  ADD PRIMARY KEY (`games_plateformes_games_ID`,`games_plateformes_plateformes_ID`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_ID`);

--
-- Index pour la table `plateformes`
--
ALTER TABLE `plateformes`
  ADD PRIMARY KEY (`plateformes_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `games_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_ID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `plateformes`
--
ALTER TABLE `plateformes`
  MODIFY `plateformes_ID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
