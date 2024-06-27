-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : jeu. 27 juin 2024 à 14:41
-- Version du serveur : 8.0.37
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `onlinetraining`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `type`) VALUES
(1, 'Polo manches longues'),
(2, 'Polo manches courtes'),
(7, 'Short'),
(8, 'Pantalon Chino'),
(9, 'Pantalon');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `user_id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postale_ville` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `panier_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `user_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `quantite` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int NOT NULL,
  `image_produit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `categorie_id` int NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `taille` varchar(255) NOT NULL,
  `quantite` int NOT NULL,
  `prix_ht` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image_produit`, `alt`, `nom_produit`, `genre`, `reference`, `marque`, `categorie_id`, `couleur`, `matiere`, `motif`, `description`, `taille`, `quantite`, `prix_ht`) VALUES
(14, '../../img/produits/ob8ngAGr0baavXn6asuQ.jpg', 'a', 'a', 'Homme', 'a', 'a', 7, 'a', 'a', 'a', 'a', 's', 1, '10');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `roles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `email`, `pass`, `adresse`, `roles`) VALUES
(1, 'abc', 'abc', 'abc@abc.fr', '$argon2id$v=19$m=65536,t=4,p=1$WmR4cnFFR2xpSVBrSUhFLg$U5Bt0rKcc3q7Hc8OpbXzRhUTywwbOxY/hUfM/wNCjzM', NULL, '[\"ROLE_USER\"]'),
(2, 'aaa', 'aaa', 'aaa@aaa.fr', '$argon2id$v=19$m=65536,t=4,p=1$ZEpCL1VJREVZVHhsTFIyUw$JeUsj039qvoNx62b33hPertgotyfy3rrhYrAU5413lw', NULL, '[\"ROLE_USER\"]'),
(3, 'bbb', 'bbb', 'bbb@bbb.fr', '$argon2id$v=19$m=65536,t=4,p=1$MnhFWGsyRm5pM0dGZllBZw$DfZ/44q5Yquo+4PCbNb2+d/z/mLfeCtfwsQ9EqmUdNQ', NULL, '[\"ROLE_USER\"]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
