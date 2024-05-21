-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 11:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saint_andrews_club_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `club_id` varchar(255) DEFAULT NULL,
  `participants` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `leader` varchar(255) DEFAULT NULL,
  `members` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `logo`, `details`, `leader`, `members`, `created_at`, `updated_at`) VALUES
(1, 'Test Club', 'Test Club - Logo1714399529.jpeg', 'testing adding a club', NULL, '[]', '2024-04-29 12:05:30', '2024-05-03 09:53:25'),
(2, 'Chess Club', 'Chess Club - Logo1714737550.jpg', 'This is a club where we play chess', '1', '[1]', '2024-05-03 09:59:10', '2024-05-08 08:37:12'),
(3, 'Football Club', 'Football Club - Logo1714737743.jpg', 'we play football', '1', '[1]', '2024-05-03 10:02:23', '2024-05-07 05:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `club_attendances`
--

CREATE TABLE `club_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `club_id` varchar(255) NOT NULL,
  `present_members` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `club_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `candidates` varchar(255) NOT NULL,
  `winner` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `end_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `club_id`, `name`, `candidates`, `winner`, `status`, `end_date`, `created_at`, `updated_at`) VALUES
(1, '2', 'Chess Club Election', '\"[1]\"', '1', 'completed', '2024-05-08 08:55:12', '2024-05-07 12:14:10', '2024-05-08 08:37:12'),
(2, '3', 'Football Club Election', '\"[1]\"', NULL, 'in progress', '2024-05-09 08:48:00', '2024-05-08 08:48:39', '2024-05-08 08:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `date_and_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `club_id` varchar(255) NOT NULL,
  `attendance_list` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `poster`, `details`, `venue`, `date_and_time`, `club_id`, `attendance_list`, `created_at`, `updated_at`) VALUES
(1, 'First Event', 'First Event - Poster1714415697.jpg', 'First Event Details', 'Nacit', '2024-05-03 04:04:31', '1', '[]', '2024-04-29 16:34:57', '2024-04-29 16:34:57'),
(4, 'Chess Tournament', 'Chess Tournament - Poster1715153066.jpg', 'There is Chess tournament coming up', 'Nacit', '2024-05-08 09:33:10', '2', '[1]', '2024-05-08 07:24:26', '2024-05-08 09:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `event_attendances`
--

CREATE TABLE `event_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` varchar(255) NOT NULL,
  `present_students` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `chat_id` varchar(255) DEFAULT NULL,
  `club_id` varchar(255) DEFAULT NULL,
  `sender_id` varchar(255) NOT NULL,
  `receiver_id` varchar(255) DEFAULT NULL,
  `message` longtext NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `type`, `chat_id`, `club_id`, `sender_id`, `receiver_id`, `message`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'club message', NULL, '1', '1', NULL, 'hie', NULL, '2024-05-02 18:26:37', '2024-05-02 18:26:37'),
(2, 'club message', NULL, '1', '1', NULL, 'message with picture', 'IMG-1714681793.jpg', '2024-05-02 18:29:53', '2024-05-02 18:29:53'),
(3, 'announcement', NULL, NULL, '1', NULL, 'A new Club has been created! go to the clubs tab for more info', NULL, '2024-05-03 09:59:10', '2024-05-03 09:59:10'),
(4, 'announcement', NULL, NULL, '1', NULL, 'A new Club has been created! go to the clubs tab for more info', NULL, '2024-05-03 10:02:24', '2024-05-03 10:02:24'),
(5, 'club message', NULL, '2', '1', NULL, 'hie i am Spence Kabambe', NULL, '2024-05-03 10:11:44', '2024-05-03 10:11:44'),
(6, 'club message', NULL, '2', '1', NULL, '.', NULL, '2024-05-07 14:56:03', '2024-05-07 14:56:03'),
(7, 'announcement', NULL, '2', '1', NULL, 'A new Event has been posted! go to the events tab for more info', NULL, '2024-05-08 07:24:26', '2024-05-08 07:24:26'),
(8, 'announcement', NULL, '2', '1', NULL, 'Chess Club Election election results.. and the winner is Spence Kabambe', NULL, '2024-05-08 08:39:05', '2024-05-08 08:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
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
(6, '2024_04_29_041650_create_sessions_table', 1),
(7, '2024_04_29_044138_create_clubs_table', 1),
(8, '2024_04_29_044246_create_club_attendances_table', 1),
(9, '2024_04_29_044320_create_chats_table', 1),
(10, '2024_04_29_044328_create_messages_table', 1),
(11, '2024_04_29_045631_create_elections_table', 1),
(12, '2024_04_29_045639_create_votes_table', 1),
(13, '2024_04_29_050149_create_events_table', 1),
(14, '2024_04_29_050250_create_event_attendances_table', 1),
(15, '2024_04_29_062716_create_students_table', 1),
(16, '2024_05_07_085333_create_students_club_histories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Dn7iUmeLzHM1KDd8m3yrjmvlhs76RzoTy15AaCsI', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGhVT2lHcUQwMldlY0taSjRiSlNzN0RuUjdOSERYQmZoYzZXaUZHTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2FpbnRzLWNsdWJzL3B1YmxpYy9zdHVkZW50L2V2ZW50LzQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1715160793);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `gender`, `class`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Spence', 'Kabambe', 'male', 'form 4', 'spence_student@gmail.com', '2024-05-02 10:31:58', '2024-05-02 10:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `students_club_histories`
--

CREATE TABLE `students_club_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `club_id` varchar(255) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exit_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_club_histories`
--

INSERT INTO `students_club_histories` (`id`, `student_id`, `club_id`, `join_date`, `exit_date`, `created_at`, `updated_at`) VALUES
(1, '1', '3', '2024-05-07 05:44:14', NULL, '2024-05-07 05:44:14', '2024-05-07 05:44:14'),
(2, '1', '2', '2024-05-07 07:09:37', NULL, '2024-05-07 07:09:37', '2024-05-07 07:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'student',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Spence Admin', 'admin', 'spence_admin@saints-clubs.com', NULL, '$2y$10$CfCUNyva//xDUPrAgkD1I.8aICgTgFOmbs9/caVX7aCd3SyYPkB9.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Spence Kabambe', 'student', 'spence_student@gmail.com', NULL, '$2y$10$srLOk016E28PfrmreItTy..Zehf2wLRTD6c5P4XtyxthTdHwijY3G', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-02 12:31:59', '2024-05-02 12:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `election_id` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `chosen_candidate` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `election_id`, `student_id`, `chosen_candidate`, `reason`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', 'good guy', '2024-05-07 16:50:42', '2024-05-07 16:50:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_attendances`
--
ALTER TABLE `club_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_attendances`
--
ALTER TABLE `event_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_club_histories`
--
ALTER TABLE `students_club_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_attendances`
--
ALTER TABLE `club_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_attendances`
--
ALTER TABLE `event_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students_club_histories`
--
ALTER TABLE `students_club_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
