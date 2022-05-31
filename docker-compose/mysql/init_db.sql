-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 01:22 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `cat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `cat`) VALUES
(99, 2, 'loop'),
(100, 2, 'toop'),
(101, 2, 'roop'),
(102, 2, 'boop'),
(103, 2, 'soop'),
(106, 2, 'Cap'),
(108, 4, 'Elahi'),
(109, 9, 'abb'),
(110, 9, 'test'),
(111, 9, 'Kab');

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE `docs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `subcat_id` int(10) DEFAULT NULL,
  `filename` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `fileextension` varchar(10) DEFAULT NULL,
  `filesize` int(10) DEFAULT NULL,
  `filemimetype` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` (`id`, `user_id`, `cat_id`, `subcat_id`, `filename`, `description`, `fileextension`, `filesize`, `filemimetype`, `created_at`) VALUES
(198, 2, 102, NULL, 'jet.sql', NULL, 'txt', 14495, 'text/plain', '2021-06-01 22:03:57'),
(199, 2, 102, NULL, 'jet.sql', NULL, 'txt', 14495, 'text/plain', '2021-06-01 22:04:44'),
(200, 2, 99, NULL, 'jet.sql', NULL, 'txt', 14495, 'text/plain', '2021-06-01 22:05:31'),
(201, 2, 99, NULL, 'jet.sql', NULL, 'txt', 14495, 'text/plain', '2021-06-01 22:08:44'),
(202, 2, 99, NULL, 'jet.sql', NULL, 'txt', 14495, 'text/plain', '2021-06-01 22:11:31'),
(203, 2, 102, 34, 'jet.sql', 'kooft', 'txt', 14495, 'text/plain', '2021-06-01 22:26:35'),
(204, 4, 108, 40, 'jet.sql', 'test shalgham khan', 'txt', 14495, 'text/plain', '2021-06-01 22:33:03'),
(205, 9, 109, NULL, 'IMG_0045.jpg', 'test', 'jpg', 2913741, 'image/jpeg', '2021-06-27 00:18:44'),
(206, 9, 110, 42, 'IMG_0077.jpg', 'test', 'jpg', 2686350, 'image/jpeg', '2021-06-29 21:55:23'),
(207, 9, 111, 43, 'dsc08354.jpg', 'shhhhhhhhhhhh', 'jpg', 230664, 'image/jpeg', '2021-07-14 20:19:51'),
(208, 9, 109, NULL, 'IMG_1544-.jpg', NULL, 'jpg', 251310, 'image/jpeg', '2021-08-04 01:34:09'),
(209, 9, 111, NULL, 'IMG_1551.JPG', '\'/\'.env(\'APP_NAME\', \'pet\');', 'jpg', 261595, 'image/jpeg', '2021-08-04 20:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `emaillog`
--

CREATE TABLE `emaillog` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `target` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attached` blob DEFAULT NULL,
  `filename` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filemimetype` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt` datetime NOT NULL,
  `text` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emaillog`
--

INSERT INTO `emaillog` (`id`, `user_id`, `target`, `subject`, `attached`, `filename`, `filemimetype`, `dt`, `text`, `sent`) VALUES
(28, 2, 'radfar04@yahoo.com', 'mmmm', NULL, NULL, NULL, '2021-05-30 17:49:49', 'The configuration file ( php.ini ) is read when PHP starts up. For the server module versions of PHP, this happens only once when the web server is started.', 'Y'),
(29, 9, 'radfar04@yahoo.com', 'test', 0x433a5c6b6f6f66745c73746f726167655c6170705c6c697665776972652d746d702f663364645364795a4f636f75545a3250457956784c50793978487648774c2d6d6574615a484e6a4d44677a4e545175616e426e2d2e6a7067, 'dsc08354.jpg', 'image/jpeg', '2021-07-14 15:19:22', 'test', 'Y'),
(30, 9, 'radfar04@yahoo.com', 'test', 0x433a5c6b6f6f66745c73746f726167655c6170705c6c697665776972652d746d702f663364645364795a4f636f75545a3250457956784c50793978487648774c2d6d6574615a484e6a4d44677a4e545175616e426e2d2e6a7067, 'dsc08354.jpg', 'image/jpeg', '2021-07-14 15:21:22', 'test', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_03_10_212235_create_sessions_table', 1),
(7, '2021_04_02_133125_create_contacts_table', 2),
(8, '2015_12_10_091718_add_last_login_at_to_users_table', 3),
(9, '2015_12_10_092156_add_role_to_users_table', 3),
(10, '2015_10_05_110608_create_messages_table', 4),
(11, '2015_10_05_110622_create_conversations_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `email` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`id`, `user_id`, `email`, `dt`, `description`) VALUES
(151, 2, NULL, '2021-05-24 17:10:00', 'were'),
(152, 2, NULL, '2021-05-24 17:10:00', 'tell me'),
(153, 4, NULL, '2021-06-01 15:36:00', 'kooft'),
(154, 4, NULL, '2021-06-01 17:20:00', 'yadam Nare'),
(155, 2, NULL, '2021-06-01 17:40:00', 'kkk'),
(170, 9, NULL, '2021-06-22 13:04:00', 'test'),
(173, 9, NULL, '2021-06-29 13:24:00', 'this'),
(174, 9, NULL, '2021-06-29 14:20:00', 'Your'),
(180, 9, NULL, '2021-08-02 14:53:00', 'kjkj'),
(181, 9, NULL, '2021-08-04 13:37:00', 'lkllklklklklklklklklkl');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('uWzaCmv0im6sIFxItnrfmyidnpPdvsc8cCunnXrr', 10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNnBVQVhqcUY3d3JMNVdjUjE1eEZHb3JnWXFSZ1p2Q1hpSUpLVHFYSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wZXQvcmVtaW5kZXIiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMDtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFZSWjhrQlZuSDI2aXJBY3o2d0NXdC55eUc1ZXhMQ2hvUFlGSWtZcEh2Z3BDcFp4b3V0S0UyIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRWUlo4a0JWbkgyNmlyQWN6NndDV3QueXlHNWV4TENob1BZRklrWXBIdmdwQ3BaeG91dEtFMiI7fQ==', 1628117711),
('Xy4b9bWwcdQKu0DJkeaVzMRnMkd0g007yj2XsHXM', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVkgzS0ZWQ0ZXdGxjTEIzTDh0TkNTUlVzMWw1NnhMVU5ZaXZSNmtrZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wZXQvbG9naW4iO31zOjc6ImNhcHRjaGEiO2E6Mzp7czo5OiJzZW5zaXRpdmUiO2I6MDtzOjM6ImtleSI7czo2MDoiJDJ5JDEwJHhveTBlWnA2dlRyUy5YSzZWQ3VuNmVTa0NHNnYzd3Z2aHc3cUE4Z2tLTWJXNHJKLlA1ZC42IjtzOjc6ImVuY3J5cHQiO2I6MDt9fQ==', 1628119234);

-- --------------------------------------------------------

--
-- Table structure for table `subcat`
--

CREATE TABLE `subcat` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `subcat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcat`
--

INSERT INTO `subcat` (`id`, `user_id`, `cat_id`, `subcat`) VALUES
(34, 2, 102, 'Fereidoon'),
(35, 2, 106, 'Tap'),
(36, 2, 106, 'Rap'),
(37, 2, 103, 'Fereidoon'),
(39, 2, 102, 'Hell'),
(40, 4, 108, 'Bemiri'),
(41, 9, 109, 'baa'),
(42, 9, 110, 'mest'),
(43, 9, 111, 'Tab');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `role` enum('user','editor','administrator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `last_login_at`, `role`) VALUES
(9, 'Fereidoon Radfar', 'radfar04@yahoo.com', NULL, '$2y$10$Jb/eSCmQbGzcmM7Zf2qwDOy/99Yd7dD/pWkRYDuuvQZ6rSNpob7q6', NULL, NULL, '8bmUZNX4YiltZbGdTVb8QMLmPP0WSCPE6j5HF9LqgVB6U2DuLx0NA96GWdGQ', NULL, 'profile-photos/vgytO7sGsHpQY8oF7WBf5a3wXF2GnRCP5ZjGoOQA.jpg', '2021-06-18 23:04:08', '2021-08-04 23:20:31', NULL, 'user'),
(10, 'Shalgham Khan', 'radfar04@gmail.com', NULL, '$2y$10$VRZ8kBVnH26irAcz6wCWt.yyG5exLChoPYFIkYpHvgpCpZxoutKE2', NULL, NULL, NULL, NULL, 'profile-photos/y2yi5CiFdohPhHUjeYKU9nXmj199cDihK8frfslo.jpg', '2021-08-04 20:57:40', '2021-08-04 22:55:04', NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_unique_index` (`id`,`user_id`),
  ADD UNIQUE KEY `cat` (`cat`);

--
-- Indexes for table `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emaillog`
--
ALTER TABLE `emaillog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user_id`,`email`,`dt`),
  ADD UNIQUE KEY `end` (`id`,`user_id`,`dt`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subcat`
--
ALTER TABLE `subcat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcat_id_index` (`id`),
  ADD UNIQUE KEY `cat_id` (`cat_id`,`subcat`),
  ADD UNIQUE KEY `subcat_unique_index` (`id`,`user_id`),
  ADD KEY `reference_cat_id` (`id`,`cat_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `docs`
--
ALTER TABLE `docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `emaillog`
--
ALTER TABLE `emaillog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `subcat`
--
ALTER TABLE `subcat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subcat`
--
ALTER TABLE `subcat`
  ADD CONSTRAINT `subcat_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
