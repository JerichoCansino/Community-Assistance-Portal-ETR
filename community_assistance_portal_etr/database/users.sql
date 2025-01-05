-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 01:10 PM
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
-- Database: `community_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('staff','admin','user') NOT NULL DEFAULT 'user',
  `age` int(11) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `address` text NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `role`, `age`, `sex`, `address`, `profile_picture`) VALUES
(1, '', 'admin_user', '*9A9A8DF73F6431CD3B43F2EE3309A01592D8ADFA', 'admin', 0, 'Male', '', 'default.jpg'),
(2, '', 'staff_user', '*72F8F6A6C19DFEB71EAE311D2DB42F22556059D9', 'staff', 0, 'Male', '', 'default.jpg'),
(3, '', 'regular_user', '*3D885319D32AF8352A3B6DC864F86159F67911C1', 'user', 0, 'Male', '', 'default.jpg'),
(7, '', 'sample', 'sample123', 'user', 0, 'Male', '', 'default.jpg'),
(8, '', 'admin', 'admin123', 'admin', 0, 'Male', '', 'default.jpg'),
(10, 'angelo caspe', 'angelo', '12345678', 'user', 22, 'Male', 'cabungan', 'default.jpg'),
(12, 'mark angelo', 'caspesample', 'sample54321', 'staff', 22, 'Male', 'cabungan', 'default.jpg'),
(13, 'Guest Account', 'guestaccount', 'guest123', 'user', 30, 'Male', 'Pangasinan', 'default.jpg'),
(16, 'Jerone Ayz Del Rosario', 'jeroneayz', 'caspe123', 'user', 22, 'Female', 'Malasiqui, Pangasinan', '677a354c0b1a2_try.jpg'),
(17, 'Malupiton', 'malupiton', 'kupal123', 'user', 25, 'Male', 'Kupalogs, Pangasinan', '677a3afae64a3_kupal.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
