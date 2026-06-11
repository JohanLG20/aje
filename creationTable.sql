-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 11 juin 2026 à 09:19
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
-- Base de données : `aje`
--

-- --------------------------------------------------------

--
-- Structure de la table `ARTICLE`
--

CREATE TABLE `ARTICLE` (
  `id_article` int(11) NOT NULL,
  `id_article_informations` int(11) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ARTICLE_INFORMATIONS`
--

CREATE TABLE `ARTICLE_INFORMATIONS` (
  `id_article_informations` int(11) NOT NULL,
  `article_name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image_repertory` varchar(50) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ARTICLE_ORDER`
--

CREATE TABLE `ARTICLE_ORDER` (
  `id_article` int(11) NOT NULL,
  `id_order_` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `BRAND`
--

CREATE TABLE `BRAND` (
  `id_brand` int(11) NOT NULL,
  `brand_label` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `id_category` int(11) NOT NULL,
  `cat_label` varchar(50) NOT NULL,
  `id_category_parent_of` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_`
--

CREATE TABLE `CHOICE_` (
  `id_choice_` int(11) NOT NULL,
  `id_filter_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_COLOR`
--

CREATE TABLE `CHOICE_COLOR` (
  `id_choice_` int(11) NOT NULL,
  `color_choice_label` varchar(30) NOT NULL,
  `color_choice_hexa` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_NUMBER`
--

CREATE TABLE `CHOICE_NUMBER` (
  `id_choice_` int(11) NOT NULL,
  `choice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_RANGE`
--

CREATE TABLE `CHOICE_RANGE` (
  `id_choice_` int(11) NOT NULL,
  `min_` decimal(8,3) NOT NULL,
  `max_` decimal(8,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_TXT`
--

CREATE TABLE `CHOICE_TXT` (
  `id_choice_` int(11) NOT NULL,
  `choice` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `COMMENT`
--

CREATE TABLE `COMMENT` (
  `id_comment` int(11) NOT NULL,
  `comment_label` varchar(120) DEFAULT NULL,
  `id_article_informations` int(11) NOT NULL,
  `id_user_` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `FILTERED_BY`
--

CREATE TABLE `FILTERED_BY` (
  `id_category` int(11) NOT NULL,
  `id_filter_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `FILTER_TYPE`
--

CREATE TABLE `FILTER_TYPE` (
  `id_filter_type` int(11) NOT NULL,
  `filter_type_label` varchar(50) NOT NULL,
  `filter_type_unit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `FILTER_VALUES_ASSOCIATIONS`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `FILTER_VALUES_ASSOCIATIONS` (
`id_choice_` int(11)
,`id_filter_type` int(11)
,`filter_value` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure de la table `ORDER_`
--

CREATE TABLE `ORDER_` (
  `id_order_` int(11) NOT NULL,
  `date_` date NOT NULL DEFAULT current_timestamp(),
  `id_user_` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ORDER_`
--

INSERT INTO `ORDER_` (`id_order_`, `date_`, `id_user_`) VALUES
(1, '2026-06-09', 5),
(2, '2026-06-09', 5),
(3, '2026-06-09', 5),
(4, '2026-06-10', 5),
(5, '2026-06-10', 5),
(6, '2026-06-11', 5);

-- --------------------------------------------------------

--
-- Structure de la table `PRICE_HISTORY`
--

CREATE TABLE `PRICE_HISTORY` (
  `id_price_history` int(11) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `PRICE_HISTORY`
--

INSERT INTO `PRICE_HISTORY` (`id_price_history`, `start_date`, `end_date`, `price`, `id_article`) VALUES
(35, '0000-00-00', NULL, 58.00, 12),
(36, '0000-00-00', NULL, 58.00, 13),
(37, '0000-00-00', NULL, 58.00, 14),
(38, '0000-00-00', NULL, 58.00, 15),
(39, '0000-00-00', NULL, 58.00, 16),
(40, '0000-00-00', NULL, 58.00, 17),
(41, '0000-00-00', NULL, 58.00, 18),
(42, '0000-00-00', NULL, 58.00, 19),
(43, '0000-00-00', NULL, 58.00, 20),
(44, '0000-00-00', NULL, 58.00, 21),
(45, '0000-00-00', NULL, 58.00, 22),
(46, '0000-00-00', NULL, 25.00, 23),
(47, '0000-00-00', NULL, 25.00, 24),
(48, '0000-00-00', NULL, 25.00, 25),
(49, '0000-00-00', NULL, 25.00, 26),
(50, '0000-00-00', NULL, 25.00, 27),
(51, '0000-00-00', NULL, 25.00, 28),
(52, '0000-00-00', NULL, 42.00, 29),
(53, '0000-00-00', NULL, 42.00, 30),
(54, '0000-00-00', NULL, 42.00, 31),
(55, '0000-00-00', NULL, 42.00, 32),
(56, '0000-00-00', NULL, 42.00, 33),
(57, '0000-00-00', NULL, 42.00, 34),
(58, '0000-00-00', NULL, 42.00, 35),
(59, '0000-00-00', NULL, 55.00, 36),
(60, '0000-00-00', NULL, 55.00, 37),
(61, '0000-00-00', NULL, 55.00, 38),
(62, '0000-00-00', NULL, 55.00, 39),
(63, '0000-00-00', NULL, 55.00, 40),
(64, '0000-00-00', NULL, 35.00, 41),
(65, '0000-00-00', NULL, 35.00, 42),
(66, '0000-00-00', NULL, 35.00, 43),
(67, '0000-00-00', NULL, 35.00, 44),
(68, '0000-00-00', NULL, 35.00, 45),
(69, '0000-00-00', NULL, 35.00, 46),
(70, '0000-00-00', NULL, 10.00, 47),
(71, '0000-00-00', NULL, 50.00, 48),
(72, '0000-00-00', NULL, 50.00, 49),
(73, '0000-00-00', NULL, 50.00, 50),
(74, '0000-00-00', NULL, 50.00, 51),
(75, '0000-00-00', NULL, 50.00, 52),
(76, '2026-04-20', '2026-06-19', 25.00, 48),
(77, '2026-04-20', '2026-06-19', 25.00, 49),
(78, '2026-04-20', '2026-06-19', 25.00, 50),
(79, '2026-04-20', '2026-06-19', 25.00, 51),
(80, '2026-04-20', '2026-06-19', 25.00, 52),
(81, '2026-04-20', '2026-06-19', 19.99, 23),
(82, '2026-04-20', '2026-06-19', 19.99, 24),
(83, '2026-04-20', '2026-06-19', 19.99, 25),
(84, '2026-04-20', '2026-06-19', 19.99, 26),
(85, '2026-04-20', '2026-06-19', 19.99, 27),
(86, '2026-04-20', '2026-06-19', 19.99, 28),
(87, '0000-00-00', NULL, 54.00, 53),
(88, '0000-00-00', NULL, 54.00, 54),
(89, '0000-00-00', NULL, 54.00, 55),
(90, '0000-00-00', NULL, 54.00, 56),
(91, '0000-00-00', NULL, 48.00, 57),
(92, '0000-00-00', NULL, 48.00, 58),
(93, '0000-00-00', NULL, 48.00, 59),
(94, '0000-00-00', NULL, 48.00, 60),
(95, '0000-00-00', NULL, 48.00, 61),
(96, '0000-00-00', NULL, 15.00, 62),
(97, '2026-04-20', '2026-06-19', 9.99, 62),
(98, '0000-00-00', NULL, 44.99, 63),
(99, '0000-00-00', NULL, 44.99, 64),
(100, '0000-00-00', NULL, 44.99, 65),
(101, '0000-00-00', NULL, 44.99, 66),
(102, '0000-00-00', NULL, 44.99, 67),
(103, '0000-00-00', NULL, 44.99, 68),
(104, '0000-00-00', NULL, 44.99, 69),
(105, '0000-00-00', NULL, 44.99, 70),
(106, '0000-00-00', NULL, 44.99, 71),
(107, '0000-00-00', NULL, 44.99, 72),
(108, '2026-04-20', '2026-06-19', 43.99, 36),
(109, '2026-04-20', '2026-06-19', 43.99, 37),
(110, '2026-04-20', '2026-06-19', 43.99, 38),
(111, '2026-04-20', '2026-06-19', 43.99, 39),
(112, '2026-04-20', '2026-06-19', 43.99, 40),
(113, '0000-00-00', NULL, 15.00, 73),
(114, '0000-00-00', NULL, 15.00, 74),
(115, '0000-00-00', NULL, 15.00, 75),
(116, '0000-00-00', NULL, 15.00, 76),
(117, '0000-00-00', NULL, 15.00, 77),
(118, '2026-04-23', '2026-06-19', 25.00, 17),
(119, '0000-00-00', NULL, 12.00, 78),
(120, '2026-05-20', '2026-06-20', 15.00, 15);

-- --------------------------------------------------------

--
-- Structure de la table `USER_`
--

CREATE TABLE `USER_` (
  `id_user_` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `id_user_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `USER_`
--

INSERT INTO `USER_` (`id_user_`, `mail`, `passwd`, `first_name`, `last_name`, `postal_code`, `city`, `address`, `phone_number`, `id_user_level`) VALUES
(3, 'bourdin.alb@gmail.com', '$2y$12$xa9USJDX0qydo4TY0pUwKeNk4frW3tbV2hLsZkDQXx8YKil.UvoWW', 'Amelie', 'Bourdin', 56000, 'VANNES', 'rue des thunes', '0783630968', 1),
(4, 'vazuzibi@gmail.com', '$2y$12$sSycDYRXd5RGlHLiPZvGw.7DTqu8CTqK1X3OlkdGFhuBlZX2TZ..S', 'test', 'Test', 56500, 'Test', 'Coucou la vie', '0201030506', 1),
(5, 'test@test.fr', '$2y$12$/FInF/LFFLhCVqG9lvu0B.s77YX2Bjy20opuoQu4pX5NF2MvLMzVm', 'Johan', 'Le Guennec', 12546, 'test', 'Rue du test 25', '0602268923', 3),
(6, 'vampyr@kisucdu.san', '$2y$12$a017goUS3nuMUdonerDxaeUOIPTQPtH57/WcM25HFQ.PXb/OYZE6u', 'Dracu', 'Lope', 69696, 'Tralala', 'Rue du Fion', '06 66 99 96 69', 1),
(7, 'leyla@gmail.com', '$2y$12$RDZogQq1V3zheDiCUtXuJe/8AWC6X50CimC6fVIXzQj2iYkEG5D4m', 'Leyla', 'Chakour', 92220, 'Bagneux', '1', '0643808290', 1),
(12, 'chakour.leyla@gmail.com', '$2y$12$vVFVg3EAXJ7q0dP04vY0j.1kuVAdPn4RlyLZoITTDuC3G1bF/aTOi', 'Leyla', 'Chakour', 92220, 'Bagneux', '10 rue de frfer', '0643808299', 1);

-- --------------------------------------------------------

--
-- Structure de la table `USER_LEVEL`
--

CREATE TABLE `USER_LEVEL` (
  `id_user_level` int(11) NOT NULL,
  `users_level_label` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `USER_LEVEL`
--

INSERT INTO `USER_LEVEL` (`id_user_level`, `users_level_label`) VALUES
(1, 'client'),
(2, 'moderator'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `VALUES_`
--

CREATE TABLE `VALUES_` (
  `id_values_` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_choice_` int(11) NOT NULL,
  `id_filter_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `VALUES_`
--

INSERT INTO `VALUES_` (`id_values_`, `id_article`, `id_choice_`, `id_filter_type`) VALUES
(62, 12, 14, 2),
(63, 12, 30, 4),
(64, 13, 14, 2),
(65, 13, 31, 4),
(66, 14, 14, 2),
(67, 14, 32, 4),
(68, 15, 14, 2),
(69, 15, 33, 4),
(70, 16, 14, 2),
(71, 16, 34, 4),
(72, 17, 14, 2),
(73, 17, 35, 4),
(74, 18, 14, 2),
(75, 18, 36, 4),
(76, 19, 14, 2),
(77, 19, 37, 4),
(78, 20, 14, 2),
(79, 20, 38, 4),
(80, 21, 14, 2),
(81, 21, 39, 4),
(82, 22, 14, 2),
(83, 22, 40, 4),
(84, 23, 1, 1),
(85, 23, 14, 2),
(86, 24, 2, 1),
(87, 24, 14, 2),
(88, 25, 3, 1),
(89, 25, 14, 2),
(90, 26, 4, 1),
(91, 26, 14, 2),
(92, 27, 5, 1),
(93, 27, 14, 2),
(94, 28, 6, 1),
(95, 28, 14, 2),
(96, 29, 1, 1),
(97, 29, 8, 2),
(98, 30, 2, 1),
(99, 30, 8, 2),
(100, 31, 3, 1),
(101, 31, 8, 2),
(102, 32, 4, 1),
(103, 32, 8, 2),
(104, 33, 5, 1),
(105, 33, 8, 2),
(106, 34, 6, 1),
(107, 34, 8, 2),
(108, 35, 7, 1),
(109, 35, 8, 2),
(110, 36, 1, 1),
(111, 36, 17, 2),
(112, 37, 2, 1),
(113, 37, 17, 2),
(114, 38, 3, 1),
(115, 38, 17, 2),
(116, 39, 4, 1),
(117, 39, 17, 2),
(118, 40, 5, 1),
(119, 40, 17, 2),
(120, 41, 1, 1),
(121, 41, 8, 2),
(122, 42, 2, 1),
(123, 42, 8, 2),
(124, 43, 3, 1),
(125, 43, 8, 2),
(126, 44, 4, 1),
(127, 44, 8, 2),
(128, 45, 5, 1),
(129, 45, 8, 2),
(130, 46, 6, 1),
(131, 46, 8, 2),
(132, 47, 66, 5),
(133, 48, 1, 1),
(134, 48, 13, 2),
(135, 48, 20, 3),
(136, 49, 2, 1),
(137, 49, 13, 2),
(138, 49, 20, 3),
(139, 50, 3, 1),
(140, 50, 13, 2),
(141, 50, 20, 3),
(142, 51, 4, 1),
(143, 51, 13, 2),
(144, 51, 20, 3),
(145, 52, 5, 1),
(146, 52, 13, 2),
(147, 52, 20, 3),
(148, 53, 1, 1),
(149, 53, 17, 2),
(150, 53, 20, 3),
(151, 54, 2, 1),
(152, 54, 17, 2),
(153, 54, 20, 3),
(154, 55, 3, 1),
(155, 55, 17, 2),
(156, 55, 20, 3),
(157, 56, 4, 1),
(158, 56, 17, 2),
(159, 56, 20, 3),
(160, 57, 1, 1),
(161, 57, 11, 2),
(162, 57, 20, 3),
(163, 58, 2, 1),
(164, 58, 11, 2),
(165, 58, 20, 3),
(166, 59, 3, 1),
(167, 59, 11, 2),
(168, 59, 20, 3),
(169, 60, 4, 1),
(170, 60, 11, 2),
(171, 60, 20, 3),
(172, 61, 5, 1),
(173, 61, 11, 2),
(174, 61, 20, 3),
(175, 62, 11, 2),
(176, 63, 14, 2),
(177, 63, 28, 4),
(178, 64, 14, 2),
(179, 64, 29, 4),
(180, 65, 14, 2),
(181, 65, 30, 4),
(182, 66, 14, 2),
(183, 66, 31, 4),
(184, 67, 14, 2),
(185, 67, 32, 4),
(186, 68, 14, 2),
(187, 68, 33, 4),
(188, 69, 14, 2),
(189, 69, 34, 4),
(190, 70, 14, 2),
(191, 70, 35, 4),
(192, 71, 14, 2),
(193, 71, 36, 4),
(194, 72, 14, 2),
(195, 72, 37, 4),
(196, 73, 1, 1),
(197, 73, 17, 2),
(198, 73, 26, 3),
(199, 74, 2, 1),
(200, 74, 17, 2),
(201, 74, 26, 3),
(202, 75, 3, 1),
(203, 75, 17, 2),
(204, 75, 26, 3),
(205, 76, 4, 1),
(206, 76, 17, 2),
(207, 76, 26, 3),
(208, 77, 5, 1),
(209, 77, 17, 2),
(210, 77, 26, 3),
(211, 78, 3, 1),
(212, 78, 9, 2),
(213, 78, 21, 3);

-- --------------------------------------------------------

--
-- Structure de la vue `FILTER_VALUES_ASSOCIATIONS`
--
DROP TABLE IF EXISTS `FILTER_VALUES_ASSOCIATIONS`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `FILTER_VALUES_ASSOCIATIONS`  AS SELECT `C`.`id_choice_` AS `id_choice_`, `C`.`id_filter_type` AS `id_filter_type`, CASE WHEN exists(select 1 from `CHOICE_COLOR` `CC` where `CC`.`id_choice_` = `C`.`id_choice_` limit 1) THEN (select `CC`.`color_choice_label` from `CHOICE_COLOR` `CC` where `CC`.`id_choice_` = `C`.`id_choice_`) WHEN exists(select 1 from `CHOICE_TXT` `CT` where `CT`.`id_choice_` = `C`.`id_choice_` limit 1) THEN (select `CT`.`choice` from `CHOICE_TXT` `CT` where `CT`.`id_choice_` = `C`.`id_choice_`) WHEN exists(select 1 from `CHOICE_NUMBER` `CN` where `CN`.`id_choice_` = `C`.`id_choice_` limit 1) THEN (select `CN`.`choice` from `CHOICE_NUMBER` `CN` where `CN`.`id_choice_` = `C`.`id_choice_`) WHEN exists(select 1 from `CHOICE_RANGE` `CR` where `CR`.`id_choice_` = `C`.`id_choice_` limit 1) THEN (select concat(`CR`.`min_`,' - ',`CR`.`max_`) from `CHOICE_RANGE` `CR` where `CR`.`id_choice_` = `C`.`id_choice_`) ELSE NULL END AS `filter_value` FROM `CHOICE_` AS `C` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `id_article_informations` (`id_article_informations`);

--
-- Index pour la table `ARTICLE_INFORMATIONS`
--
ALTER TABLE `ARTICLE_INFORMATIONS`
  ADD PRIMARY KEY (`id_article_informations`),
  ADD UNIQUE KEY `image_repertory` (`image_repertory`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Index pour la table `ARTICLE_ORDER`
--
ALTER TABLE `ARTICLE_ORDER`
  ADD PRIMARY KEY (`id_article`,`id_order_`),
  ADD KEY `id_order_` (`id_order_`);

--
-- Index pour la table `BRAND`
--
ALTER TABLE `BRAND`
  ADD PRIMARY KEY (`id_brand`),
  ADD UNIQUE KEY `brand_label` (`brand_label`);

--
-- Index pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `id_category_parent_of` (`id_category_parent_of`);

--
-- Index pour la table `CHOICE_`
--
ALTER TABLE `CHOICE_`
  ADD PRIMARY KEY (`id_choice_`),
  ADD KEY `id_filter_type` (`id_filter_type`);

--
-- Index pour la table `CHOICE_COLOR`
--
ALTER TABLE `CHOICE_COLOR`
  ADD PRIMARY KEY (`id_choice_`);

--
-- Index pour la table `CHOICE_NUMBER`
--
ALTER TABLE `CHOICE_NUMBER`
  ADD PRIMARY KEY (`id_choice_`);

--
-- Index pour la table `CHOICE_RANGE`
--
ALTER TABLE `CHOICE_RANGE`
  ADD PRIMARY KEY (`id_choice_`);

--
-- Index pour la table `CHOICE_TXT`
--
ALTER TABLE `CHOICE_TXT`
  ADD PRIMARY KEY (`id_choice_`);

--
-- Index pour la table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_article_informations` (`id_article_informations`),
  ADD KEY `id_user_` (`id_user_`);

--
-- Index pour la table `FILTERED_BY`
--
ALTER TABLE `FILTERED_BY`
  ADD PRIMARY KEY (`id_category`,`id_filter_type`),
  ADD KEY `id_filter_type` (`id_filter_type`);

--
-- Index pour la table `FILTER_TYPE`
--
ALTER TABLE `FILTER_TYPE`
  ADD PRIMARY KEY (`id_filter_type`);

--
-- Index pour la table `ORDER_`
--
ALTER TABLE `ORDER_`
  ADD PRIMARY KEY (`id_order_`),
  ADD KEY `id_user_` (`id_user_`);

--
-- Index pour la table `PRICE_HISTORY`
--
ALTER TABLE `PRICE_HISTORY`
  ADD PRIMARY KEY (`id_price_history`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `USER_`
--
ALTER TABLE `USER_`
  ADD PRIMARY KEY (`id_user_`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `id_user_level` (`id_user_level`);

--
-- Index pour la table `USER_LEVEL`
--
ALTER TABLE `USER_LEVEL`
  ADD PRIMARY KEY (`id_user_level`);

--
-- Index pour la table `VALUES_`
--
ALTER TABLE `VALUES_`
  ADD PRIMARY KEY (`id_values_`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_choice_` (`id_choice_`),
  ADD KEY `id_filter_type` (`id_filter_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ARTICLE_INFORMATIONS`
--
ALTER TABLE `ARTICLE_INFORMATIONS`
  MODIFY `id_article_informations` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `BRAND`
--
ALTER TABLE `BRAND`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CHOICE_`
--
ALTER TABLE `CHOICE_`
  MODIFY `id_choice_` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `COMMENT`
--
ALTER TABLE `COMMENT`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `FILTER_TYPE`
--
ALTER TABLE `FILTER_TYPE`
  MODIFY `id_filter_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ORDER_`
--
ALTER TABLE `ORDER_`
  MODIFY `id_order_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `PRICE_HISTORY`
--
ALTER TABLE `PRICE_HISTORY`
  MODIFY `id_price_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT pour la table `USER_`
--
ALTER TABLE `USER_`
  MODIFY `id_user_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `USER_LEVEL`
--
ALTER TABLE `USER_LEVEL`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `VALUES_`
--
ALTER TABLE `VALUES_`
  MODIFY `id_values_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  ADD CONSTRAINT `ARTICLE_ibfk_1` FOREIGN KEY (`id_article_informations`) REFERENCES `ARTICLE_INFORMATIONS` (`id_article_informations`);

--
-- Contraintes pour la table `ARTICLE_INFORMATIONS`
--
ALTER TABLE `ARTICLE_INFORMATIONS`
  ADD CONSTRAINT `ARTICLE_INFORMATIONS_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `CATEGORY` (`id_category`),
  ADD CONSTRAINT `ARTICLE_INFORMATIONS_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `BRAND` (`id_brand`);

--
-- Contraintes pour la table `ARTICLE_ORDER`
--
ALTER TABLE `ARTICLE_ORDER`
  ADD CONSTRAINT `ARTICLE_ORDER_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `ARTICLE` (`id_article`),
  ADD CONSTRAINT `ARTICLE_ORDER_ibfk_2` FOREIGN KEY (`id_order_`) REFERENCES `ORDER_` (`id_order_`);

--
-- Contraintes pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD CONSTRAINT `CATEGORY_ibfk_1` FOREIGN KEY (`id_category_parent_of`) REFERENCES `CATEGORY` (`id_category`);

--
-- Contraintes pour la table `CHOICE_`
--
ALTER TABLE `CHOICE_`
  ADD CONSTRAINT `CHOICE__ibfk_1` FOREIGN KEY (`id_filter_type`) REFERENCES `FILTER_TYPE` (`id_filter_type`);

--
-- Contraintes pour la table `CHOICE_COLOR`
--
ALTER TABLE `CHOICE_COLOR`
  ADD CONSTRAINT `CHOICE_COLOR_ibfk_1` FOREIGN KEY (`id_choice_`) REFERENCES `CHOICE_` (`id_choice_`);

--
-- Contraintes pour la table `CHOICE_NUMBER`
--
ALTER TABLE `CHOICE_NUMBER`
  ADD CONSTRAINT `CHOICE_NUMBER_ibfk_1` FOREIGN KEY (`id_choice_`) REFERENCES `CHOICE_` (`id_choice_`);

--
-- Contraintes pour la table `CHOICE_RANGE`
--
ALTER TABLE `CHOICE_RANGE`
  ADD CONSTRAINT `CHOICE_RANGE_ibfk_1` FOREIGN KEY (`id_choice_`) REFERENCES `CHOICE_` (`id_choice_`);

--
-- Contraintes pour la table `CHOICE_TXT`
--
ALTER TABLE `CHOICE_TXT`
  ADD CONSTRAINT `CHOICE_TXT_ibfk_1` FOREIGN KEY (`id_choice_`) REFERENCES `CHOICE_` (`id_choice_`);

--
-- Contraintes pour la table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD CONSTRAINT `COMMENT_ibfk_1` FOREIGN KEY (`id_user_`) REFERENCES `USER_` (`id_user_`) ON DELETE SET NULL,
  ADD CONSTRAINT `COMMENT_ibfk_2` FOREIGN KEY (`id_user_`) REFERENCES `USER_` (`id_user_`) ON DELETE SET NULL;

--
-- Contraintes pour la table `FILTERED_BY`
--
ALTER TABLE `FILTERED_BY`
  ADD CONSTRAINT `FILTERED_BY_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `CATEGORY` (`id_category`),
  ADD CONSTRAINT `FILTERED_BY_ibfk_2` FOREIGN KEY (`id_filter_type`) REFERENCES `FILTER_TYPE` (`id_filter_type`);

--
-- Contraintes pour la table `ORDER_`
--
ALTER TABLE `ORDER_`
  ADD CONSTRAINT `ORDER__ibfk_1` FOREIGN KEY (`id_user_`) REFERENCES `USER_` (`id_user_`) ON DELETE SET NULL;

--
-- Contraintes pour la table `PRICE_HISTORY`
--
ALTER TABLE `PRICE_HISTORY`
  ADD CONSTRAINT `PRICE_HISTORY_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `ARTICLE` (`id_article`);

--
-- Contraintes pour la table `USER_`
--
ALTER TABLE `USER_`
  ADD CONSTRAINT `USER__ibfk_1` FOREIGN KEY (`id_user_level`) REFERENCES `USER_LEVEL` (`id_user_level`);

--
-- Contraintes pour la table `VALUES_`
--
ALTER TABLE `VALUES_`
  ADD CONSTRAINT `VALUES__ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `ARTICLE` (`id_article`),
  ADD CONSTRAINT `VALUES__ibfk_2` FOREIGN KEY (`id_choice_`) REFERENCES `CHOICE_` (`id_choice_`),
  ADD CONSTRAINT `VALUES__ibfk_3` FOREIGN KEY (`id_filter_type`) REFERENCES `FILTER_TYPE` (`id_filter_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;