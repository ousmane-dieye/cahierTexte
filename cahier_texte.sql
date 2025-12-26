-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 déc. 2025 à 00:23
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cahier_texte`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(11) NOT NULL,
  `root_id` int(11) NOT NULL,
  `nom_classe` varchar(50) NOT NULL,
  `niveau` enum('premiere_annee','deuxieme_annee','troisieme_annee','quatrieme_annee','cinquieme_annee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `delegue`
--

CREATE TABLE `delegue` (
  `etudiant_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `classe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int(11) NOT NULL,
  `nom_matiere` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matiere_classe`
--

CREATE TABLE `matiere_classe` (
  `matiere_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `root`
--

CREATE TABLE `root` (
  `id_root` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id_tache` int(11) NOT NULL,
  `matiere_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  `delegue_id` int(11) NOT NULL,
  `date_ajout` datetime DEFAULT current_timestamp(),
  `date_limite` date DEFAULT NULL,
  `heure_limite` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `root_id` (`root_id`);

--
-- Index pour la table `delegue`
--
ALTER TABLE `delegue`
  ADD PRIMARY KEY (`etudiant_id`),
  ADD KEY `classe_id` (`classe_id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD KEY `classe_id` (`classe_id`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `matiere_classe`
--
ALTER TABLE `matiere_classe`
  ADD PRIMARY KEY (`matiere_id`,`classe_id`),
  ADD KEY `classe_id` (`classe_id`);

--
-- Index pour la table `root`
--
ALTER TABLE `root`
  ADD PRIMARY KEY (`id_root`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id_tache`),
  ADD KEY `matiere_id` (`matiere_id`),
  ADD KEY `classe_id` (`classe_id`),
  ADD KEY `delegue_id` (`delegue_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `root`
--
ALTER TABLE `root`
  MODIFY `id_root` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id_tache` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`root_id`) REFERENCES `root` (`id_root`);

--
-- Contraintes pour la table `delegue`
--
ALTER TABLE `delegue`
  ADD CONSTRAINT `delegue_ibfk_1` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `delegue_ibfk_2` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id_classe`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id_classe`);

--
-- Contraintes pour la table `matiere_classe`
--
ALTER TABLE `matiere_classe`
  ADD CONSTRAINT `matiere_classe_ibfk_1` FOREIGN KEY (`matiere_id`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `matiere_classe_ibfk_2` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id_classe`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`matiere_id`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `tache_ibfk_2` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id_classe`),
  ADD CONSTRAINT `tache_ibfk_3` FOREIGN KEY (`delegue_id`) REFERENCES `delegue` (`etudiant_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
