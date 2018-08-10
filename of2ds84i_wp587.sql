-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  ven. 10 août 2018 à 21:08
-- Version du serveur :  5.6.35-cll-lve
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `of2ds84i_wp587`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

CREATE TABLE `affectation` (
  `id` int(12) NOT NULL,
  `id_projet` varchar(12) NOT NULL,
  `id_tache` varchar(12) NOT NULL,
  `id_sous_tache` varchar(12) NOT NULL,
  `phase` varchar(255) NOT NULL,
  `date_max` varchar(255) NOT NULL,
  `date_max_timestamp` varchar(255) NOT NULL,
  `traitant` varchar(255) NOT NULL,
  `ordre` varchar(12) NOT NULL,
  `ordre_cat` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'à faire',
  `date_realisation` varchar(255) NOT NULL,
  `affectation_le` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `collab`
--

CREATE TABLE `collab` (
  `collab_id` bigint(20) NOT NULL,
  `collab_name` varchar(100) NOT NULL,
  `collab_pname` varchar(100) NOT NULL,
  `collab_function` varchar(200) NOT NULL,
  `collab_tel` varchar(10) NOT NULL,
  `collab_mail` varchar(200) NOT NULL,
  `collab_plan` bigint(20) NOT NULL,
  `collab_status` int(2) NOT NULL,
  `collab_active` varchar(2) NOT NULL,
  `collab_a` varchar(2) NOT NULL,
  `collab_t` varchar(2) NOT NULL,
  `collab_ceo` varchar(2) NOT NULL,
  `collab_comment` text NOT NULL,
  `collab_clientid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE `fichiers` (
  `id` int(12) NOT NULL,
  `chemin` varchar(500) NOT NULL,
  `type_fichier` varchar(255) NOT NULL,
  `id_projet` varchar(12) NOT NULL,
  `nom_traitant` varchar(255) NOT NULL,
  `date_depot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notes_taches`
--

CREATE TABLE `notes_taches` (
  `id` int(12) NOT NULL,
  `traitant` varchar(12) NOT NULL,
  `nom_traitant` varchar(255) NOT NULL,
  `id_tache` varchar(12) NOT NULL,
  `date_ajout` varchar(255) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` int(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_debut` varchar(255) NOT NULL,
  `date_installation` varchar(255) NOT NULL,
  `id_manager` varchar(12) NOT NULL,
  `manager` varchar(500) NOT NULL,
  `id_client` varchar(255) NOT NULL,
  `client` varchar(500) NOT NULL,
  `id_tech` varchar(255) NOT NULL,
  `tech` varchar(500) NOT NULL,
  `etat` varchar(255) NOT NULL DEFAULT 'Initialisé',
  `commentaires` varchar(5000) NOT NULL,
  `last_modification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sous_projets`
--

CREATE TABLE `sous_projets` (
  `id` int(12) NOT NULL,
  `id_projet` int(12) NOT NULL,
  `id_tache` int(12) NOT NULL,
  `id_sous_tache` int(12) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'à faire',
  `id_technicien` int(12) NOT NULL,
  `date_max` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sous_taches`
--

CREATE TABLE `sous_taches` (
  `id` int(12) NOT NULL,
  `nom` varchar(500) NOT NULL,
  `id_tache` varchar(25) NOT NULL,
  `ordre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `id` int(12) NOT NULL,
  `nom` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `company` varchar(200) NOT NULL,
  `siren` varchar(15) DEFAULT NULL,
  `naf` varchar(10) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `refvosfact` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `profile_image` varchar(500) NOT NULL,
  `description` varchar(600) NOT NULL,
  `canal` varchar(100) DEFAULT NULL,
  `user_history` longtext NOT NULL,
  `status` varchar(100) NOT NULL,
  `stade` varchar(10) NOT NULL,
  `activation_key` varchar(100) NOT NULL,
  `date_register` date NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `collab`
--
ALTER TABLE `collab`
  ADD PRIMARY KEY (`collab_id`),
  ADD KEY `collab_id` (`collab_id`);

--
-- Index pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes_taches`
--
ALTER TABLE `notes_taches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sous_taches`
--
ALTER TABLE `sous_taches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `affectation`
--
ALTER TABLE `affectation`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `collab`
--
ALTER TABLE `collab`
  MODIFY `collab_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT pour la table `fichiers`
--
ALTER TABLE `fichiers`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `notes_taches`
--
ALTER TABLE `notes_taches`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `sous_taches`
--
ALTER TABLE `sous_taches`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
