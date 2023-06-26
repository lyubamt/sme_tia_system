-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 09:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sme_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `id` int(2) NOT NULL,
  `business_category_id` int(3) NOT NULL,
  `business_type` int(1) NOT NULL,
  `name` varchar(191) NOT NULL,
  `physical_address` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `website` varchar(191) DEFAULT NULL,
  `currency_id` int(2) NOT NULL,
  `certificate` varchar(191) DEFAULT NULL,
  `geo_tag` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`id`, `business_category_id`, `business_type`, `name`, `physical_address`, `email`, `phone`, `website`, `currency_id`, `certificate`, `geo_tag`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Agro Business', 'Box 2576', 'agro@gmail.com', '12334567', NULL, 1, NULL, NULL, 1, 1, '2023-06-23 08:04:50', '2023-06-25 09:12:05'),
(2, 1, 1, 'Agro Business', 'Box 2576', 'agro@gmail.com', '12334567', NULL, 1, NULL, NULL, 1, 0, '2023-06-23 08:54:37', '2023-06-23 08:54:37'),
(3, 2, 2, 'Kukus TZ', 'Box 2576', 'kukus@gmail.com', '07666777888', 'kukus@gmail.com', 1, '1687630632-SME SRS_2023_06_16.docx', 'Kuku TZ', 1, 0, '2023-06-24 15:17:12', '2023-06-24 15:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `business_categories`
--

CREATE TABLE `business_categories` (
  `id` int(2) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_categories`
--

INSERT INTO `business_categories` (`id`, `name`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Sole Proprietorship', NULL, 1, 0, '2023-06-23 07:47:05', '2023-06-23 07:47:05'),
(2, 'Company', NULL, 1, 0, '2023-06-23 07:47:05', '2023-06-23 07:47:05'),
(3, 'Partnership', NULL, 1, 0, '2023-06-23 07:47:05', '2023-06-23 07:47:05'),
(4, 'Corporation', NULL, 1, 0, '2023-06-23 07:47:05', '2023-06-23 07:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `business_owners`
--

CREATE TABLE `business_owners` (
  `id` int(2) NOT NULL,
  `business_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_owners`
--

INSERT INTO `business_owners` (`id`, `business_id`, `user_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 25, 1, 0, '2023-06-23 08:04:50', '2023-06-23 08:04:50'),
(2, 2, 26, 1, 0, '2023-06-23 08:54:37', '2023-06-23 08:54:37'),
(3, 3, 5, 1, 0, '2023-06-24 15:17:12', '2023-06-24 15:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(2) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Tanzania', 'United Republic of Tanzania', 1, 0, '2022-11-30 09:28:41', '2022-11-30 09:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(2) NOT NULL,
  `name` varchar(191) NOT NULL,
  `abbreviation` varchar(20) DEFAULT NULL,
  `symbol` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `factor` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `abbreviation`, `symbol`, `description`, `factor`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Tanzanian Shilling', 'T-Shilling', 'TZS', NULL, '1', 1, 0, NULL, NULL),
(2, 'United States Dollar', 'USD', '$', NULL, '2300', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) NOT NULL,
  `region_id` int(3) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `region_id`, `name`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 'Nyamagana', 'Nyamagana', 1, 0, '2022-12-01 04:23:50', '2022-12-01 04:23:50'),
(2, 1, 'Songea', 'Songea', 1, 0, '2022-12-01 04:24:09', '2022-12-01 04:42:43'),
(3, 3, 'Iringa Mjini', 'Iringa Mjini', 1, 0, '2023-06-23 06:39:04', '2023-06-23 06:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'User Victor has has logged out', 5, '2023-01-02 04:13:20', '2023-01-02 04:13:20'),
(2, 'User Victor has has logged in', 5, '2023-01-02 04:18:43', '2023-01-02 04:18:43'),
(3, 'User Victor has has logged out', 5, '2023-01-02 04:20:02', '2023-01-02 04:20:02'),
(4, 'User Victor has has logged in', 5, '2023-01-02 04:20:12', '2023-01-02 04:20:12'),
(5, 'User Victor has has logged out', 5, '2023-01-02 04:20:39', '2023-01-02 04:20:39'),
(6, 'User Victor has has logged in', 5, '2023-01-02 04:20:55', '2023-01-02 04:20:55'),
(7, 'User Victor has has logged out', 5, '2023-01-02 03:25:51', '2023-01-02 03:25:51'),
(8, 'User Victor has has logged in', 5, '2023-01-02 03:30:06', '2023-01-02 03:30:06'),
(9, 'User Victor has has logged out', 5, '2023-01-02 03:32:28', '2023-01-02 03:32:28'),
(10, 'User Victor has has logged in', 5, '2023-01-02 03:56:43', '2023-01-02 03:56:43'),
(11, 'User Victor has has logged in', 5, '2023-01-02 18:14:49', '2023-01-02 18:14:49'),
(12, 'User Victor has has logged in', 5, '2023-01-03 22:50:22', '2023-01-03 22:50:22'),
(13, 'User Victor has has logged in', 5, '2023-01-03 22:58:19', '2023-01-03 22:58:19'),
(14, 'User Victor has has logged in', 5, '2023-01-03 23:17:29', '2023-01-03 23:17:29'),
(15, 'User Victor has has logged in', 5, '2023-01-03 23:19:39', '2023-01-03 23:19:39'),
(16, 'User Victor has has logged in', 5, '2023-01-03 23:26:27', '2023-01-03 23:26:27'),
(24, 'User Victor has has logged in', 5, '2023-01-04 13:32:46', '2023-01-04 13:32:46'),
(25, 'User Victor has has logged out', 5, '2023-01-04 13:35:33', '2023-01-04 13:35:33'),
(26, 'User Victor has has logged out', 5, '2023-01-04 13:39:52', '2023-01-04 13:39:52'),
(27, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Demo 1\'', 5, '2023-01-04 13:41:11', '2023-01-04 13:41:11'),
(28, 'User Victor has has logged in', 5, '2023-01-04 13:41:11', '2023-01-04 13:41:11'),
(29, 'User Victor has has logged out', 5, '2023-01-04 13:43:36', '2023-01-04 13:43:36'),
(30, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Demo 1\'', 5, '2023-01-04 13:43:52', '2023-01-04 13:43:52'),
(31, 'User Victor has has logged in', 5, '2023-01-04 13:43:52', '2023-01-04 13:43:52'),
(32, 'User Victor has has logged out', 5, '2023-01-04 13:45:19', '2023-01-04 13:45:19'),
(33, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-05 15:59:59', '2023-01-05 15:59:59'),
(34, 'User Victor has has logged in', 5, '2023-01-05 15:59:59', '2023-01-05 15:59:59'),
(35, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-06 05:55:41', '2023-01-06 05:55:41'),
(36, 'User Victor has has logged in', 5, '2023-01-06 05:55:41', '2023-01-06 05:55:41'),
(37, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-06 09:16:12', '2023-01-06 09:16:12'),
(38, 'User Victor has has logged in', 5, '2023-01-06 09:16:12', '2023-01-06 09:16:12'),
(39, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-06 14:19:41', '2023-01-06 14:19:41'),
(40, 'User Victor has has logged in', 5, '2023-01-06 14:19:42', '2023-01-06 14:19:42'),
(41, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-06 19:26:08', '2023-01-06 19:26:08'),
(42, 'User Victor has has logged in', 5, '2023-01-06 19:26:08', '2023-01-06 19:26:08'),
(43, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-06 21:10:27', '2023-01-06 21:10:27'),
(44, 'User Victor has has logged in', 5, '2023-01-06 21:10:27', '2023-01-06 21:10:27'),
(45, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-07 05:22:52', '2023-01-07 05:22:52'),
(46, 'User Victor has has logged in', 5, '2023-01-07 05:22:52', '2023-01-07 05:22:52'),
(47, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-07 20:04:23', '2023-01-07 20:04:23'),
(48, 'User Victor has has logged in', 5, '2023-01-07 20:04:23', '2023-01-07 20:04:23'),
(49, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-08 05:42:39', '2023-01-08 05:42:39'),
(50, 'User Victor has has logged in', 5, '2023-01-08 05:42:39', '2023-01-08 05:42:39'),
(51, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-09 06:57:42', '2023-01-09 06:57:42'),
(52, 'User Victor has has logged in', 5, '2023-01-09 06:57:42', '2023-01-09 06:57:42'),
(53, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-09 10:45:18', '2023-01-09 10:45:18'),
(54, 'User Victor has has logged in', 5, '2023-01-09 10:45:18', '2023-01-09 10:45:18'),
(55, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-10 04:38:57', '2023-01-10 04:38:57'),
(56, 'User Victor has has logged in', 5, '2023-01-10 04:38:57', '2023-01-10 04:38:57'),
(57, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-11 02:31:38', '2023-01-11 02:31:38'),
(58, 'User Victor has has logged in', 5, '2023-01-11 02:31:38', '2023-01-11 02:31:38'),
(59, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-11 05:41:00', '2023-01-11 05:41:00'),
(60, 'User Victor has has logged in', 5, '2023-01-11 05:41:01', '2023-01-11 05:41:01'),
(61, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-11 10:51:56', '2023-01-11 10:51:56'),
(62, 'User Victor has has logged in', 5, '2023-01-11 10:51:56', '2023-01-11 10:51:56'),
(63, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-12 06:15:19', '2023-01-12 06:15:19'),
(64, 'User Victor has has logged in', 5, '2023-01-12 06:15:19', '2023-01-12 06:15:19'),
(65, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-12 13:50:43', '2023-01-12 13:50:43'),
(66, 'User Victor has has logged in', 5, '2023-01-12 13:50:43', '2023-01-12 13:50:43'),
(67, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-13 06:08:38', '2023-01-13 06:08:38'),
(68, 'User Victor has has logged in', 5, '2023-01-13 06:08:38', '2023-01-13 06:08:38'),
(69, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-16 08:58:57', '2023-01-16 08:58:57'),
(70, 'User Victor has has logged in', 5, '2023-01-16 08:58:57', '2023-01-16 08:58:57'),
(71, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-17 00:47:35', '2023-01-17 00:47:35'),
(72, 'User Victor has has logged in', 5, '2023-01-17 00:47:35', '2023-01-17 00:47:35'),
(73, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-25 09:14:03', '2023-01-25 09:14:03'),
(74, 'User Victor has has logged in', 5, '2023-01-25 09:14:03', '2023-01-25 09:14:03'),
(75, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-26 00:47:28', '2023-01-26 00:47:28'),
(76, 'User Victor has has logged in', 5, '2023-01-26 00:47:28', '2023-01-26 00:47:28'),
(77, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-26 14:12:49', '2023-01-26 14:12:49'),
(78, 'User Victor has has logged in', 5, '2023-01-26 14:12:49', '2023-01-26 14:12:49'),
(79, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-27 00:19:56', '2023-01-27 00:19:56'),
(80, 'User Victor has has logged in', 5, '2023-01-27 00:19:56', '2023-01-27 00:19:56'),
(81, 'User Victor has has logged out', 5, '2023-01-27 04:16:14', '2023-01-27 04:16:14'),
(82, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-27 04:35:25', '2023-01-27 04:35:25'),
(83, 'User Victor has has logged in', 5, '2023-01-27 04:35:25', '2023-01-27 04:35:25'),
(84, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-27 09:42:54', '2023-01-27 09:42:54'),
(85, 'User Victor has has logged in', 5, '2023-01-27 09:42:54', '2023-01-27 09:42:54'),
(86, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-27 18:01:09', '2023-01-27 18:01:09'),
(87, 'User Victor has has logged in', 5, '2023-01-27 18:01:09', '2023-01-27 18:01:09'),
(88, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-27 21:53:57', '2023-01-27 21:53:57'),
(89, 'User Victor has has logged in', 5, '2023-01-27 21:53:57', '2023-01-27 21:53:57'),
(90, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-28 06:49:56', '2023-01-28 06:49:56'),
(91, 'User Victor has has logged in', 5, '2023-01-28 06:49:56', '2023-01-28 06:49:56'),
(92, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-28 11:27:34', '2023-01-28 11:27:34'),
(93, 'User Victor has has logged in', 5, '2023-01-28 11:27:34', '2023-01-28 11:27:34'),
(94, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-29 06:16:49', '2023-01-29 06:16:49'),
(95, 'User Victor has has logged in', 5, '2023-01-29 06:16:49', '2023-01-29 06:16:49'),
(96, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-29 12:05:16', '2023-01-29 12:05:16'),
(97, 'User Victor has has logged in', 5, '2023-01-29 12:05:16', '2023-01-29 12:05:16'),
(98, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-29 22:13:56', '2023-01-29 22:13:56'),
(99, 'User Victor has has logged in', 5, '2023-01-29 22:13:56', '2023-01-29 22:13:56'),
(100, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-30 06:51:07', '2023-01-30 06:51:07'),
(101, 'User Victor has has logged in', 5, '2023-01-30 06:51:07', '2023-01-30 06:51:07'),
(102, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-30 11:56:46', '2023-01-30 11:56:46'),
(103, 'User Victor has has logged in', 5, '2023-01-30 11:56:46', '2023-01-30 11:56:46'),
(104, 'User Victor has has logged out', 5, '2023-01-30 18:30:59', '2023-01-30 18:30:59'),
(105, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-30 18:31:20', '2023-01-30 18:31:20'),
(106, 'User Victor has has logged in', 5, '2023-01-30 18:31:20', '2023-01-30 18:31:20'),
(107, 'User Victor has has logged out', 5, '2023-01-30 20:32:30', '2023-01-30 20:32:30'),
(108, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-30 20:32:45', '2023-01-30 20:32:45'),
(109, 'User Victor has has logged in', 5, '2023-01-30 20:32:45', '2023-01-30 20:32:45'),
(110, 'User Victor has has logged out', 5, '2023-01-30 20:33:20', '2023-01-30 20:33:20'),
(111, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-30 20:35:25', '2023-01-30 20:35:25'),
(112, 'User Victor has has logged in', 5, '2023-01-30 20:35:25', '2023-01-30 20:35:25'),
(113, 'User Victor has has logged out', 5, '2023-01-30 20:38:28', '2023-01-30 20:38:28'),
(114, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-30 20:38:46', '2023-01-30 20:38:46'),
(115, 'User Victor has has logged in', 5, '2023-01-30 20:38:46', '2023-01-30 20:38:46'),
(116, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-30 23:15:59', '2023-01-30 23:15:59'),
(117, 'User Victor has has logged in', 5, '2023-01-30 23:15:59', '2023-01-30 23:15:59'),
(118, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 08:21:46', '2023-01-31 08:21:46'),
(119, 'User Victor has has logged in', 5, '2023-01-31 08:21:46', '2023-01-31 08:21:46'),
(120, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 13:11:35', '2023-01-31 13:11:35'),
(121, 'User Victor has has logged in', 5, '2023-01-31 13:11:35', '2023-01-31 13:11:35'),
(122, 'User Victor has has logged out', 5, '2023-01-31 15:37:38', '2023-01-31 15:37:38'),
(123, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 16:30:50', '2023-01-31 16:30:50'),
(124, 'User Victor has failed to log out', 5, '2023-01-31 16:32:45', '2023-01-31 16:32:45'),
(125, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 16:38:50', '2023-01-31 16:38:50'),
(126, 'User Victor has logged in successfully', 5, '2023-01-31 16:38:50', '2023-01-31 16:38:50'),
(127, 'User Victor has logged out', 5, '2023-01-31 16:50:23', '2023-01-31 16:50:23'),
(128, 'User admin@clidimis has failed to log in because he/she has been locked', 0, '2023-01-31 16:55:11', '2023-01-31 16:55:11'),
(129, 'User admin@clidimis has failed to log in because he/she has been locked', 0, '2023-01-31 16:55:59', '2023-01-31 16:55:59'),
(130, 'User admin@clidimis has failed to log in because he/she has been locked', 0, '2023-01-31 17:05:09', '2023-01-31 17:05:09'),
(131, 'User admin@clidimis has failed to log in because he/she has been assigned Mysql Clidimis Live 1 database', 0, '2023-01-31 17:05:35', '2023-01-31 17:05:35'),
(132, 'User admin@clidimis has failed to log in because he/she has been assigned \'Mysql Clidimis Live 1\' database', 0, '2023-01-31 17:06:18', '2023-01-31 17:06:18'),
(133, 'User admin@clidimis has failed to log in because he/she has been assigned \'Mysql Clidimis Live 1\' database', 0, '2023-01-31 17:11:29', '2023-01-31 17:11:29'),
(134, 'User admin@clidimis has failed to log in because the account has been deleted', 0, '2023-01-31 17:12:07', '2023-01-31 17:12:07'),
(135, 'User admin@clidimis has failed to log in because the account has been deleted', 0, '2023-01-31 17:13:22', '2023-01-31 17:13:22'),
(136, 'User admin@clidimis has failed to log in because he/she has been assigned \'Mysql Clidimis Live 1\' database', 0, '2023-01-31 17:14:04', '2023-01-31 17:14:04'),
(137, 'User Victor has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 17:14:28', '2023-01-31 17:14:28'),
(138, 'User Victor has logged in successfully', 5, '2023-01-31 17:14:29', '2023-01-31 17:14:29'),
(139, 'New user with email \'neema@gmail.com\' has been created', 5, '2023-01-31 19:33:25', '2023-01-31 19:33:25'),
(140, 'User Victor Massam has logged out', 5, '2023-01-31 19:58:56', '2023-01-31 19:58:56'),
(141, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 19:59:05', '2023-01-31 19:59:05'),
(142, 'User Victor Massam has logged in successfully', 5, '2023-01-31 19:59:05', '2023-01-31 19:59:05'),
(143, 'User Victor Massam has logged out', 5, '2023-01-31 20:21:57', '2023-01-31 20:21:57'),
(144, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 20:25:50', '2023-01-31 20:25:50'),
(145, 'User Victor Massam has logged in successfully', 5, '2023-01-31 20:25:50', '2023-01-31 20:25:50'),
(146, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 20:40:25', '2023-01-31 20:40:25'),
(147, 'User Victor Massam has logged in successfully', 5, '2023-01-31 20:40:25', '2023-01-31 20:40:25'),
(148, 'User admin@clidimis has already been logged in!', 0, '2023-01-31 20:45:00', '2023-01-31 20:45:00'),
(149, 'Failed to login user admin@clidimis because his/her account is still/already logged in!', 0, '2023-01-31 20:46:49', '2023-01-31 20:46:49'),
(150, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-01-31 20:47:12', '2023-01-31 20:47:12'),
(151, 'User Victor Massam has logged in successfully', 5, '2023-01-31 20:47:12', '2023-01-31 20:47:12'),
(152, 'User \'neema@gmail.com\' has been recovered successfully', 5, '2023-01-31 21:12:51', '2023-01-31 21:12:51'),
(153, 'User \'neema@gmail.com\' has been deleted successfully', 5, '2023-01-31 21:13:39', '2023-01-31 21:13:39'),
(154, 'User \'neema@gmail.com\' has been recovered successfully', 5, '2023-01-31 21:13:51', '2023-01-31 21:13:51'),
(155, 'User \'neema@gmail.com\' has been deleted successfully', 5, '2023-01-31 21:14:07', '2023-01-31 21:14:07'),
(156, 'User \'admin@clidimis\' has tried to log out his/her account', 5, '2023-01-31 21:36:13', '2023-01-31 21:36:13'),
(157, 'New user with email \'chobo@gmail.com\' has been created', 5, '2023-01-31 21:46:19', '2023-01-31 21:46:19'),
(158, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 21:46:50', '2023-01-31 21:46:50'),
(159, 'User \'admin@clidimis\' has tried to unlock his/her account', 5, '2023-01-31 21:50:26', '2023-01-31 21:50:26'),
(160, 'User \'admin@clidimis\' has tried to unlock his/her account', 5, '2023-01-31 21:51:22', '2023-01-31 21:51:22'),
(161, 'User \'chobo@gmail.com\' has been unlocked successfully', 5, '2023-01-31 21:52:05', '2023-01-31 21:52:05'),
(162, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 21:53:36', '2023-01-31 21:53:36'),
(163, 'User \'neema@gmail.com\' has been recovered successfully', 5, '2023-01-31 21:55:51', '2023-01-31 21:55:51'),
(164, 'User neema@gmail.com has failed to log in because he/she has been assigned \'Mysql Clidimis Live 1\' database', 0, '2023-01-31 21:57:14', '2023-01-31 21:57:14'),
(165, 'User chobo@gmail.com has failed to log in because he/she has been locked', 0, '2023-01-31 21:57:46', '2023-01-31 21:57:46'),
(166, 'User \'chobo@gmail.com\' has been unlocked successfully', 5, '2023-01-31 21:57:55', '2023-01-31 21:57:55'),
(167, 'User chobo@gmail.com has failed to log in', 0, '2023-01-31 21:58:12', '2023-01-31 21:58:12'),
(168, 'User Dr Jafary S. Chobo has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 13, '2023-01-31 21:58:36', '2023-01-31 21:58:36'),
(169, 'User Dr Jafary S. Chobo has logged in successfully', 13, '2023-01-31 21:58:36', '2023-01-31 21:58:36'),
(170, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 22:00:11', '2023-01-31 22:00:11'),
(171, 'User \'chobo@gmail.com\' has been unlocked successfully', 5, '2023-01-31 22:00:34', '2023-01-31 22:00:34'),
(172, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 22:01:47', '2023-01-31 22:01:47'),
(173, 'User \'chobo@gmail.com\' has been unlocked successfully', 5, '2023-01-31 22:02:28', '2023-01-31 22:02:28'),
(174, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 22:03:25', '2023-01-31 22:03:25'),
(175, 'User \'chobo@gmail.com\' has been unlocked successfully', 5, '2023-01-31 22:04:05', '2023-01-31 22:04:05'),
(176, 'Failed to login user chobo@gmail.com because his/her account is still/already logged in!', 0, '2023-01-31 22:12:32', '2023-01-31 22:12:32'),
(177, 'User \'chobo@gmail.com\' has been force logged out by Admin successfully', 5, '2023-01-31 22:13:06', '2023-01-31 22:13:06'),
(178, 'User Dr Jafary S. Chobo has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 13, '2023-01-31 22:13:24', '2023-01-31 22:13:24'),
(179, 'User Dr Jafary S. Chobo has logged in successfully', 13, '2023-01-31 22:13:24', '2023-01-31 22:13:24'),
(180, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 22:15:00', '2023-01-31 22:15:00'),
(181, 'User \'chobo@gmail.com\' has been unlocked successfully', 5, '2023-01-31 22:15:28', '2023-01-31 22:15:28'),
(182, 'Failed to login user chobo@gmail.com because his/her account is still/already logged in!', 0, '2023-01-31 22:19:47', '2023-01-31 22:19:47'),
(183, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 22:19:57', '2023-01-31 22:19:57'),
(184, 'User \'chobo@gmail.com\' has been unlocked successfully', 5, '2023-01-31 22:20:11', '2023-01-31 22:20:11'),
(185, 'User \'chobo@gmail.com\' has been force logged out by Admin successfully', 5, '2023-01-31 22:20:19', '2023-01-31 22:20:19'),
(186, 'User Dr Jafary S. Chobo has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 13, '2023-01-31 22:20:35', '2023-01-31 22:20:35'),
(187, 'User Dr Jafary S. Chobo has logged in successfully', 13, '2023-01-31 22:20:35', '2023-01-31 22:20:35'),
(188, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 22:21:06', '2023-01-31 22:21:06'),
(189, 'User \'chobo@gmail.com\' has been unlocked successfully', 5, '2023-01-31 22:21:30', '2023-01-31 22:21:30'),
(190, 'User Dr Jafary S. Chobo has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 13, '2023-01-31 22:21:55', '2023-01-31 22:21:55'),
(191, 'User Dr Jafary S. Chobo has logged in successfully', 13, '2023-01-31 22:21:55', '2023-01-31 22:21:55'),
(192, 'User \'chobo@gmail.com\' has been force logged out by Admin successfully', 5, '2023-01-31 22:22:17', '2023-01-31 22:22:17'),
(193, 'User Dr Jafary S. Chobo has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 13, '2023-01-31 22:22:46', '2023-01-31 22:22:46'),
(194, 'User Dr Jafary S. Chobo has logged in successfully', 13, '2023-01-31 22:22:46', '2023-01-31 22:22:46'),
(195, 'User \'chobo@gmail.com\' has been deleted successfully', 5, '2023-01-31 22:23:08', '2023-01-31 22:23:08'),
(196, 'User \'chobo@gmail.com\' has been recovered successfully', 5, '2023-01-31 22:23:25', '2023-01-31 22:23:25'),
(197, 'User chobo@gmail.com has failed to log in because recaptcha has expired', 0, '2023-01-31 22:28:32', '2023-01-31 22:28:32'),
(198, 'User chobo@gmail.com has failed to log in because he/she has been assigned \'Mysql Clidimis Live 1\' database', 0, '2023-01-31 22:28:50', '2023-01-31 22:28:50'),
(199, 'User \'chobo@gmail.com\' has been locked successfully', 5, '2023-01-31 22:29:24', '2023-01-31 22:29:24'),
(200, 'User \'neema@gmail.com\' has been deleted successfully', 5, '2023-01-31 22:32:20', '2023-01-31 22:32:20'),
(201, 'User \'chobo@gmail.com\' has been deleted successfully', 5, '2023-01-31 22:32:31', '2023-01-31 22:32:31'),
(202, 'User \'chobo@gmail.com\' has been recovered successfully', 5, '2023-01-31 22:32:38', '2023-01-31 22:32:38'),
(203, 'User \'neema@gmail.com\' has been recovered successfully', 5, '2023-01-31 22:32:46', '2023-01-31 22:32:46'),
(204, 'User Dr Jafary S. Chobo has logged out', 13, '2023-01-31 22:46:36', '2023-01-31 22:46:36'),
(205, 'User with email \'neema@gmail.com\' has been updated successfully', 5, '2023-01-31 22:58:06', '2023-01-31 22:58:06'),
(206, 'User with email \'neema@gmail.com\' has been updated successfully', 5, '2023-01-31 23:02:27', '2023-01-31 23:02:27'),
(207, 'User with email \'neema@gmail.com\' has been updated successfully', 5, '2023-01-31 23:03:38', '2023-01-31 23:03:38'),
(208, 'User neema@gmail.com has exceeded more than 3 login attempts therefore his/her account has been locked', 0, '2023-01-31 23:05:03', '2023-01-31 23:05:03'),
(209, 'User neema@gmail.com has failed to log in because of wrong username or password', 0, '2023-01-31 23:05:03', '2023-01-31 23:05:03'),
(210, 'User neema@gmail.com has failed to log in because he/she has been locked', 0, '2023-01-31 23:06:06', '2023-01-31 23:06:06'),
(211, 'User \'neema@gmail.com\' has been unlocked successfully', 5, '2023-01-31 23:10:47', '2023-01-31 23:10:47'),
(212, 'User neema@gmail.com has failed to log in because of wrong username or password', 0, '2023-01-31 23:12:11', '2023-01-31 23:12:11'),
(213, 'User neema@gmail.com has exceeded more than 3 login attempts therefore his/her account has been locked', 0, '2023-01-31 23:12:12', '2023-01-31 23:12:12'),
(214, 'User neema@gmail.com has failed to log in because he/she has been locked', 0, '2023-01-31 23:12:53', '2023-01-31 23:12:53'),
(215, 'User \'neema@gmail.com\' has been unlocked successfully', 5, '2023-01-31 23:13:16', '2023-01-31 23:13:16'),
(216, 'User Neema Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 12, '2023-01-31 23:13:36', '2023-01-31 23:13:36'),
(217, 'User Neema Edward has logged in successfully', 12, '2023-01-31 23:13:36', '2023-01-31 23:13:36'),
(218, 'User Neema Edward has logged out', 12, '2023-01-31 23:13:43', '2023-01-31 23:13:43'),
(219, 'User neema@gmail.com has failed to log in because of wrong username or password', 0, '2023-01-31 23:14:09', '2023-01-31 23:14:09'),
(220, 'User neema@gmail.com has failed to log in because of wrong username or password', 0, '2023-01-31 23:14:28', '2023-01-31 23:14:28'),
(221, 'User neema@gmail.com has failed to log in because of wrong username or password', 0, '2023-01-31 23:15:12', '2023-01-31 23:15:12'),
(222, 'User neema@gmail.com has failed to log in because of wrong username or password', 0, '2023-01-31 23:15:52', '2023-01-31 23:15:52'),
(223, 'User neema@gmail.com has exceeded more than 3 login attempts therefore his/her account has been locked', 0, '2023-01-31 23:15:52', '2023-01-31 23:15:52'),
(224, 'User with email \'neema@gmail.com\' has been updated successfully', 5, '2023-01-31 23:26:51', '2023-01-31 23:26:51'),
(225, 'User Victor Massam has logged out', 5, '2023-02-01 03:04:35', '2023-02-01 03:04:35'),
(226, 'User admin@clidimis has failed to log in because of wrong username or password', 0, '2023-02-01 03:04:56', '2023-02-01 03:04:56'),
(227, 'User admin@clidimis has failed to log in because recaptcha has expired', 0, '2023-02-01 03:05:40', '2023-02-01 03:05:40'),
(228, 'User admin@clidimis has failed to log in because of wrong username or password', 0, '2023-02-01 03:06:00', '2023-02-01 03:06:00'),
(229, 'User admin@clidimis has exceeded more than 3 login attempts therefore his/her account has been locked', 0, '2023-02-01 03:06:00', '2023-02-01 03:06:00'),
(230, 'User admin@clidimis has failed to log in because he/she has been locked', 0, '2023-02-01 03:07:22', '2023-02-01 03:07:22'),
(231, 'User admin@clidimis has failed to log in because recaptcha has expired', 0, '2023-02-01 03:08:52', '2023-02-01 03:08:52'),
(232, 'User admin@clidimis has failed to log in because of wrong username or password', 0, '2023-02-01 03:10:05', '2023-02-01 03:10:05'),
(233, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 03:10:18', '2023-02-01 03:10:18'),
(234, 'User Victor Massam has logged in successfully', 5, '2023-02-01 03:10:18', '2023-02-01 03:10:18'),
(235, 'Failed to login user admin@clidimis because his/her account is still/already logged in!', 0, '2023-02-01 03:38:38', '2023-02-01 03:38:38'),
(236, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 03:39:44', '2023-02-01 03:39:44'),
(237, 'User Victor Massam has logged in successfully', 5, '2023-02-01 03:39:44', '2023-02-01 03:39:44'),
(238, 'Failed to login user admin@clidimis because his/her account is still/already logged in!', 0, '2023-02-01 08:37:31', '2023-02-01 08:37:31'),
(239, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 08:38:48', '2023-02-01 08:38:48'),
(240, 'User Victor Massam has logged in successfully', 5, '2023-02-01 08:38:48', '2023-02-01 08:38:48'),
(241, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 08:43:02', '2023-02-01 08:43:02'),
(242, 'User Victor Massam has logged in successfully', 5, '2023-02-01 08:43:02', '2023-02-01 08:43:02'),
(243, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 08:50:21', '2023-02-01 08:50:21'),
(244, 'User Victor Massam has logged in successfully', 5, '2023-02-01 08:50:21', '2023-02-01 08:50:21'),
(245, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 09:02:58', '2023-02-01 09:02:58'),
(246, 'User Victor Massam has logged in successfully', 5, '2023-02-01 09:02:58', '2023-02-01 09:02:58'),
(247, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 09:23:08', '2023-02-01 09:23:08'),
(248, 'User Victor Massam has logged in successfully', 5, '2023-02-01 09:23:08', '2023-02-01 09:23:08'),
(249, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 09:43:46', '2023-02-01 09:43:46'),
(250, 'User Victor Massam has logged in successfully', 5, '2023-02-01 09:43:46', '2023-02-01 09:43:46'),
(251, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 09:53:16', '2023-02-01 09:53:16'),
(252, 'User Victor Massam has logged in successfully', 5, '2023-02-01 09:53:16', '2023-02-01 09:53:16'),
(253, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 09:53:42', '2023-02-01 09:53:42'),
(254, 'User Victor Massam has logged in successfully', 5, '2023-02-01 09:53:42', '2023-02-01 09:53:42'),
(255, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 09:55:37', '2023-02-01 09:55:37'),
(256, 'User Victor Massam has logged in successfully', 5, '2023-02-01 09:55:37', '2023-02-01 09:55:37'),
(257, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 10:00:37', '2023-02-01 10:00:37'),
(258, 'User Victor Massam has logged in successfully', 5, '2023-02-01 10:00:37', '2023-02-01 10:00:37'),
(259, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 10:04:30', '2023-02-01 10:04:30'),
(260, 'User Victor Massam has logged in successfully', 5, '2023-02-01 10:04:30', '2023-02-01 10:04:30'),
(261, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 10:20:21', '2023-02-01 10:20:21'),
(262, 'User Victor Massam has logged in successfully', 5, '2023-02-01 10:20:21', '2023-02-01 10:20:21'),
(263, 'User Victor Massam has logged out', 5, '2023-02-01 10:25:22', '2023-02-01 10:25:22'),
(264, 'User admin@clidimis has failed to log in due to incorrect recaptcha', 0, '2023-02-01 10:28:02', '2023-02-01 10:28:02'),
(265, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 10:28:17', '2023-02-01 10:28:17'),
(266, 'User Victor Massam has logged in successfully', 5, '2023-02-01 10:28:17', '2023-02-01 10:28:17'),
(267, 'User Victor Massam has logged out', 5, '2023-02-01 10:31:16', '2023-02-01 10:31:16'),
(268, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 10:32:58', '2023-02-01 10:32:58'),
(269, 'User Victor Massam has logged in successfully', 5, '2023-02-01 10:32:58', '2023-02-01 10:32:58'),
(270, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 10:46:10', '2023-02-01 10:46:10'),
(271, 'User Victor Massam has logged in successfully', 5, '2023-02-01 10:46:10', '2023-02-01 10:46:10'),
(272, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 13:58:09', '2023-02-01 13:58:09'),
(273, 'User Victor Massam has logged in successfully', 5, '2023-02-01 13:58:09', '2023-02-01 13:58:09'),
(274, 'System Setting \'session_idle_time\' has been updated from value: 600000 to 600000', 5, '2023-02-01 14:46:24', '2023-02-01 14:46:24'),
(275, 'User Victor Massam has logged out', 5, '2023-02-01 15:50:20', '2023-02-01 15:50:20'),
(276, 'User admin@clidimis has failed to log in because recaptcha has expired', 0, '2023-02-01 15:51:03', '2023-02-01 15:51:03'),
(277, 'User admin@clidimis has failed to log in due to incorrect recaptcha', 0, '2023-02-01 15:51:58', '2023-02-01 15:51:58'),
(278, 'User admin@clidimis has failed to log in due to incorrect recaptcha', 0, '2023-02-01 15:52:18', '2023-02-01 15:52:18'),
(279, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 15:54:09', '2023-02-01 15:54:09'),
(280, 'User Victor Massam has logged in successfully', 5, '2023-02-01 15:54:09', '2023-02-01 15:54:09'),
(281, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 16:07:34', '2023-02-01 16:07:34'),
(282, 'User Victor Massam has logged in successfully', 5, '2023-02-01 16:07:34', '2023-02-01 16:07:34'),
(283, 'User admin@clidimis has failed to log in because recaptcha has expired', 0, '2023-02-01 16:52:14', '2023-02-01 16:52:14'),
(284, 'User admin@clidimis has failed to log in because recaptcha has expired', 0, '2023-02-01 16:53:03', '2023-02-01 16:53:03'),
(285, 'User admin@clidimis has failed to log in because recaptcha has expired', 0, '2023-02-01 17:19:41', '2023-02-01 17:19:41'),
(286, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 17:20:13', '2023-02-01 17:20:13'),
(287, 'User Victor Massam has logged in successfully', 5, '2023-02-01 17:20:13', '2023-02-01 17:20:13'),
(288, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 21:27:41', '2023-02-01 21:27:41'),
(289, 'User Victor Massam has logged in successfully', 5, '2023-02-01 21:27:41', '2023-02-01 21:27:41'),
(290, 'Failed to login user admin@clidimis because his/her account is still/already logged in!', 0, '2023-02-01 23:02:04', '2023-02-01 23:02:04'),
(291, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 23:04:21', '2023-02-01 23:04:21'),
(292, 'User Victor Massam has logged in successfully', 5, '2023-02-01 23:04:21', '2023-02-01 23:04:21'),
(293, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-01 23:23:48', '2023-02-01 23:23:48'),
(294, 'User Victor Massam has logged in successfully', 5, '2023-02-01 23:23:48', '2023-02-01 23:23:48'),
(295, 'User Victor Massam has logged out', 5, '2023-02-01 23:28:54', '2023-02-01 23:28:54'),
(296, 'User admin@clidimis has failed to log in because recaptcha has expired', 0, '2023-02-02 06:46:55', '2023-02-02 06:46:55'),
(297, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-02 06:47:14', '2023-02-02 06:47:14'),
(298, 'User Victor Massam has logged in successfully', 5, '2023-02-02 06:47:14', '2023-02-02 06:47:14'),
(299, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-02 07:05:03', '2023-02-02 07:05:03'),
(300, 'User Victor Massam has logged in successfully', 5, '2023-02-02 07:05:03', '2023-02-02 07:05:03'),
(301, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-02 07:15:48', '2023-02-02 07:15:48'),
(302, 'User Victor Massam has logged in successfully', 5, '2023-02-02 07:15:49', '2023-02-02 07:15:49'),
(303, 'System Setting \'session_idle_time\' has been updated from value: 600000 to 3600000', 5, '2023-02-02 07:18:40', '2023-02-02 07:18:40'),
(304, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-02 07:46:01', '2023-02-02 07:46:01'),
(305, 'User Victor Massam has logged in successfully', 5, '2023-02-02 07:46:01', '2023-02-02 07:46:01'),
(306, 'User aziza@saccos has failed to log in because he/she does not exist', 0, '2023-02-03 13:22:30', '2023-02-03 13:22:30'),
(307, 'Failed to login user admin@clidaims because his/her account is still/already logged in!', 0, '2023-02-03 13:23:12', '2023-02-03 13:23:12'),
(308, 'User admin@clidaims has failed to log in because he/she has been assigned \'Mysql Clidimis Live 1\' database', 0, '2023-02-03 13:24:17', '2023-02-03 13:24:17'),
(309, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-03 13:25:38', '2023-02-03 13:25:38'),
(310, 'User Victor Massam has logged in successfully', 5, '2023-02-03 13:25:38', '2023-02-03 13:25:38'),
(311, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-04 06:30:46', '2023-02-04 06:30:46'),
(312, 'User Victor Massam has logged in successfully', 5, '2023-02-04 06:30:46', '2023-02-04 06:30:46'),
(313, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-04 19:14:20', '2023-02-04 19:14:20'),
(314, 'User Victor Massam has logged in successfully', 5, '2023-02-04 19:14:20', '2023-02-04 19:14:20'),
(315, 'Failed to login user admin@clidaims because his/her account is still/already logged in!', 0, '2023-02-09 01:56:35', '2023-02-09 01:56:35'),
(316, 'User admin@clidaims has failed to log in because recaptcha has expired', 0, '2023-02-09 03:22:24', '2023-02-09 03:22:24'),
(317, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-09 03:22:37', '2023-02-09 03:22:37'),
(318, 'User Victor Massam has logged in successfully', 5, '2023-02-09 03:22:37', '2023-02-09 03:22:37'),
(319, 'User admin@clidaims has failed to log in because recaptcha has expired', 0, '2023-02-14 07:41:01', '2023-02-14 07:41:01'),
(320, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-14 07:41:42', '2023-02-14 07:41:42'),
(321, 'User Victor Massam has logged in successfully', 5, '2023-02-14 07:41:42', '2023-02-14 07:41:42'),
(322, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-14 19:25:33', '2023-02-14 19:25:33'),
(323, 'User Victor Massam has logged in successfully', 5, '2023-02-14 19:25:34', '2023-02-14 19:25:34'),
(324, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-15 06:36:07', '2023-02-15 06:36:07'),
(325, 'User Victor Massam has logged in successfully', 5, '2023-02-15 06:36:08', '2023-02-15 06:36:08'),
(326, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-02-24 08:29:36', '2023-02-24 08:29:36'),
(327, 'User Victor Massam has logged in successfully', 5, '2023-02-24 08:29:36', '2023-02-24 08:29:36'),
(328, 'Failed to login user admin@clidaims because his/her account is still/already logged in!', 0, '2023-03-02 08:37:53', '2023-03-02 08:37:53'),
(329, 'User admin@clidaims has failed to log in because recaptcha has expired', 0, '2023-03-02 08:50:33', '2023-03-02 08:50:33'),
(330, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-03-02 08:50:46', '2023-03-02 08:50:46'),
(331, 'User Minga Edward has logged in successfully', 5, '2023-03-02 08:50:46', '2023-03-02 08:50:46'),
(332, 'Failed to login user admin@clidaims because his/her account is still/already logged in!', 0, '2023-03-05 14:42:04', '2023-03-05 14:42:04'),
(333, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-03-05 14:43:09', '2023-03-05 14:43:09'),
(334, 'User Minga Edward has logged in successfully', 5, '2023-03-05 14:43:09', '2023-03-05 14:43:09'),
(335, 'User admin@clidimis has failed to log in because his/her account does not exist', 0, '2023-03-09 09:48:47', '2023-03-09 09:48:47'),
(336, 'User admin@clidimis has failed to log in because his/her account does not exist', 0, '2023-03-09 09:54:49', '2023-03-09 09:54:49'),
(337, 'User admin@clidimis has failed to log in because his/her account does not exist', 0, '2023-03-09 10:01:38', '2023-03-09 10:01:38'),
(338, 'Failed to login user admin@clidaims because his/her account is still/already logged in!', 0, '2023-03-09 10:02:40', '2023-03-09 10:02:40'),
(339, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-03-09 10:03:11', '2023-03-09 10:03:11'),
(340, 'User Minga Edward has logged in successfully', 5, '2023-03-09 10:03:11', '2023-03-09 10:03:11'),
(341, 'Failed to login user admin@clidaims because his/her account is still/already logged in!', 0, '2023-03-13 13:31:41', '2023-03-13 13:31:41'),
(342, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-03-13 13:49:43', '2023-03-13 13:49:43'),
(343, 'User Minga Edward has logged in successfully', 5, '2023-03-13 13:49:43', '2023-03-13 13:49:43'),
(344, 'Failed to login user admin@clidaims because his/her account is still/already logged in!', 0, '2023-04-03 11:26:22', '2023-04-03 11:26:22'),
(345, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-03 11:29:14', '2023-04-03 11:29:14'),
(346, 'User Minga Edward has logged in successfully', 5, '2023-04-03 11:29:14', '2023-04-03 11:29:14'),
(347, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-17 08:50:04', '2023-04-17 08:50:04'),
(348, 'User Minga Edward has logged in successfully', 5, '2023-04-17 08:50:05', '2023-04-17 08:50:05'),
(349, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-17 11:09:44', '2023-04-17 11:09:44'),
(350, 'User Minga Edward has logged in successfully', 5, '2023-04-17 11:09:44', '2023-04-17 11:09:44'),
(351, 'User admin@clidaims has failed to log in because recaptcha has expired', 0, '2023-04-17 12:40:14', '2023-04-17 12:40:14'),
(352, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-17 12:40:27', '2023-04-17 12:40:27'),
(353, 'User Minga Edward has logged in successfully', 5, '2023-04-17 12:40:27', '2023-04-17 12:40:27'),
(354, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-23 13:46:33', '2023-04-23 13:46:33'),
(355, 'User Minga Edward has logged in successfully', 5, '2023-04-23 13:46:33', '2023-04-23 13:46:33'),
(356, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-24 04:14:41', '2023-04-24 04:14:41'),
(357, 'User Minga Edward has logged in successfully', 5, '2023-04-24 04:14:41', '2023-04-24 04:14:41'),
(358, 'User admin@clidaims has failed to log in because CAPTCHA has expired', 0, '2023-04-24 05:46:47', '2023-04-24 05:46:47'),
(359, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-24 05:47:07', '2023-04-24 05:47:07'),
(360, 'User Victor Massam has logged in successfully', 5, '2023-04-24 05:47:07', '2023-04-24 05:47:07'),
(361, 'User Victor Massam has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-26 04:52:15', '2023-04-26 04:52:15'),
(362, 'User Victor Massam has logged in successfully', 5, '2023-04-26 04:52:15', '2023-04-26 04:52:15'),
(363, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-26 08:59:02', '2023-04-26 08:59:02'),
(364, 'User Minga Edward has logged in successfully', 5, '2023-04-26 08:59:03', '2023-04-26 08:59:03'),
(365, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-26 13:13:10', '2023-04-26 13:13:10'),
(366, 'User Minga Edward has logged in successfully', 5, '2023-04-26 13:13:10', '2023-04-26 13:13:10'),
(367, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-27 05:27:07', '2023-04-27 05:27:07'),
(368, 'User Minga Edward has logged in successfully', 5, '2023-04-27 05:27:07', '2023-04-27 05:27:07'),
(369, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-27 17:26:16', '2023-04-27 17:26:16'),
(370, 'User Minga Edward has logged in successfully', 5, '2023-04-27 17:26:16', '2023-04-27 17:26:16'),
(371, 'User admin@clidaims has failed to log in because he/she has been assigned \'Mysql Clidimis Live 1\' database', 0, '2023-04-28 00:57:15', '2023-04-28 00:57:15'),
(372, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-28 00:58:42', '2023-04-28 00:58:42'),
(373, 'User Minga Edward has logged in successfully', 5, '2023-04-28 00:58:42', '2023-04-28 00:58:42'),
(374, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-04-30 05:29:36', '2023-04-30 05:29:36'),
(375, 'User Minga Edward has logged in successfully', 5, '2023-04-30 05:29:36', '2023-04-30 05:29:36'),
(376, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-05-02 05:28:43', '2023-05-02 05:28:43'),
(377, 'User Minga Edward has logged in successfully', 5, '2023-05-02 05:28:43', '2023-05-02 05:28:43'),
(378, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-05-03 05:45:32', '2023-05-03 05:45:32'),
(379, 'User Minga Edward has logged in successfully', 5, '2023-05-03 05:45:32', '2023-05-03 05:45:32'),
(380, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-05-06 02:56:56', '2023-05-06 02:56:56'),
(381, 'User Minga Edward has logged in successfully', 5, '2023-05-06 02:56:56', '2023-05-06 02:56:56'),
(382, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-05-24 05:57:06', '2023-05-24 05:57:06'),
(383, 'User Minga Edward has logged in successfully', 5, '2023-05-24 05:57:06', '2023-05-24 05:57:06'),
(384, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-05-26 12:14:13', '2023-05-26 12:14:13'),
(385, 'User Minga Edward has logged in successfully', 5, '2023-05-26 12:14:13', '2023-05-26 12:14:13'),
(386, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-05-28 12:29:02', '2023-05-28 12:29:02'),
(387, 'User Minga Edward has logged in successfully', 5, '2023-05-28 12:29:02', '2023-05-28 12:29:02'),
(388, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-05-29 01:47:13', '2023-05-29 01:47:13'),
(389, 'User Minga Edward has logged in successfully', 5, '2023-05-29 01:47:13', '2023-05-29 01:47:13'),
(390, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-05-29 04:20:29', '2023-05-29 04:20:29'),
(391, 'User Minga Edward has logged in successfully', 5, '2023-05-29 04:20:29', '2023-05-29 04:20:29'),
(392, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-02 08:34:16', '2023-06-02 08:34:16'),
(393, 'User Minga Edward has logged in successfully', 5, '2023-06-02 08:34:16', '2023-06-02 08:34:16'),
(394, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-03 05:20:12', '2023-06-03 05:20:12'),
(395, 'User Minga Edward has logged in successfully', 5, '2023-06-03 05:20:12', '2023-06-03 05:20:12'),
(396, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-03 07:38:04', '2023-06-03 07:38:04'),
(397, 'User Minga Edward has logged in successfully', 5, '2023-06-03 07:38:04', '2023-06-03 07:38:04'),
(398, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-03 10:37:48', '2023-06-03 10:37:48'),
(399, 'User Minga Edward has logged in successfully', 5, '2023-06-03 10:37:48', '2023-06-03 10:37:48'),
(400, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-03 14:44:10', '2023-06-03 14:44:10'),
(401, 'User Minga Edward has logged in successfully', 5, '2023-06-03 14:44:10', '2023-06-03 14:44:10'),
(402, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-03 18:51:30', '2023-06-03 18:51:30'),
(403, 'User Minga Edward has logged in successfully', 5, '2023-06-03 18:51:31', '2023-06-03 18:51:31'),
(404, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-03 14:13:02', '2023-06-03 14:13:02'),
(405, 'User Minga Edward has logged in successfully', 5, '2023-06-03 14:13:02', '2023-06-03 14:13:02'),
(406, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-04 04:06:50', '2023-06-04 04:06:50'),
(407, 'User Minga Edward has logged in successfully', 5, '2023-06-04 04:06:50', '2023-06-04 04:06:50'),
(408, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-05 11:39:52', '2023-06-05 11:39:52'),
(409, 'User Minga Edward has logged in successfully', 5, '2023-06-05 11:39:53', '2023-06-05 11:39:53'),
(410, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-06 02:46:59', '2023-06-06 02:46:59'),
(411, 'User Minga Edward has logged in successfully', 5, '2023-06-06 02:46:59', '2023-06-06 02:46:59');
INSERT INTO `logs` (`id`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(412, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-06 09:31:00', '2023-06-06 09:31:00'),
(413, 'User Minga Edward has logged in successfully', 5, '2023-06-06 09:31:00', '2023-06-06 09:31:00'),
(414, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-06 15:56:49', '2023-06-06 15:56:49'),
(415, 'User Minga Edward has logged in successfully', 5, '2023-06-06 15:56:49', '2023-06-06 15:56:49'),
(416, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-07 08:50:52', '2023-06-07 08:50:52'),
(417, 'User Minga Edward has logged in successfully', 5, '2023-06-07 08:50:52', '2023-06-07 08:50:52'),
(418, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-07 16:41:13', '2023-06-07 16:41:13'),
(419, 'User Minga Edward has logged in successfully', 5, '2023-06-07 16:41:13', '2023-06-07 16:41:13'),
(420, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-08 01:05:41', '2023-06-08 01:05:41'),
(421, 'User Minga Edward has logged in successfully', 5, '2023-06-08 01:05:41', '2023-06-08 01:05:41'),
(422, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-12 03:29:31', '2023-06-12 03:29:31'),
(423, 'User Minga Edward has logged in successfully', 5, '2023-06-12 03:29:31', '2023-06-12 03:29:31'),
(424, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-12 06:13:02', '2023-06-12 06:13:02'),
(425, 'User Minga Edward has logged in successfully', 5, '2023-06-12 06:13:02', '2023-06-12 06:13:02'),
(426, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-12 20:01:52', '2023-06-12 20:01:52'),
(427, 'User Minga Edward has logged in successfully', 5, '2023-06-12 20:01:52', '2023-06-12 20:01:52'),
(428, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-13 05:42:13', '2023-06-13 05:42:13'),
(429, 'User Minga Edward has logged in successfully', 5, '2023-06-13 05:42:13', '2023-06-13 05:42:13'),
(430, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-13 11:05:30', '2023-06-13 11:05:30'),
(431, 'User Minga Edward has logged in successfully', 5, '2023-06-13 11:05:30', '2023-06-13 11:05:30'),
(432, 'User Minga Edward has switched database to \'clidata\' and connection to \'Mysql Clidimis Live 1\'', 5, '2023-06-20 09:35:45', '2023-06-20 09:35:45'),
(433, 'User Minga Edward has logged in successfully', 5, '2023-06-20 09:35:45', '2023-06-20 09:35:45'),
(434, 'User Minga Edward has logged out', 5, '2023-06-22 09:59:59', '2023-06-22 09:59:59'),
(435, 'User Minga Edward has logged out', 5, '2023-06-22 10:00:56', '2023-06-22 10:00:56'),
(436, 'User Minga Edward has logged out', 5, '2023-06-22 11:38:16', '2023-06-22 11:38:16'),
(437, 'User Francis  Mashala has logged out', 18, '2023-06-23 06:40:45', '2023-06-23 06:40:45'),
(438, 'User Francis M Mashala has logged out', 24, '2023-06-23 08:02:37', '2023-06-23 08:02:37'),
(439, 'User Francis M Mashala has logged out', 25, '2023-06-23 08:36:36', '2023-06-23 08:36:36'),
(440, 'User Isaac C Mwita has logged out', 26, '2023-06-23 08:57:50', '2023-06-23 08:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 5),
(19, 'App\\Models\\User', 12),
(19, 'App\\Models\\User', 13),
(19, 'App\\Models\\User', 20),
(19, 'App\\Models\\User', 25),
(20, 'App\\Models\\User', 21),
(21, 'App\\Models\\User', 12),
(21, 'App\\Models\\User', 21);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_permission', 'web', '2019-07-25 16:35:11', '2019-07-25 16:35:11'),
(2, 'add_permission', 'web', '2019-07-25 16:35:11', '2019-07-25 16:35:11'),
(3, 'edit_permission', 'web', '2019-07-25 16:35:11', '2019-07-25 16:35:11'),
(4, 'delete_permission', 'web', '2019-07-25 16:35:11', '2019-07-25 16:35:11'),
(5, 'view_role', 'web', '2019-07-25 16:35:11', '2019-07-25 16:35:11'),
(6, 'add_role', 'web', '2019-07-25 16:35:11', '2019-07-25 16:35:11'),
(7, 'edit_role', 'web', '2019-07-25 16:35:11', '2019-07-25 16:35:11'),
(8, 'delete_role', 'web', '2019-07-25 16:35:12', '2019-07-25 16:35:12'),
(9, 'view_user', 'web', '2019-07-25 16:35:12', '2019-07-25 16:35:12'),
(10, 'add_user', 'web', '2019-07-25 16:35:12', '2019-07-25 16:35:12'),
(11, 'edit_user', 'web', '2019-07-25 16:35:12', '2019-07-25 16:35:12'),
(12, 'delete_user', 'web', '2019-07-25 16:35:12', '2019-07-25 16:35:12'),
(433, 'view_academic_evaluation_type', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(434, 'add_academic_evaluation_type', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(435, 'edit_academic_evaluation_type', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(436, 'delete_academic_evaluation_type', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(437, 'view_age', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(438, 'add_age', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(439, 'edit_age', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(440, 'delete_age', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(441, 'view_applicant', 'web', '2020-09-27 17:15:33', '2020-09-27 17:15:33'),
(442, 'add_applicant', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(443, 'edit_applicant', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(444, 'delete_applicant', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(445, 'view_application_reason', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(446, 'add_application_reason', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(447, 'edit_application_reason', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(448, 'delete_application_reason', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(449, 'view_application_type', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(450, 'add_application_type', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(451, 'edit_application_type', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(452, 'delete_application_type', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(453, 'view_attendance', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(454, 'add_attendance', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(455, 'edit_attendance', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(456, 'delete_attendance', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(457, 'view_body_part', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(458, 'add_body_part', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(459, 'edit_body_part', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(460, 'delete_body_part', 'web', '2020-09-27 17:15:34', '2020-09-27 17:15:34'),
(461, 'view_book', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(462, 'add_book', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(463, 'edit_book', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(464, 'delete_book', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(465, 'view_calendar_year', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(466, 'add_calendar_year', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(467, 'edit_calendar_year', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(468, 'delete_calendar_year', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(469, 'view_comment', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(470, 'add_comment', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(471, 'edit_comment', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(472, 'delete_comment', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(473, 'view_country', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(474, 'add_country', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(475, 'edit_country', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(476, 'delete_country', 'web', '2020-09-27 17:15:35', '2020-09-27 17:15:35'),
(477, 'view_curriculum', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(478, 'add_curriculum', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(479, 'edit_curriculum', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(480, 'delete_curriculum', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(481, 'view_denomination', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(482, 'add_denomination', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(483, 'edit_denomination', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(484, 'delete_denomination', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(485, 'view_department', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(486, 'add_department', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(487, 'edit_department', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(488, 'delete_department', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(489, 'view_designation', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(490, 'add_designation', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(491, 'edit_designation', 'web', '2020-09-27 17:15:36', '2020-09-27 17:15:36'),
(492, 'delete_designation', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(493, 'view_district', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(494, 'add_district', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(495, 'edit_district', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(496, 'delete_district', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(497, 'view_education_level', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(498, 'add_education_level', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(499, 'edit_education_level', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(500, 'delete_education_level', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(501, 'view_employee', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(502, 'add_employee', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(503, 'edit_employee', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(504, 'delete_employee', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(505, 'view_employee_status', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(506, 'add_employee_status', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(507, 'edit_employee_status', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(508, 'delete_employee_status', 'web', '2020-09-27 17:15:37', '2020-09-27 17:15:37'),
(509, 'view_financial_year', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(510, 'add_financial_year', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(511, 'edit_financial_year', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(512, 'delete_financial_year', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(513, 'view_funding', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(514, 'add_funding', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(515, 'edit_funding', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(516, 'delete_funding', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(517, 'view_gender', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(518, 'add_gender', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(519, 'edit_gender', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(520, 'delete_gender', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(521, 'view_head_of_department', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(522, 'add_head_of_department', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(523, 'edit_head_of_department', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(524, 'delete_head_of_department', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(525, 'view_head_of_section', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(526, 'add_head_of_section', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(527, 'edit_head_of_section', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(528, 'delete_head_of_section', 'web', '2020-09-27 17:15:38', '2020-09-27 17:15:38'),
(529, 'view_language', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(530, 'add_language', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(531, 'edit_language', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(532, 'delete_language', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(533, 'view_lesson_break', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(534, 'add_lesson_break', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(535, 'edit_lesson_break', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(536, 'delete_lesson_break', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(537, 'view_month', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(538, 'add_month', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(539, 'edit_month', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(540, 'delete_month', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(541, 'view_occupation', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(542, 'add_occupation', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(543, 'edit_occupation', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(544, 'delete_occupation', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(545, 'view_post', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(546, 'add_post', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(547, 'edit_post', 'web', '2020-09-27 17:15:39', '2020-09-27 17:15:39'),
(548, 'delete_post', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(549, 'view_region', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(550, 'add_region', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(551, 'edit_region', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(552, 'delete_region', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(553, 'view_relationship', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(554, 'add_relationship', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(555, 'edit_relationship', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(556, 'delete_relationship', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(557, 'view_religion', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(558, 'add_religion', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(559, 'edit_religion', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(560, 'delete_religion', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(561, 'view_role_has_permission', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(562, 'add_role_has_permission', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(563, 'edit_role_has_permission', 'web', '2020-09-27 17:15:40', '2020-09-27 17:15:40'),
(564, 'delete_role_has_permission', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(565, 'view_scheme_of_work', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(566, 'add_scheme_of_work', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(567, 'edit_scheme_of_work', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(568, 'delete_scheme_of_work', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(569, 'view_scheme_of_works_source', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(570, 'add_scheme_of_works_source', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(571, 'edit_scheme_of_works_source', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(572, 'delete_scheme_of_works_source', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(573, 'view_school', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(574, 'add_school', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(575, 'edit_school', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(576, 'delete_school', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(577, 'view_school_day_break', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(578, 'add_school_day_break', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(579, 'edit_school_day_break', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(580, 'delete_school_day_break', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(581, 'view_school_day_period', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(582, 'add_school_day_period', 'web', '2020-09-27 17:15:41', '2020-09-27 17:15:41'),
(583, 'edit_school_day_period', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(584, 'delete_school_day_period', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(585, 'view_school_event', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(586, 'add_school_event', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(587, 'edit_school_event', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(588, 'delete_school_event', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(589, 'view_school_grade', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(590, 'add_school_grade', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(591, 'edit_school_grade', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(592, 'delete_school_grade', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(593, 'view_school_grade_division', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(594, 'add_school_grade_division', 'web', '2020-09-27 17:15:42', '2020-09-27 17:15:42'),
(595, 'edit_school_grade_division', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(596, 'delete_school_grade_division', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(597, 'view_school_grade_subject', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(598, 'add_school_grade_subject', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(599, 'edit_school_grade_subject', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(600, 'delete_school_grade_subject', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(601, 'view_school_mode', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(602, 'add_school_mode', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(603, 'edit_school_mode', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(604, 'delete_school_mode', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(605, 'view_section', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(606, 'add_section', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(607, 'edit_section', 'web', '2020-09-27 17:15:43', '2020-09-27 17:15:43'),
(608, 'delete_section', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(609, 'view_stream', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(610, 'add_stream', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(611, 'edit_stream', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(612, 'delete_stream', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(613, 'view_stream_time_table', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(614, 'add_stream_time_table', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(615, 'edit_stream_time_table', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(616, 'delete_stream_time_table', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(617, 'view_student', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(618, 'add_student', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(619, 'edit_student', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(620, 'delete_student', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(621, 'view_student_academic_evaluation', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(622, 'add_student_academic_evaluation', 'web', '2020-09-27 17:15:44', '2020-09-27 17:15:44'),
(623, 'edit_student_academic_evaluation', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(624, 'delete_student_academic_evaluation', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(625, 'view_student_grade', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(626, 'add_student_grade', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(627, 'edit_student_grade', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(628, 'delete_student_grade', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(629, 'view_student_grade_reason', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(630, 'add_student_grade_reason', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(631, 'edit_student_grade_reason', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(632, 'delete_student_grade_reason', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(633, 'view_sub_topic', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(634, 'add_sub_topic', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(635, 'edit_sub_topic', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(636, 'delete_sub_topic', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(637, 'view_subject', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(638, 'add_subject', 'web', '2020-09-27 17:15:45', '2020-09-27 17:15:45'),
(639, 'edit_subject', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(640, 'delete_subject', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(641, 'view_system_notification', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(642, 'add_system_notification', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(643, 'edit_system_notification', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(644, 'delete_system_notification', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(645, 'view_topic', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(646, 'add_topic', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(647, 'edit_topic', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(648, 'delete_topic', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(649, 'view_user_birth_info', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(650, 'add_user_birth_info', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(651, 'edit_user_birth_info', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(652, 'delete_user_birth_info', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(653, 'view_user_chronic_disease', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(654, 'add_user_chronic_disease', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(655, 'edit_user_chronic_disease', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(656, 'delete_user_chronic_disease', 'web', '2020-09-27 17:15:46', '2020-09-27 17:15:46'),
(657, 'view_user_disability', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(658, 'add_user_disability', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(659, 'edit_user_disability', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(660, 'delete_user_disability', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(661, 'view_user_education_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(662, 'add_user_education_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(663, 'edit_user_education_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(664, 'delete_user_education_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(665, 'view_user_father_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(666, 'add_user_father_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(667, 'edit_user_father_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(668, 'delete_user_father_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(669, 'view_user_guardian_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(670, 'add_user_guardian_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(671, 'edit_user_guardian_info', 'web', '2020-09-27 17:15:47', '2020-09-27 17:15:47'),
(672, 'delete_user_guardian_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(673, 'view_user_hobby', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(674, 'add_user_hobby', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(675, 'edit_user_hobby', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(676, 'delete_user_hobby', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(677, 'view_user_mother_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(678, 'add_user_mother_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(679, 'edit_user_mother_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(680, 'delete_user_mother_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(681, 'view_user_personal_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(682, 'add_user_personal_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(683, 'edit_user_personal_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(684, 'delete_user_personal_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(685, 'view_user_residence_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(686, 'add_user_residence_info', 'web', '2020-09-27 17:15:48', '2020-09-27 17:15:48'),
(687, 'edit_user_residence_info', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(688, 'delete_user_residence_info', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(689, 'view_user_skill', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(690, 'add_user_skill', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(691, 'edit_user_skill', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(692, 'delete_user_skill', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(693, 'view_user_work_experience', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(694, 'add_user_work_experience', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(695, 'edit_user_work_experience', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(696, 'delete_user_work_experience', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(697, 'view_week', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(698, 'add_week', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(699, 'edit_week', 'web', '2020-09-27 17:15:49', '2020-09-27 17:15:49'),
(700, 'delete_week', 'web', '2020-09-27 17:15:50', '2020-09-27 17:15:50'),
(701, 'view_week_day', 'web', '2020-09-27 17:15:50', '2020-09-27 17:15:50'),
(702, 'add_week_day', 'web', '2020-09-27 17:15:50', '2020-09-27 17:15:50'),
(703, 'edit_week_day', 'web', '2020-09-27 17:15:50', '2020-09-27 17:15:50'),
(704, 'delete_week_day', 'web', '2020-09-27 17:15:50', '2020-09-27 17:15:50'),
(705, 'view_financial_transaction', 'web', '2020-10-01 10:01:28', '2020-10-01 10:01:28'),
(706, 'add_financial_transaction', 'web', '2020-10-01 10:01:28', '2020-10-01 10:01:28'),
(707, 'edit_financial_transaction', 'web', '2020-10-01 10:01:28', '2020-10-01 10:01:28'),
(708, 'delete_financial_transaction', 'web', '2020-10-01 10:01:28', '2020-10-01 10:01:28'),
(709, 'view_post_transaction', 'web', '2020-10-01 10:01:29', '2020-10-01 10:01:29'),
(710, 'add_post_transaction', 'web', '2020-10-01 10:01:29', '2020-10-01 10:01:29'),
(711, 'edit_post_transaction', 'web', '2020-10-01 10:01:29', '2020-10-01 10:01:29'),
(712, 'delete_post_transaction', 'web', '2020-10-01 10:01:29', '2020-10-01 10:01:29'),
(713, 'view_school_event_scope', 'web', '2020-10-01 10:01:29', '2020-10-01 10:01:29'),
(714, 'add_school_event_scope', 'web', '2020-10-01 10:01:30', '2020-10-01 10:01:30'),
(715, 'edit_school_event_scope', 'web', '2020-10-01 10:01:30', '2020-10-01 10:01:30'),
(716, 'delete_school_event_scope', 'web', '2020-10-01 10:01:30', '2020-10-01 10:01:30'),
(717, 'view_school_event_type', 'web', '2020-10-01 10:01:30', '2020-10-01 10:01:30'),
(718, 'add_school_event_type', 'web', '2020-10-01 10:01:30', '2020-10-01 10:01:30'),
(719, 'edit_school_event_type', 'web', '2020-10-01 10:01:30', '2020-10-01 10:01:30'),
(720, 'delete_school_event_type', 'web', '2020-10-01 10:01:30', '2020-10-01 10:01:30'),
(721, 'view_transaction_category', 'web', '2020-10-01 10:01:31', '2020-10-01 10:01:31'),
(722, 'add_transaction_category', 'web', '2020-10-01 10:01:31', '2020-10-01 10:01:31'),
(723, 'edit_transaction_category', 'web', '2020-10-01 10:01:31', '2020-10-01 10:01:31'),
(724, 'delete_transaction_category', 'web', '2020-10-01 10:01:31', '2020-10-01 10:01:31'),
(725, 'view_transaction_type', 'web', '2020-10-01 10:01:31', '2020-10-01 10:01:31'),
(726, 'add_transaction_type', 'web', '2020-10-01 10:01:31', '2020-10-01 10:01:31'),
(727, 'edit_transaction_type', 'web', '2020-10-01 10:01:31', '2020-10-01 10:01:31'),
(728, 'delete_transaction_type', 'web', '2020-10-01 10:01:31', '2020-10-01 10:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(2) NOT NULL,
  `country_id` int(2) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `country_id`, `name`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ruvuma', 'Ruvuma', 1, 0, '2022-12-01 04:12:28', '2022-12-01 04:12:28'),
(2, 1, 'Mwanza', 'Mwanza', 1, 0, '2022-12-01 04:12:49', '2022-12-01 04:16:15'),
(3, 1, 'Iringa', 'Iringa', 1, 0, '2023-06-23 06:34:53', '2023-06-23 06:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2019-07-25 16:47:33', '2019-07-25 16:47:33'),
(19, 'Business Owner', 'web', '2020-09-30 13:36:16', '2023-01-31 14:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 3),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 18),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(17, 18),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(21, 18),
(22, 1),
(23, 1),
(25, 1),
(26, 1),
(27, 1),
(29, 1),
(29, 2),
(29, 9),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 2),
(33, 1),
(33, 2),
(33, 9),
(34, 1),
(34, 2),
(34, 9),
(35, 1),
(35, 2),
(35, 9),
(36, 2),
(36, 9),
(37, 1),
(37, 3),
(37, 11),
(38, 1),
(38, 3),
(39, 1),
(39, 3),
(40, 3),
(41, 1),
(41, 3),
(41, 11),
(42, 1),
(42, 3),
(42, 11),
(43, 1),
(43, 3),
(44, 3),
(45, 1),
(45, 3),
(46, 1),
(46, 3),
(46, 9),
(46, 10),
(47, 1),
(47, 3),
(48, 3),
(49, 1),
(49, 3),
(50, 1),
(50, 3),
(51, 1),
(51, 3),
(52, 3),
(53, 1),
(54, 1),
(55, 1),
(57, 1),
(57, 3),
(58, 1),
(59, 1),
(61, 1),
(62, 1),
(63, 1),
(65, 1),
(66, 1),
(67, 1),
(69, 1),
(70, 1),
(71, 1),
(73, 1),
(73, 5),
(74, 1),
(74, 5),
(75, 1),
(75, 5),
(76, 5),
(77, 1),
(77, 3),
(78, 1),
(78, 3),
(79, 1),
(79, 3),
(80, 3),
(81, 1),
(81, 3),
(82, 1),
(82, 3),
(83, 1),
(83, 3),
(84, 3),
(85, 1),
(85, 2),
(85, 9),
(86, 1),
(86, 2),
(87, 1),
(87, 2),
(88, 2),
(89, 1),
(89, 3),
(90, 1),
(90, 3),
(91, 1),
(93, 1),
(94, 1),
(95, 1),
(97, 1),
(98, 1),
(99, 1),
(101, 1),
(102, 1),
(103, 1),
(105, 1),
(106, 1),
(107, 1),
(109, 1),
(109, 3),
(110, 1),
(110, 3),
(111, 1),
(111, 3),
(112, 3),
(113, 1),
(114, 1),
(115, 1),
(117, 1),
(118, 1),
(119, 1),
(121, 1),
(122, 1),
(123, 1),
(125, 1),
(126, 1),
(127, 1),
(129, 1),
(130, 1),
(131, 1),
(133, 1),
(134, 1),
(135, 1),
(137, 1),
(137, 4),
(138, 1),
(139, 1),
(141, 1),
(142, 1),
(143, 1),
(145, 1),
(146, 1),
(147, 1),
(149, 1),
(150, 1),
(151, 1),
(153, 1),
(154, 1),
(155, 1),
(157, 1),
(158, 1),
(159, 1),
(161, 1),
(162, 1),
(163, 1),
(165, 1),
(166, 1),
(167, 1),
(189, 6),
(189, 7),
(190, 6),
(191, 6),
(205, 8),
(233, 9),
(253, 10),
(254, 10),
(255, 10),
(256, 10),
(329, 12),
(330, 12),
(331, 12),
(332, 12),
(333, 12),
(334, 12),
(335, 12),
(336, 12),
(337, 12),
(338, 12),
(339, 12),
(340, 12),
(617, 19),
(619, 19),
(705, 21),
(706, 21),
(707, 21),
(708, 21),
(709, 21),
(710, 21),
(711, 21),
(712, 21),
(721, 21),
(722, 21),
(723, 21),
(724, 21),
(725, 21),
(726, 21),
(727, 21),
(728, 21);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `descrption` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position` int(5) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `value`, `descrption`, `status`, `position`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'session_idle_time', '3600000', 'Allowed idle time when the logged in user does not interact with the system. When this threshold is reached the user\'s session is terminated automatically and the user is redirected to login again. This setting is measured & calculated in milli-seconds. 1 second equals to 1000 milli-seconds. \"0\" value is translated as \"Unlimited\" amount of idle time without session termination.', 1, 0, 0, '2023-02-01 02:42:05', '2023-02-02 07:18:39'),
(2, 'max_login_attempts', '3', 'Maximum allowed number of failed login attempts. When this threshold is reached the user is automatically locked until manually unlocked by the System Administrators. \"0\" value is translated as \"Unlimited\" number of failed login attempts', 1, 0, 0, '2023-02-01 02:42:05', '2023-02-01 02:42:05'),
(3, 'captcha_expiration_time', '600', 'CAPTCHA challenge expiration time. This setting is measured & calculated in seconds. \"0\" value means the CAPTCHA will never expire.', 1, 0, 1, '2023-02-01 02:42:05', '2023-02-01 02:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(2) NOT NULL,
  `business_id` int(10) NOT NULL,
  `transaction_type_id` int(2) NOT NULL,
  `transaction_category_id` int(3) NOT NULL,
  `item_id` int(10) NOT NULL,
  `unit_id` int(3) NOT NULL,
  `value` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `date` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `business_id`, `transaction_type_id`, `transaction_category_id`, `item_id`, `unit_id`, `value`, `quantity`, `description`, `parent_id`, `date`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 1, 1, '15000', '2', NULL, NULL, '2023-06-25', 1, 0, '2023-06-25 11:13:22', '2023-06-25 11:22:06'),
(2, 3, 1, 3, 2, 2, '5000', '3', NULL, NULL, '2023-06-20', 1, 0, '2023-06-25 12:56:16', '2023-06-25 12:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_categories`
--

CREATE TABLE `transaction_categories` (
  `id` int(2) NOT NULL,
  `transaction_type_id` int(2) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_categories`
--

INSERT INTO `transaction_categories` (`id`, `transaction_type_id`, `name`, `description`, `parent_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Fixed', NULL, 0, 1, 0, '2023-06-25 06:53:16', '2023-06-25 09:15:56'),
(2, 1, 'Current', NULL, 0, 1, 0, '2023-06-25 06:53:59', '2023-06-25 06:53:59'),
(3, 1, 'Existing', NULL, 1, 1, 0, '2023-06-25 06:54:31', '2023-06-25 06:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `is_asset` tinyint(1) NOT NULL DEFAULT 0,
  `is_liability` tinyint(1) NOT NULL DEFAULT 0,
  `is_capital` tinyint(1) NOT NULL DEFAULT 0,
  `is_purchase` tinyint(1) NOT NULL DEFAULT 0,
  `is_sale` tinyint(1) NOT NULL DEFAULT 0,
  `is_expense` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `name`, `description`, `is_asset`, `is_liability`, `is_capital`, `is_purchase`, `is_sale`, `is_expense`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Azam Cola', 'Azam Cola', 1, 0, 1, 1, 1, 0, 1, 0, '2023-06-25 10:33:31', '2023-06-25 10:33:31'),
(2, 'Mo Energy', 'Mo Energy', 1, 0, 1, 1, 1, 1, 1, 0, '2023-06-25 10:34:59', '2023-06-26 03:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int(2) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `name`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Asset', NULL, 1, 0, '2023-06-24 17:39:41', '2023-06-24 17:39:41'),
(2, 'Liability', NULL, 1, 0, '2023-06-24 17:39:41', '2023-06-24 17:39:41'),
(3, 'Capital', NULL, 1, 0, '2023-06-24 17:39:41', '2023-06-24 17:39:41'),
(4, 'Purchase', NULL, 1, 0, '2023-06-24 17:39:41', '2023-06-24 17:39:41'),
(5, 'Sale', NULL, 1, 0, '2023-06-24 17:39:41', '2023-06-24 17:39:41'),
(6, 'Expense', NULL, 1, 0, '2023-06-24 17:39:41', '2023-06-24 17:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `symbol` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `description`, `symbol`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Box', 'Box', 'Bx', 1, 0, '2023-06-25 09:56:33', '2023-06-25 09:56:33'),
(2, 'Carton', 'Carton', 'Crt', 1, 0, '2023-06-25 09:57:14', '2023-06-25 09:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `middle_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `mobile_phone` varchar(100) NOT NULL,
  `last_login_time` varchar(191) DEFAULT NULL,
  `is_logged_in` tinyint(1) NOT NULL DEFAULT 0,
  `last_active_time` varchar(191) DEFAULT NULL,
  `last_session_id` varchar(191) DEFAULT NULL,
  `is_first_time_login` tinyint(1) NOT NULL DEFAULT 1,
  `last_password_update` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `middle_name`, `last_name`, `gender`, `email`, `email_verified_at`, `password`, `remember_token`, `mobile_phone`, `last_login_time`, `is_logged_in`, `last_active_time`, `last_session_id`, `is_first_time_login`, `last_password_update`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(5, 'Minga Edward', 'Minga', NULL, 'Edward', 'MALE', 'admin@sme', NULL, '$2y$10$JEawqkLG2BWfPm/QI7seK.kB4skeOgfG1g..E36pgVGPSk.Oc65nO', NULL, '+255789846587', '2023-06-26 06:45:57', 1, '2023-06-26 06:45:57', NULL, 1, NULL, 1, 0, '2021-11-20 18:25:56', '2023-06-26 03:45:57'),
(12, 'Neema Edward', 'Neema', NULL, 'Edward', 'FEMALE', 'neema@gmail.com', NULL, '$2y$10$XKzmrFxRBp/MpBjTh4PsLuViSBvdPS/tfmQu1UhbazOPEgZ4C2qF6', NULL, '0657112259', '2023-02-01 02:13:36', 0, NULL, NULL, 1, NULL, 0, 0, '2023-01-31 19:33:25', '2023-01-31 23:15:52'),
(13, 'Dr Jafary S. Chobo', 'Dr. Jafary', 'S', 'Chobo', 'MALE', 'chobo@gmail.com', NULL, '$2y$10$YdQaMlrgDnOLdJHkO.lJNOr9ImxlmmAxvRnNitwlg922zTEmgovG6', NULL, '0674353645', '2023-02-01 01:22:46', 0, NULL, NULL, 1, NULL, 1, 0, '2023-01-31 21:46:19', '2023-01-31 22:32:38'),
(25, 'Francis M Mashala', 'Francis', 'M', 'Mashala', 'MALE', 'francis.mashala@gmail.com', NULL, '$2y$10$cHnxpIdzd2xmazsXl34H4ulM/l4beJQyiCmgzqh.VkZ8HNX6GcjJC', NULL, '07666777888', NULL, 0, NULL, NULL, 1, NULL, 1, 0, '2023-06-23 08:03:35', '2023-06-23 08:03:35'),
(26, 'Isaac C Mwita', 'Isaac', 'C', 'Mwita', 'MALE', 'isaac@gmail.com', NULL, '$2y$10$FQCc/ozz3MlSrGx5duqFjORC5SRVv/zCBvHhH2ffEImHbi7WA08wa', NULL, '0762396299', NULL, 0, NULL, NULL, 1, NULL, 1, 0, '2023-06-23 08:52:44', '2023-06-23 08:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_logs`
--

CREATE TABLE `user_activity_logs` (
  `id` int(2) NOT NULL,
  `uri` varchar(100) NOT NULL,
  `comment` text DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_databases`
--

CREATE TABLE `user_databases` (
  `id` int(2) NOT NULL,
  `user_id` int(10) NOT NULL,
  `email` varchar(191) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_databases`
--

INSERT INTO `user_databases` (`id`, `user_id`, `email`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 5, 'admin@clidaims', 'mysql_clidimis_live_1', 0, '2023-01-31 17:07:25', '2023-01-31 17:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_lock_logs`
--

CREATE TABLE `user_lock_logs` (
  `id` int(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direction` tinyint(1) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_lock_logs`
--

INSERT INTO `user_lock_logs` (`id`, `email`, `direction`, `comment`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'admin@sme', 0, 'Your account has been locked because you have exceeded 3 failed login attempts', 5, '2023-06-22 09:37:05', '2023-06-22 09:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_login_logs`
--

CREATE TABLE `user_login_logs` (
  `id` int(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `http_client_ip` varchar(100) DEFAULT NULL,
  `http_x_forwarded_for` varchar(100) DEFAULT NULL,
  `remote_addr` varchar(100) NOT NULL,
  `server_name` varchar(100) DEFAULT NULL,
  `direction` tinyint(1) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login_logs`
--

INSERT INTO `user_login_logs` (`id`, `email`, `http_client_ip`, `http_x_forwarded_for`, `remote_addr`, `server_name`, `direction`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Invalid credentials', 0, '2023-06-22 09:36:04', '2023-06-22 09:36:04'),
(2, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Invalid credentials', 0, '2023-06-22 09:36:40', '2023-06-22 09:36:40'),
(3, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Invalid credentials', 0, '2023-06-22 09:37:05', '2023-06-22 09:37:05'),
(4, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Locked Account', 0, '2023-06-22 09:37:21', '2023-06-22 09:37:21'),
(5, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Locked Account', 0, '2023-06-22 09:38:05', '2023-06-22 09:38:05'),
(6, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Already Logged In Account', 0, '2023-06-22 09:38:50', '2023-06-22 09:38:50'),
(7, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Already Logged In Account', 0, '2023-06-22 09:42:44', '2023-06-22 09:42:44'),
(8, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-22 09:42:44', '2023-06-22 09:42:44'),
(9, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 0, 'Logged out successfully', 1, '2023-06-22 09:59:58', '2023-06-22 09:59:58'),
(10, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-22 10:00:39', '2023-06-22 10:00:39'),
(11, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 0, 'Logged out successfully', 1, '2023-06-22 10:00:56', '2023-06-22 10:00:56'),
(12, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-22 10:02:33', '2023-06-22 10:02:33'),
(13, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 0, 'Logged out successfully', 1, '2023-06-22 11:38:16', '2023-06-22 11:38:16'),
(14, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-23 04:53:28', '2023-06-23 04:53:28'),
(15, 'malendaayohana@gmail.com', 'NONE', 'NONE', '::1', 'localhost', 0, 'Logged out successfully', 1, '2023-06-23 06:40:45', '2023-06-23 06:40:45'),
(16, 'francis.mashala@gmail.com', 'NONE', 'NONE', '::1', 'localhost', 0, 'Logged out successfully', 1, '2023-06-23 08:02:37', '2023-06-23 08:02:37'),
(17, 'francis.mashala@gmail.com', 'NONE', 'NONE', '::1', 'localhost', 0, 'Logged out successfully', 1, '2023-06-23 08:36:36', '2023-06-23 08:36:36'),
(18, 'isaac@gmail.com', 'NONE', 'NONE', '::1', 'localhost', 0, 'Logged out successfully', 1, '2023-06-23 08:57:50', '2023-06-23 08:57:50'),
(19, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Already Logged In Account', 0, '2023-06-23 08:58:01', '2023-06-23 08:58:01'),
(20, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-23 08:58:01', '2023-06-23 08:58:01'),
(21, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Already Logged In Account', 0, '2023-06-24 09:53:47', '2023-06-24 09:53:47'),
(22, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-24 09:53:47', '2023-06-24 09:53:47'),
(23, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Already Logged In Account', 0, '2023-06-24 13:10:46', '2023-06-24 13:10:46'),
(24, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-24 13:10:46', '2023-06-24 13:10:46'),
(25, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Already Logged In Account', 0, '2023-06-25 00:36:02', '2023-06-25 00:36:02'),
(26, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-25 00:36:02', '2023-06-25 00:36:02'),
(27, 'admin@clidaims', 'NONE', 'NONE', '::1', 'localhost', 1, 'Unexisting User', 0, '2023-06-25 03:40:06', '2023-06-25 03:40:06'),
(28, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Already Logged In Account', 0, '2023-06-25 03:40:16', '2023-06-25 03:40:16'),
(29, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-25 03:40:16', '2023-06-25 03:40:16'),
(30, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Already Logged In Account', 0, '2023-06-26 03:45:57', '2023-06-26 03:45:57'),
(31, 'admin@sme', 'NONE', 'NONE', '::1', 'localhost', 1, 'Logged in successfully', 1, '2023-06-26 03:45:57', '2023-06-26 03:45:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_categories`
--
ALTER TABLE `business_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_owners`
--
ALTER TABLE `business_owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_categories`
--
ALTER TABLE `transaction_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_databases`
--
ALTER TABLE `user_databases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_lock_logs`
--
ALTER TABLE `user_lock_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login_logs`
--
ALTER TABLE `user_login_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_categories`
--
ALTER TABLE `business_categories`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_owners`
--
ALTER TABLE `business_owners`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_categories`
--
ALTER TABLE `transaction_categories`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_databases`
--
ALTER TABLE `user_databases`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_lock_logs`
--
ALTER TABLE `user_lock_logs`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_login_logs`
--
ALTER TABLE `user_login_logs`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
