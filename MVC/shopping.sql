-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 01 mai 2023 à 22:05
-- Version du serveur :  5.7.17
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
-- Base de données :  `shopping`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `ref` varchar(20) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  `prix` int(4) NOT NULL,
  `Qt_stock` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`ref`, `libelle`, `prix`, `Qt_stock`) VALUES
('RF1', 'Souris', 25, 20),
('RF03', 'Carte', 400, 20),
('RF15', 'Clavier', 30, 20),
('R12', 'Ecran', 400, 20);

-- --------------------------------------------------------

--
-- Structure de la table `article_fournisseur`
--

CREATE TABLE `article_fournisseur` (
  `ref` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article_fournisseur`
--

INSERT INTO `article_fournisseur` (`ref`, `id`) VALUES
('R12', 'F2-Info'),
('RF03', 'F3-Info'),
('RF15', 'F2-Info'),
('RF1', 'F1-Info'),
('RF1', 'F3-Info');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`) VALUES
('F1-Info', 'MediaTech'),
('F2-Info', 'Best Price'),
('F3-Info', 'Zoom');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`login`, `password`) VALUES
('Admin', 'admin'),
('Ali', 'azert'),
('Sami', 'nbvc');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ref`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
