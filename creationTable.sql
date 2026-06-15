-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 15 juin 2026 à 11:50
-- Version du serveur : 11.4.12-MariaDB
-- Version de PHP : 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tima6358_johan-leguennec-projet`
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

--
-- Déchargement des données de la table `ARTICLE`
--

INSERT INTO `ARTICLE` (`id_article`, `id_article_informations`, `deleted_at`) VALUES
(12, 2, NULL),
(13, 2, NULL),
(14, 2, NULL),
(15, 2, NULL),
(16, 2, NULL),
(17, 2, NULL),
(18, 2, NULL),
(19, 2, NULL),
(20, 2, '2026-04-24'),
(21, 2, NULL),
(22, 2, NULL),
(23, 3, NULL),
(24, 3, NULL),
(25, 3, '2026-04-24'),
(26, 3, NULL),
(27, 3, NULL),
(28, 3, NULL),
(29, 4, NULL),
(30, 4, NULL),
(31, 4, NULL),
(32, 4, NULL),
(33, 4, NULL),
(34, 4, NULL),
(35, 4, NULL),
(36, 5, NULL),
(37, 5, NULL),
(38, 5, NULL),
(39, 5, NULL),
(40, 5, NULL),
(41, 6, NULL),
(42, 6, NULL),
(43, 6, NULL),
(44, 6, NULL),
(45, 6, NULL),
(46, 6, NULL),
(47, 7, NULL),
(48, 8, NULL),
(49, 8, NULL),
(50, 8, NULL),
(51, 8, NULL),
(52, 8, NULL),
(53, 9, NULL),
(54, 9, NULL),
(55, 9, NULL),
(56, 9, NULL),
(57, 10, NULL),
(58, 10, NULL),
(59, 10, NULL),
(60, 10, NULL),
(61, 10, NULL),
(62, 11, NULL),
(63, 12, NULL),
(64, 12, NULL),
(65, 12, NULL),
(66, 12, NULL),
(67, 12, NULL),
(68, 12, NULL),
(69, 12, NULL),
(70, 12, NULL),
(71, 12, NULL),
(72, 12, NULL),
(73, 13, '2026-04-24'),
(74, 13, NULL),
(75, 13, NULL),
(76, 13, '2026-04-24'),
(77, 13, NULL),
(78, 14, NULL),
(79, 15, NULL),
(80, 16, NULL),
(81, 16, NULL),
(82, 16, NULL),
(83, 16, NULL),
(84, 16, NULL),
(85, 16, NULL),
(86, 16, NULL);

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

--
-- Déchargement des données de la table `ARTICLE_INFORMATIONS`
--

INSERT INTO `ARTICLE_INFORMATIONS` (`id_article_informations`, `article_name`, `description`, `image_repertory`, `id_category`, `id_brand`) VALUES
(1, 'Maillot de l&#039;équipe de france', 'Supportez les bleues en arborant leurs couleurs ! Cette année elle est à nous !', '6a2fe05ff0f1d', 15, 8),
(2, 'Baskets vertes', 'Basket running légère et respirante au coloris vert dynamique. Dotée d&#039;une semelle crantée pour une bonne accroche et d&#039;un amorti confortable, elle s&#039;adapte aussi bien à la course qu&#039;à un usage quotidien.', '69e7fe51f1bf0', 11, 6),
(3, 'Haut femme vert', 'Débardeur de sport femme en tissu technique respirant. Sa coupe dos nageur offre une liberté de mouvement totale, idéale pour le yoga, le fitness ou la course. Disponible en vert bouteille.', '69e802c669ac8', 16, 1),
(4, 'Jogging noir homme', 'Jogging homme coupe slim en molleton doux et résistant. Équipé de poches zippées et d&#039;une ceinture élastique ajustable, il alllie confort et style aussi bien pour le sport que pour la détente.', '69e803d5282ee', 9, 6),
(5, 'Jogging rose femme', 'Jogging femme en molleton doux au coloris rose vif. Coupe décontractée avec ceinture élastique et poches latérales, parfait pour les séances de sport ou les journées casual à la maison.', '69e804bc9e909', 10, 6),
(6, 'Sweat à capuche noir', 'Sweat à capuche homme en coton épais et confortable. Son coloris noir sobre et sa poche kangourou en font un essentiel du vestiaire sportif, idéal pour l&#039;échauffement ou les sorties en extérieur par temps frais.', '69e80758bdf23', 13, 4),
(7, 'Haltère', 'Haltère réglable de 10 kg avec disques en fonte enrobés. Robuste et ergonomique, il est parfait pour vos séances de musculation à domicile ou en salle, que vous soyez débutant ou confirmé.', '69e808f5ab82e', 19, 2),
(8, 'Sweat rouge à capuche', 'Sweat à capuche unisexe en coton épais et confortable. Son coloris rouge et sa poche kangourou en font un essentiel du vestiaire sportif, idéal pour l&#039;échauffement ou les sorties en extérieur par temps frais.', '69e84ef81a982', 13, 10),
(9, 'Sweat à capuche rose', 'Sweat à capuche unisexe en coton épais et confortable. Son coloris rose sobre et sa poche kangourou en font un essentiel du vestiaire sportif, idéal pour l&#039;échauffement ou les sorties en extérieur par temps frais.', '69e8557765f8c', 14, 1),
(10, 'Tee-shirt bleue marine pour homme', 'Redéfinissez vos basiques avec ce tee-shirt bleu marine premium. Sa maille respirante et sa coupe ergonomique assurent une allure impeccable en toute circonstance.', '69e858386c12b', 15, 7),
(11, 'Ballon de foot bleu', 'Dominez le terrain avec ce ballon au design aérodynamique haute performance. Ses motifs bleus et or assurent une visibilité parfaite, tandis que son revêtement technique garantit un toucher de balle précis et une trajectoire stable', '69e8599d4293e', 20, 9),
(12, 'Baskets vertes pour femme', 'Basket running légère et respirante au coloris vert dynamique. Dotée d&amp;#039;une semelle crantée pour une bonne accroche et d&amp;#039;un amorti confortable, elle s&amp;#039;adapte aussi bien à la course qu&amp;#039;à un usage quotidien.', '69e85d3fee651', 12, 3),
(13, 'Jogging rose femme', 'Super jogging', '69eb42386702f', 9, 10),
(14, 'test', 'dfdf', '69eb431d00d29', 18, 6),
(16, 'Maillot de l&#039;équipe de france', 'Venez supporter nos bleus !', '6a2fe131a7fe4', 15, 8);

-- --------------------------------------------------------

--
-- Structure de la table `ARTICLE_ORDER`
--

CREATE TABLE `ARTICLE_ORDER` (
  `id_article` int(11) NOT NULL,
  `id_order_` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ARTICLE_ORDER`
--

INSERT INTO `ARTICLE_ORDER` (`id_article`, `id_order_`, `quantity`) VALUES
(17, 2, 1),
(17, 5, 3),
(29, 4, 1),
(49, 3, 3),
(74, 5, 1),
(78, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `BRAND`
--

CREATE TABLE `BRAND` (
  `id_brand` int(11) NOT NULL,
  `brand_label` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `BRAND`
--

INSERT INTO `BRAND` (`id_brand`, `brand_label`) VALUES
(6, 'ActiveWave'),
(1, 'AthleteX'),
(8, 'EndureFit'),
(4, 'IronCore'),
(10, 'PeakForce'),
(7, 'ProStrike'),
(3, 'RunFast'),
(2, 'SportEdge'),
(9, 'SwiftGear'),
(5, 'VeloSpeed');

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `id_category` int(11) NOT NULL,
  `cat_label` varchar(50) NOT NULL,
  `id_category_parent_of` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `CATEGORY`
--

INSERT INTO `CATEGORY` (`id_category`, `cat_label`, `id_category_parent_of`) VALUES
(1, 'Sports', NULL),
(2, 'Vêtements', NULL),
(3, 'Homme', 2),
(4, 'Femme', 2),
(5, 'Haut', 3),
(6, 'Haut', 4),
(7, 'Bas', 3),
(8, 'Bas', 4),
(9, 'Jogging', 7),
(10, 'Jogging', 8),
(11, 'Chaussures', 7),
(12, 'Chaussures', 8),
(13, 'Sweat', 5),
(14, 'Sweat', 6),
(15, 'Tee-shirt', 5),
(16, 'Tee-shirt', 6),
(17, 'Pull', 5),
(18, 'Pull', 6),
(19, 'Musculation', 1),
(20, 'Football', 1);

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_`
--

CREATE TABLE `CHOICE_` (
  `id_choice_` int(11) NOT NULL,
  `id_filter_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `CHOICE_`
--

INSERT INTO `CHOICE_` (`id_choice_`, `id_filter_type`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4),
(42, 4),
(43, 6),
(44, 6),
(45, 6),
(46, 7),
(47, 7),
(48, 7),
(49, 7),
(50, 7),
(51, 8),
(52, 8),
(53, 8),
(54, 8),
(55, 8),
(56, 8),
(57, 9),
(58, 9),
(59, 9),
(60, 9),
(61, 9),
(62, 9),
(63, 5),
(64, 5),
(65, 5),
(66, 5);

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_COLOR`
--

CREATE TABLE `CHOICE_COLOR` (
  `id_choice_` int(11) NOT NULL,
  `color_choice_label` varchar(30) NOT NULL,
  `color_choice_hexa` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `CHOICE_COLOR`
--

INSERT INTO `CHOICE_COLOR` (`id_choice_`, `color_choice_label`, `color_choice_hexa`) VALUES
(8, 'Noir', '#000000'),
(9, 'Blanc', '#FFFFFF'),
(10, 'Gris', '#808080'),
(11, 'Bleu marine', '#000080'),
(12, 'Bleu ciel', '#87CEEB'),
(13, 'Rouge', '#FF0000'),
(14, 'Vert', '#008000'),
(15, 'Jaune', '#FFD700'),
(16, 'Orange', '#FFA500'),
(17, 'Rose', '#FFC0CB'),
(18, 'Bordeaux', '#800020'),
(19, 'Beige', '#F5F5DC');

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_NUMBER`
--

CREATE TABLE `CHOICE_NUMBER` (
  `id_choice_` int(11) NOT NULL,
  `choice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `CHOICE_NUMBER`
--

INSERT INTO `CHOICE_NUMBER` (`id_choice_`, `choice`) VALUES
(28, 35),
(29, 36),
(30, 37),
(31, 38),
(32, 39),
(33, 40),
(34, 41),
(35, 42),
(36, 43),
(37, 44),
(38, 45),
(39, 46),
(40, 47),
(41, 48),
(42, 49),
(46, 28),
(47, 30),
(48, 32),
(49, 34),
(50, 36),
(51, 54),
(52, 55),
(53, 56),
(54, 57),
(55, 58),
(56, 59),
(57, 10),
(58, 15),
(59, 20),
(60, 30),
(61, 40),
(62, 50),
(66, 10);

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_RANGE`
--

CREATE TABLE `CHOICE_RANGE` (
  `id_choice_` int(11) NOT NULL,
  `min_` decimal(8,3) NOT NULL,
  `max_` decimal(8,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `CHOICE_RANGE`
--

INSERT INTO `CHOICE_RANGE` (`id_choice_`, `min_`, `max_`) VALUES
(63, 0.000, 0.500),
(64, 0.500, 1.000),
(65, 1.000, 3.000);

-- --------------------------------------------------------

--
-- Structure de la table `CHOICE_TXT`
--

CREATE TABLE `CHOICE_TXT` (
  `id_choice_` int(11) NOT NULL,
  `choice` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `CHOICE_TXT`
--

INSERT INTO `CHOICE_TXT` (`id_choice_`, `choice`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, 'XXXL'),
(20, 'Coton'),
(21, 'Polyester'),
(22, 'Élasthanne'),
(23, 'Laine'),
(24, 'Nylon'),
(25, 'Gore-Tex'),
(26, 'Caoutchouc'),
(27, 'Cuir'),
(43, 'Homme'),
(44, 'Femme'),
(45, 'Mixte');

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

--
-- Déchargement des données de la table `COMMENT`
--

INSERT INTO `COMMENT` (`id_comment`, `comment_label`, `id_article_informations`, `id_user_`) VALUES
(2, 'Test', 6, 5),
(4, 'Je l&#039;ai reçu en 12 secondes, je le croivay pas de mes oeils nus.', 7, 6);

-- --------------------------------------------------------

--
-- Structure de la table `FILTERED_BY`
--

CREATE TABLE `FILTERED_BY` (
  `id_category` int(11) NOT NULL,
  `id_filter_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `FILTERED_BY`
--

INSERT INTO `FILTERED_BY` (`id_category`, `id_filter_type`) VALUES
(2, 2),
(3, 2),
(5, 1),
(5, 3),
(6, 1),
(6, 3),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 4),
(12, 4),
(19, 5),
(20, 2);

-- --------------------------------------------------------

--
-- Structure de la table `FILTER_TYPE`
--

CREATE TABLE `FILTER_TYPE` (
  `id_filter_type` int(11) NOT NULL,
  `filter_type_label` varchar(50) NOT NULL,
  `filter_type_unit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `FILTER_TYPE`
--

INSERT INTO `FILTER_TYPE` (`id_filter_type`, `filter_type_label`, `filter_type_unit`) VALUES
(1, 'Taille', NULL),
(2, 'Couleur', NULL),
(3, 'Matière', NULL),
(4, 'Pointure', 'EU'),
(5, 'Poids', 'kg'),
(6, 'Genre', NULL),
(7, 'Longueur', 'cm'),
(8, 'Tour de tête', 'cm'),
(9, 'Volume', 'L');

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
(6, '2026-06-11', 0),
(7, '2026-06-11', 0),
(8, '2026-06-11', 0),
(9, '2026-06-11', 0),
(10, '2026-06-11', 0),
(11, '2026-06-11', 0);

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
(120, '2026-05-20', '2026-06-20', 15.00, 15),
(121, '2026-06-15', NULL, 99.99, 79),
(208, '2026-06-15', NULL, 99.99, 80),
(209, '2026-06-15', NULL, 99.99, 81),
(210, '2026-06-15', NULL, 99.99, 82),
(211, '2026-06-15', NULL, 99.99, 83),
(212, '2026-06-15', NULL, 99.99, 84),
(213, '2026-06-15', NULL, 99.99, 85),
(214, '2026-06-15', NULL, 99.99, 86);

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
(7, 'leilaandterracid@love.fr', '$2y$12$tjOj7Nv3KtR9K7Mp.m4tMetRD2I/whIpMNPvhyQky4qrdLYoJGVaa', 'Terracid', 'Leila', 75001, 'Paris', 'Rue de lamour', '0708080808', 1);

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
(213, 78, 21, 3),
(214, 79, 1, 1),
(215, 79, 11, 2),
(216, 79, 21, 3),
(369, 80, 1, 1),
(370, 80, 11, 2),
(371, 80, 21, 3),
(372, 81, 2, 1),
(373, 81, 11, 2),
(374, 81, 21, 3),
(375, 82, 3, 1),
(376, 82, 11, 2),
(377, 82, 21, 3),
(378, 83, 4, 1),
(379, 83, 11, 2),
(380, 83, 21, 3),
(381, 84, 5, 1),
(382, 84, 11, 2),
(383, 84, 21, 3),
(384, 85, 6, 1),
(385, 85, 11, 2),
(386, 85, 21, 3),
(387, 86, 7, 1),
(388, 86, 11, 2),
(389, 86, 21, 3);

-- --------------------------------------------------------

--
-- Structure de la vue `FILTER_VALUES_ASSOCIATIONS`
--
DROP TABLE IF EXISTS `FILTER_VALUES_ASSOCIATIONS`;

CREATE ALGORITHM=UNDEFINED DEFINER=`tima6358_johan-leguennec`@`localhost` SQL SECURITY DEFINER VIEW `FILTER_VALUES_ASSOCIATIONS`  AS SELECT `C`.`id_choice_` AS `id_choice_`, `C`.`id_filter_type` AS `id_filter_type`, CASE WHEN exists(select 1 from `CHOICE_COLOR` `CC` where `CC`.`id_choice_` = `C`.`id_choice_` limit 1) THEN (select `CC`.`color_choice_label` from `CHOICE_COLOR` `CC` where `CC`.`id_choice_` = `C`.`id_choice_`) WHEN exists(select 1 from `CHOICE_TXT` `CT` where `CT`.`id_choice_` = `C`.`id_choice_` limit 1) THEN (select `CT`.`choice` from `CHOICE_TXT` `CT` where `CT`.`id_choice_` = `C`.`id_choice_`) WHEN exists(select 1 from `CHOICE_NUMBER` `CN` where `CN`.`id_choice_` = `C`.`id_choice_` limit 1) THEN (select `CN`.`choice` from `CHOICE_NUMBER` `CN` where `CN`.`id_choice_` = `C`.`id_choice_`) WHEN exists(select 1 from `CHOICE_RANGE` `CR` where `CR`.`id_choice_` = `C`.`id_choice_` limit 1) THEN (select concat(`CR`.`min_`,' - ',`CR`.`max_`) from `CHOICE_RANGE` `CR` where `CR`.`id_choice_` = `C`.`id_choice_`) ELSE NULL END AS `filter_value` FROM `CHOICE_` AS `C` ;

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
  ADD PRIMARY KEY (`id_choice_`);

--
-- Index pour la table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD PRIMARY KEY (`id_comment`);

--
-- Index pour la table `FILTER_TYPE`
--
ALTER TABLE `FILTER_TYPE`
  ADD PRIMARY KEY (`id_filter_type`);

--
-- Index pour la table `ORDER_`
--
ALTER TABLE `ORDER_`
  ADD PRIMARY KEY (`id_order_`);

--
-- Index pour la table `PRICE_HISTORY`
--
ALTER TABLE `PRICE_HISTORY`
  ADD PRIMARY KEY (`id_price_history`);

--
-- Index pour la table `USER_`
--
ALTER TABLE `USER_`
  ADD PRIMARY KEY (`id_user_`);

--
-- Index pour la table `USER_LEVEL`
--
ALTER TABLE `USER_LEVEL`
  ADD PRIMARY KEY (`id_user_level`);

--
-- Index pour la table `VALUES_`
--
ALTER TABLE `VALUES_`
  ADD PRIMARY KEY (`id_values_`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `ARTICLE_INFORMATIONS`
--
ALTER TABLE `ARTICLE_INFORMATIONS`
  MODIFY `id_article_informations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `ARTICLE_ORDER`
--
ALTER TABLE `ARTICLE_ORDER`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT pour la table `BRAND`
--
ALTER TABLE `BRAND`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `CHOICE_`
--
ALTER TABLE `CHOICE_`
  MODIFY `id_choice_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `COMMENT`
--
ALTER TABLE `COMMENT`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `FILTER_TYPE`
--
ALTER TABLE `FILTER_TYPE`
  MODIFY `id_filter_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `ORDER_`
--
ALTER TABLE `ORDER_`
  MODIFY `id_order_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `PRICE_HISTORY`
--
ALTER TABLE `PRICE_HISTORY`
  MODIFY `id_price_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT pour la table `USER_`
--
ALTER TABLE `USER_`
  MODIFY `id_user_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `USER_LEVEL`
--
ALTER TABLE `USER_LEVEL`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `VALUES_`
--
ALTER TABLE `VALUES_`
  MODIFY `id_values_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;