-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 09:56 AM
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
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_avatar` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `role_id`, `account_name`, `account_avatar`, `password_hash`, `email`, `create_at`) VALUES
(1, 1, 'kaka1409', 'uploads/account/kaka1409.png', 'test', 'testEmail@gmail.com', '2025-03-16 05:06:49'),
(7, 1, 'test user', 'uploads/account/default.jpg', '$2y$10$j37XG4wZOUJslK3dH1IM7uQv4BOGfa5RK6H7l3t88lNlgQo.CI5Fq', 'test@gmail.com', '2025-03-20 04:54:40'),
(8, 1, 'kk1409', 'uploads/account/default.jpg', '$2y$10$nVSapmddlfUCX344CJumde9w/qL1aiCGvLrw1MSkjEyDRoVmbLsfO', 'bruh@gmail.com', '2025-03-20 04:58:36'),
(10, 1, 'new user', 'uploads/account/default.jpg', '$2y$10$S8y9wx2ADVjKz/gT7rVllO2jsnxNKbYTcJ3S9qZ3eDCIlhzfN1Tju', 'new@gmail.com', '2025-03-21 06:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vote` int(11) NOT NULL DEFAULT 0,
  `depth_level` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `account_id`, `post_id`, `parent_comment_id`, `content`, `updated_at`, `commented_at`, `vote`, `depth_level`) VALUES
(1, 10, 1, NULL, 'yay', '2025-03-29 02:03:28', '2025-03-29 02:03:28', 0, 0),
(2, 10, 1, NULL, 'asd', '2025-03-29 02:03:42', '2025-03-29 02:03:42', 0, 0),
(5, 10, 1, NULL, 'test', '2025-03-29 05:49:16', '2025-03-29 05:49:16', 0, 0),
(6, 10, 1, NULL, 'toi bi ngu', '2025-03-29 05:50:19', '2025-03-29 05:50:19', 0, 0),
(7, 10, 1, NULL, 'toi het bi ngu roi', '2025-03-29 06:08:09', '2025-03-29 06:08:09', 0, 0),
(8, 8, 2, NULL, 'Nah I\'m cooked', '2025-03-29 07:26:50', '2025-03-29 07:26:50', 0, 0),
(9, 8, 2, NULL, 'oooooooohhh', '2025-03-29 07:30:31', '2025-03-29 07:30:31', 0, 0),
(10, 8, 2, NULL, 'dsnfdfnsdfsdlfknaklflkdflkaslflkasdlk klas dklaslkdj alksdlk asflksndkl fneksfn skdnfk nsdkfn sdnkfskjdfn jksdnfjk sndjk sdf', '2025-03-29 07:31:14', '2025-03-29 07:31:14', 0, 0),
(11, 8, 12, NULL, 'congrat on your first post', '2025-03-29 07:36:40', '2025-03-29 07:36:40', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read','deleted') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `account_id`, `title`, `content`, `updated_at`, `sent_at`, `status`) VALUES
(1, 10, 'test email', 'yayaay', '2025-03-25 17:20:01', '2025-03-25 17:20:01', 'unread'),
(2, 10, 'message 2', 'wowow', '2025-03-25 17:27:43', '2025-03-25 17:27:43', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `teacher` varchar(50) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `teacher`, `description`) VALUES
(1, 'Test module', 'random teacher', 'test module discription'),
(2, 'Web Progarmming', 'Mr Tra', 'Learn web development concepts'),
(3, 'Data Science', 'Pro. David', 'Data is gold, and data science is the best field in CompSci change my mind');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `post_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `vote` int(11) NOT NULL DEFAULT 0,
  `comments_count` int(11) DEFAULT NULL,
  `thumbnail_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `account_id`, `module_id`, `title`, `content`, `post_at`, `updated_at`, `vote`, `comments_count`, `thumbnail_url`) VALUES
(1, 1, 1, 'test post updated 3', 'lorem isuapum yeah', '2025-03-16 05:08:41', '2025-03-29 07:34:26', 2, 5, 'uploads/1.webp'),
(2, 1, 2, 'test post number oishdfshiodfu', 'lorem isuapum of post number 2', '2025-03-16 05:11:20', '2025-03-29 08:53:48', 2, 3, 'uploads/2.jpg'),
(4, 1, 1, 'post number 3', 'lorem isuapum of post number 3', '2025-03-16 05:11:56', '2025-03-25 15:54:11', -1, 0, 'uploads/3.webp'),
(12, 8, 3, 'new post yeah', 'oh baby oh bay oh baby', '2025-03-20 08:56:49', '2025-03-29 07:37:51', 1, 1, 'uploads/'),
(13, 8, 1, 'yeah baby', 'oy hm good', '2025-03-21 04:27:54', '2025-03-26 04:33:54', -1, 0, 'uploads/'),
(14, 10, 1, 'my first post ever', 'yayayayayaaayaa', '2025-03-22 16:09:17', '2025-03-25 15:16:49', 2, 0, 'uploads/4.webp'),
(15, 10, 2, 'yeah yeah', 'a', '2025-03-23 10:22:23', '2025-03-29 05:54:46', 1, 0, 'uploads/4.webp'),
(16, 10, 1, 'my lastest post IG', 'uspen nivka', '2025-03-25 17:25:50', '2025-03-28 05:47:11', 1, 0, 'uploads/');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(2, 'admin'),
(1, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `vote_type` enum('1','-1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `account_id`, `post_id`, `comment_id`, `vote_type`) VALUES
(2, 8, 14, NULL, '1'),
(3, 1, 14, NULL, '1'),
(4, 7, 14, NULL, '-1'),
(51, 10, 14, NULL, '1'),
(52, 10, 4, NULL, '-1'),
(53, 10, 16, NULL, '1'),
(54, 10, 2, NULL, '1'),
(55, 10, 12, NULL, '1'),
(56, 10, 13, NULL, '-1'),
(79, 10, 1, NULL, '1'),
(85, 10, 15, NULL, '1'),
(86, 8, 2, NULL, '1'),
(87, 8, 1, NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_account_role_id` (`role_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `idx_comment_account_id` (`account_id`),
  ADD KEY `idx_comment_post_id` (`post_id`),
  ADD KEY `idx_comment_parent_id` (`parent_comment_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `idx_message_sender_id` (`account_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `idx_post_account_id` (`account_id`),
  ADD KEY `idx_post_module_id` (`module_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `unique_account_post` (`account_id`,`post_id`),
  ADD UNIQUE KEY `unique_account_comment` (`account_id`,`comment_id`),
  ADD KEY `idx_vote_account_id` (`account_id`),
  ADD KEY `idx_vote_post_id` (`post_id`),
  ADD KEY `idx_vote_comment_id` (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE CASCADE;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
