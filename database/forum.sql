-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 10:12 AM
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
(7, 1, 'test user', 'uploads/account/default.jpg', '$2y$10$j37XG4wZOUJslK3dH1IM7uQv4BOGfa5RK6H7l3t88lNlgQo.CI5Fq', 'test@gmail.com', '2025-03-20 04:54:40'),
(8, 2, 'kk1409', 'uploads/account/default.jpg', '$2y$10$nVSapmddlfUCX344CJumde9w/qL1aiCGvLrw1MSkjEyDRoVmbLsfO', 'bruh@gmail.com', '2025-03-20 04:58:36'),
(10, 1, 'new user', 'uploads/account/default.jpg', '$2y$10$S8y9wx2ADVjKz/gT7rVllO2jsnxNKbYTcJ3S9qZ3eDCIlhzfN1Tju', 'new@gmail.com', '2025-03-21 06:10:40'),
(23, 1, 'Alma Mcknight', 'uploads/account/uni.jfif', '$2y$10$zjgNbwCeo65s8KFdT.Klnuj.bDQDrDUTrf9vwP8SqsDfrnrlbgNlK', 'zixecixop@mailinator.com', '2025-04-10 03:48:26'),
(26, 2, 'admin', 'uploads/account/default.jpg', '$2y$10$OwaGCruSWcKwBPNAA1jfnulUK/AwNe.v8c8sfkv94wRudzbusY0LS', 'admin@gmail.com', '2025-04-26 05:35:06'),
(31, 1, 'kaka1409', 'uploads/account/kaka1409.png', '$2y$10$8264PElCOt2nR1l6S99i1u74Xlb.6B0vXPTVS3BZvgCxQkGCfRvLq', 'khanhphqgcs230461@fpt.edu.vn', '2025-04-26 08:33:25'),
(34, 1, 'My new Account', 'uploads/account/default.jpg', '$2y$10$ZUjYHbHnSBMeEEqj5MJKwuiUKjXHfzlEl6nJSzv9ZT6UpHMTuBuF2', 'newAccount@gmail.com', '2025-04-29 08:32:15'),
(41, 1, 'test user', 'uploads/account/default.jpg', '$2y$10$QlX760Lj2SMOF5VtvKMzueeUyTH0MNpnSQgLXsDYR5TviYQS2MxPi', 'asd123@gmail.com', '2025-05-05 08:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarked`
--

CREATE TABLE `bookmarked` (
  `account_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmarked`
--

INSERT INTO `bookmarked` (`account_id`, `post_id`) VALUES
(8, 13),
(26, 45),
(26, 30),
(26, 15);

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
(11, 8, 12, NULL, 'congrat on your first post', '2025-04-28 06:18:31', '2025-03-29 07:36:40', -1, 0),
(12, 8, 13, NULL, 'never cook again', '2025-04-28 06:21:12', '2025-04-01 10:10:37', 1, 0),
(13, 8, 16, NULL, 'haha', '2025-04-01 10:11:17', '2025-04-01 10:11:17', 0, 0),
(14, 8, 13, NULL, 'no wayyas', '2025-04-28 06:21:15', '2025-04-03 08:18:28', 1, 0),
(15, 8, 13, NULL, 'huh', '2025-04-28 06:21:14', '2025-04-03 08:18:43', 1, 0),
(16, 8, 13, NULL, 'hehehehe', '2025-04-28 06:21:16', '2025-04-03 08:20:16', -1, 0),
(17, 26, 23, NULL, 'Use margin 0 auto', '2025-04-29 09:41:09', '2025-04-29 09:30:55', -1, 0),
(18, 26, 30, NULL, 'first comment', '2025-05-05 08:08:33', '2025-05-05 08:08:28', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `commentvote`
--

CREATE TABLE `commentvote` (
  `vote_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `vote_type` enum('1','-1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commentvote`
--

INSERT INTO `commentvote` (`vote_id`, `account_id`, `comment_id`, `vote_type`) VALUES
(1, 26, 11, '-1'),
(2, 26, 12, '1'),
(3, 26, 14, '1'),
(4, 26, 15, '1'),
(5, 26, 16, '-1'),
(7, 26, 17, '-1'),
(8, 26, 18, '1');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `admin_id` int(11) NOT NULL,
  `action` enum('create','update','delete') DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`admin_id`, `action`, `post_id`, `module_id`, `user_id`) VALUES
(8, 'create', NULL, NULL, 23),
(8, 'create', 25, NULL, NULL),
(31, 'update', NULL, NULL, 31),
(26, 'update', NULL, NULL, 23),
(26, 'create', 30, NULL, NULL),
(26, 'create', 45, NULL, NULL),
(26, 'update', 45, NULL, NULL),
(26, 'update', 45, NULL, NULL),
(26, 'update', 45, NULL, NULL);

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
(1, 10, 'test email', 'yayaay', '2025-04-04 08:17:57', '2025-03-25 17:20:01', 'read'),
(2, 10, 'message 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita impedit inventore consequatur, amet ratione molestias dolorem ad incidunt provident. Veritatis aliquid tempora aliquam in maxime ab obcaecati sequi, optio unde?', '2025-04-05 14:29:06', '2025-03-25 17:27:43', 'read'),
(3, 8, '---', '---', '2025-04-04 09:29:43', '2025-04-04 08:48:25', 'deleted'),
(5, 8, '---', '---', '2025-04-25 10:52:49', '2025-04-09 10:08:41', 'deleted'),
(6, 26, 'How can I log out?', 'I can\'t find the logout button, please help me', '2025-04-29 07:13:36', '2025-04-29 07:09:36', 'read'),
(7, 26, '---', '---', '2025-05-05 08:07:07', '2025-05-05 08:06:48', 'deleted');

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
(1, 'Test module updated', 'random teacher', 'test module discription'),
(2, 'Web Progarmming', 'Mr Tra', 'Learn web development concepts'),
(3, 'Data Science', 'Pro. David', 'Data is gold, and data science is the best field in CompSci change my mind'),
(4, 'IOT', 'Mr Charles', 'Working around with IOT ecosystem');

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
(12, 8, 3, 'new post yeah', 'oh baby oh bay oh baby', '2025-03-20 08:56:49', '2025-05-05 08:10:42', 4, 1, 'uploads/default.png'),
(13, 8, 1, 'yeah baby', 'oy hm good', '2025-03-21 04:27:54', '2025-05-05 08:10:39', -1, 4, 'uploads/1.webp'),
(14, 10, 1, 'my first post ever', 'yayayayayaaayaa', '2025-03-22 16:09:17', '2025-03-25 15:16:49', 2, 0, 'uploads/4.webp'),
(15, 10, 2, 'yeah yeah', 'a', '2025-03-23 10:22:23', '2025-04-04 07:42:07', 2, 0, 'uploads/4.webp'),
(16, 10, 1, 'my lastest post IG', 'uspen nivka', '2025-03-25 17:25:50', '2025-05-05 05:54:17', 1, 1, 'uploads/default.png'),
(23, 8, 2, 'how can  I center a div?', 'seriously how can I do that?', '2025-04-09 09:03:04', '2025-04-29 09:39:08', 1, 1, 'uploads/4.webp'),
(25, 8, 1, 'psot 123', 'sdjjasfkff', '2025-04-10 04:15:07', '2025-05-05 08:08:00', 1, 0, 'uploads/default.png'),
(30, 26, 4, 'Announcement', 'New announcement to all student, this website will stop running', '2025-05-04 10:45:02', '2025-05-05 08:08:28', 1, 1, 'uploads/4.webp'),
(45, 26, 1, 'asd', 'asd', '2025-05-04 12:40:17', '2025-05-05 06:43:37', 1, 0, 'uploads/Screenshot (73).png');

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
(4, 7, 14, NULL, '-1'),
(51, 10, 14, NULL, '1'),
(53, 10, 16, NULL, '1'),
(55, 10, 12, NULL, '1'),
(56, 10, 13, NULL, '-1'),
(85, 10, 15, NULL, '1'),
(98, 8, 12, NULL, '1'),
(102, 8, 15, NULL, '1'),
(106, 8, 23, NULL, '1'),
(107, 8, 13, NULL, '1'),
(108, 26, 12, NULL, '1'),
(110, 26, 13, NULL, '-1'),
(113, 26, 45, NULL, '1'),
(114, 26, 25, NULL, '1'),
(115, 26, 30, NULL, '1'),
(118, 41, 12, NULL, '1');

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
-- Indexes for table `bookmarked`
--
ALTER TABLE `bookmarked`
  ADD KEY `account_id` (`account_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `idx_comment_account_id` (`account_id`),
  ADD KEY `idx_comment_post_id` (`post_id`),
  ADD KEY `idx_comment_parent_id` (`parent_comment_id`);

--
-- Indexes for table `commentvote`
--
ALTER TABLE `commentvote`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `commentvote`
--
ALTER TABLE `commentvote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookmarked`
--
ALTER TABLE `bookmarked`
  ADD CONSTRAINT `bookmarked_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarked_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE;

--
-- Constraints for table `commentvote`
--
ALTER TABLE `commentvote`
  ADD CONSTRAINT `commentvote_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `commentvote_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `logs_ibfk_3` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `logs_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE;

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
