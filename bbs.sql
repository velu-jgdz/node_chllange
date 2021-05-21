-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 06:47 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`id`, `user_id`, `account_number`, `balance`, `created_at`, `updated_at`) VALUES
(1, '1', '9384595730', '460', '2021-05-19 10:57:24', '2021-05-19 23:20:01'),
(2, '1', '9384595731', '500', '2021-05-19 10:59:30', '2021-05-19 10:59:30'),
(3, '1', '9384595732', '500', '2021-05-19 11:00:52', '2021-05-19 11:00:52'),
(4, '2', '9944094858', '460', '2021-05-19 23:05:20', '2021-05-19 23:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `api_tokens`
--

CREATE TABLE `api_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api_tokens`
--

INSERT INTO `api_tokens` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, '1', 'vrYUEtrBmjSfpXoaBdgIlX8FE2n5G6vOlrpnT4l337rqde3umx', '2021-05-19 10:04:36', '2021-05-19 23:22:49'),
(2, '2', '88JBJBMZZ5X1rhlr176Mldy8a5NAfwhn91wvYfi85ToTpP003L', '2021-05-19 23:03:07', '2021-05-19 23:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_05_19_144710_create_account_details', 2),
(4, '2021_05_19_145452_create_api_tokens', 3),
(5, '2021_05_19_150815_create_transaction_history', 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `account_from`, `account_to`, `transaction_amount`, `transaction_notes`, `created_at`, `updated_at`) VALUES
(1, '9384595730', '9384595730', '20', NULL, '2021-05-19 11:32:32', '2021-05-19 11:32:32'),
(2, '9384595730', '9384595730', '20', NULL, '2021-05-19 11:35:17', '2021-05-19 11:35:17'),
(3, '9384595730', '9384595730', '20', NULL, '2021-05-19 11:44:28', '2021-05-19 11:44:28'),
(4, '9384595730', '9384595730', '20', NULL, '2021-05-19 11:45:53', '2021-05-19 11:45:53'),
(5, '9944094858', '9384595730', '20', NULL, '2021-05-19 23:11:18', '2021-05-19 23:11:18'),
(6, '9944094858', '9384595730', '20', NULL, '2021-05-19 23:13:13', '2021-05-19 23:13:13'),
(7, '9944094858', '9384595730', '20', NULL, '2021-05-19 23:19:04', '2021-05-19 23:19:04'),
(8, '9384595730', '9944094858', '20', NULL, '2021-05-19 23:20:01', '2021-05-19 23:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mani Velu', 'manivelu16@gmail.com', '9384595730', NULL, '$2y$10$y98/uKQL1/AWiBdBiAqaOOxmH0F4Ai0I9B3auMeXioprEM07NmeCO', NULL, '2021-05-19 10:04:36', '2021-05-19 10:04:36'),
(2, 'Mani Velu', 'manivelu16@hotmail.com', '9944094858', NULL, '$2y$10$CSx4nEyKKi6g4RtODWE2zuddfZQUUNzKkCTD/WR73/YQVEK0LL21a', NULL, '2021-05-19 23:03:07', '2021-05-19 23:03:07'),
(3, 'Manivelu', 'manivelu16@gmail.comm', '9875674532', NULL, 'Qwerty@123', NULL, NULL, NULL),
(5, 'Manivelu', 'manivelu16@gmail.commmm', '', NULL, '$2a$10$L32MiPCsCyRpLoJVC9.HYOYiqi8S1.8CkJvlwmUf3bazdgmteMX.u', NULL, NULL, NULL),
(6, 'Manivelu', 'manivelu16@gmail.commmmm', '9875674532', NULL, '$2a$10$QvSzouUUAaG8yn2N/KY46effwE/e9eNJu4o5z6XZ5Amg4Xx8ZKmhK', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `api_tokens`
--
ALTER TABLE `api_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
