-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2021 at 04:42 PM
-- Server version: 8.0.19
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psychLids`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `started` varchar(255) NOT NULL,
  `finished` varchar(255) DEFAULT NULL,
  `p1` varchar(255) NOT NULL,
  `p2` varchar(255) DEFAULT NULL,
  `p3` varchar(255) DEFAULT NULL,
  `p4` varchar(255) DEFAULT NULL,
  `p5` varchar(255) DEFAULT NULL,
  `p6` varchar(255) DEFAULT NULL,
  `p7` varchar(255) DEFAULT NULL,
  `p8` varchar(255) DEFAULT NULL,
  `p9` varchar(255) DEFAULT NULL,
  `round` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `users` varchar(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `picks`
--

CREATE TABLE `picks` (
  `id` int NOT NULL,
  `gameID` varchar(255) NOT NULL,
  `round` varchar(255) NOT NULL,
  `winner` varchar(20) DEFAULT NULL,
  `p1` varchar(20) DEFAULT NULL,
  `p2` varchar(20) DEFAULT NULL,
  `p3` varchar(20) DEFAULT NULL,
  `p4` varchar(20) DEFAULT NULL,
  `p5` varchar(20) DEFAULT NULL,
  `p6` varchar(20) DEFAULT NULL,
  `p7` varchar(20) DEFAULT NULL,
  `p8` varchar(20) DEFAULT NULL,
  `p9` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `userID` int DEFAULT NULL,
  `gameID` int DEFAULT NULL,
  `question` text NOT NULL,
  `approved` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

CREATE TABLE `rounds` (
  `id` int NOT NULL,
  `gameID` varchar(255) NOT NULL,
  `round` varchar(10) NOT NULL,
  `questionID` varchar(255) NOT NULL,
  `winnerID` varchar(255) DEFAULT NULL,
  `p1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p7` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p8` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p9` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `added` int NOT NULL,
  `ready` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picks`
--
ALTER TABLE `picks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rounds`
--
ALTER TABLE `rounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `picks`
--
ALTER TABLE `picks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
