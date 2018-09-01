-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 01, 2018 at 07:19 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mfeapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `artists_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `artists_id`, `created_at`) VALUES
(1, 'Across The Sky', 1, '2018-08-17 09:46:52'),
(2, 'Fields Of Freedom', 1, '2018-08-17 09:46:52'),
(3, 'Instrumental Singles', 2, '2018-08-17 09:48:03'),
(4, 'Rhythm Of Christmas', 2, '2018-08-17 09:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'john smith'),
(2, 'peeter poll'),
(3, 'Russ Abbot'),
(4, 'Zak Abel'),
(5, 'Alan Barton'),
(6, 'Colin Bass'),
(7, 'T. P. Bragg'),
(8, 'Martin Brammer'),
(9, 'Kirk Brandon'),
(10, 'Lee Brennan'),
(11, 'David Brett'),
(12, 'Martin Briley'),
(13, 'David M. Allen'),
(14, 'Steven Beckingham'),
(15, 'Terry Britten'),
(16, 'Ralph Amner'),
(17, 'Tony Beet'),
(18, 'Terry Britten'),
(19, 'Chris Amoo'),
(20, 'Sam Beeton'),
(21, 'Justin Broadrick'),
(22, 'Brett Anderson'),
(23, 'Gary Brooker'),
(24, 'Jon Anderson');

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `artists_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `name`, `artists_id`, `album_id`, `created_at`, `updated_at`) VALUES
(1, 'See you again', 1, 1, '2018-08-17 09:40:14', '2018-08-17 09:40:14'),
(2, 'Blank space', 1, 2, '2018-08-17 09:40:47', '2018-08-17 09:40:47'),
(3, 'Shake it off', 1, 1, '2018-08-17 09:41:31', '2018-08-17 09:41:31'),
(4, 'Uptown funk', 1, 2, '2018-08-17 09:41:31', '2018-08-17 09:41:31'),
(5, 'Dark horse', 2, 1, '2018-08-17 09:42:24', '2018-08-17 09:42:24'),
(6, 'Love the way you lie', 2, 2, '2018-08-17 09:42:24', '2018-08-17 09:42:24'),
(7, 'Thrift shop', 2, 1, '2018-08-17 09:42:55', '2018-08-17 09:42:55'),
(8, 'Love me like you do', 2, 2, '2018-08-17 09:42:55', '2018-08-17 09:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`, `status`, `delete_status`) VALUES
(1, 'charan', 'singh', 'admin@gmail.com', 'admin', '2018-08-16 11:52:21', '2018-08-16 11:52:21', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
