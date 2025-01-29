-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 juin 2024 à 15:19
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `workshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `Role` enum('super_admin','admin','suivie','') NOT NULL,
  `mot_passe_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conscesion organisationnelle`
--

CREATE TABLE `conscesion organisationnelle` (
  `id_Organisationnelle` int(11) NOT NULL,
  `Président_O` varchar(255) NOT NULL,
  `Vice-président_O` varchar(255) NOT NULL,
  `Membres-O` varchar(255) NOT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conscesion_scientifique`
--

CREATE TABLE `conscesion_scientifique` (
  `id_scientifique` int(11) NOT NULL,
  `Président` varchar(255) NOT NULL,
  `Vice-président` varchar(255) NOT NULL,
  `Membres` varchar(255) NOT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenu`
--

CREATE TABLE `contenu` (
  `id_contenu` int(11) NOT NULL,
  `URL_imag_cont` varchar(255) NOT NULL,
  `text_cont` varchar(255) NOT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `division`
--

CREATE TABLE `division` (
  `id_division` int(11) NOT NULL,
  `nom_div` varchar(255) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `id_etablissement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE `etablissement` (
  `id_etablissement` int(11) NOT NULL,
  `nom_etablissement` varchar(255) NOT NULL,
  `staut` varchar(255) NOT NULL,
  `other` varchar(255) NOT NULL,
  `secteur` varchar(255) NOT NULL,
  `id_secteur` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE `fichiers` (
  `id_fichiers` int(11) NOT NULL,
  `URL_fichiers` varchar(255) NOT NULL,
  `id_theme` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `logo`
--

CREATE TABLE `logo` (
  `id_logo` int(11) NOT NULL,
  `logo_1` varchar(255) NOT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reseaux_sociaux`
--

CREATE TABLE `reseaux_sociaux` (
  `id_RS` int(11) NOT NULL,
  `Youtube` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numero_telephone` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `id_secteur` int(11) NOT NULL,
  `nom_sect` varchar(255) NOT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sponsore`
--

CREATE TABLE `sponsore` (
  `id_sponsore` int(11) NOT NULL,
  `URL_imag_spon` varchar(255) NOT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `id_sujet` int(11) NOT NULL,
  `design_sujet` varchar(255) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `id_theme` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id_theme` int(11) NOT NULL,
  `Dates des ateliers` varchar(255) NOT NULL,
  `design_theme` varchar(255) NOT NULL,
  `frais_dinscription` varchar(255) NOT NULL,
  `Notification` varchar(255) NOT NULL,
  `URL_theme` varchar(255) NOT NULL,
  `date_sous_article` varchar(255) NOT NULL,
  `id_Organisationnelle` int(11) DEFAULT NULL,
  `id_scientifique` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nam` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `nomber_telephone` varchar(255) NOT NULL,
  `id_etablissement` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `conscesion organisationnelle`
--
ALTER TABLE `conscesion organisationnelle`
  ADD PRIMARY KEY (`id_Organisationnelle`),
  ADD KEY `FK_conscesion organisationnelle_admin` (`id_admin`);

--
-- Index pour la table `conscesion_scientifique`
--
ALTER TABLE `conscesion_scientifique`
  ADD PRIMARY KEY (`id_scientifique`),
  ADD KEY `FK_conscesion_scientifique_admin` (`id_admin`);

--
-- Index pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD PRIMARY KEY (`id_contenu`),
  ADD KEY `FK_contenu_admin` (`id_admin`);

--
-- Index pour la table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id_division`),
  ADD KEY `FK_division_admin` (`id_admin`),
  ADD KEY `FK_division_etablissement` (`id_etablissement`);

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD PRIMARY KEY (`id_etablissement`),
  ADD KEY `FK_etablissement_secteur` (`id_secteur`),
  ADD KEY `FK_etablissement_admin` (`id_admin`);

--
-- Index pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD PRIMARY KEY (`id_fichiers`),
  ADD KEY `FK_fichiers_theme` (`id_theme`),
  ADD KEY `FK_fichiers_user` (`id_user`),
  ADD KEY `FK_fichiers_admin` (`id_admin`);

--
-- Index pour la table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id_logo`),
  ADD KEY `FK_logo_admin` (`id_admin`);

--
-- Index pour la table `reseaux_sociaux`
--
ALTER TABLE `reseaux_sociaux`
  ADD PRIMARY KEY (`id_RS`),
  ADD KEY `FK_reseaux_sociaux_admin` (`id_admin`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`id_secteur`),
  ADD KEY `FK_secteur_admin` (`id_admin`);

--
-- Index pour la table `sponsore`
--
ALTER TABLE `sponsore`
  ADD PRIMARY KEY (`id_sponsore`),
  ADD KEY `FK_sponsore_admin` (`id_admin`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`id_sujet`),
  ADD KEY `FK_sujet_admin` (`id_admin`),
  ADD KEY `FK_sujet_theme` (`id_theme`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_theme`),
  ADD KEY `FK_theme_conscesion organisationnelle` (`id_Organisationnelle`),
  ADD KEY `FK_theme_conscesion_scientifique` (`id_scientifique`),
  ADD KEY `FK_theme_admin` (`id_admin`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_user_etablissement` (`id_etablissement`),
  ADD KEY `FK_user_admin` (`id_admin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conscesion organisationnelle`
--
ALTER TABLE `conscesion organisationnelle`
  MODIFY `id_Organisationnelle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conscesion_scientifique`
--
ALTER TABLE `conscesion_scientifique`
  MODIFY `id_scientifique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contenu`
--
ALTER TABLE `contenu`
  MODIFY `id_contenu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `division`
--
ALTER TABLE `division`
  MODIFY `id_division` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `id_etablissement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fichiers`
--
ALTER TABLE `fichiers`
  MODIFY `id_fichiers` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `logo`
--
ALTER TABLE `logo`
  MODIFY `id_logo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reseaux_sociaux`
--
ALTER TABLE `reseaux_sociaux`
  MODIFY `id_RS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id_secteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sponsore`
--
ALTER TABLE `sponsore`
  MODIFY `id_sponsore` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id_sujet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id_theme` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conscesion organisationnelle`
--
ALTER TABLE `conscesion organisationnelle`
  ADD CONSTRAINT `FK_conscesion organisationnelle_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `conscesion_scientifique`
--
ALTER TABLE `conscesion_scientifique`
  ADD CONSTRAINT `FK_conscesion_scientifique_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD CONSTRAINT `FK_contenu_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `division`
--
ALTER TABLE `division`
  ADD CONSTRAINT `FK_division_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_division_etablissement` FOREIGN KEY (`id_etablissement`) REFERENCES `etablissement` (`id_etablissement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD CONSTRAINT `FK_etablissement_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_etablissement_secteur` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id_secteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD CONSTRAINT `FK_fichiers_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fichiers_theme` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id_theme`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fichiers_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `logo`
--
ALTER TABLE `logo`
  ADD CONSTRAINT `FK_logo_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reseaux_sociaux`
--
ALTER TABLE `reseaux_sociaux`
  ADD CONSTRAINT `FK_reseaux_sociaux_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD CONSTRAINT `FK_secteur_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sponsore`
--
ALTER TABLE `sponsore`
  ADD CONSTRAINT `FK_sponsore_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `FK_sujet_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sujet_theme` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id_theme`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK_theme_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_theme_conscesion organisationnelle` FOREIGN KEY (`id_Organisationnelle`) REFERENCES `conscesion organisationnelle` (`id_Organisationnelle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_theme_conscesion_scientifique` FOREIGN KEY (`id_scientifique`) REFERENCES `conscesion_scientifique` (`id_scientifique`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_etablissement` FOREIGN KEY (`id_etablissement`) REFERENCES `etablissement` (`id_etablissement`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
