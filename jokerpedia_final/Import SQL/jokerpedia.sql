-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 08:47 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jokerpedia`
--
CREATE DATABASE IF NOT EXISTS `jokerpedia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jokerpedia`;

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `bid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Bid ID',
  `pid` int(11) NOT NULL COMMENT 'Post ID',
  `author` varchar(25) NOT NULL COMMENT 'Author Username',
  `title` varchar(254) NOT NULL,
  `bidder` varchar(25) NOT NULL COMMENT 'Bidder Username',
  `status` tinyint(2) NOT NULL DEFAULT 2 COMMENT '0 - No, 1 - Yes, 2 - Pending',
  `reviewed` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 - No, 1 - Yes',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `bid`
--

TRUNCATE TABLE `bid`;
-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `pid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Post ID',
  `title` varchar(254) NOT NULL,
  `username` varchar(25) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `filePath` varchar(255) NOT NULL,
  `approve` tinyint(2) NOT NULL DEFAULT 2 COMMENT '0 - No, 1 - Yes, 2 - Pending',
  UNIQUE KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `post`
--

TRUNCATE TABLE `post`;
-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `rid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'reply ID',
  `pid` int(11) NOT NULL COMMENT 'Post ID',
  `title` varchar(254) NOT NULL COMMENT 'Author Title',
  `author` varchar(25) NOT NULL COMMENT 'Author Username',
  `bidder` varchar(25) NOT NULL COMMENT 'Reviewer Username',
  `rating` varchar(20) NOT NULL DEFAULT '0' COMMENT 'Strong Accept (3), Accept (2), Weak Accept (1), Borderline Paper (0), Weak Reject (-1), Reject (-2), Strong Reject (-3)',
  `quote` longtext NOT NULL COMMENT 'Quote Comment',
  `comment` longtext NOT NULL COMMENT 'Reviewer''s Comment',
  `datetime` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Review Date',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `review`
--

TRUNCATE TABLE `review`;
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
  `username` varchar(25) NOT NULL COMMENT 'Username',
  `password` varchar(254) NOT NULL COMMENT 'Password',
  `email` varchar(254) NOT NULL COMMENT 'Email',
  `usertype` varchar(20) NOT NULL DEFAULT 'Author' COMMENT 'Author (Default)\r\nReviewer\r\nConference Chair\r\nSystem Admin',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 - disable\r\n1 - enable',
  PRIMARY KEY (`username`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `email`, `usertype`, `active`) VALUES
(1, 'admin', '$2y$10$CWz4x9Q6GCfOvYeC2kGcz.MU9LjdOAVSPPlITK9bHVuenRfL6gIqu', 'jokerpedia314@gmail.com', 'System Admin', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
