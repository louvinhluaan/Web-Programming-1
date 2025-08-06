-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 06:52 AM
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
-- Database: `coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `answer_text` text NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `user_name`, `answer_text`, `question_id`, `created_at`) VALUES
(44, 5, 'lvl', 'a', 91, '2025-08-04 21:12:21'),
(45, 5, 'lvl', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 90, '2025-08-04 21:30:45'),
(47, 24, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 93, '2025-08-04 21:32:49'),
(48, 5, 'lvl', 'aaa', 93, '2025-08-06 06:37:32'),
(49, 5, 'lvl', 'test answer\r\n', 113, '2025-08-06 09:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'luan', 'louvinhluan@gmail.com', 'test send message to admin', '2025-07-27 17:20:59'),
(2, 'luan', 'louvinhluan321@gmail.com', 'test send message to admin 2', '2025-07-27 17:22:28'),
(3, 'luan', 'luan@gmail.com', 'lasjdkljaskldjasdkas', '2025-07-27 17:23:20'),
(7, 'luan', 'luan@gmail.com', 'testttttt', '2025-08-04 11:07:22'),
(12, 'luan', 'luan@gmail.com', '<strong>hello</strong>', '2025-08-05 20:00:44'),
(13, 'luann', 'luan@gmail.com', 'alert(\'x\')', '2025-08-05 20:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'COMP1841', 'this is web1 subject', '2025-07-27 15:37:41'),
(2, 'COMP1770', 'this is PM ', '2025-07-27 15:37:41'),
(3, 'COMP1843', 'this is Security', '2025-07-27 15:37:41'),
(4, 'COMP1589', 'this is OOP', '2025-07-27 15:37:41'),
(5, 'COMP1773', 'this is UI', '2025-07-27 15:37:41'),
(7, 'COMP1752', NULL, '2025-07-28 17:02:02'),
(8, 'COMP1809', NULL, '2025-07-28 17:02:15'),
(9, 'COMP1845', NULL, '2025-07-28 17:02:36'),
(11, 'COMP1753', NULL, '2025-07-28 17:03:06'),
(12, 'COMP1821', NULL, '2025-07-28 17:03:19'),
(16, 'COMP1999aa', 'this is a COMP1999 subject', '2025-08-06 09:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `quest_title` text NOT NULL,
  `questtext` text NOT NULL,
  `questdate` datetime DEFAULT current_timestamp(),
  `images` text DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `moduleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `quest_title`, `questtext`, `questdate`, `images`, `userid`, `moduleid`) VALUES
(85, 'question 1', 'this is question 1', '2025-08-04 20:46:50', 'duck.jpg', 5, 1),
(86, 'question 2', 'this is question 2', '2025-08-04 20:47:10', 'chicken.jpg', 5, 2),
(87, 'question 3', 'this is question 3', '2025-08-04 20:47:21', 'doctor.jpeg', 5, 3),
(88, 'question 4', 'this is question 4', '2025-08-04 20:47:31', 'fish.jpg', 5, 4),
(89, 'question 5', 'this is question 5', '2025-08-04 20:47:48', 'penguin.png', 5, 7),
(90, 'question 6', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-08-04 20:48:44', 'clock.png', 5, 9),
(91, 'question 7', 'no image', '2025-08-04 20:49:40', NULL, 5, 9),
(93, 'question 8', 'aaaasasdsdasdasaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-08-04 21:32:27', NULL, 24, 2),
(94, 'question 10', 'testttttt', '2025-08-06 06:41:56', NULL, 5, 1),
(103, 'question 11', 'this is question 11', '2025-08-06 08:53:16', NULL, 5, 1),
(104, 'question 12', 'this is question 12', '2025-08-06 08:53:28', NULL, 5, 1),
(105, 'question 13', 'this is question 13\r\n', '2025-08-06 09:00:04', NULL, 5, 2),
(106, 'question 14', 'this is question 14', '2025-08-06 09:00:14', NULL, 5, 8),
(107, 'question 15', 'this is question 15\r\n', '2025-08-06 09:00:24', NULL, 5, 8),
(108, 'question 16', 'this is question 16', '2025-08-06 09:00:36', NULL, 5, 2),
(109, 'question 17', 'this is question 17', '2025-08-06 09:00:49', NULL, 5, 5),
(110, 'question 18', 'this is questionnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn 1888888888888888888', '2025-08-06 09:01:11', NULL, 5, 4),
(111, 'question 19', 'this is question 19', '2025-08-06 09:01:25', NULL, 5, 7),
(112, 'question 20', 'this is question 20', '2025-08-06 09:01:42', 'comp1841.jpg', 5, 1),
(113, 'add question (edited)', 'this is the example for add question (edited)', '2025-08-06 09:11:52', 'example2.png', 5, 2),
(114, 'question 21', 'this is question for peter', '2025-08-06 10:26:34', NULL, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'admin', 'abcxyz', '2025-07-27 15:49:39'),
(2, 'user', 'dfsdfdsfdsfds', '2025-07-27 15:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_at`, `bio`) VALUES
(3, 'vinh', 'dangquangvinh@gmail.com', '$2y$10$z25Fvhx3fAxCdaUCxbSZdumPlLfPhoC3wWJVNA/Byegjy28TzLKKq', '2025-07-27 14:19:32', 'vinh'),
(4, 'duong', 'nguyendaiduong@gmail.com', '$2y$10$PQs434s2GKSY3UY8buzseODL/Q8HBZP5FTomWmz.r0wbMulR1vtcS', '2025-07-27 14:19:32', 'duong'),
(5, 'lvl', 'lvl@gmail.com', '$2y$10$xoDXFgh9fR5mlDqO89dl3OFfHowGgdZbtolo19CKGmcBDByHYTlMS', '2025-07-27 14:19:32', 'vluan'),
(6, 'huy', 'huy@gmail.com', '$2y$10$A1BejL1ARghjXh3.AIlwkeGbtjqo6ObueSZqjI0DPrmbZszJCBpqa', '2025-07-27 14:19:32', 'huyy'),
(7, 'luann', 'luan@gmail.com', '$2y$10$z0PrCHI81m8vVEUYhfO40ee57BNLTdgmqqA/JPwl2BHyt/10vNZGC', '2025-07-27 14:19:32', 'luan'),
(17, 'admin', 'admin@gmail.com', '$2y$10$C.F2PUkcixtRRniODAmzaONYDiSWgv5l.m17UzjLKK27AgxqxVF56', '2025-07-27 23:11:00', 'admin'),
(22, 'lvl 2', 'lvl2@gmail.com', '$2y$10$Ajeq.YBqa7wr7u4EyuqizekVg9apdWG9H2ANKh0jTqtbHdBAkXV1S', '2025-08-04 17:36:27', NULL),
(23, 'lvl 3', 'lvl3@gmail.com', '$2y$10$p4i.8DbtUZK/caldM3P0yuhXY3bTcJB0/OeAu5KHnc0.ar2Sw.lhe', '2025-08-04 17:41:03', NULL),
(24, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaa@gmail.com', '$2y$10$9/U5ADWNxi0fy1.CHO87qet3JiHyuWK23HLpvZsF91wEIlJ9rbqJK', '2025-08-04 21:32:05', NULL),
(25, 'peter', 'peter@gmail.com', '$2y$10$.FqQ7R4of0KyuKY9whsH3ObrHiSNKAQO06ZhNWvGWGvz.PUvRvpmG', '2025-08-06 05:44:44', '');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`userid`, `roleid`) VALUES
(3, 2),
(4, 2),
(5, 1),
(6, 2),
(7, 2),
(17, 1),
(22, 2),
(23, 2),
(24, 2),
(25, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorid` (`userid`),
  ADD KEY `moduleid` (`moduleid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`userid`,`roleid`),
  ADD KEY `roleid` (`roleid`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`moduleid`) REFERENCES `module` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `userrole`
--
ALTER TABLE `userrole`
  ADD CONSTRAINT `userrole_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userrole_ibfk_2` FOREIGN KEY (`roleid`) REFERENCES `role` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
