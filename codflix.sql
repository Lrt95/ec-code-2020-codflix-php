-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 25 juin 2020 à 10:57
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `codflix`
--
DROP DATABASE IF EXISTS `codflix`;
CREATE DATABASE `codflix`;
--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction'),
(4, 'Humour');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `serie_id` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) DEFAULT 0 COMMENT 'in seconds'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `user_id`, `movie_id`, `serie_id`, `start_date`, `finish_date`, `watch_duration`) VALUES
(1, 4, 1, 0, '2020-06-25 10:56:23', NULL, NULL),
(2, 4, 4, 1, '2020-06-25 10:56:38', NULL, NULL),
(3, 4, 4, 9, '2020-06-25 10:56:43', NULL, NULL),
(4, 4, 4, 10, '2020-06-25 10:56:48', NULL, NULL),
(5, 4, 4, 2, '2020-06-25 10:56:51', NULL, NULL),
(6, 4, 4, 6, '2020-06-25 10:56:54', NULL, NULL),
(7, 4, 4, 3, '2020-06-25 10:57:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `release_date`, `summary`, `trailer_url`) VALUES
(1, 1, 'Retour vers le futur', 'Film', 'Média publié', '1985-10-30', 'Le jeune Marty McFly mène une existence anonyme, auprès de sa petite amie Jennifer, seulement troublée par sa famille en crise et un proviseur qui serait ravi de l\'expulser du lycée. Ami de l\'excentrique professeur Emmett Brown, il l\'accompagne tester sa nouvelle expérience : le voyage dans le temps via une DeLorean modifiée. La démonstration tourne mal : des trafiquants d\'armes débarquent et assassinent le scientifique.', 'https://www.youtube.com/embed/cU5BREZ9ke0'),
(3, 1, 'Indiana Jones', 'Film', 'Média publié', '1981-09-16', 'Professeur d\'archéologie, Indiana Jones parcourt le monde à la recherche de trésors. Son rival, le Français René Belloq, travaille pour les nazis qui rêvent de retrouver l\'Arche d\'alliance contenant les Tables de la Loi. Or, feu le professeur Ravenwood, père de Marion, l\'ex-petite amie d\'Indiana Jones, détenait une médaille permettant de localiser l\'arche. Jones part sur les traces de Marion au Népal.', 'https://www.youtube.com/embed/HqOSLZl9GUo'),
(4, 4, 'South Park', 'Serie', 'Média publié', '1997-08-13', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.', 'https://www.youtube.com/embed/rvccxQUCmO0');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `duration` time NOT NULL,
  `url_movie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `movie_id`, `duration`, `url_movie`) VALUES
(1, 1, '01:58:00', 'https://www.youtube.com/embed/cU5BREZ9ke0'),
(2, 3, '01:43:00', 'https://www.youtube.com/embed/HqOSLZl9GUo');

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `saison` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `duration` time NOT NULL,
  `name` varchar(254) NOT NULL,
  `url_serie` varchar(100) NOT NULL,
  `summary` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `series`
--

INSERT INTO `series` (`id`, `serie_id`, `saison`, `episode`, `duration`, `name`, `url_serie`, `summary`) VALUES
(1, 4, 1, 1, '00:24:00', 'South Park 1', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.'),
(2, 4, 1, 2, '00:24:00', 'South Park 2', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.'),
(3, 4, 1, 3, '00:24:00', 'South Park 3', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.'),
(4, 4, 1, 4, '00:24:00', 'South Park 4', 'https://www.youtube.com/embed/rvccxQUCmO0', 'blablablablablablablabla'),
(5, 4, 1, 5, '00:24:00', 'South Park 5', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.'),
(6, 4, 1, 6, '00:24:00', 'South Park 6', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.'),
(7, 4, 1, 7, '00:24:00', 'South Park 7', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.'),
(8, 4, 1, 8, '00:24:00', 'South Park 8', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.'),
(9, 4, 2, 1, '00:24:00', 'South Park 1', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.'),
(10, 4, 2, 2, '00:24:00', 'South Park 2', 'https://www.youtube.com/embed/rvccxQUCmO0', 'La petite ville de South Park dans le Colorado est le théâtre des aventures de Cartman, Stan, Kyle et Kenny, quatre enfants qui ont un langage un peu décalé.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(80) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `isActive`) VALUES
(4, 'coding@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_user_id_fk_media_id` (`user_id`),
  ADD KEY `history_media_id_fk_media_id` (`movie_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE;

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_film_id` (`movie_id`) USING BTREE;

--
-- Index pour la table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_serie_id` (`serie_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`movie_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Contraintes pour la table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `fk_media_serie_id` FOREIGN KEY (`serie_id`) REFERENCES `media` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
