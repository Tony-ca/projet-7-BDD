-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 juil. 2023 à 16:42
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `marvel`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE `acteur` (
  `ID_acteur` int(11) NOT NULL,
  `nom_acteur` varchar(50) DEFAULT NULL,
  `prenom_acteur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`ID_acteur`, `nom_acteur`, `prenom_acteur`) VALUES
(1, '', ''),
(2, '4545', '4545'),
(3, '44', '44'),
(4, '44', '44'),
(5, 'sidfksdhf', 'sdfsdfksdgf');

-- --------------------------------------------------------

--
-- Structure de la table `a_ete_vu`
--

CREATE TABLE `a_ete_vu` (
  `ID_film` int(11) NOT NULL,
  `ID_historique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `ID_film` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `duree` int(50) DEFAULT NULL,
  `affiche` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`ID_film`, `titre`, `date`, `duree`, `affiche`) VALUES
(1, 'dsdsds', '0000-00-00', 10, 'ggg'),
(2, 'dfdfdf', '4555-05-04', 45, '454'),
(3, 'gfdg', '0044-04-04', 44, '44'),
(4, 'erer', '4444-04-04', 44, '44'),
(5, 'jsjdhsjdhjshd', '5555-05-05', 45, 'https://img.phonandroid.com/2021/04/avengers-infinity-war.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `ID_historique` int(11) NOT NULL,
  `vu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jouer`
--

CREATE TABLE `jouer` (
  `ID_acteur` int(11) NOT NULL,
  `ID_film` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `realisateur`
--

CREATE TABLE `realisateur` (
  `ID_realisateur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `realisateur`
--

INSERT INTO `realisateur` (`ID_realisateur`, `nom`, `prenom`) VALUES
(1, '', ''),
(2, '5454', '5454'),
(3, '44', '44'),
(4, '44', '44'),
(5, 'dkjhfdfkdjfk', 'dfdfjdhfdjhf');

-- --------------------------------------------------------

--
-- Structure de la table `realise`
--

CREATE TABLE `realise` (
  `ID_realisateur` int(11) NOT NULL,
  `ID_film` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID_utilisateur` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `password` int(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `visionner`
--

CREATE TABLE `visionner` (
  `ID_utilisateur` int(11) NOT NULL,
  `ID_historique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`ID_acteur`);

--
-- Index pour la table `a_ete_vu`
--
ALTER TABLE `a_ete_vu`
  ADD PRIMARY KEY (`ID_film`,`ID_historique`),
  ADD KEY `FK_a_ete_vu_ID_historique` (`ID_historique`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`ID_film`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`ID_historique`);

--
-- Index pour la table `jouer`
--
ALTER TABLE `jouer`
  ADD PRIMARY KEY (`ID_acteur`,`ID_film`),
  ADD KEY `FK_jouer_ID_film` (`ID_film`);

--
-- Index pour la table `realisateur`
--
ALTER TABLE `realisateur`
  ADD PRIMARY KEY (`ID_realisateur`);

--
-- Index pour la table `realise`
--
ALTER TABLE `realise`
  ADD PRIMARY KEY (`ID_realisateur`,`ID_film`),
  ADD KEY `FK_realise_ID_film` (`ID_film`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_utilisateur`);

--
-- Index pour la table `visionner`
--
ALTER TABLE `visionner`
  ADD PRIMARY KEY (`ID_utilisateur`,`ID_historique`),
  ADD KEY `FK_visionner_ID_historique` (`ID_historique`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `ID_acteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `a_ete_vu`
--
ALTER TABLE `a_ete_vu`
  MODIFY `ID_film` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `ID_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `ID_historique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jouer`
--
ALTER TABLE `jouer`
  MODIFY `ID_acteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `realisateur`
--
ALTER TABLE `realisateur`
  MODIFY `ID_realisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `realise`
--
ALTER TABLE `realise`
  MODIFY `ID_realisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `visionner`
--
ALTER TABLE `visionner`
  MODIFY `ID_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `a_ete_vu`
--
ALTER TABLE `a_ete_vu`
  ADD CONSTRAINT `FK_a_ete_vu_ID_film` FOREIGN KEY (`ID_film`) REFERENCES `film` (`ID_film`),
  ADD CONSTRAINT `FK_a_ete_vu_ID_historique` FOREIGN KEY (`ID_historique`) REFERENCES `historique` (`ID_historique`);

--
-- Contraintes pour la table `jouer`
--
ALTER TABLE `jouer`
  ADD CONSTRAINT `FK_jouer_ID_acteur` FOREIGN KEY (`ID_acteur`) REFERENCES `acteur` (`ID_acteur`),
  ADD CONSTRAINT `FK_jouer_ID_film` FOREIGN KEY (`ID_film`) REFERENCES `film` (`ID_film`);

--
-- Contraintes pour la table `realise`
--
ALTER TABLE `realise`
  ADD CONSTRAINT `FK_realise_ID_film` FOREIGN KEY (`ID_film`) REFERENCES `film` (`ID_film`),
  ADD CONSTRAINT `FK_realise_ID_realisateur` FOREIGN KEY (`ID_realisateur`) REFERENCES `realisateur` (`ID_realisateur`);

--
-- Contraintes pour la table `visionner`
--
ALTER TABLE `visionner`
  ADD CONSTRAINT `FK_visionner_ID_historique` FOREIGN KEY (`ID_historique`) REFERENCES `historique` (`ID_historique`),
  ADD CONSTRAINT `FK_visionner_ID_utilisateur` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
