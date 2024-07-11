-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : jeu. 11 juil. 2024 à 07:56
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
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `date_commande` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `nom`, `prenom`, `adresse`, `ville`, `code_postal`, `email`, `total`, `date_commande`) VALUES
(1, 'user', 'user', 'user', 'user', '58000', 'user@user.fr', 4, NULL),
(2, 'user', 'user', 'user', 'user', '58000', 'user@user.fr', 4, NULL),
(3, 'user', 'user', 'user', 'user', '58000', 'user@user.fr', 6, NULL),
(4, 'user', 'user', 'user', 'user', '58000', 'user@user.fr', 6, NULL),
(5, 'user', 'user', 'user', 'user', '58000', 'user@user.fr', 11, '2024-07-11 07:49:15'),
(6, 'aaa', 'aaa', 'aaa', 'aaa', '58000', 'aaa@aaa.fr', 33, '2024-07-11 07:52:58');

-- --------------------------------------------------------

--
-- Structure de la table `commande_details`
--

CREATE TABLE `commande_details` (
  `id` int NOT NULL,
  `commande_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix_ht` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande_details`
--

INSERT INTO `commande_details` (`id`, `commande_id`, `produit_id`, `quantite`, `prix_ht`) VALUES
(1, 2, 43, 1, 4),
(2, 3, 44, 1, 6),
(3, 4, 44, 1, 6),
(4, 5, 40, 1, 11),
(5, 6, 40, 3, 11);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `user_id`, `message`, `time`) VALUES
(1, 9, 'hello', '2024-07-02 11:07:20'),
(2, 9, 'hello', '2024-07-02 11:07:29'),
(3, 1, 'GGGG', '2024-07-08 11:24:11'),
(4, 1, 'GGGG', '2024-07-08 11:24:13');

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
  `nom_produit` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `categorie_id` int NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `taille` varchar(255) NOT NULL,
  `quantite` int NOT NULL,
  `prix_ht` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image_produit`, `nom_produit`, `genre`, `reference`, `marque`, `categorie_id`, `couleur`, `matiere`, `motif`, `description`, `taille`, `quantite`, `prix_ht`) VALUES
(39, 'img/produits/Y6aRhcV8HGYDCz0IUOZT.jpg', 'Azerty', 'HOMME', 'Azerty', 'Azerty', 7, 'Azerty', 'Azerty', 'AzertyAzerty', 'Azertysjgydjfgshefhsfohoifhoez fbiozebfhzoifhoeiz  zghioeghzipeghipezghipezhgoiezg gnighiezohgiezioze giohioeghioreg', 'Azerty', 111, '11111112221'),
(40, 'img/produits/nlwNKQ4zRZfCpn1MoGRm.jpg', 'aaaabbbbbb', 'HOMME', 'aaaa', 'aaaa', 1, 'aaaa', 'aaaa', 'aaaa', 'aaaa', 'aaaa', 1, '11'),
(43, 'img/produits/ezuZ9DA6NrUwKKdzU1ZH.jpg', 'aaa', 'femme', 'aaa', 'aaa', 9, 'aaa', 'aaa', 'aaa', 'aaa aaa', 'aaa', 1, '4'),
(44, 'img/produits/3omSG2P1HPYSAvcbnTTH.jpg', 'aaa', 'femme', 'aaa', 'aaa', 8, 'aaa', 'aaa', 'aaa', 'aaa aaa', 'aaa', 3, '6');

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
(1, 'admin', 'super', 'super@dmin.fr', '$argon2id$v=19$m=65536,t=4,p=1$T1pvV2NNbDZTaHBCNUl4MA$BZELCDFpRwLtjgCTKxeQfouBTuzPirvP/FWvj5goImE', NULL, '[\"ROLE_SUPER_ADMIN\"]'),
(4, 'admin', 'admin', 'admin@dmin.fr', '$argon2id$v=19$m=65536,t=4,p=1$Wkp0OGdtMzFnNzRkTXdKQg$Wng5DnehOQhjlWq5fOxO8Rs5XJFy72QN5/RXXIstPyE', NULL, '[\"ROLE_ADMIN\"]'),
(5, 'user', 'user', 'user@user.fr', '$argon2id$v=19$m=65536,t=4,p=1$YUU1bnB5SnpLNDBaQTlndA$hRrsp0k3K8b+0NJjQ6Xoo0RfAJFavx1B5/AFBPJfcBs', NULL, '[\"ROLE_USER\"]'),
(8, 'aaa', 'aaa', 'aaa@aaa.fr', '$argon2id$v=19$m=65536,t=4,p=1$cFg1SU5FYlVBS0dMN1hiUA$yA7SXTQOLVmsAQ4DAR693p7ZYCCXXYoKafFWxIvwxVg', NULL, '[\"ROLE_USER\"]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande_details`
--
ALTER TABLE `commande_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comande_id` (`commande_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commande_details`
--
ALTER TABLE `commande_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande_details`
--
ALTER TABLE `commande_details`
  ADD CONSTRAINT `commande_details_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `commande_details_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
