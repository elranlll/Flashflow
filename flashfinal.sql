-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 12:46 PM
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
-- Database: `flashfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `setcode` int(12) NOT NULL,
  `itemcode` int(12) NOT NULL,
  `question` varchar(512) NOT NULL,
  `answer` varchar(512) NOT NULL,
  `memorized` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`setcode`, `itemcode`, `question`, `answer`, `memorized`) VALUES
(6155, 2, 'wwwwwwwwwww', 'hahahahah', 0),
(6155, 2147483647, 'gegfffg', 'rtrttrr', 0),
(8504, 15, 'wa', 'wwwa', 0),
(8504, 0, 'fd', 'dsf', 1),
(8504, 66583, 'fds', 'fds', 0),
(8504, 40, 'qweqw', 'qewqwe', 1),
(8504, 210, 'ccd', 'dasd', 1),
(8504, 1, 'asd', 'asd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setit`
--

CREATE TABLE `setit` (
  `id` int(12) NOT NULL,
  `setname` varchar(56) NOT NULL,
  `setcode` int(12) NOT NULL,
  `user_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setit`
--

INSERT INTO `setit` (`id`, `setname`, `setcode`, `user_id`) VALUES
(20, 'asdasdasdasd', 6155, 0),
(27, 'rerer', 8504, 2),
(28, 'erwer', 7081, 1),
(29, 'sdaasd', 3415, 1),
(30, 'dasdasd', 8319, 1),
(33, 'sdasd', 5451, 1),
(49, 'fsdfsdfsdfsdf', 1812, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setpg`
--

CREATE TABLE `setpg` (
  `setcode` int(12) NOT NULL,
  `setdes` varchar(1048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setpg`
--

INSERT INTO `setpg` (`setcode`, `setdes`) VALUES
(6155, 'sdasdasd'),
(8504, ''),
(7081, ''),
(3415, ''),
(8319, ''),
(5451, ''),
(1812, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`) VALUES
(1, 'Admin', 'admin@example.com', 'adminadmin'),
(2, 'rain', 'rain@gmail.com', '$2y$10$t/3DxT2qXgVFMyrvuSao4ekp9IAZgCWedfNJ.DmFuqr7GTV5vP79m');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `setit`
--
ALTER TABLE `setit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `setit`
--
ALTER TABLE `setit`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
