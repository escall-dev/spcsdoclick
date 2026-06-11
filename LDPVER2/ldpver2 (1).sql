-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2026 at 11:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ldpver2`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES
(1, 1, 'Logged In', NULL, '::1', '2026-01-08 02:00:21'),
(3, 1, 'Logged In', NULL, '::1', '2026-01-08 02:32:31'),
(4, 6, 'Logged In', NULL, '::1', '2026-01-08 02:50:58'),
(5, 1, 'Logged In', NULL, '::1', '2026-01-08 02:52:17'),
(6, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 03:05:47'),
(7, 1, 'Logged Out', NULL, '::1', '2026-01-08 03:05:50'),
(8, 1, 'Logged In', NULL, '::1', '2026-01-08 03:05:55'),
(9, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 03:05:55'),
(10, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 03:47:44'),
(11, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 03:47:46'),
(12, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 03:47:51'),
(13, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 03:48:05'),
(14, 1, 'Viewed Specific Activity', 'escal', '::1', '2026-01-08 03:48:07'),
(15, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 03:50:53'),
(16, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 04:26:10'),
(17, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 04:26:12'),
(18, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 04:26:17'),
(19, 1, 'Logged Out', NULL, '::1', '2026-01-08 04:26:58'),
(40, 1, 'Logged In', NULL, '::1', '2026-01-08 05:02:24'),
(41, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:02:24'),
(42, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:03:04'),
(43, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:06:39'),
(44, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:10:12'),
(45, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:10:13'),
(46, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:10:17'),
(47, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:10:43'),
(48, 1, 'Logged Out', NULL, '::1', '2026-01-08 05:10:44'),
(53, 1, 'Logged In', NULL, '::1', '2026-01-08 05:11:03'),
(54, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:11:03'),
(55, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:11:06'),
(56, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:11:09'),
(57, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:14:44'),
(58, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:15:16'),
(59, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:15:20'),
(60, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:17:12'),
(61, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:19:20'),
(62, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:21:39'),
(63, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:21:40'),
(64, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:21:54'),
(65, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:21:55'),
(66, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:21:59'),
(67, 1, 'Logged Out', NULL, '::1', '2026-01-08 05:22:21'),
(76, 1, 'Logged In', NULL, '::1', '2026-01-08 05:29:04'),
(77, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:29:04'),
(78, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:29:25'),
(79, 1, 'Viewed Admin Dashboard', NULL, '::1', '2026-01-08 05:32:36'),
(80, 1, 'Logged Out', NULL, '::1', '2026-01-08 05:37:35'),
(83, 1, 'Logged In', NULL, '::1', '2026-01-08 05:40:25'),
(84, 1, 'Viewed Specific Activity', 'escal', '::1', '2026-01-08 05:40:47'),
(85, 1, 'Viewed Specific Activity', 'PROCEEDING TO DESIGN', '::1', '2026-01-08 05:40:55'),
(86, 1, 'Logged Out', NULL, '::1', '2026-01-08 05:41:24'),
(89, 1, 'Logged In', NULL, '::1', '2026-01-08 05:43:30'),
(90, 1, 'Logged Out', NULL, '::1', '2026-01-08 05:44:19'),
(94, 1, 'Logged In', NULL, '::1', '2026-01-08 22:51:43'),
(95, 1, 'Logged Out', NULL, '::1', '2026-01-08 22:52:38'),
(103, 1, 'Logged In', NULL, '::1', '2026-01-08 23:17:28'),
(104, 1, 'Logged Out', NULL, '::1', '2026-01-08 23:17:42'),
(105, 1, 'Logged In', NULL, '::1', '2026-01-08 23:24:06'),
(106, 1, 'Viewed Specific Activity', 'sssssss', '::1', '2026-01-08 23:24:12'),
(107, 1, 'Logged Out', NULL, '::1', '2026-01-08 23:25:20'),
(111, 1, 'Logged In', NULL, '::1', '2026-01-08 23:30:26'),
(112, 1, 'Viewed Specific Activity', 'sssssss', '::1', '2026-01-08 23:35:11'),
(113, 1, 'Logged Out', NULL, '::1', '2026-01-08 23:38:17'),
(126, 1, 'Logged In', NULL, '::1', '2026-01-08 23:59:35'),
(127, 1, 'Logged Out', NULL, '::1', '2026-01-09 00:00:17'),
(128, 6, 'Logged In', NULL, '::1', '2026-01-09 00:00:48'),
(129, 6, 'Updated User Record', 'User ID: 1 (Role: admin)', '::1', '2026-01-09 00:00:53'),
(130, 1, 'Logged In', NULL, '::1', '2026-01-09 00:39:24'),
(131, 1, 'Logged Out', NULL, '::1', '2026-01-09 00:39:39'),
(134, 1, 'Logged In', NULL, '::1', '2026-01-09 00:45:38'),
(135, 1, 'Viewed Specific Activity', 'sssssss', '::1', '2026-01-09 00:45:40'),
(136, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-09 00:46:50'),
(137, 1, 'Viewed Specific Activity', 'sssssss', '::1', '2026-01-09 00:46:55'),
(138, 1, 'Viewed Specific Activity', 'sssssss', '::1', '2026-01-09 00:49:19'),
(139, 1, 'Logged Out', NULL, '::1', '2026-01-09 00:49:42'),
(145, 1, 'Logged In', NULL, '::1', '2026-01-09 00:52:15'),
(146, 1, 'Viewed Specific Activity', 'TODAY', '::1', '2026-01-09 00:52:18'),
(147, 1, 'Viewed Specific Activity', 'TODAY', '::1', '2026-01-09 00:56:02'),
(148, 1, 'Logged Out', NULL, '::1', '2026-01-09 00:59:28'),
(152, 1, 'Logged In', NULL, '::1', '2026-01-09 02:22:12'),
(153, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-09 02:22:15'),
(154, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-09 02:25:30'),
(155, 1, 'Logged Out', NULL, '::1', '2026-01-09 02:25:32'),
(159, 1, 'Logged In', NULL, '::1', '2026-01-09 02:26:54'),
(160, 1, 'Viewed Specific Activity', 'test2', '::1', '2026-01-09 02:26:57'),
(161, 1, 'Logged Out', NULL, '::1', '2026-01-09 02:27:12'),
(166, 1, 'Logged In', NULL, '::1', '2026-01-09 02:44:49'),
(167, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 02:44:54'),
(168, 1, 'Viewed Specific Activity', 'Web Security Fundamentals', '::1', '2026-01-09 02:48:44'),
(169, 1, 'Viewed Specific Activity', 'Advanced Project Management', '::1', '2026-01-09 02:48:50'),
(170, 1, 'Viewed Specific Activity', 'seminar', '::1', '2026-01-09 02:48:54'),
(171, 1, 'Viewed Specific Activity', 'test1', '::1', '2026-01-09 02:48:57'),
(172, 1, 'Viewed Specific Activity', 'test1', '::1', '2026-01-09 02:49:02'),
(173, 1, 'Viewed Specific Activity', 'MLBB Tournament', '::1', '2026-01-09 02:49:05'),
(174, 1, 'Viewed Specific Activity', 'SEMINAR NG MGA POGI', '::1', '2026-01-09 02:49:09'),
(175, 1, 'Viewed Specific Activity', 'PRESENTATION OF L&D PASSBOOK', '::1', '2026-01-09 02:49:12'),
(176, 1, 'Viewed Specific Activity', 'Unpre', '::1', '2026-01-09 02:49:15'),
(177, 1, 'Viewed Specific Activity', 'PROCEEDING TO DESIGN', '::1', '2026-01-09 02:49:18'),
(178, 1, 'Viewed Specific Activity', 'PROCEEDING TO DESIGN', '::1', '2026-01-09 02:49:23'),
(179, 1, 'Viewed Specific Activity', 'escal', '::1', '2026-01-09 02:49:25'),
(180, 1, 'Viewed Specific Activity', 'Natapon', '::1', '2026-01-09 02:49:28'),
(181, 1, 'Viewed Specific Activity', 'TODAY', '::1', '2026-01-09 02:50:04'),
(182, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 02:52:09'),
(183, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 02:54:30'),
(184, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 02:55:48'),
(185, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 03:13:28'),
(186, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 03:13:43'),
(187, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 03:14:22'),
(188, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 03:23:26'),
(189, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 03:23:31'),
(190, 1, 'Logged Out', NULL, '::1', '2026-01-09 03:23:33'),
(194, 1, 'Logged In', NULL, '::1', '2026-01-09 03:25:57'),
(195, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 03:26:00'),
(196, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 03:48:09'),
(197, 1, 'Viewed Specific Activity', 'sssssss', '::1', '2026-01-09 03:48:56'),
(198, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 03:49:03'),
(199, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 03:49:11'),
(200, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 03:50:32'),
(201, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 03:55:39'),
(202, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 03:56:44'),
(203, 1, 'Viewed Specific Activity', 'TODAY', '::1', '2026-01-09 03:59:06'),
(204, 1, 'Viewed Specific Activity', 'TODAY', '::1', '2026-01-09 04:08:24'),
(205, 1, 'Viewed Specific Activity', 'TODAY', '::1', '2026-01-09 04:08:25'),
(206, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 04:08:31'),
(207, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-09 04:17:41'),
(208, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-09 04:18:11'),
(209, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-09 04:18:36'),
(210, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-09 04:18:46'),
(211, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-09 04:18:47'),
(212, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 04:19:31'),
(213, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-09 04:22:07'),
(214, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 04:22:40'),
(215, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 04:22:49'),
(216, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 04:23:04'),
(217, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-09 04:26:28'),
(218, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-09 04:26:34'),
(219, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-09 04:26:54'),
(220, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-09 04:55:11'),
(221, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 05:02:35'),
(222, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 05:02:44'),
(223, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 05:03:00'),
(224, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 05:03:21'),
(225, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 05:03:25'),
(226, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 05:03:27'),
(227, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 05:04:11'),
(228, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 05:05:52'),
(229, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 05:09:11'),
(230, 1, 'Logged Out', NULL, '::1', '2026-01-09 05:09:25'),
(233, 1, 'Logged In', NULL, '::1', '2026-01-09 05:09:46'),
(234, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 05:09:55'),
(235, 1, 'Logged Out', NULL, '::1', '2026-01-09 05:09:59'),
(236, 1, 'Logged In', NULL, '::1', '2026-01-09 05:10:03'),
(237, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 05:10:05'),
(238, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 05:10:59'),
(239, 1, 'Viewed Specific Activity', 'Real shi', '::1', '2026-01-09 05:11:39'),
(240, 1, 'Viewed Specific Activity', 'Testing lang oma', '::1', '2026-01-09 05:15:33'),
(241, 1, 'Logged Out', NULL, '::1', '2026-01-09 05:39:41'),
(244, 1, 'Logged In', NULL, '::1', '2026-01-09 05:40:05'),
(245, 1, 'Logged Out', NULL, '::1', '2026-01-09 05:40:26'),
(252, 1, 'Logged In', NULL, '::1', '2026-01-09 05:48:06'),
(253, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-09 05:48:33'),
(254, 1, 'Logged Out', NULL, '::1', '2026-01-09 05:48:36'),
(255, 1, 'Logged In', NULL, '::1', '2026-01-09 05:58:21'),
(256, 1, 'Logged Out', NULL, '::1', '2026-01-09 05:59:56'),
(257, 6, 'Logged In', NULL, '::1', '2026-01-09 06:02:28'),
(258, 6, 'Logged Out', NULL, '::1', '2026-01-09 06:07:46'),
(261, 1, 'Logged In', NULL, '::1', '2026-01-09 06:08:04'),
(262, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-09 06:08:13'),
(263, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-09 06:08:53'),
(264, 1, 'Logged Out', NULL, '::1', '2026-01-09 06:09:14'),
(266, 1, 'Logged In', NULL, '::1', '2026-01-11 06:14:19'),
(267, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-11 06:14:26'),
(268, 1, 'Logged Out', NULL, '::1', '2026-01-11 07:24:30'),
(272, 1, 'Logged In', NULL, '::1', '2026-01-11 11:35:26'),
(273, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-11 11:35:52'),
(274, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-11 11:36:03'),
(275, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-11 11:36:05'),
(276, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-11 11:36:05'),
(277, 1, 'Logged Out', NULL, '::1', '2026-01-11 11:36:10'),
(285, 1, 'Logged In', NULL, '::1', '2026-01-12 00:58:03'),
(286, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 00:58:29'),
(287, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 01:04:43'),
(289, 1, 'Logged In', NULL, '::1', '2026-01-12 01:19:12'),
(290, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 01:20:34'),
(291, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 01:22:18'),
(292, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 01:29:00'),
(293, 1, 'Logged Out', NULL, '::1', '2026-01-12 01:43:27'),
(307, 1, 'Logged In', NULL, '::1', '2026-01-12 02:13:14'),
(308, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 02:13:17'),
(309, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 02:13:20'),
(310, 1, 'Logged Out', NULL, '::1', '2026-01-12 02:13:21'),
(315, 1, 'Logged In', NULL, '::1', '2026-01-12 02:30:42'),
(316, 1, 'Logged Out', NULL, '::1', '2026-01-12 02:33:33'),
(319, 1, 'Logged In', NULL, '::1', '2026-01-12 02:35:58'),
(320, 1, 'Logged Out', NULL, '::1', '2026-01-12 02:37:04'),
(326, 1, 'Logged In', NULL, '::1', '2026-01-12 02:49:36'),
(327, 1, 'Logged Out', NULL, '::1', '2026-01-12 03:00:20'),
(330, 1, 'Logged In', NULL, '::1', '2026-01-12 03:00:54'),
(331, 1, 'Logged Out', NULL, '::1', '2026-01-12 03:11:51'),
(334, 1, 'Logged In', NULL, '::1', '2026-01-12 03:12:29'),
(335, 1, 'Logged Out', NULL, '::1', '2026-01-12 03:12:43'),
(339, 1, 'Logged In', NULL, '::1', '2026-01-12 03:18:03'),
(340, 1, 'Logged Out', NULL, '::1', '2026-01-12 03:23:56'),
(345, 1, 'Logged In', NULL, '::1', '2026-01-12 03:28:42'),
(346, 1, 'Logged Out', NULL, '::1', '2026-01-12 03:29:58'),
(349, 1, 'Logged In', NULL, '::1', '2026-01-12 03:35:17'),
(350, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 03:40:41'),
(351, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 03:40:58'),
(352, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 03:41:00'),
(353, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 03:43:39'),
(354, 1, 'Logged Out', NULL, '::1', '2026-01-12 03:43:50'),
(357, 1, 'Logged In', NULL, '::1', '2026-01-12 03:45:25'),
(358, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 04:08:00'),
(359, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 04:08:13'),
(360, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 04:08:26'),
(361, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-12 04:08:30'),
(362, 1, 'Viewed Specific Activity', 'SEMINAR NG MGA POGI', '::1', '2026-01-12 04:08:34'),
(363, 1, 'Viewed Specific Activity', 'Advanced Project Management', '::1', '2026-01-12 04:09:17'),
(364, 1, 'Logged Out', NULL, '::1', '2026-01-12 04:10:43'),
(367, 1, 'Logged In', NULL, '::1', '2026-01-12 04:11:32'),
(368, 1, 'Logged Out', NULL, '::1', '2026-01-12 04:12:36'),
(369, 6, 'Logged In', NULL, '::1', '2026-01-12 04:12:53'),
(370, 6, 'Logged Out', NULL, '::1', '2026-01-12 04:13:38'),
(375, 1, 'Logged In', NULL, '::1', '2026-01-12 04:19:23'),
(376, 1, 'Logged Out', NULL, '::1', '2026-01-12 04:20:14'),
(378, 1, 'Logged In', NULL, '::1', '2026-01-12 04:31:55'),
(379, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 04:32:27'),
(380, 1, 'Logged Out', NULL, '::1', '2026-01-12 04:32:38'),
(383, 1, 'Logged In', NULL, '::1', '2026-01-12 04:41:26'),
(384, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 04:41:42'),
(385, 1, 'Viewed Specific Activity', 'ceddyboi', '::1', '2026-01-12 04:41:56'),
(386, 1, 'Viewed Specific Activity', 'escal', '::1', '2026-01-12 04:42:13'),
(387, 1, 'Viewed Specific Activity', 'escal', '::1', '2026-01-12 04:42:15'),
(388, 1, 'Logged Out', NULL, '::1', '2026-01-12 04:42:18'),
(389, 1, 'Logged In', NULL, '::1', '2026-01-12 04:44:29'),
(390, 1, 'Logged Out', NULL, '::1', '2026-01-12 04:44:37'),
(391, 1, 'Logged In', NULL, '::1', '2026-01-12 04:51:04'),
(392, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 04:51:20'),
(393, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-12 04:51:37'),
(394, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 04:51:54'),
(395, 1, 'Logged Out', NULL, '::1', '2026-01-12 04:52:30'),
(402, 1, 'Logged In', NULL, '::1', '2026-01-12 05:06:49'),
(403, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 05:07:12'),
(404, 1, 'Viewed Specific Activity', 'pushpush', '::1', '2026-01-12 05:07:23'),
(405, 1, 'Logged Out', NULL, '::1', '2026-01-12 05:13:17'),
(406, 6, 'Logged In', NULL, '::1', '2026-01-12 05:13:57'),
(407, 6, 'Logged Out', NULL, '::1', '2026-01-12 05:15:37'),
(410, 1, 'Logged In', NULL, '::1', '2026-01-12 05:59:42'),
(411, 1, 'Logged Out', NULL, '::1', '2026-01-12 09:53:39'),
(415, 1, 'Logged In', NULL, '::1', '2026-01-12 09:55:25'),
(416, 1, 'Viewed Specific Activity', 'test1', '::1', '2026-01-12 09:55:28'),
(417, 1, 'Logged Out', NULL, '::1', '2026-01-12 09:56:20'),
(418, 1, 'Logged In', NULL, '::1', '2026-01-12 09:56:30'),
(419, 1, 'Logged Out', NULL, '::1', '2026-01-12 09:56:32'),
(430, 1, 'Logged In', NULL, '::1', '2026-01-12 11:23:43'),
(431, 1, 'Logged Out', NULL, '::1', '2026-01-12 11:23:56'),
(434, 1, 'Logged In', NULL, '::1', '2026-01-12 11:34:43'),
(435, 1, 'Logged Out', NULL, '::1', '2026-01-12 11:35:03'),
(436, 1, 'Logged In', NULL, '::1', '2026-01-12 11:38:46'),
(437, 1, 'Logged Out', NULL, '::1', '2026-01-12 11:38:58'),
(441, 1, 'Logged In', NULL, '::1', '2026-01-12 11:49:25'),
(442, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 11:54:43'),
(443, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 11:54:57'),
(444, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 11:57:19'),
(445, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 11:57:33'),
(446, 1, 'Logged Out', NULL, '::1', '2026-01-12 12:01:07'),
(449, 1, 'Logged In', NULL, '::1', '2026-01-12 12:01:46'),
(450, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 12:01:59'),
(451, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 12:02:48'),
(452, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 12:05:08'),
(453, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 12:05:12'),
(454, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 12:07:16'),
(455, 1, 'Viewed Specific Activity', 'test5', '::1', '2026-01-12 12:07:29'),
(456, 1, 'Logged Out', NULL, '::1', '2026-01-12 12:08:01'),
(457, 6, 'Logged In', NULL, '::1', '2026-01-12 12:08:11'),
(458, 6, 'Updated User Record', 'User ID: 10 (Role: user)', '::1', '2026-01-12 12:08:28'),
(459, 6, 'Deleted User', 'User ID: 9 removed.', '::1', '2026-01-12 12:09:22'),
(460, 6, 'Logged Out', NULL, '::1', '2026-01-12 12:09:39'),
(461, 1, 'Logged In', NULL, '::1', '2026-01-12 12:09:43'),
(462, 1, 'Logged Out', NULL, '::1', '2026-01-12 12:09:53'),
(466, 1, 'Logged In', NULL, '::1', '2026-01-12 12:11:20'),
(467, 1, 'Logged Out', NULL, '::1', '2026-01-12 12:11:54'),
(471, 1, 'Logged In', NULL, '::1', '2026-01-12 12:13:23'),
(472, 1, 'Viewed Specific Activity', 'TEST6', '::1', '2026-01-12 12:14:14'),
(473, 1, 'Viewed Specific Activity', 'TEST6', '::1', '2026-01-12 12:14:33'),
(474, 1, 'Logged Out', NULL, '::1', '2026-01-12 12:14:36'),
(477, 1, 'Logged In', NULL, '::1', '2026-01-12 12:15:20'),
(478, 1, 'Viewed Specific Activity', 'TEST6', '::1', '2026-01-12 12:15:24'),
(479, 1, 'Viewed Specific Activity', 'TEST6', '::1', '2026-01-12 12:15:29'),
(480, 1, 'Viewed Specific Activity', 'TEST6', '::1', '2026-01-12 12:15:32'),
(481, 1, 'Viewed Specific Activity', 'TEST6', '::1', '2026-01-12 12:23:17'),
(482, 1, 'Viewed Specific Activity', 'TEST6', '::1', '2026-01-12 12:23:37'),
(483, 1, 'Logged Out', NULL, '::1', '2026-01-12 12:23:42'),
(488, 1, 'Logged In', NULL, '::1', '2026-01-12 12:40:19'),
(489, 1, 'Viewed Specific Activity', 'test7', '::1', '2026-01-12 12:40:26'),
(490, 1, 'Logged Out', NULL, '::1', '2026-01-12 12:41:29'),
(493, 1, 'Logged In', NULL, '::1', '2026-01-12 13:27:53'),
(494, 1, 'Logged Out', NULL, '::1', '2026-01-12 22:54:05'),
(508, 1, 'Logged In', NULL, '::1', '2026-01-13 00:24:27'),
(509, 1, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 00:28:32'),
(510, 1, 'Logged Out', NULL, '::1', '2026-01-13 00:28:38'),
(513, 1, 'Logged In', NULL, '::1', '2026-01-13 00:31:51'),
(514, 1, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 00:32:03'),
(515, 1, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 00:32:12'),
(516, 1, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 00:32:13'),
(517, 1, 'Logged Out', NULL, '::1', '2026-01-13 00:32:58'),
(518, 1, 'Logged In', NULL, '::1', '2026-01-13 00:36:27'),
(519, 1, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 00:36:37'),
(520, 1, 'Logged Out', NULL, '::1', '2026-01-13 00:46:42'),
(521, 6, 'Logged In', NULL, '::1', '2026-01-13 00:46:57'),
(522, 6, 'Updated User Record', 'User ID: 2 (Role: hr)', '::1', '2026-01-13 00:47:38'),
(523, 6, 'Logged Out', NULL, '::1', '2026-01-13 00:47:45'),
(524, 6, 'Logged In', NULL, '::1', '2026-01-13 00:49:00'),
(525, 6, 'Deleted User', 'User ID: 3 removed.', '::1', '2026-01-13 00:49:18'),
(526, 6, 'Deleted User', 'User ID: 11 removed.', '::1', '2026-01-13 00:49:23'),
(527, 6, 'Deleted User', 'User ID: 2 removed.', '::1', '2026-01-13 00:49:45'),
(528, 6, 'Logged In', NULL, '::1', '2026-01-13 00:58:47'),
(529, 6, 'Created User (Super Admin)', 'Created new hr: aries', '::1', '2026-01-13 01:10:03'),
(530, 6, 'Logged Out', NULL, '::1', '2026-01-13 01:10:13'),
(536, 1, 'Logged In', NULL, '::1', '2026-01-13 01:31:56'),
(537, 1, 'Logged Out', NULL, '::1', '2026-01-13 01:32:30'),
(538, 1, 'Logged In', NULL, '::1', '2026-01-13 01:32:40'),
(539, 1, 'Logged Out', NULL, '::1', '2026-01-13 01:33:08'),
(540, 6, 'Logged In', NULL, '::1', '2026-01-13 01:33:29'),
(541, 6, 'Logged Out', NULL, '::1', '2026-01-13 01:33:44'),
(544, 6, 'Logged In', NULL, '::1', '2026-01-13 01:43:18'),
(545, 6, 'Logged Out', NULL, '::1', '2026-01-13 01:46:42'),
(546, 1, 'Logged In', NULL, '::1', '2026-01-13 01:46:54'),
(547, 1, 'Logged Out', NULL, '::1', '2026-01-13 01:47:56'),
(550, 1, 'Logged In', NULL, '::1', '2026-01-13 01:48:18'),
(551, 1, 'Logged Out', NULL, '::1', '2026-01-13 01:48:26'),
(554, 1, 'Logged In', NULL, '::1', '2026-01-13 01:54:17'),
(555, 1, 'Logged Out', NULL, '::1', '2026-01-13 01:54:35'),
(556, 6, 'Logged In', NULL, '::1', '2026-01-13 01:54:45'),
(557, 6, 'Logged Out', NULL, '::1', '2026-01-13 01:55:56'),
(558, 1, 'Logged In', NULL, '::1', '2026-01-13 01:55:59'),
(559, 1, 'Logged Out', NULL, '::1', '2026-01-13 01:56:39'),
(565, 1, 'Logged In', NULL, '::1', '2026-01-13 01:58:59'),
(566, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 02:00:19'),
(567, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:02:50'),
(570, 1, 'Logged In', NULL, '::1', '2026-01-13 02:04:00'),
(571, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:05:30'),
(574, 1, 'Logged In', NULL, '::1', '2026-01-13 02:07:52'),
(575, 1, 'Viewed Specific Activity', 'Web Security Fundamentals', '::1', '2026-01-13 02:08:14'),
(576, 1, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 02:09:12'),
(577, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:09:22'),
(578, 6, 'Logged In', NULL, '::1', '2026-01-13 02:09:36'),
(579, 6, 'Deleted User', 'User ID: 7 removed.', '::1', '2026-01-13 02:11:39'),
(580, 6, 'Deleted User', 'User ID: 8 removed.', '::1', '2026-01-13 02:11:43'),
(581, 6, 'Logged Out', NULL, '::1', '2026-01-13 02:12:37'),
(582, 1, 'Logged In', NULL, '::1', '2026-01-13 02:12:42'),
(583, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:13:47'),
(586, 6, 'Logged In', NULL, '::1', '2026-01-13 02:15:23'),
(587, 6, 'Logged Out', NULL, '::1', '2026-01-13 02:15:52'),
(590, 1, 'Logged In', NULL, '::1', '2026-01-13 02:16:41'),
(591, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:17:26'),
(594, 1, 'Logged In', NULL, '::1', '2026-01-13 02:26:08'),
(595, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:30:02'),
(598, 1, 'Logged In', NULL, '::1', '2026-01-13 02:41:41'),
(599, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:41:51'),
(600, 1, 'Logged In', NULL, '::1', '2026-01-13 02:41:57'),
(601, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:42:09'),
(602, 6, 'Logged In', NULL, '::1', '2026-01-13 02:42:17'),
(603, 6, 'Logged Out', NULL, '::1', '2026-01-13 02:47:49'),
(604, 1, 'Logged In', NULL, '::1', '2026-01-13 02:47:54'),
(605, 1, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 02:49:39'),
(606, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:49:56'),
(607, 1, 'Logged In', NULL, '::1', '2026-01-13 02:50:06'),
(608, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 02:50:20'),
(609, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 02:50:25'),
(610, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 02:50:26'),
(611, 1, 'Logged Out', NULL, '::1', '2026-01-13 02:50:29'),
(612, 1, 'Logged In', NULL, '::1', '2026-01-13 03:39:47'),
(613, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 03:39:53'),
(614, 1, 'Logged Out', NULL, '::1', '2026-01-13 03:40:12'),
(615, 6, 'Logged In', NULL, '::1', '2026-01-13 03:40:22'),
(616, 6, 'Created User (Super Admin)', 'Created new immediate_head: IMHEAD', '::1', '2026-01-13 03:41:42'),
(617, 6, 'Toggled User Status', 'User ID: 10 deactivated.', '::1', '2026-01-13 03:42:10'),
(618, 6, 'Logged Out', NULL, '::1', '2026-01-13 03:42:13'),
(619, 1, 'Logged In', NULL, '::1', '2026-01-13 03:42:30'),
(620, 1, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 03:42:50'),
(621, 1, 'Logged Out', NULL, '::1', '2026-01-13 03:43:02'),
(622, 6, 'Logged In', NULL, '::1', '2026-01-13 03:43:59'),
(623, 6, 'Toggled User Status', 'User ID: 10 activated.', '::1', '2026-01-13 03:44:08'),
(624, 6, 'Toggled User Status', 'User ID: 10 activated.', '::1', '2026-01-13 03:44:30'),
(625, 6, 'Toggled User Status', 'User ID: 10 activated.', '::1', '2026-01-13 03:44:44'),
(626, 6, 'Created User (Super Admin)', 'Created new immediate_head: head', '::1', '2026-01-13 03:50:01'),
(627, 6, 'Logged Out', NULL, '::1', '2026-01-13 03:50:03'),
(629, 1, 'Logged In', NULL, '::1', '2026-01-13 03:50:34'),
(630, 1, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 03:50:41'),
(631, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 03:50:47'),
(632, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 03:52:09'),
(633, 1, 'Logged Out', NULL, '::1', '2026-01-13 03:52:20'),
(634, 6, 'Logged In', NULL, '::1', '2026-01-13 03:52:26'),
(635, 6, 'Logged Out', NULL, '::1', '2026-01-13 03:53:22'),
(642, 1, 'Logged In', NULL, '::1', '2026-01-13 03:54:18'),
(643, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 03:54:40'),
(644, 1, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 03:54:45'),
(645, 1, 'Logged Out', NULL, '::1', '2026-01-13 03:55:16'),
(646, 6, 'Logged In', NULL, '::1', '2026-01-13 03:55:24'),
(647, 6, 'Logged Out', NULL, '::1', '2026-01-13 03:58:40'),
(651, 6, 'Logged In', NULL, '::1', '2026-01-13 04:00:00'),
(652, 6, 'Deleted User', 'User ID: 14 removed.', '::1', '2026-01-13 04:00:07'),
(653, 6, 'Deleted User', 'User ID: 15 removed.', '::1', '2026-01-13 04:00:11'),
(654, 6, 'Created User (Super Admin)', 'Created new immediate_head: head', '::1', '2026-01-13 04:01:33'),
(655, 6, 'Logged Out', NULL, '::1', '2026-01-13 04:01:37'),
(656, 16, 'Logged In', NULL, '::1', '2026-01-13 04:01:40'),
(657, 16, 'Logged In', NULL, '::1', '2026-01-13 04:01:44'),
(658, 16, 'Logged In', NULL, '::1', '2026-01-13 04:01:58'),
(659, 16, 'Logged In', NULL, '::1', '2026-01-13 04:02:30'),
(660, 16, 'Logged In', NULL, '::1', '2026-01-13 04:04:28'),
(661, 16, 'Logged In', NULL, '::1', '2026-01-13 04:04:35'),
(662, 16, 'Logged In', NULL, '::1', '2026-01-13 04:04:43'),
(663, 16, 'Logged In', NULL, '::1', '2026-01-13 04:08:12'),
(664, 1, 'Logged In', NULL, '::1', '2026-01-13 04:08:25'),
(665, 1, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 04:08:30'),
(666, 1, 'Logged Out', NULL, '::1', '2026-01-13 04:08:38'),
(667, 16, 'Logged In', NULL, '::1', '2026-01-13 04:08:45'),
(668, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 04:08:50'),
(669, 16, 'Logged In', NULL, '::1', '2026-01-13 04:12:36'),
(670, 16, 'Logged In', NULL, '::1', '2026-01-13 04:12:51'),
(671, 16, 'Logged In', NULL, '::1', '2026-01-13 04:15:21'),
(672, 16, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-13 04:16:05'),
(673, 16, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 04:16:08'),
(674, 16, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 04:16:22'),
(675, 16, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 04:16:23'),
(676, 16, 'Viewed Specific Activity', 'Renaldol', '::1', '2026-01-13 04:16:39'),
(677, 16, 'Logged Out', NULL, '::1', '2026-01-13 04:16:52'),
(685, 16, 'Logged In', NULL, '::1', '2026-01-13 04:19:03'),
(686, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:19:07'),
(687, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:19:16'),
(688, 16, 'Logged Out', NULL, '::1', '2026-01-13 04:19:21'),
(689, 6, 'Logged In', NULL, '::1', '2026-01-13 04:20:50'),
(690, 6, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 04:23:30'),
(691, 6, 'Logged Out', NULL, '::1', '2026-01-13 04:23:33'),
(692, 1, 'Logged In', NULL, '::1', '2026-01-13 04:23:36'),
(693, 1, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:23:45'),
(694, 1, 'Logged Out', NULL, '::1', '2026-01-13 04:23:57'),
(695, 16, 'Logged In', NULL, '::1', '2026-01-13 04:24:06'),
(696, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:24:09'),
(697, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:26:57'),
(698, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:26:58'),
(699, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:27:00'),
(700, 16, 'Logged Out', NULL, '::1', '2026-01-13 04:27:14'),
(701, 1, 'Logged In', NULL, '::1', '2026-01-13 04:27:18'),
(702, 1, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:27:23'),
(703, 1, 'Logged Out', NULL, '::1', '2026-01-13 04:27:28'),
(704, 16, 'Logged In', NULL, '::1', '2026-01-13 04:29:56'),
(705, 16, 'Logged Out', NULL, '::1', '2026-01-13 04:30:29'),
(706, 1, 'Logged In', NULL, '::1', '2026-01-13 04:30:34'),
(707, 1, 'Logged Out', NULL, '::1', '2026-01-13 04:30:59'),
(708, 16, 'Logged In', NULL, '::1', '2026-01-13 04:31:06'),
(709, 16, 'Logged In', NULL, '::1', '2026-01-13 04:31:25'),
(710, 16, 'Logged Out', NULL, '::1', '2026-01-13 04:40:23'),
(711, 6, 'Logged In', NULL, '::1', '2026-01-13 04:40:28'),
(712, 6, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:40:35'),
(713, 6, 'Logged Out', NULL, '::1', '2026-01-13 04:42:07'),
(714, 1, 'Logged In', NULL, '::1', '2026-01-13 04:42:17'),
(715, 1, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:42:32'),
(716, 1, 'Logged Out', NULL, '::1', '2026-01-13 04:43:45'),
(717, 1, 'Logged In', NULL, '::1', '2026-01-13 04:44:06'),
(718, 1, 'Logged Out', NULL, '::1', '2026-01-13 04:44:12'),
(721, 16, 'Logged In', NULL, '::1', '2026-01-13 04:46:04'),
(722, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:46:23'),
(723, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:46:28'),
(724, 16, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-13 04:46:40'),
(725, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 04:52:18'),
(726, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 04:55:23'),
(727, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 05:02:43'),
(728, 16, 'Logged Out', NULL, '::1', '2026-01-13 05:03:05'),
(729, 1, 'Logged In', NULL, '::1', '2026-01-13 05:08:14'),
(730, 1, 'Logged Out', NULL, '::1', '2026-01-13 05:08:17'),
(731, 1, 'Logged In', NULL, '::1', '2026-01-13 05:08:47'),
(732, 1, 'Logged Out', NULL, '::1', '2026-01-13 05:09:24'),
(747, 1, 'Logged In', NULL, '::1', '2026-01-13 05:22:20'),
(748, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-13 05:22:40'),
(749, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-13 05:22:50'),
(750, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-13 05:22:59'),
(751, 1, 'Logged Out', NULL, '::1', '2026-01-13 05:23:09'),
(752, 1, 'Logged In', NULL, '::1', '2026-01-13 05:26:51'),
(753, 1, 'Logged Out', NULL, '::1', '2026-01-13 06:08:27'),
(754, 1, 'Logged In', NULL, '::1', '2026-01-13 06:09:28'),
(755, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-13 06:20:08'),
(756, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-13 06:30:23'),
(757, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-13 06:30:23'),
(758, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-13 06:30:24'),
(759, 1, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-13 07:11:57'),
(760, 1, 'Logged Out', NULL, '::1', '2026-01-13 22:59:40'),
(765, 6, 'Logged In', NULL, '::1', '2026-01-13 23:00:40'),
(766, 6, 'Logged Out', NULL, '::1', '2026-01-13 23:00:54'),
(769, 1, 'Logged In', NULL, '::1', '2026-01-13 23:07:05'),
(770, 1, 'Viewed Specific Activity', 'Web Security Fundamentals', '::1', '2026-01-13 23:07:27'),
(771, 1, 'Logged Out', NULL, '::1', '2026-01-13 23:13:45'),
(774, 1, 'Logged In', NULL, '::1', '2026-01-13 23:56:22'),
(775, 1, 'Logged Out', NULL, '::1', '2026-01-14 00:11:21'),
(776, 6, 'Logged In', NULL, '::1', '2026-01-14 00:11:24'),
(777, 6, 'Logged Out', NULL, '::1', '2026-01-14 00:11:32'),
(778, 1, 'Logged In', NULL, '::1', '2026-01-14 00:11:37'),
(779, 1, 'Logged Out', NULL, '::1', '2026-01-14 00:11:42'),
(782, 1, 'Logged In', NULL, '::1', '2026-01-14 00:13:00'),
(783, 1, 'Logged Out', NULL, '::1', '2026-01-14 00:27:00'),
(784, 1, 'Logged In', NULL, '::1', '2026-01-14 00:27:53'),
(785, 1, 'Logged Out', NULL, '::1', '2026-01-14 00:33:07'),
(790, 1, 'Logged In', NULL, '::1', '2026-01-14 00:34:04'),
(791, 1, 'Logged Out', NULL, '::1', '2026-01-14 00:50:12'),
(794, 6, 'Logged In', NULL, '::1', '2026-01-14 00:51:06'),
(795, 6, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 00:52:30'),
(796, 6, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 00:52:42'),
(797, 6, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 00:54:42'),
(798, 6, 'Logged Out', NULL, '::1', '2026-01-14 00:55:39'),
(799, 1, 'Logged In', NULL, '::1', '2026-01-14 00:55:43'),
(800, 1, 'Logged Out', NULL, '::1', '2026-01-14 00:59:43'),
(803, 1, 'Logged In', NULL, '::1', '2026-01-14 01:00:03'),
(804, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 01:04:56'),
(805, 1, 'Logged Out', NULL, '::1', '2026-01-14 01:05:53'),
(810, 1, 'Logged In', NULL, '::1', '2026-01-14 01:06:18'),
(811, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 01:31:21'),
(812, 1, 'Logged Out', NULL, '::1', '2026-01-14 01:37:21'),
(813, 6, 'Logged In', NULL, '::1', '2026-01-14 01:37:27'),
(814, 6, 'Logged Out', NULL, '::1', '2026-01-14 02:19:07'),
(815, 6, 'Logged In', NULL, '::1', '2026-01-14 02:19:25'),
(816, 6, 'Logged Out', NULL, '::1', '2026-01-14 02:33:13'),
(819, 6, 'Logged In', NULL, '::1', '2026-01-14 02:41:31'),
(820, 6, 'Logged Out', NULL, '::1', '2026-01-14 03:18:40'),
(823, 1, 'Logged In', NULL, '::1', '2026-01-14 03:19:10'),
(824, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 03:19:20'),
(825, 1, 'Logged Out', NULL, '::1', '2026-01-14 03:20:05'),
(828, 1, 'Logged In', NULL, '::1', '2026-01-14 03:52:54'),
(829, 1, 'Logged Out', NULL, '::1', '2026-01-14 03:54:01'),
(830, 6, 'Logged In', NULL, '::1', '2026-01-14 03:54:05'),
(831, 6, 'Logged Out', NULL, '::1', '2026-01-14 04:02:51'),
(834, 1, 'Logged In', NULL, '::1', '2026-01-14 04:09:55'),
(835, 1, 'Logged Out', NULL, '::1', '2026-01-14 04:10:03'),
(838, 6, 'Logged In', NULL, '::1', '2026-01-14 04:15:10'),
(839, 6, 'Logged Out', NULL, '::1', '2026-01-14 04:15:26'),
(840, 16, 'Logged In', NULL, '::1', '2026-01-14 04:15:30'),
(841, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-14 04:15:46'),
(842, 16, 'Logged Out', NULL, '::1', '2026-01-14 04:39:28'),
(843, 6, 'Logged In', NULL, '::1', '2026-01-14 04:39:32'),
(844, 6, 'Logged Out', NULL, '::1', '2026-01-14 04:49:13'),
(845, 1, 'Logged In', NULL, '::1', '2026-01-14 04:49:18'),
(846, 1, 'Logged Out', NULL, '::1', '2026-01-14 04:55:22'),
(849, 6, 'Logged In', NULL, '::1', '2026-01-14 04:55:55'),
(850, 6, 'Deleted User', 'User ID: 5 removed.', '::1', '2026-01-14 05:03:10'),
(851, 1, 'Logged In', NULL, '::1', '2026-01-14 05:20:33'),
(852, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 05:32:22'),
(853, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 05:47:32'),
(854, 1, 'Logged Out', NULL, '::1', '2026-01-14 06:01:05'),
(855, 16, 'Logged In', NULL, '::1', '2026-01-14 06:01:11'),
(856, 16, 'Logged Out', NULL, '::1', '2026-01-14 06:01:19'),
(857, 6, 'Logged In', NULL, '::1', '2026-01-14 23:03:39'),
(858, 6, 'Logged Out', NULL, '::1', '2026-01-14 23:04:05'),
(859, 16, 'Logged In', NULL, '::1', '2026-01-14 23:18:44'),
(860, 16, 'Logged Out', NULL, '::1', '2026-01-14 23:26:01'),
(863, 1, 'Logged In', NULL, '::1', '2026-01-14 23:26:34'),
(864, 1, 'Viewed Specific Activity', 'Web Security Fundamentals', '::1', '2026-01-14 23:27:53'),
(865, 1, 'Logged Out', NULL, '::1', '2026-01-14 23:52:34'),
(868, 1, 'Logged In', NULL, '::1', '2026-01-14 23:56:42'),
(869, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-14 23:59:48'),
(870, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 00:10:13'),
(871, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 00:53:50'),
(872, 1, 'Logged Out', NULL, '::1', '2026-01-15 01:27:08'),
(875, 16, 'Logged In', NULL, '::1', '2026-01-15 01:27:38'),
(876, 16, 'Logged Out', NULL, '::1', '2026-01-15 01:27:55'),
(877, 1, 'Logged In', NULL, '::1', '2026-01-15 01:28:03'),
(878, 1, 'Logged Out', NULL, '::1', '2026-01-15 02:57:42'),
(879, 16, 'Logged In', NULL, '::1', '2026-01-15 02:57:46'),
(880, 16, 'Logged Out', NULL, '::1', '2026-01-15 02:57:52'),
(883, 6, 'Logged In', NULL, '::1', '2026-01-15 02:58:09'),
(884, 6, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 03:02:00'),
(885, 6, 'Updated Admin Profile', 'Profile details changed', '::1', '2026-01-15 03:04:56'),
(886, 6, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 04:36:59'),
(887, 6, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-15 04:37:26'),
(888, 6, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-15 04:37:29'),
(889, 6, 'Viewed Specific Activity', 'test1CED', '::1', '2026-01-15 04:39:51'),
(890, 6, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 05:02:37'),
(891, 6, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 05:02:41'),
(892, 6, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-15 05:02:46'),
(893, 6, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-15 05:50:19'),
(894, 6, 'Logged Out', NULL, '::1', '2026-01-15 05:50:23'),
(895, 1, 'Logged In', NULL, '::1', '2026-01-15 05:50:27'),
(896, 1, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-01-15 05:50:35'),
(897, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 06:02:34'),
(898, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 06:04:43'),
(899, 1, 'Viewed Specific Activity', 'wewe', '::1', '2026-01-15 06:05:19'),
(900, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 06:37:31'),
(901, 1, 'Logged Out', NULL, '::1', '2026-01-15 06:39:20'),
(904, 1, 'Logged In', NULL, '::1', '2026-01-15 06:41:36'),
(905, 1, 'Logged Out', NULL, '::1', '2026-01-15 06:43:27'),
(906, 6, 'Logged In', NULL, '::1', '2026-01-15 06:43:32'),
(907, 1, 'Logged In', NULL, '::1', '2026-01-15 22:51:44'),
(908, 1, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 23:04:57'),
(909, 1, 'Logged Out', NULL, '::1', '2026-01-15 23:08:19'),
(912, 6, 'Logged In', NULL, '::1', '2026-01-15 23:08:40'),
(913, 6, 'Logged Out', NULL, '::1', '2026-01-15 23:23:05'),
(914, 1, 'Logged In', NULL, '::1', '2026-01-15 23:23:14'),
(915, 1, 'Logged Out', NULL, '::1', '2026-01-15 23:23:22'),
(916, 1, 'Logged In', NULL, '::1', '2026-01-15 23:23:26'),
(917, 1, 'Logged Out', NULL, '::1', '2026-01-15 23:28:59'),
(918, 6, 'Logged In', NULL, '::1', '2026-01-15 23:29:10'),
(919, 6, 'Viewed Specific Activity', 'HRTEST', '::1', '2026-01-15 23:32:31'),
(920, 6, 'Logged Out', NULL, '::1', '2026-01-15 23:33:01'),
(921, 1, 'Logged In', NULL, '::1', '2026-01-15 23:33:05'),
(922, 1, 'Logged Out', NULL, '::1', '2026-01-16 01:22:21'),
(923, 1, 'Logged In', NULL, '::1', '2026-01-16 01:22:47'),
(924, 1, 'Logged Out', NULL, '::1', '2026-01-16 01:23:14'),
(929, 1, 'Logged In', NULL, '::1', '2026-01-16 01:32:17'),
(930, 1, 'Viewed Specific Activity', 'TODAYTODAYYY', '::1', '2026-01-16 01:33:10'),
(931, 1, 'Logged Out', NULL, '::1', '2026-01-16 01:33:48'),
(934, 16, 'Logged In', NULL, '::1', '2026-01-16 01:34:30'),
(935, 16, 'Logged Out', NULL, '::1', '2026-01-16 01:35:27'),
(938, 1, 'Logged In', NULL, '::1', '2026-01-16 01:40:32'),
(939, 1, 'Logged Out', NULL, '::1', '2026-01-16 01:46:04'),
(942, 1, 'Logged In', NULL, '::1', '2026-01-16 01:46:39'),
(943, 1, 'Logged Out', NULL, '::1', '2026-01-16 01:46:43'),
(944, 6, 'Logged In', NULL, '::1', '2026-01-16 01:46:51'),
(945, 6, 'Viewed Specific Activity', 'TODAYTODAYYY', '::1', '2026-01-16 01:49:30'),
(946, 6, 'Logged Out', NULL, '::1', '2026-01-16 02:35:31'),
(947, 1, 'Logged In', NULL, '::1', '2026-01-16 02:35:41'),
(948, 1, 'Viewed Specific Activity', 'TODAYTODAYYY', '::1', '2026-01-16 04:24:05'),
(949, 1, 'Logged Out', NULL, '::1', '2026-01-16 06:12:30'),
(952, 1, 'Logged In', NULL, '::1', '2026-01-16 06:12:49'),
(953, 1, 'Viewed Specific Activity', 'TODAYTODAYYY', '::1', '2026-01-16 06:39:40'),
(954, 1, 'Logged In', NULL, '::1', '2026-01-18 05:59:23'),
(955, 1, 'Viewed Specific Activity', 'TODAYTODAYYY', '::1', '2026-01-18 07:55:00'),
(956, 1, 'Logged Out', NULL, '::1', '2026-01-18 23:42:54'),
(965, 1, 'Logged In', NULL, '::1', '2026-01-18 23:55:50'),
(966, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-18 23:56:16'),
(967, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 00:00:46'),
(968, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 00:03:56'),
(969, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 00:04:02'),
(970, 1, 'Logged Out', NULL, '::1', '2026-01-19 00:10:48'),
(973, 1, 'Logged In', NULL, '::1', '2026-01-19 00:11:11'),
(974, 1, 'Logged Out', NULL, '::1', '2026-01-19 00:11:54'),
(975, 1, 'Logged In', NULL, '::1', '2026-01-19 00:12:00'),
(978, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 00:46:38'),
(979, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 00:46:43'),
(980, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 00:46:52'),
(984, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 01:20:14'),
(985, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 01:20:37'),
(986, 1, 'Viewed Specific Activity', 'Web Security Fundamentals', '::1', '2026-01-19 01:25:37'),
(987, 1, 'Logged Out', NULL, '::1', '2026-01-19 01:25:43'),
(988, 1, 'Logged In', NULL, '::1', '2026-01-19 01:25:49'),
(998, 1, 'Viewed Specific Activity', 'Curse Training', '::1', '2026-01-19 02:00:08'),
(1005, 1, 'Logged Out', NULL, '::1', '2026-01-19 04:18:52'),
(1009, 1, 'Logged In', NULL, '::1', '2026-01-19 04:22:34'),
(1010, 1, 'Logged Out', NULL, '::1', '2026-01-19 05:08:47'),
(1015, 1, 'Logged In', NULL, '::1', '2026-01-19 05:51:29'),
(1016, 1, 'Logged Out', NULL, '::1', '2026-01-19 05:51:39'),
(1019, 6, 'Logged In', NULL, '::1', '2026-01-19 07:40:08'),
(1020, 6, 'Logged Out', NULL, '::1', '2026-01-19 23:11:20'),
(1021, 1, 'Logged In', NULL, '::1', '2026-01-19 23:11:25'),
(1022, 1, 'Viewed Specific Activity', 'Culling Game', '::1', '2026-01-19 23:11:32'),
(1023, 1, 'Logged Out', NULL, '::1', '2026-01-19 23:12:10'),
(1040, 1, 'Logged In', NULL, '::1', '2026-01-19 23:29:38'),
(1041, 1, 'Logged Out', NULL, '::1', '2026-01-19 23:29:57'),
(1069, 1, 'Logged In', NULL, '::1', '2026-01-20 00:31:10'),
(1070, 1, 'Logged Out', NULL, '::1', '2026-01-20 00:32:58'),
(1074, 1, 'Logged In', NULL, '::1', '2026-01-20 00:45:45'),
(1075, 1, 'Logged Out', NULL, '::1', '2026-01-20 00:46:20'),
(1082, 1, 'Logged In', NULL, '::1', '2026-01-20 00:59:54'),
(1083, 1, 'Logged Out', NULL, '::1', '2026-01-20 01:10:50'),
(1086, 1, 'Logged In', NULL, '::1', '2026-01-20 01:23:57'),
(1087, 1, 'Logged Out', NULL, '::1', '2026-01-20 01:24:01'),
(1088, 1, 'Logged In', NULL, '::1', '2026-01-20 01:35:00'),
(1089, 1, 'Logged Out', NULL, '::1', '2026-01-20 01:35:11'),
(1090, 1, 'Logged In', NULL, '::1', '2026-01-20 01:38:51'),
(1091, 1, 'Logged Out', NULL, '::1', '2026-01-20 01:42:00'),
(1099, 1, 'Logged In', NULL, '::1', '2026-01-20 01:47:26'),
(1100, 1, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 01:47:41'),
(1101, 1, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 01:47:54'),
(1102, 1, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 01:47:56'),
(1103, 1, 'Reviewed Activity', 'Activity ID: 41', '::1', '2026-01-20 01:47:56'),
(1104, 1, 'Logged Out', NULL, '::1', '2026-01-20 01:48:33'),
(1107, 16, 'Logged In', NULL, '::1', '2026-01-20 02:04:28'),
(1108, 16, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 02:04:51'),
(1109, 16, 'Logged Out', NULL, '::1', '2026-01-20 02:53:22'),
(1110, 1, 'Logged In', NULL, '::1', '2026-01-20 02:53:26'),
(1111, 1, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 04:17:47'),
(1112, 1, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 04:19:21'),
(1113, 1, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 04:22:34'),
(1114, 1, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 04:23:12'),
(1115, 1, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-20 04:26:36'),
(1116, 1, 'Viewed Specific Activity', 'TODAYTODAYYY', '::1', '2026-01-20 04:27:13'),
(1117, 1, 'Viewed Specific Activity', 'TODAYTODAYYY', '::1', '2026-01-20 04:27:15'),
(1118, 1, 'Reviewed Activity', 'Activity ID: 35', '::1', '2026-01-20 04:27:15'),
(1119, 1, 'Logged Out', NULL, '::1', '2026-01-20 04:27:34'),
(1125, 1, 'Logged In', NULL, '::1', '2026-01-20 04:56:39'),
(1127, 1, 'Logged Out', NULL, '::1', '2026-01-20 05:36:34'),
(1131, 1, 'Logged In', NULL, '::1', '2026-01-20 05:39:52'),
(1132, 1, 'Logged Out', NULL, '::1', '2026-01-20 05:40:15'),
(1133, 16, 'Logged In', NULL, '::1', '2026-01-20 05:40:22'),
(1134, 16, 'Logged Out', NULL, '::1', '2026-01-20 05:44:29'),
(1137, 6, 'Logged In', NULL, '::1', '2026-01-20 05:44:54'),
(1143, 6, 'Logged Out', NULL, '::1', '2026-01-20 05:57:52'),
(1144, 1, 'Logged In', NULL, '::1', '2026-01-20 05:57:57'),
(1145, 1, 'Logged Out', NULL, '::1', '2026-01-20 06:04:56'),
(1146, 16, 'Logged In', NULL, '::1', '2026-01-20 06:05:00'),
(1147, 16, 'Logged Out', NULL, '::1', '2026-01-20 06:05:06'),
(1150, 1, 'Logged In', NULL, '::1', '2026-01-20 06:05:26'),
(1151, 1, 'Logged Out', NULL, '::1', '2026-01-20 06:05:32'),
(1152, 6, 'Logged In', NULL, '::1', '2026-01-20 06:05:38'),
(1153, 6, 'Logged Out', NULL, '::1', '2026-01-20 06:05:50'),
(1154, 1, 'Logged In', NULL, '::1', '2026-01-20 06:52:34'),
(1155, 1, 'Logged Out', NULL, '::1', '2026-01-20 07:34:42'),
(1157, 1, 'Logged In', NULL, '::1', '2026-01-20 07:35:22'),
(1158, 1, 'Logged Out', NULL, '::1', '2026-01-20 07:36:12'),
(1161, 1, 'Logged In', NULL, '::1', '2026-01-20 07:36:33'),
(1162, 1, 'Logged Out', NULL, '::1', '2026-01-20 07:36:57'),
(1165, 1, 'Logged In', NULL, '::1', '2026-01-20 07:37:12'),
(1168, 1, 'Logged In', NULL, '::1', '2026-01-20 23:32:52'),
(1169, 1, 'Logged Out', NULL, '::1', '2026-01-20 23:48:07'),
(1171, 1, 'Logged In', NULL, '::1', '2026-01-20 23:55:49'),
(1172, 1, 'Logged Out', NULL, '::1', '2026-01-20 23:55:56'),
(1173, 6, 'Logged In', NULL, '::1', '2026-01-20 23:56:04'),
(1174, 1, 'Logged In', NULL, '::1', '2026-01-21 00:05:11'),
(1175, 1, 'Logged Out', NULL, '::1', '2026-01-21 00:05:15'),
(1176, 6, 'Logged In', NULL, '::1', '2026-01-21 00:06:41'),
(1177, 1, 'Logged In', NULL, '::1', '2026-01-21 01:57:51'),
(1178, 1, 'Logged In', NULL, '::1', '2026-01-22 07:43:02'),
(1179, 1, 'Viewed Specific Activity', 'TESTNO2', '::1', '2026-01-22 07:43:08'),
(1180, 1, 'Logged In', NULL, '::1', '2026-01-23 05:41:19'),
(1181, 1, 'Logged In', NULL, '::1', '2026-01-24 01:24:31'),
(1182, 1, 'Logged Out', NULL, '::1', '2026-01-24 01:34:47'),
(1186, 1, 'Logged In', NULL, '::1', '2026-01-24 03:08:46'),
(1187, 1, 'Logged Out', NULL, '::1', '2026-01-24 03:14:39'),
(1190, 6, 'Logged In', NULL, '::1', '2026-01-24 03:41:40'),
(1191, 6, 'Viewed Specific Activity', 'web dev seminar', '::1', '2026-01-24 05:08:34'),
(1192, 6, 'Logged Out', NULL, '::1', '2026-01-24 05:08:51'),
(1193, 1, 'Logged In', NULL, '::1', '2026-01-24 05:09:02'),
(1194, 1, 'Viewed Specific Activity', 'web dev seminar', '::1', '2026-01-24 05:09:30'),
(1195, 1, 'Viewed Specific Activity', 'web dev seminar', '::1', '2026-01-24 05:09:33'),
(1196, 1, 'Logged Out', NULL, '::1', '2026-01-24 05:45:13'),
(1199, 1, 'Logged In', NULL, '::1', '2026-01-24 05:47:30'),
(1200, 1, 'Logged Out', NULL, '::1', '2026-01-24 05:47:51'),
(1201, 6, 'Logged In', NULL, '::1', '2026-01-24 05:47:57'),
(1202, 6, 'Logged Out', NULL, '::1', '2026-01-24 05:51:09'),
(1203, 16, 'Logged In', NULL, '::1', '2026-01-24 05:51:13'),
(1204, 16, 'Logged Out', NULL, '::1', '2026-01-24 05:51:34'),
(1205, 6, 'Logged In', NULL, '::1', '2026-01-24 05:51:42'),
(1206, 6, 'Logged Out', NULL, '::1', '2026-01-24 05:51:53'),
(1207, 16, 'Logged In', NULL, '::1', '2026-01-24 05:52:04'),
(1208, 16, 'Logged Out', NULL, '::1', '2026-01-24 05:55:22'),
(1211, 16, 'Logged In', NULL, '::1', '2026-01-24 05:55:58'),
(1212, 16, 'Logged Out', NULL, '::1', '2026-01-24 06:03:00'),
(1215, 16, 'Logged In', NULL, '::1', '2026-01-24 06:03:43'),
(1216, 16, 'Logged Out', NULL, '::1', '2026-01-24 06:08:00'),
(1219, 16, 'Logged In', NULL, '::1', '2026-01-24 06:08:17'),
(1220, 16, 'Logged Out', NULL, '::1', '2026-01-24 06:09:42'),
(1221, 1, 'Logged In', NULL, '::1', '2026-01-24 06:10:01'),
(1222, 1, 'Logged Out', NULL, '::1', '2026-01-24 06:11:21'),
(1223, 16, 'Logged In', NULL, '::1', '2026-01-24 06:11:26'),
(1224, 16, 'Logged Out', NULL, '::1', '2026-01-24 06:12:41'),
(1230, 16, 'Logged In', NULL, '::1', '2026-01-24 06:35:07');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES
(1231, 16, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-24 06:35:12'),
(1232, 16, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-24 06:35:17'),
(1233, 16, 'Viewed Specific Activity', 'SOCIALMEDIA', '::1', '2026-01-24 06:35:24'),
(1234, 16, 'Logged Out', NULL, '::1', '2026-01-24 06:36:36'),
(1235, 16, 'Logged In', NULL, '::1', '2026-01-24 06:36:41'),
(1236, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-24 06:36:56'),
(1237, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-24 06:37:08'),
(1238, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-24 06:43:59'),
(1239, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-24 06:44:04'),
(1240, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-24 06:44:34'),
(1241, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-24 06:44:38'),
(1242, 16, 'SDS Final Approval Given', 'test 8', '::1', '2026-01-24 06:44:38'),
(1243, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-24 06:44:38'),
(1244, 16, 'Viewed Specific Activity', 'test 8', '::1', '2026-01-24 06:45:00'),
(1245, 16, 'Logged Out', NULL, '::1', '2026-01-24 06:45:11'),
(1246, 1, 'Logged In', NULL, '::1', '2026-01-24 06:45:17'),
(1247, 1, 'Viewed Specific Activity', 'web dev seminar', '::1', '2026-01-24 06:45:24'),
(1248, 1, 'Viewed Specific Activity', 'web dev seminar', '::1', '2026-01-24 06:45:25'),
(1249, 1, 'Reviewed Activity Submission', 'web dev seminar', '::1', '2026-01-24 06:45:25'),
(1250, 1, 'Viewed Specific Activity', 'web dev seminar', '::1', '2026-01-24 06:45:26'),
(1251, 1, 'Viewed Specific Activity', 'web dev seminar', '::1', '2026-01-24 06:45:27'),
(1252, 1, 'Recommended Activity Submission', 'web dev seminar', '::1', '2026-01-24 06:45:27'),
(1253, 1, 'Viewed Specific Activity', 'web dev seminar', '::1', '2026-01-24 06:45:27'),
(1254, 1, 'Logged Out', NULL, '::1', '2026-01-24 06:46:00'),
(1259, 1, 'Logged In', NULL, '::1', '2026-01-24 06:57:08'),
(1260, 1, 'Viewed Specific Activity', 'tryitri', '::1', '2026-01-24 06:57:13'),
(1261, 1, 'Logged Out', NULL, '::1', '2026-01-24 06:57:23'),
(1262, 16, 'Logged In', NULL, '::1', '2026-01-24 06:59:17'),
(1263, 16, 'Viewed Specific Activity', 'tryitri', '::1', '2026-01-24 06:59:33'),
(1264, 16, 'Logged Out', NULL, '::1', '2026-01-24 07:03:49'),
(1265, 1, 'Logged In', NULL, '::1', '2026-01-25 23:33:30'),
(1266, 1, 'Submitted Activity', 'Activity Title: tryout', '::1', '2026-01-25 23:36:36'),
(1267, 1, 'Viewed Specific Activity', 'TODAYTODAYYY', '::1', '2026-01-25 23:40:27'),
(1268, 1, 'Viewed Specific Activity', 'tryout', '::1', '2026-01-25 23:56:49'),
(1269, 1, 'Logged Out', NULL, '::1', '2026-01-26 00:21:29'),
(1272, 6, 'Logged In', NULL, '::1', '2026-01-26 00:48:29'),
(1273, 6, 'Logged Out', NULL, '::1', '2026-01-26 00:49:37'),
(1280, 1, 'Logged In', NULL, '::1', '2026-01-26 01:00:18'),
(1281, 1, 'Viewed Specific Activity', 'Capacity building on technical writing skills for non teaching personnel', '::1', '2026-01-26 01:03:40'),
(1282, 1, 'Viewed Specific Activity', 'Capacity building on technical writing skills for non teaching personnel', '::1', '2026-01-26 01:17:50'),
(1283, 1, 'Logged Out', NULL, '::1', '2026-01-26 01:35:05'),
(1293, 6, 'Logged In', NULL, '::1', '2026-01-26 02:49:52'),
(1294, 6, 'Logged Out', NULL, '::1', '2026-01-26 02:49:59'),
(1295, 1, 'Logged In', NULL, '::1', '2026-01-26 02:50:09'),
(1296, 1, 'Logged Out', NULL, '::1', '2026-01-26 02:51:17'),
(1297, 1, 'Logged In', NULL, '::1', '2026-01-26 02:56:06'),
(1298, 1, 'Logged Out', NULL, '::1', '2026-01-26 02:56:09'),
(1304, 1, 'Logged In', NULL, '::1', '2026-01-26 04:39:26'),
(1305, 1, 'Logged Out', NULL, '::1', '2026-01-26 04:39:33'),
(1318, 6, 'Logged In', NULL, '::1', '2026-01-26 06:30:34'),
(1319, 6, 'Logged Out', NULL, '::1', '2026-01-26 06:32:03'),
(1322, 1, 'Logged In', NULL, '::1', '2026-01-26 06:32:50'),
(1323, 1, 'Logged Out', NULL, '::1', '2026-01-26 06:36:58'),
(1333, 1, 'Logged In', NULL, '::1', '2026-01-27 00:16:56'),
(1334, 1, 'Logged Out', NULL, '::1', '2026-01-27 00:17:04'),
(1335, 16, 'Logged In', NULL, '::1', '2026-01-27 00:17:12'),
(1336, 16, 'Logged Out', NULL, '::1', '2026-01-27 00:17:19'),
(1341, 1, 'Logged In', NULL, '::1', '2026-01-27 00:34:02'),
(1342, 1, 'Logged Out', NULL, '::1', '2026-01-27 00:34:09'),
(1343, 16, 'Logged In', NULL, '::1', '2026-01-27 00:40:19'),
(1344, 16, 'Logged Out', NULL, '::1', '2026-01-27 00:41:21'),
(1347, 1, 'Logged In', NULL, '::1', '2026-01-27 00:57:10'),
(1348, 1, 'Logged Out', NULL, '::1', '2026-01-27 00:58:03'),
(1351, 1, 'Logged In', NULL, '::1', '2026-01-27 01:41:18'),
(1352, 1, 'Logged Out', NULL, '::1', '2026-01-27 01:41:35'),
(1367, 6, 'Logged In', NULL, '::1', '2026-01-27 02:44:58'),
(1368, 6, 'Logged Out', NULL, '::1', '2026-01-27 02:45:28'),
(1369, 1, 'Logged In', NULL, '::1', '2026-01-27 02:47:44'),
(1370, 1, 'Logged Out', NULL, '::1', '2026-01-27 02:48:20'),
(1371, 1, 'Logged In', NULL, '::1', '2026-01-27 02:53:13'),
(1372, 1, 'Logged Out', NULL, '::1', '2026-01-27 02:53:18'),
(1378, 1, 'Logged In', NULL, '::1', '2026-01-27 03:56:50'),
(1379, 1, 'Logged Out', NULL, '::1', '2026-01-27 03:56:51'),
(1382, 6, 'Logged In', NULL, '::1', '2026-01-27 03:57:03'),
(1383, 6, 'Logged Out', NULL, '::1', '2026-01-27 03:57:05'),
(1386, 16, 'Logged In', NULL, '::1', '2026-01-27 04:18:55'),
(1387, 16, 'Logged Out', NULL, '::1', '2026-01-27 04:19:50'),
(1394, 6, 'Logged In', NULL, '::1', '2026-01-27 04:25:50'),
(1395, 6, 'Logged Out', NULL, '::1', '2026-01-27 04:42:42'),
(1396, 1, 'Logged In', NULL, '::1', '2026-01-27 04:42:46'),
(1397, 1, 'Logged Out', NULL, '::1', '2026-01-27 04:53:14'),
(1398, 6, 'Logged In', NULL, '::1', '2026-01-27 04:53:47'),
(1399, 6, 'Created User (Super Admin)', 'Created new head_hr: headhr', '::1', '2026-01-27 04:58:20'),
(1400, 6, 'Approved Registration', 'User ID: 23', '::1', '2026-01-27 04:59:09'),
(1401, 6, 'Logged Out', NULL, '::1', '2026-01-27 04:59:17'),
(1402, 23, 'Logged In', NULL, '::1', '2026-01-27 05:00:07'),
(1403, 23, 'Logged In', NULL, '::1', '2026-01-27 05:00:27'),
(1404, 6, 'Logged In', NULL, '::1', '2026-01-27 05:05:09'),
(1405, 6, 'Logged Out', NULL, '::1', '2026-01-27 05:19:04'),
(1406, 6, 'Logged Out', NULL, '::1', '2026-01-27 05:19:06'),
(1407, 23, 'Logged In', NULL, '::1', '2026-01-27 05:19:14'),
(1408, 23, 'Logged In', NULL, '::1', '2026-01-27 05:21:24'),
(1409, 23, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-01-27 05:25:56'),
(1410, 23, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-01-27 05:31:57'),
(1411, 23, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-01-27 05:35:27'),
(1412, 23, 'Logged Out', NULL, '::1', '2026-01-27 05:49:16'),
(1415, 1, 'Logged In', NULL, '::1', '2026-01-27 05:49:40'),
(1416, 1, 'Viewed Specific Activity', 'Capacity building on technical writing skills for non teaching personnel', '::1', '2026-01-27 05:49:52'),
(1417, 1, 'Logged Out', NULL, '::1', '2026-01-27 05:50:16'),
(1418, 6, 'Logged In', NULL, '::1', '2026-01-27 05:50:22'),
(1419, 6, 'Created User (Super Admin)', 'Created new hr: hrhr', '::1', '2026-01-27 05:58:15'),
(1420, 6, 'Logged Out', NULL, '::1', '2026-01-27 05:58:19'),
(1426, 23, 'Logged In', NULL, '::1', '2026-01-27 06:11:36'),
(1427, 23, 'Deleted User', 'User ID: 12 removed.', '::1', '2026-01-27 06:11:42'),
(1428, 23, 'Logged Out', NULL, '::1', '2026-01-27 06:12:18'),
(1432, 1, 'Logged In', NULL, '::1', '2026-01-27 06:19:14'),
(1433, 1, 'Logged Out', NULL, '::1', '2026-01-27 06:19:38'),
(1436, 23, 'Logged In', NULL, '::1', '2026-01-27 06:21:26'),
(1437, 23, 'Logged Out', NULL, '::1', '2026-01-27 06:40:45'),
(1449, 16, 'Logged In', NULL, '::1', '2026-01-27 06:57:28'),
(1450, 16, 'Logged Out', NULL, '::1', '2026-01-27 06:57:38'),
(1454, 23, 'Logged In', NULL, '::1', '2026-01-27 07:12:44'),
(1455, 23, 'Profile Updated', 'User updated their own profile information.', '::1', '2026-01-27 07:13:08'),
(1456, 23, 'Logged Out', NULL, '::1', '2026-01-27 07:25:24'),
(1461, 23, 'Logged In', NULL, '::1', '2026-01-27 07:36:48'),
(1462, 23, 'Logged Out', NULL, '::1', '2026-01-27 23:43:23'),
(1463, 1, 'Logged In', NULL, '::1', '2026-01-27 23:43:32'),
(1464, 1, 'Logged Out', NULL, '::1', '2026-01-27 23:46:45'),
(1465, 6, 'Logged In', NULL, '::1', '2026-01-27 23:46:50'),
(1466, 6, 'Logged Out', NULL, '::1', '2026-01-27 23:54:15'),
(1469, 1, 'Logged In', NULL, '::1', '2026-01-28 02:14:35'),
(1470, 1, 'Logged Out', NULL, '::1', '2026-01-28 02:16:47'),
(1471, 23, 'Logged In', NULL, '::1', '2026-01-28 02:16:53'),
(1472, 23, 'Logged Out', NULL, '::1', '2026-01-28 23:35:04'),
(1473, 1, 'Logged In', NULL, '::1', '2026-01-28 23:35:28'),
(1474, 1, 'Logged Out', NULL, '::1', '2026-01-28 23:59:31'),
(1475, 23, 'Logged In', NULL, '::1', '2026-01-29 00:05:19'),
(1476, 23, 'Logged Out', NULL, '::1', '2026-01-29 00:05:35'),
(1477, 1, 'Logged In', NULL, '::1', '2026-01-29 00:05:42'),
(1478, 1, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-01-29 00:22:49'),
(1479, 1, 'Logged Out', NULL, '::1', '2026-01-29 00:23:55'),
(1480, 23, 'Logged In', NULL, '::1', '2026-01-29 00:24:01'),
(1481, 23, 'Logged Out', NULL, '::1', '2026-01-29 00:25:04'),
(1482, 1, 'Logged In', NULL, '::1', '2026-01-29 00:54:37'),
(1483, 1, 'Logged Out', NULL, '::1', '2026-01-29 00:54:40'),
(1484, 23, 'Logged In', NULL, '::1', '2026-01-29 00:54:44'),
(1485, 23, 'Logged Out', NULL, '::1', '2026-01-29 00:54:52'),
(1489, 23, 'Logged In', NULL, '::1', '2026-01-29 01:15:56'),
(1490, 23, 'Logged Out', NULL, '::1', '2026-01-29 01:27:17'),
(1491, 1, 'Logged In', NULL, '::1', '2026-01-29 01:52:26'),
(1492, 1, 'Logged Out', NULL, '::1', '2026-01-29 01:52:44'),
(1493, 23, 'Logged In', NULL, '::1', '2026-01-29 01:53:06'),
(1494, 23, 'Logged Out', NULL, '::1', '2026-01-29 01:53:29'),
(1495, 1, 'Logged In', NULL, '::1', '2026-01-29 01:53:34'),
(1496, 1, 'Logged Out', NULL, '::1', '2026-01-29 02:06:12'),
(1497, 23, 'Logged In', NULL, '::1', '2026-01-29 02:06:16'),
(1498, 1, 'Logged In', NULL, '::1', '2026-01-29 04:09:48'),
(1499, 1, 'Viewed Specific Activity', 'tryout', '::1', '2026-01-29 04:12:57'),
(1500, 1, 'Logged Out', NULL, '::1', '2026-01-29 04:14:22'),
(1501, 23, 'Logged In', NULL, '::1', '2026-01-29 04:14:31'),
(1502, 23, 'Logged Out', NULL, '::1', '2026-01-29 04:16:28'),
(1503, 1, 'Logged In', NULL, '::1', '2026-01-29 04:16:38'),
(1504, 1, 'Logged Out', NULL, '::1', '2026-01-29 04:22:27'),
(1509, 1, 'Logged In', NULL, '::1', '2026-01-29 04:43:13'),
(1510, 1, 'Logged Out', NULL, '::1', '2026-01-29 04:59:32'),
(1517, 26, 'Logged In', NULL, '::1', '2026-01-29 05:04:37'),
(1518, 26, 'Profile Updated', 'Personnel updated their own profile information and/or profile picture.', '::1', '2026-01-29 05:04:50'),
(1519, 26, 'Submitted Activity', 'Activity Title: Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:07:15'),
(1520, 26, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:07:20'),
(1521, 26, 'Updated Certificate', 'Activity ID: 50', '::1', '2026-01-29 05:08:24'),
(1522, 26, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:08:34'),
(1523, 26, 'Logged Out', NULL, '::1', '2026-01-29 05:08:40'),
(1524, 1, 'Logged In', NULL, '::1', '2026-01-29 05:08:49'),
(1525, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:09:02'),
(1526, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:09:17'),
(1527, 1, 'Reviewed Activity Submission', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:09:17'),
(1528, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:09:17'),
(1529, 1, 'Logged Out', NULL, '::1', '2026-01-29 05:09:24'),
(1530, 26, 'Logged In', NULL, '::1', '2026-01-29 05:09:28'),
(1531, 26, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:09:33'),
(1532, 26, 'Logged Out', NULL, '::1', '2026-01-29 05:09:47'),
(1533, 1, 'Logged In', NULL, '::1', '2026-01-29 05:09:52'),
(1534, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:11:13'),
(1535, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:11:14'),
(1536, 1, 'Recommended Activity Submission', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:11:14'),
(1537, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:11:14'),
(1538, 1, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-01-29 05:11:17'),
(1539, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-01-29 05:11:20'),
(1540, 1, 'Viewed Specific Activity', 'Capacity building on technical writing skills for non teaching personnel', '::1', '2026-01-29 05:11:23'),
(1541, 1, 'Viewed Specific Activity', 'TESTNO1', '::1', '2026-01-29 05:11:30'),
(1542, 1, 'Viewed Specific Activity', 'Web Security Fundamentals', '::1', '2026-01-29 05:11:37'),
(1543, 1, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-01-29 05:11:41'),
(1544, 1, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-01-29 05:11:43'),
(1545, 1, 'Reviewed Activity Submission', 'BEHEADING TANK', '::1', '2026-01-29 05:11:43'),
(1546, 1, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-01-29 05:11:43'),
(1547, 1, 'Logged Out', NULL, '::1', '2026-01-29 05:12:35'),
(1553, 1, 'Logged In', NULL, '::1', '2026-01-29 05:33:32'),
(1554, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:33:38'),
(1555, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-29 05:33:48'),
(1556, 1, 'Logged Out', NULL, '::1', '2026-01-29 05:34:04'),
(1559, 23, 'Logged In', NULL, '::1', '2026-01-29 05:34:46'),
(1560, 23, 'Logged Out', NULL, '::1', '2026-01-29 05:59:30'),
(1561, 1, 'Logged In', NULL, '::1', '2026-01-29 23:01:30'),
(1562, 1, 'Logged Out', NULL, '::1', '2026-01-29 23:20:46'),
(1566, 1, 'Logged In', NULL, '::1', '2026-01-29 23:33:55'),
(1567, 1, 'Logged Out', NULL, '::1', '2026-01-29 23:34:06'),
(1573, 1, 'Logged In', NULL, '::1', '2026-01-30 00:22:19'),
(1574, 1, 'Logged Out', NULL, '::1', '2026-01-30 00:28:15'),
(1575, 6, 'Logged In', NULL, '::1', '2026-01-30 00:29:05'),
(1576, 6, 'Logged Out', NULL, '::1', '2026-01-30 00:33:33'),
(1577, 23, 'Logged In', NULL, '::1', '2026-01-30 00:33:40'),
(1578, 23, 'Logged Out', NULL, '::1', '2026-01-30 00:39:26'),
(1579, 1, 'Logged In', NULL, '::1', '2026-01-30 00:44:21'),
(1580, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-30 00:49:05'),
(1581, 1, 'Logged Out', NULL, '::1', '2026-01-30 00:49:36'),
(1582, 23, 'Logged In', NULL, '::1', '2026-01-30 00:49:44'),
(1583, 23, 'Logged Out', NULL, '::1', '2026-01-30 00:49:53'),
(1590, 6, 'Logged In', NULL, '::1', '2026-01-30 00:50:39'),
(1591, 6, 'Logged Out', NULL, '::1', '2026-01-30 00:50:51'),
(1594, 23, 'Logged In', NULL, '::1', '2026-01-30 00:51:17'),
(1595, 23, 'Logged Out', NULL, '::1', '2026-01-30 00:51:31'),
(1602, 16, 'Logged In', NULL, '::1', '2026-01-30 00:51:54'),
(1603, 16, 'Logged Out', NULL, '::1', '2026-01-30 00:52:52'),
(1604, 23, 'Logged In', NULL, '::1', '2026-01-30 00:52:55'),
(1605, 23, 'Logged Out', NULL, '::1', '2026-01-30 00:53:00'),
(1608, 1, 'Logged In', NULL, '::1', '2026-01-30 01:17:42'),
(1609, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-30 01:18:01'),
(1610, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-01-30 01:18:03'),
(1611, 1, 'Logged Out', NULL, '::1', '2026-01-30 01:18:15'),
(1615, 23, 'Logged In', NULL, '::1', '2026-01-30 01:18:38'),
(1616, 23, 'Submitted Activity', 'Activity Title: head hr trial', '::1', '2026-01-30 01:20:12'),
(1617, 23, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-01-30 01:23:54'),
(1618, 23, 'Logged Out', NULL, '::1', '2026-01-30 01:23:59'),
(1619, 1, 'Logged In', NULL, '::1', '2026-01-30 01:24:03'),
(1620, 1, 'Viewed Specific Activity', 'Advanced Project Management', '::1', '2026-01-30 01:24:07'),
(1621, 1, 'Logged In', NULL, '::1', '2026-02-02 00:46:14'),
(1622, 1, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-02 01:38:53'),
(1623, 1, 'Viewed Specific Activity', 'tryout', '::1', '2026-02-02 01:39:11'),
(1624, 1, 'Logged Out', NULL, '::1', '2026-02-02 01:39:48'),
(1625, 23, 'Logged In', NULL, '::1', '2026-02-02 01:39:53'),
(1626, 23, 'Logged Out', NULL, '::1', '2026-02-02 01:40:27'),
(1627, 6, 'Logged In', NULL, '::1', '2026-02-02 01:40:31'),
(1628, 6, 'Logged Out', NULL, '::1', '2026-02-02 01:40:52'),
(1629, 1, 'Logged In', NULL, '::1', '2026-02-02 01:40:56'),
(1630, 1, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-02 01:42:19'),
(1631, 1, 'Logged Out', NULL, '::1', '2026-02-02 01:44:35'),
(1634, 1, 'Logged In', NULL, '::1', '2026-02-02 01:53:41'),
(1635, 1, 'Logged Out', NULL, '::1', '2026-02-02 01:53:51'),
(1640, 1, 'Logged In', NULL, '::1', '2026-02-02 01:55:16'),
(1641, 1, 'Viewed Specific Activity', 'tttttttttt', '::1', '2026-02-02 01:55:21'),
(1642, 1, 'Viewed Specific Activity', 'tttttttttt', '::1', '2026-02-02 01:55:27'),
(1643, 1, 'Reviewed Activity Submission', 'tttttttttt', '::1', '2026-02-02 01:55:27'),
(1644, 1, 'Viewed Specific Activity', 'tttttttttt', '::1', '2026-02-02 01:55:27'),
(1645, 1, 'Viewed Specific Activity', 'tttttttttt', '::1', '2026-02-02 01:55:28'),
(1646, 1, 'Recommended Activity Submission', 'tttttttttt', '::1', '2026-02-02 01:55:28'),
(1647, 1, 'Viewed Specific Activity', 'tttttttttt', '::1', '2026-02-02 01:55:28'),
(1648, 1, 'Logged Out', NULL, '::1', '2026-02-02 01:55:32'),
(1651, 23, 'Logged In', NULL, '::1', '2026-02-02 01:56:03'),
(1652, 23, 'Logged Out', NULL, '::1', '2026-02-02 01:56:10'),
(1653, 1, 'Logged In', NULL, '::1', '2026-02-02 01:56:58'),
(1654, 1, 'Logged Out', NULL, '::1', '2026-02-02 02:00:15'),
(1655, 23, 'Logged In', NULL, '::1', '2026-02-02 02:00:19'),
(1656, 23, 'Logged Out', NULL, '::1', '2026-02-02 02:00:24'),
(1659, 1, 'Logged In', NULL, '::1', '2026-02-02 02:00:53'),
(1660, 1, 'Logged Out', NULL, '::1', '2026-02-02 02:01:44'),
(1663, 1, 'Logged In', NULL, '::1', '2026-02-02 02:28:13'),
(1664, 1, 'Logged Out', NULL, '::1', '2026-02-02 02:33:57'),
(1667, 1, 'Logged In', NULL, '::1', '2026-02-02 02:34:23'),
(1668, 1, 'Logged Out', NULL, '::1', '2026-02-02 02:38:23'),
(1671, 1, 'Logged In', NULL, '::1', '2026-02-02 02:38:52'),
(1672, 1, 'Logged Out', NULL, '::1', '2026-02-02 02:39:10'),
(1678, 1, 'Logged In', NULL, '::1', '2026-02-02 03:36:53'),
(1679, 1, 'Logged Out', NULL, '::1', '2026-02-02 03:57:25'),
(1680, 16, 'Logged In', NULL, '::1', '2026-02-02 03:57:30'),
(1681, 16, 'Logged Out', NULL, '::1', '2026-02-02 03:57:50'),
(1686, 23, 'Logged In', NULL, '::1', '2026-02-02 03:58:14'),
(1687, 23, 'Logged Out', NULL, '::1', '2026-02-02 03:58:45'),
(1690, 1, 'Logged In', NULL, '::1', '2026-02-02 03:59:09'),
(1691, 1, 'Logged Out', NULL, '::1', '2026-02-02 04:12:56'),
(1697, 27, 'Logged In', NULL, '::1', '2026-02-02 05:04:49'),
(1698, 27, 'Submitted Activity', 'Activity Title: Training on Technical Writing', '::1', '2026-02-02 05:18:54'),
(1699, 27, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:19:01'),
(1700, 27, 'Logged Out', NULL, '::1', '2026-02-02 05:20:07'),
(1701, 1, 'Logged In', NULL, '::1', '2026-02-02 05:20:13'),
(1702, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:20:24'),
(1703, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:21:06'),
(1704, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:22:44'),
(1705, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:22:47'),
(1706, 1, 'Reviewed Activity Submission', 'Training on Technical Writing', '::1', '2026-02-02 05:22:47'),
(1707, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:22:47'),
(1708, 1, 'Logged Out', NULL, '::1', '2026-02-02 05:22:54'),
(1709, 27, 'Logged In', NULL, '::1', '2026-02-02 05:22:58'),
(1710, 27, 'Logged Out', NULL, '::1', '2026-02-02 05:23:10'),
(1711, 1, 'Logged In', NULL, '::1', '2026-02-02 05:23:15'),
(1712, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:23:20'),
(1713, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:23:23'),
(1714, 1, 'Recommended Activity Submission', 'Training on Technical Writing', '::1', '2026-02-02 05:23:23'),
(1715, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:23:23'),
(1716, 1, 'Logged Out', NULL, '::1', '2026-02-02 05:24:05'),
(1717, 16, 'Logged In', NULL, '::1', '2026-02-02 05:24:09'),
(1718, 16, 'Logged Out', NULL, '::1', '2026-02-02 05:25:02'),
(1719, 6, 'Logged In', NULL, '::1', '2026-02-02 05:25:11'),
(1720, 6, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:25:38'),
(1721, 6, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:25:52'),
(1722, 6, 'Created User (Super Admin)', 'Created new immediate_head: imhead', '::1', '2026-02-02 05:26:28'),
(1723, 6, 'Logged Out', NULL, '::1', '2026-02-02 05:26:32'),
(1724, 28, 'Logged In', NULL, '::1', '2026-02-02 05:26:37'),
(1725, 28, 'Logged In', NULL, '::1', '2026-02-02 05:26:40'),
(1726, 28, 'Logged In', NULL, '::1', '2026-02-02 05:26:43'),
(1727, 28, 'Logged In', NULL, '::1', '2026-02-02 05:26:44'),
(1728, 28, 'Logged In', NULL, '::1', '2026-02-02 05:26:45'),
(1729, 28, 'Logged In', NULL, '::1', '2026-02-02 05:26:46'),
(1730, 28, 'Logged In', NULL, '::1', '2026-02-02 05:26:48'),
(1731, 28, 'Logged In', NULL, '::1', '2026-02-02 05:26:48'),
(1732, 28, 'Logged Out', NULL, '::1', '2026-02-02 05:26:58'),
(1733, 16, 'Logged In', NULL, '::1', '2026-02-02 05:27:06'),
(1734, 16, 'Logged Out', NULL, '::1', '2026-02-02 05:27:39'),
(1735, 1, 'Logged In', NULL, '::1', '2026-02-02 05:27:42'),
(1736, 1, 'Viewed Specific Activity', 'tttttttttt', '::1', '2026-02-02 05:29:43'),
(1737, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:32:17'),
(1738, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 05:35:05'),
(1739, 1, 'Viewed Specific Activity', 'tryout', '::1', '2026-02-02 05:36:04'),
(1740, 1, 'Logged Out', NULL, '::1', '2026-02-02 05:36:10'),
(1741, 23, 'Logged In', NULL, '::1', '2026-02-02 05:36:18'),
(1742, 23, 'Logged Out', NULL, '::1', '2026-02-02 05:47:30'),
(1743, 1, 'Logged In', NULL, '::1', '2026-02-02 06:03:00'),
(1744, 1, 'Logged Out', NULL, '::1', '2026-02-02 06:03:21'),
(1745, 6, 'Logged In', NULL, '::1', '2026-02-02 06:03:25'),
(1746, 6, 'Logged Out', NULL, '::1', '2026-02-02 06:05:31'),
(1747, 1, 'Logged In', NULL, '::1', '2026-02-02 06:05:35'),
(1748, 1, 'Logged Out', NULL, '::1', '2026-02-02 06:06:04'),
(1749, 6, 'Logged In', NULL, '::1', '2026-02-02 06:06:08'),
(1750, 6, 'Logged Out', NULL, '::1', '2026-02-02 06:08:28'),
(1751, 1, 'Logged In', NULL, '::1', '2026-02-02 06:08:33'),
(1752, 1, 'Logged Out', NULL, '::1', '2026-02-02 06:13:16'),
(1753, 23, 'Logged In', NULL, '::1', '2026-02-02 06:13:21'),
(1754, 23, 'Logged Out', NULL, '::1', '2026-02-02 06:15:27'),
(1755, 1, 'Logged In', NULL, '::1', '2026-02-02 06:15:33'),
(1756, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 06:15:38'),
(1757, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 06:20:06'),
(1758, 1, 'Logged Out', NULL, '::1', '2026-02-02 06:22:10'),
(1759, 16, 'Logged In', NULL, '::1', '2026-02-02 06:23:47'),
(1760, 16, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 06:23:52'),
(1761, 16, 'Logged Out', NULL, '::1', '2026-02-02 06:24:54'),
(1762, 1, 'Logged In', NULL, '::1', '2026-02-02 06:25:17'),
(1763, 6, 'Logged In', NULL, '::1', '2026-02-02 06:25:28'),
(1764, 6, 'Logged Out', NULL, '::1', '2026-02-02 06:35:46'),
(1765, 1, 'Logged In', NULL, '::1', '2026-02-02 06:35:51'),
(1766, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 06:35:57'),
(1767, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 06:36:12'),
(1768, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 06:36:30'),
(1769, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 06:46:03'),
(1770, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 07:02:28'),
(1771, 1, 'Logged Out', NULL, '::1', '2026-02-02 07:02:35'),
(1772, 27, 'Logged In', NULL, '::1', '2026-02-02 07:02:46'),
(1773, 27, 'Logged Out', NULL, '::1', '2026-02-02 07:10:19'),
(1774, 1, 'Logged In', NULL, '::1', '2026-02-02 07:10:21'),
(1775, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-02 07:10:25'),
(1776, 1, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-02 07:10:30'),
(1777, 1, 'Logged Out', NULL, '::1', '2026-02-02 07:10:46'),
(1778, 23, 'Logged In', NULL, '::1', '2026-02-02 07:10:49'),
(1779, 23, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-02 07:10:54'),
(1780, 23, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-02 07:10:57'),
(1781, 23, 'Reviewed Activity Submission', 'head hr trial', '::1', '2026-02-02 07:10:57'),
(1782, 23, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-02 07:10:57'),
(1783, 23, 'Logged Out', NULL, '::1', '2026-02-02 07:11:01'),
(1784, 1, 'Logged In', NULL, '::1', '2026-02-02 07:11:06'),
(1785, 1, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-02 07:11:10'),
(1786, 1, 'Logged Out', NULL, '::1', '2026-02-02 07:11:41'),
(1787, 27, 'Logged In', NULL, '::1', '2026-02-02 07:11:45'),
(1788, 1, 'Logged Out', NULL, '::1', '2026-02-02 07:30:56'),
(1789, 27, 'Logged In', NULL, '::1', '2026-02-02 07:31:00'),
(1790, 27, 'Submitted Activity', 'Activity Title: deded', '::1', '2026-02-02 07:47:09'),
(1791, 27, 'Logged Out', NULL, '::1', '2026-02-02 07:47:16'),
(1792, 1, 'Logged In', NULL, '::1', '2026-02-02 07:47:24'),
(1793, 1, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 07:47:31'),
(1794, 1, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 07:47:37'),
(1795, 1, 'Reviewed Activity Submission', 'deded', '::1', '2026-02-02 07:47:37'),
(1796, 1, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 07:47:37'),
(1797, 1, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 07:47:56'),
(1798, 1, 'Recommended Activity Submission', 'deded', '::1', '2026-02-02 07:47:56'),
(1799, 1, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 07:47:57'),
(1800, 1, 'Logged Out', NULL, '::1', '2026-02-02 07:48:00'),
(1801, 16, 'Logged In', NULL, '::1', '2026-02-02 07:48:04'),
(1802, 16, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 07:48:11'),
(1803, 16, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 07:48:25'),
(1804, 16, 'SDS Final Approval Given', 'deded', '::1', '2026-02-02 07:48:25'),
(1805, 16, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 07:48:25'),
(1806, 16, 'Logged Out', NULL, '::1', '2026-02-02 07:48:44'),
(1807, 27, 'Viewed Specific Activity', 'deded', '::1', '2026-02-02 23:44:58'),
(1808, 27, 'Submitted Activity', 'Activity Title: Presentationn', '::1', '2026-02-02 23:59:00'),
(1809, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-02 23:59:03'),
(1810, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:03:11'),
(1811, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:04:18'),
(1812, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:04:19'),
(1813, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:12:53'),
(1814, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:23:26'),
(1815, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:23:38'),
(1816, 27, 'Viewed Specific Activity', 'deded', '::1', '2026-02-03 00:23:41'),
(1817, 27, 'Viewed Specific Activity', 'deded', '::1', '2026-02-03 00:24:29'),
(1818, 27, 'Viewed Specific Activity', 'deded', '::1', '2026-02-03 00:24:51'),
(1819, 27, 'Viewed Specific Activity', 'deded', '::1', '2026-02-03 00:25:34'),
(1820, 27, 'Viewed Specific Activity', 'deded', '::1', '2026-02-03 00:33:46'),
(1821, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:36:43'),
(1822, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:39:12'),
(1823, 27, 'Logged Out', NULL, '::1', '2026-02-03 00:39:26'),
(1824, 1, 'Logged In', NULL, '::1', '2026-02-03 00:39:29'),
(1825, 1, 'Logged Out', NULL, '::1', '2026-02-03 00:51:09'),
(1826, 1, 'Logged In', NULL, '::1', '2026-02-03 00:51:11'),
(1827, 1, 'Logged Out', NULL, '::1', '2026-02-03 00:51:15'),
(1828, 27, 'Logged In', NULL, '::1', '2026-02-03 00:51:21'),
(1829, 1, 'Logged In', NULL, '::1', '2026-02-03 00:51:37'),
(1830, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:51:44'),
(1831, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:52:04'),
(1832, 1, 'Reviewed Activity Submission', 'Presentationn', '::1', '2026-02-03 00:52:06'),
(1833, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:52:08'),
(1834, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:53:52'),
(1835, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:53:54'),
(1836, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 00:58:44'),
(1837, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 01:03:35'),
(1838, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 01:05:43'),
(1839, 1, 'Viewed Specific Activity', 'deded', '::1', '2026-02-03 01:05:55'),
(1840, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 01:06:08'),
(1841, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 01:14:21'),
(1842, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-02-03 01:14:36'),
(1843, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-02-03 01:14:42'),
(1844, 1, 'Reviewed Activity Submission', 'TACKLING GORILLA', '::1', '2026-02-03 01:14:42'),
(1845, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-02-03 01:14:42'),
(1846, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-02-03 01:15:13'),
(1847, 1, 'Recommended Activity Submission', 'TACKLING GORILLA', '::1', '2026-02-03 01:15:13'),
(1848, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-02-03 01:15:13'),
(1849, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-02-03 01:18:14'),
(1850, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-02-03 01:19:48'),
(1851, 1, 'Viewed Specific Activity', 'tryitri', '::1', '2026-02-03 01:20:00'),
(1852, 1, 'Viewed Specific Activity', 'tryitri', '::1', '2026-02-03 01:20:05'),
(1853, 1, 'Reviewed Activity Submission', 'tryitri', '::1', '2026-02-03 01:20:05'),
(1854, 1, 'Viewed Specific Activity', 'tryitri', '::1', '2026-02-03 01:20:05'),
(1855, 1, 'Viewed Specific Activity', 'tryitri', '::1', '2026-02-03 01:20:24'),
(1856, 1, 'Recommended Activity Submission', 'tryitri', '::1', '2026-02-03 01:20:24'),
(1857, 1, 'Viewed Specific Activity', 'tryitri', '::1', '2026-02-03 01:20:24'),
(1858, 1, 'Viewed Specific Activity', 'tryitri', '::1', '2026-02-03 01:29:46'),
(1859, 1, 'Viewed Specific Activity', 'tryitri', '::1', '2026-02-03 01:40:48'),
(1860, 1, 'Viewed Specific Activity', 'Capacity building on technical writing skills for non teaching personnel', '::1', '2026-02-03 01:40:57'),
(1861, 27, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-03 01:43:35'),
(1862, 27, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-03 01:48:01'),
(1863, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 01:48:10'),
(1864, 27, 'Logged Out', NULL, '::1', '2026-02-03 01:48:14'),
(1865, 27, 'Logged In', NULL, '::1', '2026-02-03 01:48:26'),
(1866, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-03 01:48:38'),
(1867, 1, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-02-03 01:48:45'),
(1868, 27, 'Logged Out', NULL, '::1', '2026-02-03 01:52:56'),
(1869, 27, 'Logged In', NULL, '::1', '2026-02-03 01:55:29'),
(1870, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 02:01:05'),
(1871, 1, 'Logged Out', NULL, '::1', '2026-02-03 02:01:17'),
(1872, 1, 'Logged In', NULL, '::1', '2026-02-03 02:01:37'),
(1873, 1, 'Logged Out', NULL, '::1', '2026-02-03 02:19:03'),
(1874, 1, 'Logged In', NULL, '::1', '2026-02-03 02:37:24'),
(1875, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 02:37:43'),
(1876, 27, 'Profile Updated', 'Personnel updated their own profile information and/or profile picture.', '::1', '2026-02-03 03:22:49'),
(1877, 1, 'Logged In', NULL, '::1', '2026-02-03 04:09:15'),
(1878, 27, 'Logged In', NULL, '::1', '2026-02-03 04:09:25'),
(1879, 27, 'Profile Updated', 'Personnel updated their own profile information and/or profile picture.', '::1', '2026-02-03 04:09:37'),
(1880, 27, 'Profile Updated', 'Personnel updated their own profile information and/or profile picture.', '::1', '2026-02-03 04:09:48'),
(1881, 27, 'Logged Out', NULL, '::1', '2026-02-03 04:34:36'),
(1882, 23, 'Logged In', NULL, '::1', '2026-02-03 04:34:41'),
(1883, 23, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 04:37:04'),
(1884, 23, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 04:57:07'),
(1885, 23, 'Logged Out', NULL, '::1', '2026-02-03 05:18:45'),
(1886, 1, 'Viewed Specific Activity', 'deded', '::1', '2026-02-03 05:19:21'),
(1887, 1, 'Viewed Specific Activity', 'Capacity building on technical writing skills for non teaching personnel', '::1', '2026-02-03 05:30:54'),
(1888, 1, 'Logged Out', NULL, '::1', '2026-02-03 05:53:52'),
(1889, 27, 'Logged In', NULL, '::1', '2026-02-03 05:54:02'),
(1890, 27, 'Profile Updated', 'Personnel updated their own profile information and/or profile picture.', '::1', '2026-02-03 05:55:05'),
(1891, 27, 'Logged In', NULL, '::1', '2026-02-03 05:55:30'),
(1892, 27, 'Logged In', NULL, '::1', '2026-02-03 05:56:56'),
(1893, 1, 'Logged In', NULL, '::1', '2026-02-03 06:01:23'),
(1894, 1, 'Logged Out', NULL, '::1', '2026-02-03 06:02:30'),
(1895, 23, 'Logged In', NULL, '::1', '2026-02-03 06:02:38'),
(1896, 23, 'Logged Out', NULL, '::1', '2026-02-03 06:02:43'),
(1897, 16, 'Logged In', NULL, '::1', '2026-02-03 06:02:47'),
(1898, 16, 'Logged Out', NULL, '::1', '2026-02-03 06:02:56'),
(1899, 1, 'Logged In', NULL, '::1', '2026-02-03 06:03:43'),
(1900, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-03 06:06:54'),
(1901, 1, 'Sent Notification', 'Recipient ID: 4', '::1', '2026-02-03 06:09:35'),
(1902, 1, 'Logged Out', NULL, '::1', '2026-02-03 06:09:38'),
(1903, 1, 'Logged In', NULL, '::1', '2026-02-03 06:09:46'),
(1904, 27, 'Logged Out', NULL, '::1', '2026-02-03 06:09:50'),
(1906, 1, 'Sent Notification', 'Recipient ID: 4', '::1', '2026-02-03 06:10:40'),
(1907, 1, 'Sent Notification', 'Recipient ID: 4', '::1', '2026-02-03 06:10:45'),
(1909, 16, 'Logged In', NULL, '::1', '2026-02-03 06:13:14'),
(1910, 16, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 06:13:18'),
(1911, 16, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-03 06:13:25'),
(1912, 16, 'Logged Out', NULL, '::1', '2026-02-03 06:13:35'),
(1913, 27, 'Logged In', NULL, '::1', '2026-02-03 06:13:48'),
(1914, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 06:14:05'),
(1915, 27, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-03 06:26:28'),
(1916, 27, 'Viewed Specific Activity', 'deded', '::1', '2026-02-03 06:26:34'),
(1917, 1, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-03 06:26:58'),
(1918, 1, 'Viewed Specific Activity', 'TACKLING GORILLA', '::1', '2026-02-03 06:27:04'),
(1919, 1, 'Viewed Specific Activity', 'PARASAAPPROVAL', '::1', '2026-02-03 06:27:11'),
(1920, 1, 'Viewed Specific Activity', 'test 8', '::1', '2026-02-03 06:27:24'),
(1921, 27, 'Logged Out', NULL, '::1', '2026-02-03 06:53:58'),
(1923, 1, 'Logged In', NULL, '::1', '2026-02-03 07:00:43'),
(1924, 27, 'Logged In', NULL, '::1', '2026-02-03 07:00:53'),
(1925, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-03 07:34:00'),
(1926, 1, 'Logged In', NULL, '::1', '2026-02-03 10:51:27'),
(1927, 27, 'Logged In', NULL, '::1', '2026-02-03 10:51:47'),
(1928, 27, 'Logged Out', NULL, '::1', '2026-02-03 10:52:58'),
(1933, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-03 11:26:02'),
(1935, 27, 'Logged In', NULL, '::1', '2026-02-03 11:26:20'),
(1936, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-03 11:26:46'),
(1937, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-03 11:26:50'),
(1938, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-03 11:26:53'),
(1939, 27, 'Logged Out', NULL, '::1', '2026-02-03 11:33:43'),
(1943, 27, 'Logged In', NULL, '::1', '2026-02-03 11:39:15'),
(1944, 1, 'Logged Out', NULL, '::1', '2026-02-03 11:59:10'),
(1945, 16, 'Logged In', NULL, '::1', '2026-02-03 11:59:14'),
(1946, 16, 'Viewed Specific Activity', 'Training on Technical Writing', '::1', '2026-02-03 11:59:19'),
(1947, 16, 'Logged Out', NULL, '::1', '2026-02-03 11:59:45'),
(1948, 1, 'Logged In', NULL, '::1', '2026-02-03 12:01:38'),
(1949, 1, 'Logged Out', NULL, '::1', '2026-02-03 12:02:02'),
(1950, 23, 'Logged In', NULL, '::1', '2026-02-03 12:02:06'),
(1951, 23, 'Logged Out', NULL, '::1', '2026-02-03 12:02:24'),
(1952, 16, 'Logged In', NULL, '::1', '2026-02-03 12:02:27'),
(1953, 16, 'Logged Out', NULL, '::1', '2026-02-03 12:03:01'),
(1954, 1, 'Logged In', NULL, '::1', '2026-02-03 12:03:12'),
(1955, 27, 'Submitted Activity', 'Activity Title: TESTALGEN1', '::1', '2026-02-03 12:06:45'),
(1956, 27, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-03 12:06:48'),
(1957, 27, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-03 12:07:52'),
(1958, 27, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-03 12:08:11'),
(1959, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-03 12:16:59'),
(1960, 1, 'Logged Out', NULL, '::1', '2026-02-03 12:17:10'),
(1961, 1, 'Logged In', NULL, '::1', '2026-02-03 23:06:49'),
(1962, 27, 'Logged In', NULL, '::1', '2026-02-03 23:07:06'),
(1963, 27, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-03 23:17:35'),
(1964, 1, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-04 00:51:49'),
(1965, 27, 'Logged Out', NULL, '::1', '2026-02-04 01:13:34'),
(1966, 6, 'Logged In', NULL, '::1', '2026-02-04 01:13:42'),
(1967, 1, 'Logged In', NULL, '::1', '2026-02-04 01:49:25'),
(1968, 1, 'Logged Out', NULL, '::1', '2026-02-04 01:50:57'),
(1969, 27, 'Logged In', NULL, '::1', '2026-02-04 01:51:06'),
(1970, 27, 'Submitted Activity', 'Activity Title: fefefed', '::1', '2026-02-04 01:51:42'),
(1971, 27, 'Logged Out', NULL, '::1', '2026-02-04 02:13:55'),
(1972, 1, 'Logged In', NULL, '::1', '2026-02-04 02:14:01'),
(1973, 27, 'Logged In', NULL, '::1', '2026-02-04 02:18:55'),
(1974, 27, 'Logged Out', NULL, '::1', '2026-02-04 02:19:04'),
(1975, 27, 'Logged In', NULL, '::1', '2026-02-04 02:19:14'),
(1976, 1, 'Logged Out', NULL, '::1', '2026-02-04 02:19:21'),
(1977, 23, 'Logged In', NULL, '::1', '2026-02-04 02:19:40'),
(1978, 23, 'Logged Out', NULL, '::1', '2026-02-04 02:20:08'),
(1979, 1, 'Logged In', NULL, '::1', '2026-02-04 02:20:12'),
(1980, 1, 'Logged Out', NULL, '::1', '2026-02-04 02:20:18'),
(1981, 23, 'Logged In', NULL, '::1', '2026-02-04 02:20:23'),
(1982, 27, 'Logged Out', NULL, '::1', '2026-02-04 02:55:38'),
(1983, 1, 'Logged In', NULL, '::1', '2026-02-04 02:55:40'),
(1984, 1, 'Logged In', NULL, '::1', '2026-02-04 02:58:14'),
(1985, 1, 'Logged In', NULL, '::1', '2026-02-04 03:09:42'),
(1986, 1, 'Logged Out', NULL, '::1', '2026-02-04 03:11:53'),
(1987, 27, 'Logged In', NULL, '::1', '2026-02-04 03:11:56'),
(1988, 27, 'Logged In', NULL, '::1', '2026-02-04 03:20:47'),
(1989, 27, 'Logged Out', NULL, '::1', '2026-02-04 03:25:20'),
(1990, 23, 'Logged In', NULL, '::1', '2026-02-04 03:25:25'),
(1991, 1, 'Logged Out', NULL, '::1', '2026-02-04 03:28:40'),
(1992, 23, 'Logged In', NULL, '::1', '2026-02-04 03:28:46'),
(1993, 23, 'Logged Out', NULL, '::1', '2026-02-04 03:28:58'),
(1994, 16, 'Logged In', NULL, '::1', '2026-02-04 03:29:01'),
(1995, 23, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 04:42:07'),
(1996, 23, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 04:42:22'),
(1997, 23, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 04:45:24'),
(1998, 23, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 04:48:33'),
(1999, 23, 'Logged Out', NULL, '::1', '2026-02-04 04:50:11'),
(2000, 1, 'Logged In', NULL, '::1', '2026-02-04 04:50:17'),
(2001, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 05:01:39'),
(2002, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-04 05:14:03'),
(2003, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 05:14:10'),
(2004, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-04 05:19:30'),
(2005, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 05:19:36'),
(2006, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 05:22:59'),
(2007, 1, 'Logged Out', NULL, '::1', '2026-02-04 05:23:21'),
(2008, 16, 'Logged In', NULL, '::1', '2026-02-04 05:23:24'),
(2009, 16, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 05:23:25'),
(2010, 16, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-04 05:23:37'),
(2011, 16, 'Logged Out', NULL, '::1', '2026-02-04 05:23:46'),
(2012, 23, 'Logged In', NULL, '::1', '2026-02-04 05:23:51'),
(2013, 23, 'Logged Out', NULL, '::1', '2026-02-04 05:24:14'),
(2014, 27, 'Logged In', NULL, '::1', '2026-02-04 05:24:22'),
(2015, 1, 'Logged In', NULL, '::1', '2026-02-04 05:24:29'),
(2016, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 05:40:14'),
(2017, 1, 'Viewed Specific Activity', 'tttttttttt', '::1', '2026-02-04 05:40:17'),
(2018, 1, 'Viewed Specific Activity', 'deded', '::1', '2026-02-04 05:40:25'),
(2019, 1, 'Viewed Specific Activity', 'tttttttttt', '::1', '2026-02-04 05:40:38'),
(2020, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 05:41:05'),
(2021, 1, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-02-04 05:41:08'),
(2022, 1, 'Viewed Specific Activity', 'BEHEADING TANK', '::1', '2026-02-04 05:41:10'),
(2023, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-04 05:46:18'),
(2024, 16, 'Logged Out', NULL, '::1', '2026-02-04 05:46:36'),
(2025, 27, 'Logged In', NULL, '::1', '2026-02-04 05:46:40'),
(2026, 27, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 06:28:31'),
(2027, 1, 'Logged In', NULL, '::1', '2026-02-04 06:46:36'),
(2028, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-04 06:46:48'),
(2029, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-04 06:51:44'),
(2030, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-04 06:51:50'),
(2031, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-04 06:52:12'),
(2032, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-04 06:52:32'),
(2033, 1, 'Sent Notification', 'Recipient ID: 27', '::1', '2026-02-04 06:55:02'),
(2034, 27, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 07:02:15'),
(2035, 27, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 07:02:24'),
(2036, 27, 'Submitted Activity', 'Activity Title: testfornew', '::1', '2026-02-04 07:14:39'),
(2037, 27, 'Logged Out', NULL, '::1', '2026-02-04 07:14:43'),
(2038, 16, 'Logged In', NULL, '::1', '2026-02-04 07:14:49'),
(2039, 16, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:14:55'),
(2040, 16, 'Reviewed Activity Submission', 'testfornew', '::1', '2026-02-04 07:14:59'),
(2041, 16, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:14:59'),
(2042, 16, 'Logged Out', NULL, '::1', '2026-02-04 07:15:16'),
(2043, 1, 'Logged In', NULL, '::1', '2026-02-04 07:15:25'),
(2044, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:15:45'),
(2045, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:20:16'),
(2046, 1, 'Recommended Activity Submission', 'testfornew', '::1', '2026-02-04 07:20:29'),
(2047, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:20:29'),
(2048, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:21:46'),
(2049, 1, 'Logged Out', NULL, '::1', '2026-02-04 07:22:25'),
(2050, 16, 'Logged In', NULL, '::1', '2026-02-04 07:22:28'),
(2051, 16, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:22:39'),
(2052, 16, 'SDS Final Approval Given', 'testfornew', '::1', '2026-02-04 07:22:48'),
(2053, 16, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:22:48'),
(2054, 16, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:23:14'),
(2055, 1, 'Logged Out', NULL, '::1', '2026-02-04 07:23:24'),
(2056, 27, 'Logged In', NULL, '::1', '2026-02-04 07:23:29'),
(2057, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:23:32'),
(2058, 27, 'Logged Out', NULL, '::1', '2026-02-04 07:23:47'),
(2059, 1, 'Logged In', NULL, '::1', '2026-02-04 07:23:58'),
(2060, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:24:01'),
(2061, 1, 'Logged Out', NULL, '::1', '2026-02-04 07:24:33'),
(2062, 27, 'Logged In', NULL, '::1', '2026-02-04 07:24:37'),
(2063, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:24:41'),
(2064, 16, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:32:19'),
(2065, 16, 'Logged Out', NULL, '::1', '2026-02-04 07:33:42'),
(2066, 1, 'Logged In', NULL, '::1', '2026-02-04 07:33:47'),
(2067, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 07:36:06'),
(2068, 27, 'Logged Out', NULL, '::1', '2026-02-04 07:37:05'),
(2072, 1, 'Logged In', NULL, '::1', '2026-02-04 07:37:51'),
(2073, 1, 'Logged Out', NULL, '::1', '2026-02-04 07:38:13'),
(2074, 26, 'Logged In', NULL, '::1', '2026-02-04 07:38:23'),
(2075, 26, 'Viewed Specific Activity', 'Reaching Mythic in MLBB 101', '::1', '2026-02-04 07:52:32'),
(2076, 1, 'Logged In', NULL, '::1', '2026-02-04 12:26:29'),
(2077, 1, 'Logged Out', NULL, '::1', '2026-02-04 12:27:03'),
(2082, 16, 'Logged In', NULL, '::1', '2026-02-04 12:27:26'),
(2086, 1, 'Logged In', NULL, '::1', '2026-02-04 12:43:34'),
(2087, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 13:06:07'),
(2088, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 13:10:31'),
(2089, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 13:16:07'),
(2090, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 13:16:12'),
(2091, 1, 'Logged Out', NULL, '::1', '2026-02-04 13:16:23'),
(2094, 1, 'Logged In', NULL, '::1', '2026-02-04 13:16:48'),
(2095, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 13:17:57'),
(2096, 1, 'Logged Out', NULL, '::1', '2026-02-04 13:22:32'),
(2100, 1, 'Logged In', NULL, '::1', '2026-02-04 13:23:05'),
(2101, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 13:23:09'),
(2102, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 13:25:05'),
(2103, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 13:25:27'),
(2104, 1, 'Logged In', NULL, '::1', '2026-02-04 23:31:23'),
(2105, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 23:37:14'),
(2106, 27, 'Logged In', NULL, '::1', '2026-02-04 23:38:18'),
(2107, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 23:38:24'),
(2108, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-04 23:38:37'),
(2109, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-04 23:39:22'),
(2110, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 23:39:42'),
(2111, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-04 23:41:39'),
(2112, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:07:32'),
(2113, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:09:20'),
(2114, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:09:55'),
(2115, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:13:40'),
(2116, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:15:47'),
(2117, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:19:25'),
(2118, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:19:43'),
(2119, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:21:50'),
(2120, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:21:57'),
(2121, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:22:52'),
(2122, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:23:08'),
(2123, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:25:42'),
(2124, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:27:12'),
(2125, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:30:07'),
(2126, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:30:10'),
(2127, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:30:21'),
(2128, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:31:34'),
(2129, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:31:46'),
(2130, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:34:29'),
(2131, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:34:40'),
(2132, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:36:25'),
(2133, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:36:54'),
(2134, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:37:30'),
(2135, 27, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:47:54'),
(2136, 27, 'Logged Out', NULL, '::1', '2026-02-05 00:48:05'),
(2138, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 00:52:59'),
(2143, 23, 'Logged In', NULL, '::1', '2026-02-05 01:12:16'),
(2144, 23, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 01:12:34'),
(2145, 23, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 01:12:50'),
(2146, 23, 'Logged Out', NULL, '::1', '2026-02-05 01:13:41'),
(2148, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-05 01:17:47'),
(2149, 1, 'Reviewed Activity Submission', 'TESTALGEN1', '::1', '2026-02-05 01:17:57'),
(2150, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-05 01:17:57'),
(2152, 23, 'Logged In', NULL, '::1', '2026-02-05 01:23:43'),
(2153, 23, 'Profile Modified by Admin', 'Profile of CEDDY BOI was updated by head_hr', '::1', '2026-02-05 01:24:08'),
(2154, 23, 'Logged Out', NULL, '::1', '2026-02-05 01:30:58'),
(2155, 27, 'Logged In', NULL, '::1', '2026-02-05 01:31:02'),
(2156, 27, 'Logged Out', NULL, '::1', '2026-02-05 01:46:51'),
(2159, 23, 'Logged In', NULL, '::1', '2026-02-05 01:47:11');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES
(2160, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-02-05 02:13:19'),
(2161, 23, 'Logged Out', NULL, '::1', '2026-02-05 02:22:13'),
(2163, 1, 'Logged Out', NULL, '::1', '2026-02-05 02:42:08'),
(2164, 23, 'Logged In', NULL, '::1', '2026-02-05 02:42:13'),
(2165, 23, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 02:53:54'),
(2166, 23, 'Viewed Specific Activity', 'deded', '::1', '2026-02-05 02:53:58'),
(2167, 23, 'Logged Out', NULL, '::1', '2026-02-05 02:54:11'),
(2168, 1, 'Logged In', NULL, '::1', '2026-02-05 02:54:18'),
(2169, 1, 'Logged Out', NULL, '::1', '2026-02-05 02:56:29'),
(2170, 23, 'Logged In', NULL, '::1', '2026-02-05 02:56:32'),
(2173, 23, 'Logged Out', NULL, '::1', '2026-02-05 04:20:49'),
(2174, 1, 'Logged In', NULL, '::1', '2026-02-05 04:21:09'),
(2175, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 04:21:17'),
(2176, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 04:25:17'),
(2177, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 04:25:19'),
(2178, 1, 'Viewed Specific Activity', 'head hr trial', '::1', '2026-02-05 04:25:27'),
(2180, 27, 'Logged In', NULL, '::1', '2026-02-05 04:25:47'),
(2181, 1, 'Viewed Specific Activity', 'tryagain', '::1', '2026-02-05 06:24:21'),
(2182, 1, 'Viewed Specific Activity', 'tryagain', '::1', '2026-02-05 06:30:20'),
(2183, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:30:30'),
(2184, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:32:40'),
(2185, 1, 'Reviewed Activity Submission', 'fefefed', '::1', '2026-02-05 06:32:45'),
(2186, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:32:45'),
(2187, 1, 'Recommended Activity Submission', 'fefefed', '::1', '2026-02-05 06:33:04'),
(2188, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:33:05'),
(2189, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:34:00'),
(2190, 1, 'Profile Updated', 'User updated their personal information and/or profile picture.', '::1', '2026-02-05 06:37:21'),
(2191, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:37:26'),
(2192, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-05 06:37:52'),
(2193, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-05 06:43:06'),
(2194, 1, 'Recommended Activity Submission', 'TESTALGEN1', '::1', '2026-02-05 06:43:16'),
(2195, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-05 06:43:16'),
(2196, 1, 'Viewed Specific Activity', 'TESTALGEN1', '::1', '2026-02-05 06:46:28'),
(2197, 1, 'Logged Out', NULL, '::1', '2026-02-05 06:46:51'),
(2198, 23, 'Logged In', NULL, '::1', '2026-02-05 06:46:58'),
(2199, 23, 'Profile Modified by Admin', 'Profile of APPROVER was updated by head_hr', '::1', '2026-02-05 06:47:15'),
(2200, 23, 'Logged Out', NULL, '::1', '2026-02-05 06:47:35'),
(2201, 1, 'Logged In', NULL, '::1', '2026-02-05 06:47:38'),
(2202, 1, 'Viewed Specific Activity', 'Presentationn', '::1', '2026-02-05 06:47:46'),
(2203, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:48:09'),
(2204, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:52:10'),
(2205, 1, 'Viewed Specific Activity', 'fefefed', '::1', '2026-02-05 06:53:55'),
(2206, 1, 'Viewed Specific Activity', 'The signatory tadadada', '::1', '2026-02-05 06:56:05'),
(2207, 1, 'Viewed Specific Activity', 'The signatory tadadada', '::1', '2026-02-05 06:59:20'),
(2208, 1, 'Viewed Specific Activity', 'The signatory tadadada', '::1', '2026-02-05 06:59:24'),
(2209, 1, 'Viewed Specific Activity', 'The signatory tadadada', '::1', '2026-02-05 07:00:50'),
(2210, 1, 'Viewed Specific Activity', 'The signatory tadadada', '::1', '2026-02-05 07:01:40'),
(2211, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 07:02:48'),
(2212, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 07:03:02'),
(2213, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 07:05:51'),
(2214, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 07:43:22'),
(2215, 27, 'Logged Out', NULL, '::1', '2026-02-05 09:20:39'),
(2216, 1, 'Logged In', NULL, '::1', '2026-02-05 09:20:41'),
(2217, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 09:20:45'),
(2218, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 09:23:06'),
(2219, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 09:23:07'),
(2220, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 09:27:41'),
(2221, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 09:28:55'),
(2222, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 09:29:23'),
(2223, 1, 'Viewed Specific Activity', 'The signatory tadadada', '::1', '2026-02-05 09:29:26'),
(2224, 1, 'Viewed Specific Activity', 'tryagain', '::1', '2026-02-05 09:29:29'),
(2225, 1, 'Viewed Specific Activity', 'related expertise', '::1', '2026-02-05 09:29:34'),
(2226, 27, 'Logged In', NULL, '::1', '2026-02-05 09:32:36'),
(2227, 1, 'Logged In', NULL, '::1', '2026-02-05 10:28:40'),
(2228, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 10:51:13'),
(2229, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 11:18:52'),
(2230, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 11:27:04'),
(2231, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 11:29:24'),
(2232, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 11:29:25'),
(2233, 1, 'Updated Activity', 'Activity ID: 62 (Admin Edit)', '::1', '2026-02-05 11:29:41'),
(2234, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 11:29:42'),
(2235, 1, 'Updated Activity', 'Activity ID: 61 (Admin Edit)', '::1', '2026-02-05 11:30:24'),
(2236, 1, 'Viewed Specific Activity', 'The signatory tadadada', '::1', '2026-02-05 11:30:24'),
(2237, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 11:30:35'),
(2238, 1, 'Viewed Specific Activity', 'trial', '::1', '2026-02-05 11:30:47'),
(2239, 1, 'Updated Activity', 'Activity ID: 62 (Admin Edit)', '::1', '2026-02-05 11:39:39'),
(2240, 1, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-02-05 11:39:40'),
(2241, 1, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-02-05 11:41:08'),
(2242, 1, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-02-05 11:51:16'),
(2243, 27, 'Logged Out', NULL, '::1', '2026-02-05 12:05:50'),
(2244, 23, 'Logged In', NULL, '::1', '2026-02-05 12:05:53'),
(2245, 23, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-02-05 12:05:56'),
(2246, 1, 'Logged In', NULL, '::1', '2026-02-07 04:14:16'),
(2247, 1, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-02-07 04:14:24'),
(2248, 1, 'Viewed Specific Activity', 'related expertise', '::1', '2026-02-07 04:14:42'),
(2249, 1, 'Updated Activity', 'Activity ID: 59 (Admin Edit)', '::1', '2026-02-07 04:14:55'),
(2250, 1, 'Viewed Specific Activity', 'related expertise', '::1', '2026-02-07 04:14:55'),
(2251, 1, 'Logged Out', NULL, '::1', '2026-02-07 04:16:21'),
(2252, 27, 'Logged In', NULL, '::1', '2026-02-07 04:16:25'),
(2253, 27, 'Logged Out', NULL, '::1', '2026-02-07 04:26:57'),
(2254, 1, 'Logged In', NULL, '::1', '2026-02-07 04:27:01'),
(2255, 1, 'Logged Out', NULL, '::1', '2026-02-07 04:27:19'),
(2258, 27, 'Logged In', NULL, '::1', '2026-02-07 04:31:21'),
(2259, 27, 'Logged Out', NULL, '::1', '2026-02-07 04:31:58'),
(2260, 1, 'Logged In', NULL, '::1', '2026-02-07 04:32:02'),
(2261, 1, 'Viewed Specific Activity', 'related expertise', '::1', '2026-02-07 04:35:03'),
(2262, 1, 'Logged Out', NULL, '::1', '2026-02-07 04:35:20'),
(2265, 27, 'Logged In', NULL, '::1', '2026-02-07 04:35:38'),
(2266, 27, 'Logged Out', NULL, '::1', '2026-02-07 04:40:45'),
(2267, 1, 'Logged In', NULL, '::1', '2026-02-07 04:40:49'),
(2268, 1, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-02-07 04:41:00'),
(2269, 1, 'Viewed Specific Activity', 'related expertise', '::1', '2026-02-07 04:49:51'),
(2270, 1, 'Viewed Specific Activity', 'related expertise', '::1', '2026-02-07 04:50:10'),
(2271, 1, 'Viewed Specific Activity', 'tryagain', '::1', '2026-02-07 04:50:31'),
(2272, 1, 'Viewed Specific Activity', 'Capacity building on technical writing skills for non teaching personnel', '::1', '2026-02-07 04:51:01'),
(2273, 1, 'Logged Out', NULL, '::1', '2026-02-07 05:39:37'),
(2274, 27, 'Logged In', NULL, '::1', '2026-02-07 05:39:41'),
(2275, 27, 'Logged Out', NULL, '::1', '2026-02-07 06:19:45'),
(2276, 23, 'Logged In', NULL, '::1', '2026-02-07 06:23:39'),
(2277, 23, 'Approved Registration', 'User ID: 29', '::1', '2026-02-07 06:24:09'),
(2280, 23, 'Logged Out', NULL, '::1', '2026-02-07 08:30:37'),
(2281, 23, 'Logged In', NULL, '::1', '2026-02-07 09:50:59'),
(2282, 23, 'Logged Out', NULL, '::1', '2026-02-07 09:56:47'),
(2283, 1, 'Logged In', NULL, '::1', '2026-02-07 11:17:01'),
(2284, 1, 'Logged Out', NULL, '::1', '2026-02-07 11:17:06'),
(2285, 23, 'Logged In', NULL, '::1', '2026-02-07 11:17:10'),
(2286, 23, 'Logged Out', NULL, '::1', '2026-02-07 11:18:27'),
(2287, 23, 'Logged In', NULL, '::1', '2026-02-07 11:27:09'),
(2288, 23, 'Approved Registration', 'User ID: 30', '::1', '2026-02-07 12:49:38'),
(2289, 23, 'Logged Out', NULL, '::1', '2026-02-07 12:49:44'),
(2295, 23, 'Logged In', NULL, '::1', '2026-02-07 13:58:33'),
(2296, 23, 'Approved Registration', 'User ID: 31', '::1', '2026-02-07 13:58:37'),
(2297, 23, 'Logged Out', NULL, '::1', '2026-02-07 13:58:39'),
(2310, 23, 'Logged In', NULL, '::1', '2026-02-08 23:48:44'),
(2311, 23, 'Approved Registration', 'User ID: 32', '::1', '2026-02-08 23:49:02'),
(2312, 23, 'Logged Out', NULL, '::1', '2026-02-08 23:49:07'),
(2315, 23, 'Logged In', NULL, '::1', '2026-02-08 23:54:49'),
(2316, 23, 'Logged Out', NULL, '::1', '2026-02-09 00:01:06'),
(2317, 23, 'Logged In', NULL, '::1', '2026-02-09 01:34:24'),
(2318, 23, 'Logged Out', NULL, '::1', '2026-02-09 01:40:51'),
(2319, 23, 'Logged In', NULL, '::1', '2026-02-09 01:41:30'),
(2320, 23, 'Logged Out', NULL, '::1', '2026-02-09 01:46:41'),
(2321, 23, 'Logged In', NULL, '::1', '2026-02-09 01:47:30'),
(2322, 23, 'Approved Registration', 'User ID: 33', '::1', '2026-02-09 01:50:11'),
(2323, 23, 'Logged Out', NULL, '::1', '2026-02-09 01:50:16'),
(2328, 23, 'Logged In', NULL, '::1', '2026-02-09 02:08:39'),
(2329, 23, 'Approved Registration', 'User ID: 34', '::1', '2026-02-09 02:08:44'),
(2330, 23, 'Logged Out', NULL, '::1', '2026-02-09 02:08:46'),
(2331, 34, 'Logged In', NULL, '::1', '2026-02-09 02:13:23'),
(2332, 34, 'Logged Out', NULL, '::1', '2026-02-09 02:19:18'),
(2333, 34, 'Logged In', NULL, '::1', '2026-02-09 02:19:51'),
(2334, 34, 'Logged Out', NULL, '::1', '2026-02-09 02:45:13'),
(2335, 34, 'Logged In', NULL, '::1', '2026-02-09 02:45:17'),
(2336, 34, 'Logged Out', NULL, '::1', '2026-02-09 02:51:56'),
(2337, 34, 'Logged In', NULL, '::1', '2026-02-09 02:52:00'),
(2338, 34, 'Logged Out', NULL, '::1', '2026-02-09 02:58:42'),
(2339, 34, 'Logged In', NULL, '::1', '2026-02-09 02:58:46'),
(2340, 34, 'Logged Out', NULL, '::1', '2026-02-09 03:04:03'),
(2341, 34, 'Logged In', NULL, '::1', '2026-02-09 03:08:31'),
(2342, 34, 'Logged Out', NULL, '::1', '2026-02-09 04:18:17'),
(2343, 23, 'Logged In', NULL, '::1', '2026-02-09 04:23:24'),
(2344, 23, 'Logged Out', NULL, '::1', '2026-02-09 04:23:53'),
(2345, 6, 'Logged In', NULL, '::1', '2026-02-09 04:45:39'),
(2346, 6, 'Profile Modified by Admin', 'Profile of algen was updated by super_admin', '::1', '2026-02-09 04:46:33'),
(2347, 6, 'Logged Out', NULL, '::1', '2026-02-09 04:46:35'),
(2348, 27, 'Logged In', NULL, '::1', '2026-02-09 04:46:48'),
(2349, 27, 'Logged Out', NULL, '::1', '2026-02-09 04:46:54'),
(2350, 6, 'Logged In', NULL, '::1', '2026-02-09 04:52:02'),
(2351, 6, 'Profile Modified by Admin', 'Profile of algen was updated by super_admin', '::1', '2026-02-09 04:52:15'),
(2352, 6, 'Logged Out', NULL, '::1', '2026-02-09 04:52:17'),
(2353, 27, 'Logged In', NULL, '::1', '2026-02-09 04:52:30'),
(2354, 27, 'Logged Out', NULL, '::1', '2026-02-09 04:52:33'),
(2355, 6, 'Logged In', NULL, '::1', '2026-02-09 04:53:50'),
(2356, 6, 'Profile Modified by Admin', 'Profile of HEAD HR was updated by super_admin', '::1', '2026-02-09 04:54:23'),
(2357, 6, 'Logged Out', NULL, '::1', '2026-02-09 04:54:40'),
(2358, 23, 'Logged In', NULL, '::1', '2026-02-09 04:54:55'),
(2359, 23, 'Logged Out', NULL, '::1', '2026-02-09 05:01:46'),
(2360, 6, 'Logged In', NULL, '::1', '2026-02-09 05:05:05'),
(2361, 6, 'Profile Modified by Admin', 'Profile of milio was updated by super_admin', '::1', '2026-02-09 05:05:54'),
(2362, 6, 'Logged Out', NULL, '::1', '2026-02-09 05:06:07'),
(2363, 34, 'Logged In', NULL, '::1', '2026-02-09 05:06:48'),
(2364, 34, 'Logged Out', NULL, '::1', '2026-02-09 05:09:17'),
(2365, 34, 'Logged In', NULL, '::1', '2026-02-09 07:25:31'),
(2366, 34, 'Logged Out', NULL, '::1', '2026-02-09 07:25:34'),
(2367, 27, 'Logged In', NULL, '::1', '2026-02-09 07:31:20'),
(2368, 27, 'Logged Out', NULL, '::1', '2026-02-09 07:31:22'),
(2369, 6, 'Logged In', NULL, '::1', '2026-02-09 07:52:36'),
(2370, 6, 'Logged Out', NULL, '::1', '2026-02-09 10:55:06'),
(2371, 6, 'Logged In', NULL, '::1', '2026-02-09 10:55:26'),
(2372, 6, 'Logged In', NULL, '::1', '2026-02-09 23:06:22'),
(2373, 6, 'Profile Modified by Admin', 'Profile of Katarina was updated by super_admin', '::1', '2026-02-09 23:06:59'),
(2374, 6, 'Logged Out', NULL, '::1', '2026-02-09 23:09:15'),
(2375, 6, 'Logged In', NULL, '::1', '2026-02-09 23:40:28'),
(2376, 6, 'Logged Out', NULL, '::1', '2026-02-09 23:40:50'),
(2377, 35, 'Logged In', NULL, '::1', '2026-02-10 00:27:12'),
(2378, 35, 'Logged Out', NULL, '::1', '2026-02-10 00:27:45'),
(2379, 6, 'Logged In', NULL, '::1', '2026-02-10 00:29:13'),
(2380, 6, 'Logged Out', NULL, '::1', '2026-02-10 00:35:06'),
(2381, 6, 'Logged In', NULL, '::1', '2026-02-10 00:35:15'),
(2382, 6, 'Logged Out', NULL, '::1', '2026-02-10 00:35:28'),
(2383, 23, 'Logged In', NULL, '::1', '2026-02-10 00:37:44'),
(2384, 6, 'Logged In', NULL, '::1', '2026-02-10 01:04:49'),
(2385, 6, 'Logged Out', NULL, '::1', '2026-02-10 01:05:03'),
(2386, 23, 'Logged Out', NULL, '::1', '2026-02-10 01:06:07'),
(2387, 6, 'Logged In', NULL, '::1', '2026-02-10 01:06:14'),
(2388, 6, 'Logged Out', NULL, '::1', '2026-02-10 01:33:31'),
(2389, 23, 'Logged In', NULL, '::1', '2026-02-10 01:33:44'),
(2390, 23, 'Logged Out', NULL, '::1', '2026-02-10 02:13:11'),
(2391, 6, 'Logged In', NULL, '::1', '2026-02-10 05:37:05'),
(2392, 23, 'Logged In', NULL, '::1', '2026-02-12 05:29:20'),
(2393, 23, 'Logged Out', NULL, '::1', '2026-02-12 05:29:25'),
(2394, 23, 'Logged In', NULL, '::1', '2026-02-12 05:29:31'),
(2395, 23, 'Logged Out', NULL, '::1', '2026-02-12 05:29:33'),
(2397, 6, 'Logged In', NULL, '::1', '2026-02-13 03:28:19'),
(2398, 6, 'Logged In', NULL, '::1', '2026-02-13 03:28:53'),
(2399, 6, 'Logged Out', NULL, '::1', '2026-02-13 03:29:37'),
(2400, 23, 'Logged In', NULL, '::1', '2026-02-13 03:29:48'),
(2401, 23, 'Logged Out', NULL, '::1', '2026-02-13 03:29:54'),
(2402, 6, 'Logged In', NULL, '::1', '2026-02-18 04:59:55'),
(2403, 6, 'Viewed Specific Activity', 'sssss', '::1', '2026-02-18 05:02:27'),
(2404, 6, 'Viewed Specific Activity', 'The signatory tadadada', '::1', '2026-02-18 05:03:03'),
(2405, 6, 'Logged Out', NULL, '::1', '2026-02-18 05:16:25'),
(2406, 6, 'Logged In', NULL, '::1', '2026-02-19 06:02:44'),
(2407, 6, 'Logged Out', NULL, '::1', '2026-02-19 06:02:48'),
(2408, 6, 'Logged In', NULL, '::1', '2026-02-19 06:03:01'),
(2409, 6, 'Logged Out', NULL, '::1', '2026-02-19 06:03:31'),
(2410, 23, 'Logged In', NULL, '::1', '2026-02-19 06:03:37'),
(2411, 23, 'Viewed Specific Activity', 'sssss', '::1', '2026-02-19 06:03:41'),
(2412, 23, 'Reviewed Activity Submission', 'sssss', '::1', '2026-02-19 06:03:44'),
(2413, 23, 'Viewed Specific Activity', 'sssss', '::1', '2026-02-19 06:03:44'),
(2414, 6, 'Logged In', NULL, '::1', '2026-02-23 00:26:36'),
(2415, 6, 'Logged Out', NULL, '::1', '2026-02-23 00:27:04'),
(2416, 6, 'Logged In', NULL, '::1', '2026-02-23 00:27:56'),
(2417, 6, 'Logged Out', NULL, '::1', '2026-02-23 00:28:25'),
(2418, 6, 'Logged In', NULL, '::1', '2026-02-23 00:28:50'),
(2419, 6, 'Created User (Super Admin)', 'Created new user: BOB', '::1', '2026-02-23 00:32:20'),
(2420, 6, 'Logged In', NULL, '::1', '2026-04-01 09:40:33'),
(2421, 6, 'Logged In', NULL, '::1', '2026-04-03 11:02:21'),
(2422, 6, 'Logged In', NULL, '::1', '2026-04-04 12:47:35'),
(2423, 6, 'Logged Out', NULL, '::1', '2026-04-04 12:52:24'),
(2424, 6, 'Logged In', NULL, '::1', '2026-04-04 12:52:46'),
(2425, 6, 'Profile Modified by Admin', 'Profile of HDR was updated by super_admin', '::1', '2026-04-04 13:06:17'),
(2426, 6, 'Logged Out', NULL, '::1', '2026-04-04 13:06:20'),
(2427, 23, 'Logged In', NULL, '::1', '2026-04-04 13:06:24'),
(2428, 23, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-04 13:06:50'),
(2429, 23, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-04 13:07:45'),
(2430, 23, 'Recommended Activity Submission', 'sssss', '::1', '2026-04-04 13:07:58'),
(2431, 23, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-04 13:07:58'),
(2432, 6, 'Logged In', NULL, '::1', '2026-04-04 13:15:23'),
(2433, 6, 'Profile Modified by Admin', 'Profile of Immediate Head was updated by super_admin', '::1', '2026-04-04 13:19:57'),
(2434, 23, 'Profile Updated', 'User updated their personal information and/or profile picture.', '::1', '2026-04-04 13:22:50'),
(2435, 6, 'Profile Modified by Admin', 'Profile of HDR was updated by super_admin', '::1', '2026-04-04 13:23:36'),
(2436, 23, 'Logged Out', NULL, '::1', '2026-04-04 13:39:57'),
(2437, 6, 'Profile Modified by Admin', 'Profile of System Admin was updated by super_admin', '::1', '2026-04-04 13:51:13'),
(2438, 6, 'Logged Out', NULL, '::1', '2026-04-04 13:51:17'),
(2439, 1, 'Logged In', NULL, '::1', '2026-04-04 13:51:29'),
(2440, 1, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-04 13:51:36'),
(2441, 1, 'Logged Out', NULL, '::1', '2026-04-04 13:51:44'),
(2442, 6, 'Logged In', NULL, '::1', '2026-04-04 13:52:09'),
(2443, 6, 'Logged Out', NULL, '::1', '2026-04-04 13:52:13'),
(2444, 6, 'Logged In', NULL, '::1', '2026-04-04 13:52:21'),
(2445, 6, 'Logged Out', NULL, '::1', '2026-04-04 13:52:27'),
(2446, 23, 'Logged In', NULL, '::1', '2026-04-04 13:52:41'),
(2447, 23, 'Deleted User', 'User ID: 29 removed.', '::1', '2026-04-04 14:01:51'),
(2448, 23, 'Deleted User', 'User ID: 31 removed.', '::1', '2026-04-04 14:03:22'),
(2449, 23, 'Deleted User', 'User ID: 33 removed.', '::1', '2026-04-04 14:04:33'),
(2450, 23, 'Deleted User', 'User ID: 30 removed.', '::1', '2026-04-04 14:04:49'),
(2451, 23, 'Deleted User', 'User ID: 36 removed.', '::1', '2026-04-04 14:04:54'),
(2452, 23, 'Deleted User', 'User ID: 13 removed.', '::1', '2026-04-04 14:05:00'),
(2453, 23, 'Deleted User', 'User ID: 10 removed.', '::1', '2026-04-04 14:05:04'),
(2454, 23, 'Deleted User', 'User ID: 25 removed.', '::1', '2026-04-04 14:05:09'),
(2455, 23, 'Deleted User', 'User ID: 4 removed.', '::1', '2026-04-04 14:05:12'),
(2456, 23, 'Deleted User', 'User ID: 18 removed.', '::1', '2026-04-04 14:05:17'),
(2457, 23, 'Deleted User', 'User ID: 24 removed.', '::1', '2026-04-04 14:05:24'),
(2458, 6, 'Logged In', NULL, '::1', '2026-04-04 14:09:06'),
(2459, 23, 'Logged Out', NULL, '::1', '2026-04-04 14:09:09'),
(2460, 23, 'Logged In', NULL, '::1', '2026-04-04 14:09:14'),
(2461, 23, 'Profile Modified by Admin', 'Profile of TESTUSER was updated by head_hr', '::1', '2026-04-04 14:09:43'),
(2462, 23, 'Logged Out', NULL, '::1', '2026-04-04 14:09:47'),
(2463, 34, 'Logged In', NULL, '::1', '2026-04-04 14:09:52'),
(2464, 34, 'Logged Out', NULL, '::1', '2026-04-04 14:21:01'),
(2465, 6, 'Profile Modified by Admin', 'Profile of Immediate Head was updated by super_admin', '::1', '2026-04-04 14:21:29'),
(2466, 16, 'Logged In', NULL, '::1', '2026-04-04 14:22:07'),
(2467, 16, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-04 14:23:01'),
(2468, 16, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-04 14:25:22'),
(2469, 16, 'Logged Out', NULL, '::1', '2026-04-04 14:32:59'),
(2470, 23, 'Logged In', NULL, '::1', '2026-04-04 14:33:08'),
(2471, 23, 'Logged Out', NULL, '::1', '2026-04-04 14:33:13'),
(2472, 16, 'Logged In', NULL, '::1', '2026-04-04 14:33:36'),
(2473, 16, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-04 14:42:55'),
(2474, 16, 'Logged Out', NULL, '::1', '2026-04-04 14:49:39'),
(2475, 34, 'Logged In', NULL, '::1', '2026-04-04 14:49:43'),
(2476, 34, 'Logged Out', NULL, '::1', '2026-04-04 14:51:03'),
(2477, 16, 'Logged In', NULL, '::1', '2026-04-04 14:51:13'),
(2478, 16, 'Logged Out', NULL, '::1', '2026-04-04 14:57:41'),
(2479, 23, 'Logged In', NULL, '::1', '2026-04-04 14:57:45'),
(2480, 23, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-04 15:04:16'),
(2481, 23, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-04-04 15:04:19'),
(2482, 23, 'Reviewed Activity Submission', 'tirallumay', '::1', '2026-04-04 15:05:16'),
(2483, 23, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-04-04 15:05:17'),
(2484, 6, 'Logged In', NULL, '::1', '2026-04-05 10:02:02'),
(2485, 6, 'Logged In', NULL, '::1', '2026-04-06 04:02:35'),
(2486, 6, 'Logged In', NULL, '::1', '2026-04-06 04:36:51'),
(2487, 6, 'Logged In', NULL, '::1', '2026-04-10 01:32:07'),
(2488, 6, 'Logged Out', NULL, '::1', '2026-04-10 01:32:33'),
(2489, 34, 'Logged In', NULL, '::1', '2026-04-10 01:32:39'),
(2490, 6, 'Logged In', NULL, '::1', '2026-04-10 01:50:39'),
(2491, 6, 'Logged Out', NULL, '::1', '2026-04-10 01:50:48'),
(2492, 1, 'Logged In', NULL, '::1', '2026-04-10 01:50:52'),
(2493, 1, 'Viewed Specific Activity', 'sssss', '::1', '2026-04-10 01:51:10'),
(2494, 1, 'Viewed Specific Activity', 'tirallumay', '::1', '2026-04-10 01:51:14'),
(2495, 1, 'Viewed Specific Activity', 'tryagain', '::1', '2026-04-10 01:51:22'),
(2496, 1, 'Viewed Specific Activity', 'related expertise', '::1', '2026-04-10 01:51:26'),
(2497, 1, 'Viewed Specific Activity', 'testfornew', '::1', '2026-04-10 01:52:03'),
(2498, 34, 'Submitted New Activity', 'Activity ID: 64 - TEST TEST 1', '::1', '2026-04-10 01:54:03'),
(2499, 34, 'Submitted New Activity', 'Activity ID: 65 - TEST 2 TEST 2', '::1', '2026-04-10 02:00:23'),
(2500, 1, 'Viewed Specific Activity', 'TEST 2 TEST 2', '::1', '2026-04-10 02:37:15'),
(2501, 1, 'Reviewed Activity Submission', 'TEST 2 TEST 2', '::1', '2026-04-10 02:37:23'),
(2502, 1, 'Viewed Specific Activity', 'TEST 2 TEST 2', '::1', '2026-04-10 02:37:23'),
(2503, 34, 'Updated Activity', 'Activity ID: 65 - TEST 2 TEST 2', '::1', '2026-04-10 02:41:50'),
(2504, 1, 'Viewed Specific Activity', 'TEST 2 TEST 2', '::1', '2026-04-10 02:57:49'),
(2505, 34, 'Submitted New Activity', 'Activity ID: 66 - test 3 test 3 test 3', '::1', '2026-04-10 03:23:58'),
(2506, 1, 'Viewed Specific Activity', 'test 3 test 3 test 3', '::1', '2026-04-10 03:24:25'),
(2507, 1, 'Reviewed Activity Submission', 'test 3 test 3 test 3', '::1', '2026-04-10 03:24:28'),
(2508, 1, 'Viewed Specific Activity', 'test 3 test 3 test 3', '::1', '2026-04-10 03:24:28'),
(2509, 34, 'Updated Activity', 'Activity ID: 66 - test 3 test 3 test 3', '::1', '2026-04-10 03:24:51'),
(2510, 1, 'Viewed Specific Activity', 'test 3 test 3 test 3', '::1', '2026-04-10 03:38:51'),
(2511, 1, 'Viewed Specific Activity', 'test 3 test 3 test 3', '::1', '2026-04-10 03:38:58'),
(2512, 1, 'Viewed Specific Activity', 'test 3 test 3 test 3', '::1', '2026-04-10 03:46:44'),
(2513, 1, 'Viewed Specific Activity', 'test 3 test 3 test 3', '::1', '2026-04-10 04:54:25'),
(2514, 34, 'Updated Workplace Application Plan', 'Activity ID: 64 - TEST TEST 1', '::1', '2026-04-10 05:45:19'),
(2515, 34, 'Updated Workplace Application Plan', 'Activity ID: 64 - TEST TEST 1', '::1', '2026-04-10 05:45:49'),
(2516, 23, 'Logged In', NULL, '::1', '2026-04-13 01:59:33'),
(2517, 34, 'Logged In', NULL, '::1', '2026-04-13 02:00:11'),
(2518, 23, 'Viewed Specific Activity', 'test 3 test 3 test 3', '::1', '2026-04-13 02:04:14'),
(2519, 34, 'Submitted New Activity', 'Tracking No: LDPVUY-202604-004 - test 5', '::1', '2026-04-13 02:06:03'),
(2520, 23, 'Viewed Specific Activity', 'test 3 test 3 test 3', '::1', '2026-04-13 02:11:27'),
(2521, 23, 'Viewed Specific Activity', 'test 5', '::1', '2026-04-13 02:11:48'),
(2522, 23, 'Viewed Specific Activity', 'test 5', '::1', '2026-04-13 02:15:06'),
(2523, 23, 'Viewed Specific Activity', 'test 5', '::1', '2026-04-13 02:37:17'),
(2524, 23, 'Viewed Specific Activity', 'test 5', '::1', '2026-04-13 02:48:12'),
(2525, 23, 'Viewed Specific Activity', 'test 5', '::1', '2026-04-13 02:56:27'),
(2526, 23, 'Reviewed Activity Submission', 'test 5', '::1', '2026-04-13 02:58:46'),
(2527, 23, 'Viewed Specific Activity', 'test 5', '::1', '2026-04-13 02:58:46'),
(2528, 23, 'Viewed Specific Activity', 'test 5', '::1', '2026-04-13 04:27:17'),
(2529, 23, 'Viewed Specific Activity', 'TEST TEST 1', '::1', '2026-04-13 04:33:48'),
(2530, 23, 'Viewed Specific Activity', 'TEST TEST 1', '::1', '2026-04-13 04:44:31'),
(2531, 23, 'Viewed Specific Activity', 'TEST TEST 1', '::1', '2026-04-13 04:49:32'),
(2532, 23, 'Viewed Specific Activity', 'TEST TEST 1', '::1', '2026-04-13 05:01:45'),
(2533, 34, 'Submitted New Activity', 'Tracking No: LDPA5W-202604-005 - Test 6', '::1', '2026-04-13 05:12:44'),
(2534, 6, 'Logged In', NULL, '::1', '2026-04-13 06:09:16'),
(2535, 23, 'Logged In', NULL, '::1', '2026-04-14 03:57:49'),
(2536, 23, 'Logged Out', NULL, '::1', '2026-04-14 03:57:54'),
(2537, 34, 'Logged In', NULL, '::1', '2026-04-14 03:59:01'),
(2538, 23, 'Logged In', NULL, '::1', '2026-04-14 05:08:03'),
(2539, 23, 'Logged Out', NULL, '::1', '2026-04-14 05:08:05'),
(2540, 34, 'Logged In', NULL, '::1', '2026-04-14 05:08:11'),
(2541, 23, 'Logged In', NULL, '::1', '2026-04-15 23:54:07'),
(2542, 23, 'Profile Updated', 'User updated their personal information and/or profile picture.', '::1', '2026-04-15 23:58:03'),
(2543, 34, 'Logged In', NULL, '::1', '2026-04-16 00:48:49'),
(2544, 6, 'Logged In', NULL, '::1', '2026-04-20 22:40:39'),
(2545, 6, 'Created User (Super Admin)', 'Created new user: aries (aries@deped.gov.ph)', '::1', '2026-04-20 22:42:20'),
(2546, 6, 'Logged Out', NULL, '::1', '2026-04-20 22:42:24'),
(2547, 37, 'Logged In', NULL, '::1', '2026-04-20 22:42:38'),
(2548, 37, 'Logged Out', NULL, '::1', '2026-04-20 23:57:11'),
(2549, 34, 'Logged In', NULL, '::1', '2026-04-22 23:51:19'),
(2550, 34, 'Logged In', NULL, '::1', '2026-04-24 07:13:47'),
(2551, 23, 'Logged In', NULL, '::1', '2026-04-28 05:06:19'),
(2552, 23, 'Logged Out', NULL, '::1', '2026-04-28 05:06:37'),
(2553, 34, 'Logged In', NULL, '::1', '2026-04-28 05:34:11'),
(2554, 6, 'Logged In', NULL, '::1', '2026-04-28 05:56:55'),
(2555, 34, 'Submitted New Activity', 'Tracking No: ELDPTQ8-202604-006 - testingthenewfeatures', '::1', '2026-04-28 06:44:42'),
(2556, 6, 'Logged Out', NULL, '::1', '2026-04-28 07:43:16'),
(2557, 23, 'Logged In', NULL, '::1', '2026-04-28 07:43:33'),
(2558, 23, 'Logged Out', NULL, '::1', '2026-04-28 07:51:57'),
(2559, 6, 'Logged In', NULL, '::1', '2026-04-28 07:52:04'),
(2560, 34, 'Logged Out', NULL, '::1', '2026-04-28 07:56:13'),
(2561, 6, 'Logged In', NULL, '192.168.11.1', '2026-04-28 13:35:10'),
(2562, 6, 'Logged In', NULL, '192.168.9.100', '2026-04-29 00:59:56'),
(2563, 6, 'Deleted User', 'User ID: 32 removed.', '192.168.9.100', '2026-04-29 01:00:41'),
(2564, 38, 'Profile Created', 'New account registered and verified via email: ceededom@gmail.com', '192.168.9.237', '2026-04-29 01:04:53'),
(2565, 38, 'Logged In', NULL, '192.168.9.237', '2026-04-29 01:05:21'),
(2566, 38, 'Logged Out', NULL, '192.168.9.237', '2026-04-29 01:07:59'),
(2567, 38, 'Logged In', NULL, '192.168.9.237', '2026-04-29 01:27:26'),
(2568, 38, 'Logged Out', NULL, '192.168.9.237', '2026-04-29 01:27:52'),
(2569, 6, 'Logged In', NULL, '192.168.10.251', '2026-04-29 01:34:59'),
(2570, 38, 'Logged In', NULL, '192.168.9.237', '2026-04-29 01:35:13'),
(2571, 38, 'Logged Out', NULL, '192.168.9.237', '2026-04-29 01:35:57'),
(2572, 38, 'Logged In', NULL, '192.168.9.237', '2026-04-29 01:41:43'),
(2573, 23, 'Logged In', NULL, '192.168.9.249', '2026-04-29 01:52:14'),
(2574, 23, 'Logged Out', NULL, '192.168.9.249', '2026-04-29 01:52:23'),
(2575, 23, 'Logged In', NULL, '192.168.9.249', '2026-04-29 01:53:04'),
(2576, 6, 'Logged In', NULL, '192.168.10.251', '2026-04-29 01:54:15'),
(2577, 6, 'Created User (Super Admin)', 'Created new user: Normal User (user@gmail.com)', '192.168.10.251', '2026-04-29 01:55:28'),
(2578, 6, 'Logged Out', NULL, '192.168.10.251', '2026-04-29 01:55:40'),
(2579, 6, 'Logged In', NULL, '192.168.10.251', '2026-04-29 01:56:12'),
(2580, 6, 'Profile Modified by Admin', 'Profile of Normal User was updated by super_admin', '192.168.10.251', '2026-04-29 01:56:35'),
(2581, 6, 'Logged Out', NULL, '192.168.10.251', '2026-04-29 01:56:40'),
(2582, 39, 'Logged In', NULL, '192.168.10.251', '2026-04-29 01:56:49'),
(2583, 39, 'Logged In', NULL, '192.168.9.245', '2026-04-29 02:09:36'),
(2584, 39, 'Logged Out', NULL, '192.168.9.245', '2026-04-29 02:10:08'),
(2585, 6, 'Logged In', NULL, '192.168.11.1', '2026-05-08 04:23:42'),
(2586, 6, 'Logged Out', NULL, '192.168.11.1', '2026-05-08 04:24:35'),
(2587, 40, 'Profile Created', 'New account registered and verified via email: lykajane.leosala@deped.gov.ph', '192.168.9.183', '2026-05-21 07:21:24'),
(2588, 40, 'Logged In', NULL, '192.168.9.183', '2026-05-21 07:21:43'),
(2589, 40, 'Profile Updated', 'User updated their personal information and/or profile picture.', '192.168.9.183', '2026-05-21 07:23:16'),
(2590, 40, 'Logged In', NULL, '192.168.8.133', '2026-06-09 04:05:11'),
(2591, 2, 'Logged In', NULL, '::1', '2026-06-09 04:44:22'),
(2592, 2, 'Profile Modified by Admin', 'Profile of algen was updated by super_admin', '::1', '2026-06-09 04:44:56'),
(2593, 27, 'Logged In', NULL, '::1', '2026-06-09 04:45:14'),
(2594, 2, 'Logged In', NULL, '::1', '2026-06-09 04:46:13'),
(2595, 2, 'Logged Out', NULL, '::1', '2026-06-09 04:54:16'),
(2596, 27, 'Logged In', NULL, '::1', '2026-06-09 04:54:29'),
(2597, 2, 'Logged In', NULL, '::1', '2026-06-09 04:57:35'),
(2598, 2, 'Logged In', NULL, '::1', '2026-06-09 07:43:43'),
(2599, 39, 'Logged In', NULL, '::1', '2026-06-09 08:09:42'),
(2600, 6, 'Logged In', NULL, '::1', '2026-06-09 09:01:47'),
(2601, 6, 'Logged Out', NULL, '::1', '2026-06-09 09:19:31'),
(2602, 39, 'Logged In', NULL, '::1', '2026-06-09 09:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `classifications`
--

CREATE TABLE `classifications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classifications`
--

INSERT INTO `classifications` (`id`, `name`) VALUES
(4, 'Indigenous Peoples (IPs)'),
(6, 'Not Applicable'),
(1, 'Persons with Disability (PWD)'),
(3, 'Senior Citizen'),
(2, 'Solo Parent'),
(7, 'testclassficiation');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `status` varchar(50) DEFAULT 'Attended'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event_name`, `event_date`, `status`) VALUES
(1, 1, 'Python Workshop', '2023-10-15', 'Attended'),
(2, 1, 'Agile Leadership', '2023-11-05', 'Attended'),
(3, 1, 'Cybersecurity Basics', '2023-12-12', 'Completed'),
(4, 1, 'Data Science Intro', '2024-01-20', 'Registered');

-- --------------------------------------------------------

--
-- Table structure for table `job_embedded_learning`
--

CREATE TABLE `job_embedded_learning` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_embedded_learning`
--

INSERT INTO `job_embedded_learning` (`id`, `name`) VALUES
(1, 'TRIALJEL');

-- --------------------------------------------------------

--
-- Table structure for table `job_embedded_learnings`
--

CREATE TABLE `job_embedded_learnings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ld_activities`
--

CREATE TABLE `ld_activities` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `training_code` varchar(100) DEFAULT NULL,
  `date_attended` text DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `modality` varchar(100) DEFAULT NULL,
  `competency` varchar(255) DEFAULT NULL,
  `classification` varchar(255) DEFAULT '',
  `type_ld` varchar(100) DEFAULT NULL,
  `type_ld_others` varchar(255) DEFAULT NULL,
  `job_embedded_learning` varchar(255) DEFAULT NULL,
  `conducted_by` varchar(255) DEFAULT NULL,
  `organizer_signature_path` varchar(255) DEFAULT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `workplace_application` text DEFAULT NULL,
  `workplace_image_path` longtext DEFAULT NULL,
  `reflection` text DEFAULT NULL,
  `application_learning` text DEFAULT NULL,
  `application_file_path` varchar(255) DEFAULT NULL,
  `rating_period` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `signature_path` varchar(255) DEFAULT NULL,
  `certificate_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reviewed_by_supervisor` tinyint(1) DEFAULT 0,
  `recommending_asds` tinyint(1) DEFAULT 0,
  `approved_sds` tinyint(1) DEFAULT 0,
  `reviewed_at` datetime DEFAULT NULL,
  `recommended_at` datetime DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `completion_report_path` longtext DEFAULT NULL,
  `certificate_utilization_path` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ld_activities`
--

INSERT INTO `ld_activities` (`id`, `tracking_number`, `user_id`, `title`, `training_code`, `date_attended`, `venue`, `modality`, `competency`, `classification`, `type_ld`, `type_ld_others`, `job_embedded_learning`, `conducted_by`, `organizer_signature_path`, `approved_by`, `workplace_application`, `workplace_image_path`, `reflection`, `application_learning`, `application_file_path`, `rating_period`, `status`, `signature_path`, `certificate_path`, `created_at`, `reviewed_by_supervisor`, `recommending_asds`, `approved_sds`, `reviewed_at`, `recommended_at`, `approved_at`, `completion_report_path`, `certificate_utilization_path`) VALUES
(1, 'LDPTUN-202601-001', 1, 'Advanced Project Management', NULL, '2023-11-20', 'Manila Conference Center', 'Formal Training', 'Leadership', '', 'Managerial', NULL, NULL, 'PMI Philippines', NULL, 'Director Smith', NULL, NULL, NULL, NULL, NULL, NULL, 'Viewed', NULL, NULL, '2026-01-06 05:46:51', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'LDPE9T-202601-002', 1, 'Web Security Fundamentals', NULL, '2023-12-05', 'Online Zoom', 'Job-Embedded Learning', 'Technical Skills', '', 'Technical', NULL, NULL, 'CyberSec Inc', NULL, 'IT Head Jones', NULL, NULL, NULL, NULL, NULL, NULL, 'Approved', NULL, NULL, '2026-01-06 05:46:51', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(46, 'LDP2WF-202601-003', 1, 'tryout', NULL, '2026-01-27, 2026-01-28, 2026-01-30', 'SDO', 'Job-Embedded Learning', 'sociallfe', '', 'Others', 'Iba by ba', NULL, 'Show', 'uploads/signatures/6976a9041b7f5_org_signature.png', NULL, '', '[\"uploads\\/workplace\\/6976a9041bf4f_work_Leave_Form6_Brotota13.docx\"]', 'TRY OUT', NULL, NULL, 'Not Set', 'Viewed', NULL, NULL, '2026-01-25 23:36:36', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(50, 'LDPE4N-202601-004', 26, 'Reaching Mythic in MLBB 101', NULL, '2026-01-30', 'MLBB Malayanasia', 'Formal Training', 'Mythic', '', 'Technical', '', NULL, 'Ced S. Ahur', 'uploads/signatures/697aeb03b1a18_org_signature.png', NULL, '', '[\"uploads\\/workplace\\/697aeb03b2088_work_Thisitemisunavailable-Etsy.jpg\"]', 'I have this thing where I get older but just never wiser\r\nMidnights become my afternoons\r\nWhen my depression works the graveyard shift\r\nAll of the people I\'ve ghosted stand there in the room', NULL, NULL, '2026', 'Viewed', NULL, 'uploads/certificates/697aeb481c327_cert_50.jpg', '2026-01-29 05:07:15', 1, 1, 0, '2026-01-29 13:09:17', '2026-01-29 13:11:14', NULL, NULL, NULL),
(51, 'LDP9KD-202601-005', 23, 'head hr trial', NULL, '2026-01-31', 'San Pedro CIty SM', 'Job-Embedded Learning', 'fixing car', '', 'Others', '', NULL, 'sddd', 'uploads/signatures/697c074ce1b0a_org_signature.png', NULL, '', '[\"uploads\\/workplace\\/697c074ce1ef2_work_Cert.jpg\"]', 'ssss', NULL, NULL, '2026', 'Viewed', NULL, NULL, '2026-01-30 01:20:12', 1, 0, 0, '2026-02-02 15:10:57', NULL, NULL, NULL, NULL),
(53, 'LDPAXV-202602-001', 27, 'Training on Technical Writing', NULL, '2026-01-28, 2026-01-29, 2026-01-30', 'GABALDON HALL', 'Formal Training', 'technical writing', '', 'Technical', '', NULL, 'SDO', 'uploads/signatures/698033be141b3_org_Anime_Gachiakuta.jpg', NULL, '', '[\"uploads\\/workplace\\/698033be146d6_work_Anime_Gachiakuta.jpg\"]', 'ssssss', NULL, NULL, '2026', 'Viewed', NULL, NULL, '2026-02-02 05:18:54', 1, 1, 0, '2026-02-02 13:22:47', '2026-02-02 13:23:23', NULL, NULL, NULL),
(54, 'LDPYS2-202602-002', 27, 'deded', NULL, '2026-02-11', 'SDO', 'Job-Embedded Learning', 'Keeps the service vehicle on good condition', '', 'Supervisory', '', NULL, 'ahhhhh', 'uploads/signatures/698056acf1b17_organizer_sig_signature.png', 'eee', '', '[\"uploads\\/workplace\\/6980567d2bab2_work_Cert.jpg\"]', 'ssss', NULL, NULL, '2026', 'Viewed', 'uploads/signatures/698056c91109a_admin_sds_signature.png', NULL, '2026-02-02 07:47:09', 1, 1, 1, '2026-02-02 15:47:37', '2026-02-02 15:47:56', '2026-02-02 15:48:25', NULL, NULL),
(55, 'LDP5FX-202602-003', 27, 'Presentationn', NULL, '2026-02-19, 2026-02-20', 'pacita astrodome', 'Job-Embedded Learning', 'Keeps the service vehicle on good condition', '', 'Technical', '', NULL, '', '', NULL, '', '[\"uploads\\/workplace\\/69813a44afe4e_work_Leave_Form6_Brotota14.docx\"]', 'sssss', '', 'uploads/application_files/69813a44b0ae6_app_learning_Leave_Form6_Brotota12.docx', '2026', 'Viewed', NULL, 'uploads/certificates/69813a44b0eb4_cert_f6-back.pdf', '2026-02-02 23:59:00', 1, 0, 0, '2026-02-03 08:52:04', NULL, NULL, NULL, NULL),
(56, 'LDPDY2-202602-004', 27, 'TESTALGEN1', NULL, '2026-02-11, 2026-02-12', 'SDO', 'Relationship Discussion Learning', 'brings memo', '', 'Supervisory', '', NULL, 'Administrator1', 'uploads/signatures/69843c04789a3_organizer_sig_signature.png', NULL, '', '[\"uploads\\/workplace\\/6981e4d5683aa_work_SHA_WEEK7_ELJHON_D_LOVEREZ.docx\"]', 'TESTALGEN1', '', NULL, '2026', 'Viewed', NULL, 'uploads/certificates/6981e4d5687e0_cert_Cert.jpg', '2026-02-03 12:06:45', 1, 1, 0, '2026-02-05 09:17:57', '2026-02-05 14:43:16', NULL, NULL, NULL),
(57, 'LDP8GK-202602-005', 27, 'fefefed', NULL, '2026-02-18', 'SDO', 'Relationship Discussion Learning', 'Keeps the service vehicle on good condition', '', 'Supervisory', '', NULL, 'helo', 'uploads/signatures/698439a0a7821_organizer_sig_signature.png', NULL, '', '[\"uploads\\/workplace\\/6982a62e55ad0_work_SHA_WEEK7_ELJHON_D_LOVEREZ.docx\"]', 'fedfedfedfed', '', 'uploads/application_files/6982a62e55e6a_app_learning_Thisitemisunavailable-Etsy.jpg', '2026', 'Viewed', NULL, 'uploads/certificates/6982a62e562c6_cert_Cert.jpg', '2026-02-04 01:51:42', 1, 1, 0, '2026-02-05 14:32:45', '2026-02-05 14:33:04', NULL, NULL, NULL),
(58, 'LDPCZ4-202602-006', 27, 'testfornew', NULL, '2026-02-18, 2026-02-19', 'Jujutsu High', 'Relationship Discussion Learning', 'hhhmm', '', 'Supervisory', '', NULL, 'itsme', 'uploads/signatures/6982f33d27b59_organizer_sig_signature.png', 'SCALLENTE', '', '[\"uploads\\/workplace\\/6982f1df42e75_work_69813a44afe4e_work_Leave_Form6_Brotota14.docx\"]', 'weeeehhh', '', NULL, '2026', 'Viewed', 'uploads/signatures/6982f3c857527_admin_sds_signature.png', 'uploads/certificates/6982f1df43431_cert_Cert.jpg', '2026-02-04 07:14:39', 1, 1, 1, '2026-02-04 15:14:59', '2026-02-04 15:20:29', '2026-02-04 15:22:48', NULL, NULL),
(59, 'LDPH5A-202602-007', 27, 'related expertise', NULL, '', '', 'Online or Virtual Training', 'Relevant Expertise', '', 'Leadership and Management Development', '', NULL, '', '', NULL, '', '', 'sssss', '', NULL, '123', 'Viewed', NULL, NULL, '2026-02-05 06:11:22', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(60, 'LDP4F9-202602-008', 27, 'tryagain', NULL, '', '', '', 'Relevant Expertise', '', '', '', NULL, '', '', NULL, '', '', '', '', NULL, '123', 'Viewed', NULL, NULL, '2026-02-05 06:16:16', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(61, 'LDPQ8P-202602-009', 27, 'The signatory tadadada', NULL, '2026-02-18, 2026-02-27', 'Jujutsu High', 'Blended Learning', 'sociallfe', 'Solo Parent', 'Research and Innovation Development', '', NULL, '', '', NULL, '', 'uploads/work/69843ec25356b_workplace.jpg', 'its okatyssss', '', 'uploads/app_learning/69843ec253c12_application_files.jpg', '123', 'Viewed', NULL, 'uploads/cert/69843ec254194_certificates.jpg', '2026-02-05 06:54:58', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(62, 'LDPTJM-202602-010', 27, 'tirallumay', NULL, '2026-02-19', 'San Pedro CIty SM', 'Face to Face Training', 'Keeps the service vehicle on good condition', 'Solo Parent', 'Instructional Learning and Development', '', NULL, '', '', NULL, '', 'uploads/work/6984408b07653_workplace.jpg', 'sssssee', '', NULL, '123', 'Viewed', NULL, 'uploads/cert/6984408b07971_certificates.jpg', '2026-02-05 07:02:35', 1, 0, 0, '2026-04-04 23:05:16', NULL, NULL, NULL, NULL),
(63, 'LDPB2P-202602-011', 34, 'sssss', NULL, '', '', '', 'Relevant Expertise', '', '', '', NULL, 'HDR', 'uploads/signatures/69d10d2e0e089_organizer_sig_signature.png', NULL, '', '', '', '', NULL, '2026', 'Viewed', NULL, NULL, '2026-02-09 03:19:04', 1, 1, 0, '2026-02-19 14:03:44', '2026-04-04 21:07:58', NULL, NULL, NULL),
(64, 'LDPDFZ-202604-001', 34, 'TEST TEST 1', NULL, '2026-04-16, 2026-04-24', 'San Pedro CIty SM', 'Self Paced or Independent Learning', 'SSS', 'Not Applicable', 'Values, Ethics, and Professional Development', '', NULL, '', '', NULL, '', 'uploads/work/69d88e8ddaa3a_workplace.jpg', 'SSSSSSSSSSSSSSSSS', '', '', '2026', 'Pending', NULL, 'uploads/cert/69d8583b32976_certificates.jpg', '2026-04-10 01:54:03', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(65, 'LDPREA-202604-002', 34, 'TEST 2 TEST 2', NULL, '2026-04-22, 2026-04-23', 'test2', 'Formal Training', 'SSSSSS', 'SOGIE-Diverse / Member of LGBTQ+', 'Research and Innovation Development', '', NULL, '', '', NULL, '', 'uploads/work/69d8636ecde66_workplace.png', 'SSSSSSS', '', NULL, '2026', 'Pending', NULL, 'uploads/cert/69d859b735722_certificates.jpg', '2026-04-10 02:00:23', 1, 0, 0, '2026-04-10 10:37:23', NULL, NULL, NULL, NULL),
(66, 'LDPLQV-202604-003', 34, 'test 3 test 3 test 3', NULL, '2026-04-22, 2026-04-23, 2026-04-24', 'San Pedro CIty SM', 'Blended Learning', 'ssss', 'Indigenous Peoples (IPs)', 'Curriculum Learning and Development', '', NULL, '', '', NULL, '', 'uploads/work/69d86d8376a28_workplace.jpg, uploads/work/69d86d8376e1e_workplace.png, uploads/work/69d86d8377200_workplace.png', 'test 3', '', '', '2026', 'Pending', NULL, 'uploads/cert/69d86d4e43606_certificates.png', '2026-04-10 03:23:58', 1, 0, 0, '2026-04-10 11:24:28', NULL, NULL, NULL, NULL),
(67, 'LDPVUY-202604-004', 34, 'test 5', NULL, '2026-04-22, 2026-04-23, 2026-04-24', 'test 5', 'Online or Virtual Training', 'TEST5', 'Not Applicable', 'Learning and Development for Learner Support Services', '', NULL, '', '', NULL, '', '', 'TEST 5', '', '', '2026', 'Pending', NULL, 'uploads/cert/69dc4f8b31ab2_certificates.png', '2026-04-13 02:06:03', 1, 0, 0, '2026-04-13 10:58:46', NULL, NULL, NULL, NULL),
(68, 'LDPA5W-202604-005', 34, 'Test 6', NULL, '2026-04-22, 2026-04-23', 'test 6', 'Online or Virtual Training', 'test 6', 'Not Applicable', 'Curriculum Learning and Development', '', NULL, '', '', NULL, '', '', 'test 6', '', '', '2026', 'Pending', NULL, 'uploads/cert/69dc7b4c2c8c8_certificates.png', '2026-04-13 05:12:44', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(69, 'ELDPTQ8-202604-006', 34, 'testingthenewfeatures', '123213123', '2026-04-23, 2026-04-24', 'San Pedro CIty SM', 'Self Paced or Independent Learning', 'TESTCOMPETENCY', 'SOGIE-Diverse / Member of LGBTQ+', 'Curriculum Learning and Development', '', NULL, '', '', NULL, '', '', 'testest', '', '', '2026', 'Pending', NULL, 'uploads/cert/69f0575ac5f43_certificates.jpg', '2026-04-28 06:44:42', 0, 0, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ld_types`
--

CREATE TABLE `ld_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ld_types`
--

INSERT INTO `ld_types` (`id`, `name`) VALUES
(3, 'Curriculum Learning and Development'),
(5, 'Human Resource and Organizational Development'),
(1, 'Instructional Learning and Development'),
(4, 'Leadership and Management Development'),
(9, 'Learning and Development for Learner Support Services'),
(10, 'Others'),
(7, 'Research and Innovation Development'),
(2, 'Supervisory Learning and Development'),
(6, 'Technical and Functional Learning and Development'),
(8, 'Values, Ethics, and Professional Development');

-- --------------------------------------------------------

--
-- Table structure for table `modalities`
--

CREATE TABLE `modalities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modalities`
--

INSERT INTO `modalities` (`id`, `name`) VALUES
(3, 'Blended Learning'),
(5, 'Coaching and Mentoring'),
(1, 'Face to Face Training'),
(7, 'Formal Training'),
(8, 'Job-Embedded Learning'),
(10, 'Learning Action Cell'),
(6, 'Mobile Learning'),
(2, 'Online or Virtual Training'),
(9, 'Relationship Discussion Learning'),
(4, 'Self Paced or Independent Learning'),
(11, 'testmodal');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender_id`, `recipient_id`, `message`, `is_read`, `created_at`) VALUES
(17, 35, 23, 'A new account has been created and verified: vi (joerenz.dev@gmail.com)', 0, '2026-02-10 00:26:48'),
(18, 38, 1, 'A new account has been created and verified: Cedrick Bacaresas (ceededom@gmail.com)', 0, '2026-04-29 01:04:52'),
(19, 38, 23, 'A new account has been created and verified: Cedrick Bacaresas (ceededom@gmail.com)', 0, '2026-04-29 01:04:52'),
(20, 40, 1, 'A new account has been created and verified: LYKA JANE A. LEOSALA (lykajane.leosala@deped.gov.ph)', 0, '2026-05-21 07:21:24'),
(21, 40, 23, 'A new account has been created and verified: LYKA JANE A. LEOSALA (lykajane.leosala@deped.gov.ph)', 0, '2026-05-21 07:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `category`, `name`, `created_at`) VALUES
(1, 'OSDS', 'ADMINISTRATIVE', '2026-01-29 00:22:46'),
(2, 'OSDS', 'ADMINISTRATIVE (PERSONEL)', '2026-01-29 00:22:46'),
(3, 'OSDS', 'ADMINISTRATIVE (PROPERTY AND SUPPLY)', '2026-01-29 00:22:46'),
(4, 'OSDS', 'ADMINISTRATIVE (RECORDS)', '2026-01-29 00:22:46'),
(5, 'OSDS', 'ADMINISTRATIVE (CASH)', '2026-01-29 00:22:46'),
(6, 'OSDS', 'ADMINISTRATIVE (PROCUREMENT)', '2026-01-29 00:22:46'),
(7, 'OSDS', 'ADMINISTRATIVE (GENERAL SERVICES)', '2026-01-29 00:22:46'),
(8, 'OSDS', 'FINANCE (ACCOUNTING)', '2026-01-29 00:22:46'),
(9, 'OSDS', 'FINANCE (BUDGET)', '2026-01-29 00:22:46'),
(10, 'OSDS', 'LEGAL', '2026-01-29 00:22:46'),
(11, 'OSDS', 'ICT', '2026-01-29 00:22:46'),
(12, 'SGOD', 'SGOD (SCHOOL MANAGEMENT MONITORING & EVALUATION)', '2026-01-29 00:22:46'),
(13, 'SGOD', 'SGOD (HUMAN RESOURCES DEVELOPMENT)', '2026-01-29 00:22:46'),
(14, 'SGOD', 'SGOD (SOCIAL MOBILIZATION AND NETWORKING)', '2026-01-29 00:22:46'),
(15, 'SGOD', 'SGOD (PLANNING AND RESEARCH)', '2026-01-29 00:22:46'),
(16, 'SGOD', 'SGOD (DISASTER RISK REDUCTION AND MANAGEMENT)', '2026-01-29 00:22:46'),
(17, 'SGOD', 'SGOD (EDUCATION FACILITIES)', '2026-01-29 00:22:46'),
(18, 'SGOD', 'SGOD (SCHOOL HEALTH AND NUTRITION)', '2026-01-29 00:22:46'),
(19, 'SGOD', 'SGOD (SCHOOL HEALTH AND NUTRITION) (DENTAL)', '2026-01-29 00:22:46'),
(20, 'SGOD', 'SGOD (SCHOOL HEALTH AND NUTRITION) (MEDICAL)', '2026-01-29 00:22:46'),
(21, 'CID', 'CID (INSTRUCTIONAL MANAGEMENT)', '2026-01-29 00:22:46'),
(22, 'CID', 'CID (LEARNING RESOURCES MANAGEMENT)', '2026-01-29 00:22:46'),
(23, 'CID', 'CID (ALTERNATIVE LEARNING SYSTEM)', '2026-01-29 00:22:46'),
(24, 'CID', 'CID (DISTRICT INSTRUCTIONAL SUPERVISION)', '2026-01-29 00:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `gmail` varchar(100) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `attempts` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `gmail`, `token`, `expires_at`, `created_at`, `attempts`) VALUES
(14, 'milio', '942159', '2026-02-09 13:28:59', '2026-02-09 04:23:59', 0),
(25, 'algen', '632797', '2026-02-09 16:37:24', '2026-02-09 07:32:24', 0),
(26, 'tahm', '310321', '2026-02-09 20:00:12', '2026-02-09 10:55:12', 0),
(37, 'vi', '664265', '2026-02-10 10:37:33', '2026-02-10 01:32:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registration_request_logs`
--

CREATE TABLE `registration_request_logs` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_request_logs`
--

INSERT INTO `registration_request_logs` (`id`, `email`, `requested_at`) VALUES
(1, 'ggeenggeen@gmail.com', '2026-02-10 00:53:35'),
(2, 'ggeenggeen@gmail.com', '2026-02-10 01:03:45'),
(3, 'ggeenggeen@gmail.com', '2026-02-10 01:04:08'),
(4, 'relational02@gmail.com', '2026-04-04 14:05:41'),
(5, 'test@deped.gov.ph', '2026-04-21 00:06:56'),
(6, 'ggeenggeen@gmail.com', '2026-04-29 00:00:21'),
(7, 'kokoee972@gmail.com', '2026-04-29 00:55:27'),
(8, 'cbacaresas.spcpc@gmail.com', '2026-04-29 01:00:51'),
(9, 'ceededom@gmail.com', '2026-04-29 01:04:26'),
(10, 'yuki.borabora.01@gmail.com', '2026-04-29 01:09:49'),
(11, 'cedrickbacaresas4@gmail.com', '2026-04-29 01:32:12'),
(12, 'lykajane.leosala@deped.gov.ph', '2026-05-21 07:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `reset_request_logs`
--

CREATE TABLE `reset_request_logs` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` enum('request','resend') DEFAULT 'request',
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reset_request_logs`
--

INSERT INTO `reset_request_logs` (`id`, `email`, `type`, `requested_at`) VALUES
(1, 'loveresalgen@gmail.com', 'request', '2026-02-09 07:03:12'),
(2, 'loveresalgen@gmail.com', 'request', '2026-02-09 07:23:15'),
(3, 'loveresalgen@gmail.com', 'request', '2026-02-09 07:25:56'),
(4, 'flickhistories@gmail.com', 'request', '2026-02-09 07:31:49'),
(5, 'flickhistories@gmail.com', 'request', '2026-02-09 07:32:24'),
(6, 'loveresalgen@gmail.com', 'request', '2026-02-09 10:55:12'),
(16, 'joerenz.dev@gmail.com', 'request', '2026-02-10 01:19:00'),
(17, 'joerenz.dev@gmail.com', 'request', '2026-02-10 01:32:33'),
(18, 'joerenz.dev@gmail.com', 'resend', '2026-02-10 01:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `security_tracking`
--

CREATE TABLE `security_tracking` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `page_visits` int(11) DEFAULT 0,
  `is_blocked` tinyint(1) DEFAULT 0,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_tracking`
--

INSERT INTO `security_tracking` (`id`, `email`, `page_visits`, `is_blocked`, `last_activity`) VALUES
(1, 'loveresalgen@gmail.com', 2, 0, '2026-02-09 10:55:12'),
(3, 'joerence.dev@gmail.com', 1, 0, '2026-02-10 00:27:58'),
(4, 'joerenz.dev@gmail.com', 30, 0, '2026-02-10 01:32:49'),
(34, 'lykajane.leosala@deped.gov.ph', 1, 0, '2026-05-21 07:20:02'),
(35, 'eegeenn@gmail.com', 2, 0, '2026-06-09 04:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `training_codes`
--

CREATE TABLE `training_codes` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT 'activity_code',
  `code_name` varchar(100) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_codes`
--

INSERT INTO `training_codes` (`id`, `category`, `code_name`, `title`, `description`, `created_at`) VALUES
(1, 'activity_code', '123213123', NULL, 'hahahaha', '2026-04-28 06:09:18'),
(2, 'competency', 'TESTCOMPETENCY', NULL, 'TESTTEST', '2026-04-28 06:32:28'),
(3, 'activity_code', '0001001', 'TESTTITLE', 'WHENWHEN', '2026-04-28 07:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `gmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `office_station` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `employee_number` varchar(100) DEFAULT NULL,
  `rating_period` varchar(100) DEFAULT NULL,
  `area_of_specialization` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `passkey` varchar(6) DEFAULT NULL,
  `passkey_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `gmail`, `password`, `full_name`, `office_station`, `position`, `employee_number`, `rating_period`, `area_of_specialization`, `age`, `sex`, `role`, `created_at`, `profile_picture`, `is_active`, `created_by`, `passkey`, `passkey_expires_at`) VALUES
(1, 'kokoe972@gmail.com', '$2y$10$5BtaHlJBJqnxdqjNiil6qeUx55aCs/SFYQXFtIWlvwXRxv42jwUCy', 'System Admin', 'ICT', 'TEST', '', '', '', 0, 'Male', 'head_hr', '2026-01-06 05:05:27', NULL, 1, 6, NULL, NULL),
(2, 'ict.sanpedrocity@deped.gov.ph', '$2y$10$0HvQamePH9GDWirnrm.q2Omyhnv0xnM8tPQhHIXi8KdlWmyVsNfOq', 'Super Admin One', 'ICT', 'IT HEAD', NULL, NULL, NULL, NULL, NULL, 'super_admin', '2026-01-08 02:40:45', NULL, 1, 6, NULL, NULL),
(6, 'eegeenn@gmail.com', '$2y$10$0HvQamePH9GDWirnrm.q2Omyhnv0xnM8tPQhHIXi8KdlWmyVsNfOq', 'Super Admin One', 'ICT', 'IT HEAD', NULL, NULL, NULL, NULL, NULL, 'super_admin', '2026-01-08 02:40:45', NULL, 1, 6, NULL, NULL),
(16, 'genloveres@gmail.com', '$2y$10$V0nZA0HFpHH86dxLkA3H7OE3kb1CjhICtHtqFlyKB/loAELjmj3B6', 'Immediate Head', 'ADMINISTRATIVE (CASH)', 'test8', '2026', '', 'test8', 21, 'Male', 'immediate_head', '2026-01-13 04:01:33', 'uploads/profile_pics/69d10ffd1789b_sdsdsd.jpg', 1, 6, NULL, NULL),
(22, NULL, '$2y$10$2KAsaJVHKiKlQafwBohdzOXKcNvuVUlZ1zXd2kOyqwQWmlx3SmR/S', 'LIVELY', 'FINANCE (BUDGET)', 'ojt', '2026', NULL, 'ROT', 22, 'Male', 'user', '2026-01-26 05:37:19', NULL, 0, NULL, NULL, NULL),
(23, 'xerdapparel@gmail.com', '$2y$10$7RZlonEalxm088B/2SHmreheyDzGD7EI0tzoqB.uEdJUwaLqJuw7.', 'HRD', 'FINANCE (ACCOUNTING)', 'HR', '2026', '', 'MONEYMONEY', 24, 'Male', 'head_hr', '2026-01-27 04:58:20', 'uploads/profile_pics/69d110d8277b9_sdsdsd.jpg', 1, 6, NULL, NULL),
(26, NULL, '$2y$10$qCQ9R2Ozg2b9a0i0QnFbyeOocSPMIga.cDI55FZUjOzfPuCO9Cc3u', 'Khristine Citia Borabora', 'SGOD (SCHOOL HEALTH AND NUTRITION)', 'All around', '2026', NULL, 'Discriminate', 21, 'Female', 'user', '2026-01-29 05:03:06', 'uploads/profile_pics/697aea722161c_anime.jpg', 1, NULL, NULL, NULL),
(27, 'flickhistories@gmail.com', '$2y$10$ERPQM/59mIbqAoJ/C/orZew0Ck3Cu011wk26iUGWF1ojEVggYmiHC', 'algen', 'ICT', 'OJT', '2026', '123', 'web dev', 21, 'Male', 'user', '2026-02-02 05:01:34', 'uploads/profile_pics/69818db9717ae_Wallpapersololeveling.jpg', 1, NULL, NULL, NULL),
(28, NULL, '$2y$10$dQxtiHZuf.WmILRvUQC2x.nNUf1E6XkzFd9fninomRhid57lp818S', 'CED', 'ADMINISTRATIVE', 'OJT', '2026', NULL, 'sss', 21, 'Male', 'immediate_head', '2026-02-02 05:26:28', NULL, 1, 6, NULL, NULL),
(34, 'loveresalgen@gmail.com', '$2y$10$EBLRV2wBO5GNZ1pBWyJDw.Rjp/s4XYTPqUI/aJ6.8y1sYKrGPZfPu', 'TESTUSER', 'ADMINISTRATIVE (GENERAL SERVICES)', 'support', '1234567', '2026', 'tank', 23, 'Male', 'user', '2026-02-09 02:08:33', NULL, 1, NULL, NULL, NULL),
(35, 'joerenz.dev@gmail.com', '$2y$10$uQtyHPreZsci2qyDJ.RMc.5oJNg/46oeQ9JsCzUH8zOQHLRZPi6YG', 'vi', 'CID (DISTRICT INSTRUCTIONAL SUPERVISION)', 'jungler', '1234567', NULL, 'fighter', 23, 'Female', 'user', '2026-02-10 00:26:48', NULL, 1, NULL, NULL, NULL),
(37, 'aries@deped.gov.ph', '$2y$10$FLcIbf0PtnlTnd/cDzC32u8qQTDcEuPOz5iPux/tWGzb1BIHqP/qa', 'aries', 'ADMINISTRATIVE (GENERAL SERVICES)', 'support', '1234567', '', 'WEB DEV', 21, 'Male', 'user', '2026-04-20 22:42:20', NULL, 1, 6, NULL, NULL),
(38, 'ceededom@gmail.com', '$2y$10$WoNxg.IvVALhh/q3dSK8y.Hi.PkM8zbLxGhyHq9mpRdB.GA5KfpOG', 'Cedrick Bacaresas', 'ICT', 'INTERN', '1000042', NULL, 'Web Design', 21, 'Male', 'user', '2026-04-29 01:04:52', NULL, 1, NULL, NULL, NULL),
(39, 'user@gmail.com', '$2y$10$/LNBnBwWrSa7FSmxnliwlunwcH.hO74F4.9MvnbQ1KD9q4YFIk1GS', 'Normal User', 'ADMINISTRATIVE', 'ADA6', '1234567', '', 'clerical', 18, 'Male', 'user', '2026-04-29 01:55:27', NULL, 1, 6, NULL, NULL),
(40, 'lykajane.leosala@deped.gov.ph', '$2y$10$4TpQL5RkMQ4jEpY9P1ydMuy0YNLbgm0i4698RSZVm9v5xvlQnnKJe', 'LYKA JANE A. LEOSALA', 'ICT', 'IT OFFICER I', '6459308', '2026', 'ICT', 37, 'Female', 'user', '2026-05-21 07:21:23', NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_ildn`
--

CREATE TABLE `user_ildn` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `need_text` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ildn`
--

INSERT INTO `user_ildn` (`id`, `user_id`, `need_text`, `description`, `created_at`) VALUES
(10, 1, 'fixing car', NULL, '2026-01-24 05:44:57'),
(11, 16, 'leverage tax', NULL, '2026-01-24 05:54:51'),
(12, 16, 'STOP LOSS', NULL, '2026-01-24 06:12:09'),
(13, 16, 'RESISTANCE', NULL, '2026-01-24 06:12:14'),
(14, 16, 'SUPPORT', NULL, '2026-01-24 06:12:18'),
(15, 1, 'sociallfe', NULL, '2026-01-25 23:34:35'),
(16, 1, 'WEB DEV', 'its all about web dev', '2026-01-26 00:12:23'),
(22, 26, 'Mythic', 'reach mythic in ML  :))', '2026-01-29 05:05:21'),
(23, 23, 'fixing car', '', '2026-01-30 01:19:58'),
(24, 27, 'technical writing', '', '2026-02-02 05:05:46'),
(25, 27, 'Keeps the service vehicle on good condition', '', '2026-02-02 05:06:24'),
(26, 27, 'brings memo', '', '2026-02-02 05:06:47'),
(27, 27, 'sss', '', '2026-02-03 06:37:51'),
(28, 27, 'sssss', '', '2026-02-03 06:37:54'),
(33, 27, 'hhhmm', 'sss', '2026-02-04 06:59:22'),
(34, 27, 'sociallfe', '', '2026-02-04 07:05:50'),
(35, 34, 'fixing car', '', '2026-04-28 07:18:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `classifications`
--
ALTER TABLE `classifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `job_embedded_learning`
--
ALTER TABLE `job_embedded_learning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_embedded_learnings`
--
ALTER TABLE `job_embedded_learnings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ld_activities`
--
ALTER TABLE `ld_activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_tracking_number` (`tracking_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ld_types`
--
ALTER TABLE `ld_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `modalities`
--
ALTER TABLE `modalities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_request_logs`
--
ALTER TABLE `registration_request_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `reset_request_logs`
--
ALTER TABLE `reset_request_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email_time` (`email`,`requested_at`);

--
-- Indexes for table `security_tracking`
--
ALTER TABLE `security_tracking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `training_codes`
--
ALTER TABLE `training_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_name` (`code_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_ildn`
--
ALTER TABLE `user_ildn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2603;

--
-- AUTO_INCREMENT for table `classifications`
--
ALTER TABLE `classifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_embedded_learning`
--
ALTER TABLE `job_embedded_learning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_embedded_learnings`
--
ALTER TABLE `job_embedded_learnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ld_activities`
--
ALTER TABLE `ld_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `ld_types`
--
ALTER TABLE `ld_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `modalities`
--
ALTER TABLE `modalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `registration_request_logs`
--
ALTER TABLE `registration_request_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reset_request_logs`
--
ALTER TABLE `reset_request_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `security_tracking`
--
ALTER TABLE `security_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `training_codes`
--
ALTER TABLE `training_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_ildn`
--
ALTER TABLE `user_ildn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ld_activities`
--
ALTER TABLE `ld_activities`
  ADD CONSTRAINT `ld_activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_ildn`
--
ALTER TABLE `user_ildn`
  ADD CONSTRAINT `user_ildn_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
