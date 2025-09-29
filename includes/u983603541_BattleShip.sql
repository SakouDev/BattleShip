-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 23 nov. 2022 à 19:47
-- Version du serveur : 10.5.12-MariaDB-cll-lve
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u983603541_BattleShip`
--

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hp` int(11) NOT NULL,
  `hpGrowth` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `strengthGrowth` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`id`, `name`, `hp`, `hpGrowth`, `strength`, `strengthGrowth`) VALUES
(1, 'Captain', 150, 15, 50, 4),
(2, 'Gunner', 100, 10, 35, 5),
(3, 'Canonneer', 175, 25, 25, 2),
(4, 'Peon', 50, 2, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fights`
--

CREATE TABLE `fights` (
  `id` int(11) NOT NULL,
  `turn_count` int(11) NOT NULL,
  `team1` varchar(50) NOT NULL,
  `team2` varchar(50) NOT NULL,
  `winner` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fights`
--

INSERT INTO `fights` (`id`, `turn_count`, `team1`, `team2`, `winner`, `date`) VALUES
(207, 8, 'Formateurs', 'Apprenants', 'Formateurs', '2021-10-15 10:10:17'),
(208, 5, 'Formateurs', 'Apprenants', 'Formateurs', '2021-10-15 10:10:27'),
(209, 5, 'Team1', 'Team2', 'Team1', '2021-10-15 10:11:07'),
(210, 5, 'Team1', 'Team2', 'Team1', '2021-10-15 10:11:11'),
(211, 5, 'Team1', 'Team2', 'Team1', '2021-10-15 10:11:13'),
(212, 7, 'Team1', 'Team2', 'Team1', '2021-10-15 10:11:16'),
(213, 20, 'Team1', 'Team2', 'Team1', '2021-10-15 10:40:37'),
(214, 24, 'Formateurs', 'Apprenants', 'Apprenants', '2021-10-15 11:10:41'),
(215, 28, 'Formateurs', 'Apprenants', 'Apprenants', '2021-10-15 11:13:21'),
(216, 15, 'Team1', 'Team2', 'Team2', '2021-10-15 11:20:03'),
(217, 7, 'Team1', 'Team2', 'Team2', '2021-10-15 11:31:29'),
(218, 9, 'Team1', 'Team2', 'Team2', '2021-10-15 11:38:00'),
(219, 8, 'Team1', 'Team2', 'Team2', '2021-10-15 11:39:30'),
(220, 23, 'Team1', 'Team2', 'Team2', '2021-10-15 11:40:36'),
(221, 27, 'Team1', 'Team2', 'Team1', '2021-10-15 12:18:28'),
(222, 31, 'Lesputesdu62', 'Team2', 'Lesputesdu62', '2021-10-16 11:20:01'),
(223, 13, 'Team1', 'Team2', 'Team1', '2021-10-16 22:09:07'),
(224, 18, 'Picardie', 'Team2', 'Picardie', '2021-10-16 22:58:39'),
(225, 20, 'Team1', 'Team2', 'Team1', '2021-10-17 23:35:00'),
(226, 16, 'Team1', 'Team2', 'Team1', '2021-10-17 23:35:06'),
(227, 7, 'Team1', 'Team2', 'Team2', '2021-10-17 23:35:33'),
(228, 15, 'Team1', 'Team2', 'Team2', '2021-10-17 23:41:34'),
(229, 3, 'Team1', 'Team2', 'Team1', '2021-10-17 23:46:13'),
(230, 46, 'Team1', 'Team2', 'Team1', '2021-10-17 23:46:23'),
(231, 44, 'Team1', 'Team2', 'Team1', '2021-10-17 23:46:57'),
(232, 49, 'Team1', 'Team2', 'Team2', '2021-10-17 23:46:59'),
(233, 4, 'Team1', 'Team2', 'Team1', '2021-10-17 23:47:02'),
(234, 13, 'Team1', 'Team2', 'Team2', '2021-10-25 14:06:05'),
(235, 6, 'Team1', 'Team2', 'Team2', '2021-10-25 14:57:30'),
(236, 8, 'Team1', 'Team2', 'Team1', '2021-10-27 10:51:55'),
(237, 4, 'EuroTunnel', 'Peon', 'EuroTunnel', '2021-11-02 11:31:48'),
(238, 4, 'EuroTunnel', 'Peon', 'EuroTunnel', '2021-11-02 11:32:27'),
(239, 33, 'EGM', 'Team2', 'EGM', '2021-11-03 16:02:32'),
(240, 27, 'Team1', 'Team2', 'Team1', '2021-11-03 16:04:11'),
(241, 26, 'Clichy', 'zretrsdgbfvd', 'zretrsdgbfvd', '2021-11-17 14:00:38'),
(242, 25, 'Team1', 'Team2', 'Team2', '2021-11-17 14:01:52'),
(243, 22, 'Team1', 'Team2', 'Team2', '2021-11-17 17:03:25'),
(244, 25, 'Team1', 'Team2', 'Team2', '2021-11-17 17:03:46'),
(245, 32, 'Team1', 'Team2', 'Team2', '2021-11-17 17:05:10'),
(246, 9, 'Team1', 'Team2', 'Team1', '2021-11-17 17:05:45'),
(247, 5, 'Team1', 'Team2', 'Team1', '2021-11-17 17:06:20'),
(248, 20, 'Team1', 'Team2', 'Team1', '2021-11-17 17:07:54'),
(249, 8, 'Team1', 'Team2', 'Team2', '2021-11-17 17:08:52'),
(250, 19, 'Team1', 'Team2', 'Team1', '2021-11-17 17:10:19'),
(251, 26, 'Team1', 'Team2', 'Team1', '2021-11-17 17:10:50'),
(252, 17, 'Team1', 'Team2', 'Team1', '2021-11-17 17:10:58'),
(253, 4, 'Team1', 'Team2', 'Team2', '2021-11-17 17:11:30'),
(254, 29, 'Team1', 'Team2', 'Team2', '2021-11-17 17:13:23'),
(255, 30, 'Team1', 'Team2', 'Team2', '2021-11-17 17:13:47'),
(256, 4, 'Team1', 'Team2', 'Team2', '2021-11-25 22:01:53'),
(257, 4, 'Team1', 'Team2', 'Team2', '2021-11-25 22:02:08'),
(258, 13, 'Team1', 'Team2', 'Team2', '2021-12-16 22:57:42'),
(259, 9, 'Team1', 'Team2', 'Team2', '2021-12-16 22:58:05'),
(260, 13, 'Team1', 'Team2', 'Team2', '2021-12-16 22:58:37'),
(261, 37, 'Team1', 'Team2', 'Team2', '2021-12-24 10:02:18'),
(262, 10, 'Oui', 'Non', 'Oui', '2022-01-14 22:50:45'),
(263, 36, 'Team1', 'Team2', 'Team1', '2022-01-14 22:53:50'),
(264, 9, 'Team1', 'Team2', 'Team2', '2022-01-27 14:04:54'),
(265, 13, 'Team1', 'Team2', 'Team1', '2022-02-08 15:06:47'),
(266, 3, 'Team1', 'Team2', 'Team1', '2022-02-11 01:15:49'),
(267, 6, 'Team1', 'Team2', 'Team2', '2022-02-13 00:34:48'),
(268, 7, 'Team1', 'Team2', 'Team2', '2022-02-13 00:35:13'),
(269, 3, 'Team1', 'Team2', 'Team2', '2022-02-13 05:09:23'),
(270, 6, 'Team1', 'Team2', 'Team2', '2022-02-13 05:09:57'),
(271, 9, 'Team1', 'Team2', 'Team1', '2022-02-18 16:04:05'),
(272, 4, 'Team1', 'Team2', 'Team2', '2022-02-19 16:24:23'),
(273, 5, 'Team1', 'Team2', 'Team1', '2022-02-19 16:25:59'),
(274, 29, 'Team1', 'Team2', 'Team2', '2022-02-19 16:26:03'),
(275, 10, 'Team1', 'Team2', 'Team1', '2022-02-19 16:26:52'),
(276, 11, 'Team1', 'Team2', 'Team2', '2022-02-19 16:27:52'),
(277, 5, 'Team1', 'Team2', 'Team2', '2022-02-28 14:08:14'),
(278, 7, 'Team1', 'Team2', 'Team1', '2022-02-28 14:12:50'),
(279, 3, 'Team1', 'Team2', 'Team2', '2022-02-28 14:13:59'),
(280, 39, 'Équipe 1', 'Team 2', 'Équipe 1', '2022-02-28 14:46:08'),
(281, 24, 'Équipe 1', 'Team 2', 'Team 2', '2022-02-28 14:46:38'),
(282, 4, 'Team1', 'Team2', 'Team2', '2022-03-03 14:44:48'),
(283, 7, 'Team1', 'Team2', 'Team2', '2022-03-03 15:07:31'),
(284, 7, 'Team1', 'Team2', 'Team2', '2022-03-03 15:39:54'),
(285, 4, 'Team1', 'Team2', 'Team2', '2022-03-03 16:17:09'),
(286, 39, 'Team1', 'Team2', 'Team2', '2022-03-04 15:28:10'),
(287, 35, 'Team1', 'Team2', 'Team2', '2022-03-04 15:28:30'),
(288, 11, 'Team1', 'Team2', 'Team2', '2022-03-04 15:30:27'),
(289, 18, 'Team1', 'Team2', 'Team2', '2022-03-06 06:55:22'),
(290, 24, 'Team1', 'Team2', 'Team2', '2022-03-06 06:55:29'),
(291, 4, 'Ta win', 'Ta perdu', 'Ta win', '2022-03-06 06:57:24'),
(292, 4, 'Team1', 'Team2', 'Team2', '2022-03-06 07:02:28'),
(293, 22, 'Team1', 'Team2', 'Team2', '2022-03-06 07:08:09'),
(294, 13, 'La Taverne', 'La Palmeraie', 'La Taverne', '2022-04-02 22:19:48'),
(295, 12, 'La Taverne', 'La Palmeraie', 'La Taverne', '2022-04-02 22:21:50'),
(296, 9, 'Team1', 'Team2', 'Team1', '2022-04-05 11:19:56'),
(297, 8, 'Team1', 'Team2', 'Team1', '2022-04-05 11:20:23'),
(298, 9, 'Win', 'T nul', 'T nul', '2022-04-13 15:58:54'),
(299, 9, 'Win', 'T nul', 'T nul', '2022-04-13 15:59:59'),
(300, 8, 'Win', 'T nul', 'Win', '2022-04-13 16:00:13'),
(301, 40, 'Team1', 'Team2', 'Team1', '2022-04-13 16:00:34'),
(302, 16, 'Team1', 'Team2', 'Team2', '2022-04-13 16:01:18'),
(303, 20, 'Team1', 'Team2', 'Team1', '2022-04-13 16:01:46'),
(304, 20, 'Team1', 'Team2', 'Team1', '2022-04-15 21:02:12'),
(305, 27, 'Team1', 'Team2', 'Team1', '2022-04-15 21:03:19'),
(306, 9, 'Team1', 'Team2', 'Team2', '2022-05-14 19:01:15'),
(307, 12, 'Team1', 'Team2', 'Team2', '2022-05-14 19:01:19'),
(308, 41, 'Team1', 'Team2', 'Team2', '2022-05-22 01:48:19'),
(309, 32, 'Team1', 'Team2', 'Team1', '2022-05-22 01:49:56'),
(310, 41, 'Team1', 'Team2', 'Team2', '2022-05-22 01:50:00'),
(311, 46, 'Team1', 'Team2', 'Team2', '2022-05-22 01:50:17'),
(312, 28, 'Team1', 'Team2', 'Team2', '2022-05-22 01:50:51'),
(313, 24, 'Team1', 'Team2', 'Team1', '2022-05-22 01:53:07'),
(314, 35, 'Team1', 'Team2', 'Team2', '2022-05-22 01:54:17'),
(315, 4, 'Team1', 'Team2', 'Team1', '2022-05-24 21:37:00'),
(316, 26, 'Team1', 'Team2', 'Team1', '2022-06-14 00:26:12'),
(317, 29, 'Team1', 'Team2', 'Team2', '2022-07-04 16:23:56'),
(318, 34, 'Team1', 'Team2', 'Team1', '2022-07-04 16:25:00'),
(319, 27, 'Team1', 'Team2', 'Team2', '2022-07-04 16:30:55'),
(320, 22, 'Team1', 'Team2', 'Team2', '2022-07-04 16:31:26'),
(321, 23, 'Team1', 'Team2', 'Team2', '2022-07-04 16:40:43'),
(322, 29, 'Team1', 'Team2', 'Team2', '2022-07-04 16:40:55'),
(323, 3, 'Team1', 'Team2', 'Team1', '2022-07-04 18:40:14'),
(324, 3, 'Team1', 'Team2', 'Team1', '2022-07-04 18:40:26'),
(325, 4, 'Team1', 'Team2', 'Team1', '2022-07-04 18:40:32'),
(326, 4, 'Team1', 'Team2', 'Team1', '2022-07-04 18:42:34'),
(327, 3, 'Team1', 'Team2', 'Team1', '2022-07-04 18:42:38'),
(328, 4, 'Team1', 'Team2', 'Team1', '2022-07-04 18:42:41'),
(329, 8, 'Team1', 'Team2', 'Team1', '2022-07-05 09:39:09'),
(330, 10, 'Team1', 'Team2', 'Team1', '2022-07-05 09:40:15'),
(331, 5, 'Team1', 'Team2', 'Team1', '2022-07-05 09:41:58'),
(332, 5, 'Team1', 'Team2', 'Team1', '2022-07-05 09:43:28'),
(333, 12, 'Team1', 'Team2', 'Team2', '2022-07-05 09:44:15'),
(334, 14, 'Team1', 'Team2', 'Team2', '2022-07-05 09:44:29'),
(335, 8, 'Team1', 'Team2', 'Team1', '2022-07-05 16:03:04'),
(336, 19, 'Team1', 'Team2', 'Team1', '2022-07-05 16:13:16'),
(337, 17, 'Team1', 'Team2', 'Team1', '2022-07-05 16:14:34'),
(338, 12, 'Team1', 'Team2', 'Team1', '2022-07-05 23:44:00'),
(339, 14, 'Team1', 'Team2', 'Team2', '2022-07-05 23:44:53'),
(340, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 00:09:54'),
(341, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 00:12:56'),
(342, 2, 'Team1', 'Team2', 'Team1', '2022-07-06 00:13:05'),
(343, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 00:13:13'),
(344, 6, 'Team1', 'Team2', 'Team1', '2022-07-06 10:04:37'),
(345, 3, 'Team1', 'Team2', 'Team2', '2022-07-06 10:06:14'),
(346, 30, 'Team1', 'Team2', 'Team2', '2022-07-06 10:43:33'),
(347, 5, 'Team1', 'Team2', 'Team1', '2022-07-06 10:45:40'),
(348, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:45:49'),
(349, 6, 'Team1', 'Team2', 'Team1', '2022-07-06 10:45:53'),
(350, 5, 'Team1', 'Team2', 'Team1', '2022-07-06 10:45:57'),
(351, 5, 'Team1', 'Team2', 'Team1', '2022-07-06 10:46:02'),
(352, 6, 'Team1', 'Team2', 'Team1', '2022-07-06 10:46:05'),
(353, 6, 'Team1', 'Team2', 'Team1', '2022-07-06 10:46:08'),
(354, 5, 'Team1', 'Team2', 'Team1', '2022-07-06 10:47:45'),
(355, 6, 'Team1', 'Team2', 'Team1', '2022-07-06 10:47:49'),
(356, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:48:41'),
(357, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:48:49'),
(358, 5, 'Team1', 'Team2', 'Team1', '2022-07-06 10:48:49'),
(359, 5, 'Team1', 'Team2', 'Team1', '2022-07-06 10:48:53'),
(360, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:48:56'),
(361, 6, 'Team1', 'Team2', 'Team1', '2022-07-06 10:49:00'),
(362, 1, 'Team1', 'Team2', 'Team1', '2022-07-06 10:49:27'),
(363, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:50:01'),
(364, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:50:20'),
(365, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:50:29'),
(366, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:50:33'),
(367, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:50:42'),
(368, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:50:50'),
(369, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:50:59'),
(370, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:51:09'),
(371, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:51:23'),
(372, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:51:35'),
(373, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:51:49'),
(374, 6, 'Team1', 'Team2', 'Team1', '2022-07-06 10:51:53'),
(375, 5, 'Team1', 'Team2', 'Team1', '2022-07-06 10:51:57'),
(376, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:52:28'),
(377, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:52:41'),
(378, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:52:51'),
(379, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:53:02'),
(380, 5, 'Team1', 'Team2', 'Team1', '2022-07-06 10:53:13'),
(381, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:53:24'),
(382, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:53:53'),
(383, 4, 'Team1', 'Team2', 'Team1', '2022-07-06 10:54:06'),
(384, 3, 'Team1', 'Team2', 'Team1', '2022-07-06 10:54:27'),
(385, 2, 'Team1', 'Team2', 'Team1', '2022-07-06 10:54:34'),
(386, 1, 'Team1', 'Team2', 'Team1', '2022-07-06 10:54:43'),
(387, 1, 'Team1', 'Team2', 'Team1', '2022-07-06 10:54:50'),
(388, 27, 'Team1', 'Team2', 'Team1', '2022-07-06 10:59:06'),
(389, 2, 'Team1', 'Team2', 'Team1', '2022-07-06 11:08:10'),
(390, 14, 'Team1', 'Team2', 'Team1', '2022-07-06 13:59:44'),
(391, 4, 'Team1', 'Team2', 'Team1', '2022-07-08 22:42:38'),
(392, 3, 'Team1', 'Team2', 'Team1', '2022-07-11 22:36:17'),
(393, 4, 'Team1', 'Team2', 'Team1', '2022-07-11 22:50:04'),
(394, 5, 'Team1', 'Team2', 'Team2', '2022-07-11 22:50:30'),
(395, 35, 'Team1', 'Team2', 'Team2', '2022-07-11 22:51:00'),
(396, 7, 'Team1', 'Team2', 'Team1', '2022-07-12 13:39:26'),
(397, 8, 'Team1', 'Team2', 'Team1', '2022-07-12 13:39:50'),
(398, 7, 'Team1', 'Team2', 'Team1', '2022-07-20 10:41:55'),
(399, 30, 'Team1', 'Team2', 'Team2', '2022-07-20 10:44:05'),
(400, 8, 'Team1', 'Team2', 'Team1', '2022-07-20 10:44:18'),
(401, 4, 'Team1', 'Team2', 'Team2', '2022-07-20 10:44:32'),
(402, 6, 'Team1', 'Team2', 'Team1', '2022-07-20 10:44:44'),
(403, 5, 'Team1', 'Team2', 'Team1', '2022-07-20 10:44:50'),
(404, 1, 'Team1', 'Team2', 'Team1', '2022-07-20 10:45:22'),
(405, 4, 'Team1', 'Team2', 'Team1', '2022-07-21 12:49:55'),
(406, 5, 'Team1', 'Team2', 'Team2', '2022-07-21 12:50:38'),
(407, 6, 'Team1', 'Team2', 'Team2', '2022-07-25 14:00:35'),
(408, 14, 'Win', 'Oui', 'Win', '2022-08-16 14:14:52'),
(409, 18, 'Win', 'Oui', 'Oui', '2022-08-16 14:15:58'),
(410, 5, 'Team1', 'Team2', 'Team1', '2022-08-16 14:17:46'),
(411, 38, 'Team1', 'Team2', 'Team1', '2022-09-06 16:18:43'),
(412, 46, 'Team1', 'Team2', 'Team1', '2022-09-06 16:21:17'),
(413, 41, 'Team1', 'Team2', 'Team2', '2022-09-06 16:21:20'),
(414, 13, 'Team1', 'Team2', 'Team2', '2022-09-08 16:37:05'),
(415, 7, 'Team1', 'Team2', 'Team1', '2022-09-09 10:37:01'),
(416, 44, 'Team1', 'Team2', 'Team2', '2022-09-09 10:38:10'),
(417, 44, 'Team1', 'Team2', 'Team2', '2022-09-09 10:44:42'),
(418, 12, 'Team1', 'Team2', 'Team1', '2022-09-13 14:41:22'),
(419, 10, 'Team1', 'Team2', 'Team2', '2022-10-09 16:04:48'),
(420, 39, 'Team1', 'Team2', 'Team2', '2022-10-10 12:17:29');

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `players`
--

INSERT INTO `players` (`id`, `name`, `class`, `lvl`) VALUES
(45, 'LucV', 'Captain', 7),
(46, 'LucF', 'Captain', 11),
(47, 'Mathilde', 'Gunner', 7),
(48, 'Myriam', 'Canonneer', 6),
(49, 'Soufiane', 'Gunner', 4),
(50, 'Florian', 'Captain', 35),
(52, 'Quentin', 'Canonneer', 21),
(53, 'Dylan', 'Gunner', 17),
(54, 'Kevin', 'Canonneer', 20),
(55, 'Lucas', 'Gunner', 8),
(56, 'Nicolas', 'Captain', 17),
(57, 'Christophe', 'Canonneer', 37),
(60, 'Lou', 'Canonneer', 9),
(61, 'Yves', 'Captain', 4),
(63, 'Gabou', 'Captain', 21),
(64, 'LauraML', 'Captain', 9),
(65, 'ManapyZz', 'Captain', 2),
(66, 'Emma', 'Gunner', 16),
(67, 'Sheldark', 'Gunner', 2),
(68, 'Drasil', 'Canonneer', 11),
(69, 'Sakura', 'Peon', 3),
(70, 'AbsorbeDeLaJavel', 'Captain', 8),
(71, 'Utruna', 'Captain', 3),
(72, 'Pédo', 'Canonneer', 2),
(73, 'Olivier', 'Captain', 2),
(74, 'Aurore', 'Captain', 6),
(75, 'AuroreBis', 'Gunner', 3),
(76, 'FlorianB', 'Captain', 21),
(77, 'MancheUnChibre', 'Captain', 2);

-- --------------------------------------------------------

--
-- Structure de la table `ships`
--

CREATE TABLE `ships` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ships`
--

INSERT INTO `ships` (`id`, `name`, `path`) VALUES
(37, 'Le62', 'Yellow.png'),
(36, 'Simplon', 'Classique.png'),
(33, 'Blanc', 'White.png'),
(32, 'Rouge', 'Red.png'),
(31, 'Rose', 'Pink.png'),
(30, 'Orange', 'Orange.png'),
(29, 'Vert', 'Green.png'),
(28, 'Bleu', 'Blue.png'),
(27, 'Jaune', 'Yellow.png'),
(34, 'Classique', 'Classique.png'),
(38, 'Wiancourt', 'Blue.png'),
(39, 'EuroTunnel', 'Pink.png'),
(40, 'Mercidetrevenu', 'White.png'),
(41, 'Crépuscule', 'White.png'),
(42, 'Nicholas', 'White.png');

-- --------------------------------------------------------

--
-- Structure de la table `ship_sprites`
--

CREATE TABLE `ship_sprites` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  `path_hori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ship_sprites`
--

INSERT INTO `ship_sprites` (`id`, `name`, `path`, `path_hori`) VALUES
(2, 'Blue', 'Blue.png', 'BlueHori.png'),
(3, 'Green', 'Green.png', 'GreenHori.png'),
(4, 'Orange', 'Orange.png', 'OrangeHori.png'),
(5, 'Pink', 'Pink.png', 'PinkHori.png'),
(6, 'Red', 'Red.png', 'RedHori.png'),
(7, 'White', 'White.png', 'WhiteHori.png'),
(8, 'Yellow', 'Yellow.png', 'YellowHori.png'),
(17, 'Classique', 'Classique.png', 'ClassiqueHori.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fights`
--
ALTER TABLE `fights`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ship_sprites`
--
ALTER TABLE `ship_sprites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `fights`
--
ALTER TABLE `fights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `ships`
--
ALTER TABLE `ships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `ship_sprites`
--
ALTER TABLE `ship_sprites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
