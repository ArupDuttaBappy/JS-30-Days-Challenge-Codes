-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2020 at 06:17 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `open_timer`
--

-- --------------------------------------------------------

--
-- Table structure for table `box_list`
--

CREATE TABLE `box_list` (
  `box_title` varchar(20) DEFAULT NULL,
  `box_url` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `box_list`
--

INSERT INTO `box_list` (`box_title`, `box_url`) VALUES
('facebook', 'https://www.facebook.com/'),
('youtube', 'https://www.youtube.com/'),
('gmail', 'https://mail.google.com/mail/u/0/'),
('linkedin', 'https://www.linkedin.com/in/arup-dutta-bappy/'),
('github', 'https://www.github.com/'),
('google', 'https://www.google.com/'),
('wikipedia', 'https://www.wikipedia.com'),
('apple', 'http://www.apple.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
