-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : ven. 12 juil. 2024 à 09:41
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
(19, 'Top manches longues'),
(22, 'Chemisier'),
(26, 'Robe'),
(33, 'Pantalon');

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
(21, 'Mallard', 'Christian', '4 rue de Paris', '58000', 'Nevers', 'mallard@gmail.com', 280, '2024-07-12 07:57:06'),
(22, 'Bernard', 'Charles', '4 rue de Paris', '58000', 'Nevers', 'bernard.charles@hotmail.fr', 240, '2024-07-12 08:00:19');

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
(27, 21, 55, 2, 20),
(28, 21, 69, 3, 20),
(29, 21, 68, 4, 20),
(30, 21, 52, 5, 20),
(31, 22, 67, 3, 20),
(32, 22, 69, 5, 20),
(33, 22, 64, 4, 20);

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
(46, 'img/produits/f2EwitSD57ZZxJfIbzQY.jpg', 'Top manches longues Promod', 'femme', '2171', 'Promod', 19, 'Beige', 'coton', 'Sans', 'Top manches longues Promod beige en coton.', 's', 20, '20'),
(47, 'img/produits/KxBDLhwkgf4QPeL6MkKs.jpg', 'Chemisier Promod', 'femme', '3111', 'Promod', 22, 'Rouge', 'Viscose', 'Sans', 'Chemisier rouge Promod en viscose.', 's', 20, '20'),
(48, 'img/produits/3COPbIr38G8M4W3RlNH5.jpg', 'Robe Promod', 'femme', '21713224', 'Promod', 26, 'bleu', 'coton', 'Sans', 'Robe bleu Promod en coton.', 's', 20, '20'),
(49, 'img/produits/zhX7u18sxCYve6wkwzNR.jpg', 'Robe Promod', 'femme', '21715865', 'Promod', 26, 'Vert', 'coton', 'Sans', 'Robe verte Promod en coton.', 's', 20, '20'),
(50, 'img/produits/CQcrAmszScfU73zW55vV.jpg', 'Robe Promod', 'femme', '217155887', 'Promod', 26, 'Jaune', 'coton', 'Sans', 'Robe jaune Promod en coton.', 's', 20, '20'),
(51, 'img/produits/1WNxRGO9Yr5VB88fC8dq.jpg', 'Robe Promod', 'femme', '21715865558', 'Promod', 26, 'Orange', 'coton', 'Sans', 'Robe orange Promod en coton', 's', 20, '20'),
(52, 'img/produits/Y2KF6pCitiM72VARDHBq.jpg', 'Robe Promod', 'femme', '21715868686', 'Promod', 26, 'Noir', 'Viscose', 'Sans', 'Robe noire Promod en viscose.', 's', 15, '20'),
(53, 'img/produits/NIvQdxNuzNXomOh121Py.jpg', 'Robe Promod', 'femme', '217576875675', 'Promod', 26, 'bleu', 'coton', 'Sans', 'Robe bleu Promod en coton.', 's', 20, '20'),
(54, 'img/produits/Wiu8EXFn4hcVJCzhhnQT.jpg', 'Chemisier Promod', 'femme', '21757687567555', 'Promod', 22, 'Marron', 'coton', 'Sans', 'Chemisier marron Promod en coton.', 's', 20, '20'),
(55, 'img/produits/WLQeT4kRyYJRtNKWdal2.jpg', 'Chemisier Promod', 'femme', '217158655585', 'Promod', 22, 'bleu', 'coton', 'Sans', 'Chemisier bleu Promod en coton.', 's', 18, '20'),
(56, 'img/produits/6enODfuKRF1lJjfRz9wD.jpg', 'Chemisier Promod', 'femme', '2175768756755786786', 'Promod', 22, 'Vert', 'coton', 'Sans', 'Chemisier vert Promod en coton.', 's', 20, '20'),
(57, 'img/produits/LpGAsGBt3HoDwWtyC9Ct.jpg', 'Chemisier Promod', 'femme', '2746546', 'Promod', 22, 'noir', 'coton', 'sans', 'Chemisier noir Promod en coton.', 's', 20, '20'),
(58, 'img/produits/FwEPHjtNziVzdHWDgMd0.jpg', 'Chemisier Promod', 'femme', '274654658', 'Promod', 22, 'bleu', 'coton', 'sans', 'Chemisier bleu Promod en coton.', 's', 20, '20'),
(59, 'img/produits/E55ZW5ocsZb3Dn2QnJrA.jpg', 'Pantalon Promod', 'femme', '2746546579', 'Promod', 33, 'orange', 'coton', 'sans', 'Pantalon orange Promod en coton.', 's', 20, '20'),
(60, 'img/produits/AVaJicOt6YKeDvd07EFV.jpg', 'Pantalon Promod', 'femme', '27465465795686', 'Promod', 33, 'noir', 'coton', 'sans', 'Pantalon noir Promod en coton.', 's', 20, '20'),
(61, 'img/produits/WduJJryoZaROeSfpzguG.jpg', 'Pantalon Promod', 'femme', '27465462355', 'Promod', 33, 'Marron', 'coton', 'sans', 'Pantalon Marron Promod en coton.', 's', 20, '20'),
(62, 'img/produits/CwKKxiVTjRGdU7opsbqz.jpg', 'Pantalon Promod', 'femme', '27465465794896', 'Promod', 33, 'Blanc', 'coton', 'sans', 'Pantalon Blanc Promod en coton.', 's', 20, '20'),
(63, 'img/produits/ZA47bqRreDB76P7d23nW.jpg', 'Pantalon Promod', 'femme', '27465465456', 'Promod', 33, 'Beige', 'coton', 'sans', 'Pantalon beige Promod en coton.', 's', 20, '20'),
(64, 'img/produits/lpAWSXaSKjX81ET4aNMo.jpg', 'Pantalon Promod', 'femme', '5465456858', 'Promod', 33, 'Vert', 'coton', 'sans', 'Pantalon vert Promod en coton.', 's', 16, '20'),
(65, 'img/produits/pRzMxMLrNg90YdPu38N0.jpg', 'Pantalon Kiabi', 'homme', '27465462857', 'Kiabi', 33, 'Blanc', 'coton', 'sans', 'Pantalon blanc Kiabi en coton.', 's', 20, '20'),
(66, 'img/produits/D3Acw4OvBhkSE8VUhcJy.jpg', 'Pantalon Kiabi', 'homme', '2746546589', 'Kiabi', 33, 'Beige', 'coton', 'sans', 'Pantalon Beige Kiabi en coton', 's', 20, '20'),
(67, 'img/produits/FOA1fkVTitOr6RWF4nQ8.jpg', 'Pantalon Kiabi', 'homme', '274654658957588', 'Kiabi', 33, 'Beige', 'coton', 'sans', 'Pantalon beige Kiabi en coton.', 's', 17, '20'),
(68, 'img/produits/6eQvEXMwhYFN4kTpoNm3.jpg', 'Pantalon Kiabi', 'homme', '2746546589756524', 'Kiabi', 33, 'Vert', 'coton', 'sans', 'Pantalon vert Kiabi en coton.', 's', 16, '20'),
(69, 'img/produits/vYSb3tRdZNpF47MUxuBZ.jpg', 'Pantalon Kiabi', 'homme', '6546589', 'Kiabi', 33, 'Blanc', 'coton', 'sans', 'Pantalon blanc Kiabi en coton.', 's', 12, '20'),
(70, 'img/produits/HGVcEqmkOC6zWFfFTgJJ.jpg', 'Pantalon Kiabi', 'homme', '65456', 'Kiabi', 33, 'noir', 'coton', 'sans', 'Pantalon noir Kiabi en coton.', 's', 20, '20');

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
(2, 'admin', 'admin', 'admin@dmin.fr', '$argon2id$v=19$m=65536,t=4,p=1$Wkp0OGdtMzFnNzRkTXdKQg$Wng5DnehOQhjlWq5fOxO8Rs5XJFy72QN5/RXXIstPyE', NULL, '[\"ROLE_ADMIN\"]'),
(3, 'Christian', 'Mallard', 'mallard@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bThLNzl0NzhLdmptVzhBdg$uEzaQJxH5SieahRcNIBCSihWGG29MX5l1PEWcEiAetI', NULL, '[\"ROLE_USER\"]'),
(4, 'Patrick', 'Moreau', 'patrick.moreau@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$MHFiU2kuVUVDbTAuL2FoZA$UnptkbwFZz23xrJULTx8x2pKaAeQ74mOKQQhyNIgjyI', NULL, '[\"ROLE_USER\"]'),
(5, 'Charles', 'Bernard', 'bernard.charles@hotmail.fr', '$argon2id$v=19$m=65536,t=4,p=1$NjVFMTRtVTIub0toeExseg$0YdQDGoO7rDVpa2tKT95T2nT5XbBbgBoYxJdUMeUfJg', NULL, '[\"ROLE_USER\"]'),
(6, 'Jean', 'Garlan', 'garlan.jean@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Y0hlQ1ZvQmg0TTNWbWpBNQ$RzH26v2mmoZ6twGcayNv1UjsMgcVBwqyTxmBYIK2gxg', NULL, '[\"ROLE_USER\"]'),
(7, 'Alisson', 'Dubois', 'alisson12445@laposte.net', '$argon2id$v=19$m=65536,t=4,p=1$ZEFzNkhwZ1FOZlBsUEV2cA$EfC0H3HG1OD6xLGp/5Jq51ndgXmQOz480pkKczjkF3Q', NULL, '[\"ROLE_USER\"]'),
(8, 'Simon', 'Dupuy', 'simondupuy@hotmail.com', '$argon2id$v=19$m=65536,t=4,p=1$MGZZeFYwNFpTZ1hqVGdYSg$AYV1Y6fCJzDDIfsvK9vMiuYs8VS/+2osC+w6dyUSlXI', NULL, '[\"ROLE_USER\"]'),
(9, 'Guy', 'Colin', 'gcolin@orange.fr', '$argon2id$v=19$m=65536,t=4,p=1$cG5KM3Ywbm9CTW5DTXdlNg$0E4C8BQt1T1AmL9cR9nYzhDsBNYGioWhbpTEJf4cAZ0', NULL, '[\"ROLE_USER\"]'),
(10, 'David', 'Lombard', 'lombard.david@yahoo.com', '$argon2id$v=19$m=65536,t=4,p=1$QUVPMUpTREZ3QmlWRHl5bw$fzgh1O+ccOeJ9KrNmUQXmst4Y08PjEJwwxEW4pM1uE0', NULL, '[\"ROLE_USER\"]'),
(11, 'Jacques', 'Laroche', 'jacques.laroche@free.fr', '$argon2id$v=19$m=65536,t=4,p=1$WW5VTEcwVlBwZFp2aTZ1RQ$0FfU7rQ5m5Fx8HigD2ICINTk5DtVHhw07Qzjdhl7pxU', NULL, '[\"ROLE_USER\"]'),
(12, 'Claire', 'Tournier', 'claire.tournier@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$N3U2N0I0REtzVmZ4R0E3aw$HCU0so3EmPyvbL7ftRjhIVX9UYuXwHnKNsPhR5a/9II', NULL, '[\"ROLE_USER\"]');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `commande_details`
--
ALTER TABLE `commande_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
