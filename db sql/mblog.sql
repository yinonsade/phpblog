-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 09, 2019 at 03:19 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `date` datetime NOT NULL,
  `youtube` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `article`, `date`, `youtube`) VALUES
(6, 4, 'capital cities', 'really cool and groovy song1', '2019-01-05 22:01:21', 'https://www.youtube.com/watch?v=_OTRIp6nxB0&start_radio=1&list=RDMM_OTRIp6nxB0'),
(10, 2, 'Led Zeppein- Babe im gonna leave you', 'one of the best blues songs ever made!', '2019-01-07 12:07:52', 'https://www.youtube.com/watch?v=eOUaQz8GYPA'),
(11, 6, 'wish you were here by pink floyd', 'its classical !', '2019-01-08 15:38:23', 'https://www.youtube.com/watch?v=IXdNnw99-Ic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'yinon', 'yinonsade@gmail.com', '$2y$10$EXbmJzXctyBbmwODIOZUcOwq2hnZOkeq0jel0W2lOLTMD0uaa8UaS', '2019-01-04 19:20:35'),
(2, 'moshe', 'moshe@gmail.com', '$2y$10$lTAN/Dpfqt3g48ipuHK8ne.REYLMZEfePHLHXGfrajxeL1WdkRCMa', '2019-01-05 21:56:41'),
(3, 'david', 'david@gmail.com', '$2y$10$IzhLceGQHwMkgXKQ655jDu.yS/HFlHTCTUszRfQsmR/L.Ei8SSjIG', '2019-01-05 21:57:55'),
(4, 'testname', 'test@gmail.com', '$2y$10$Ys/EYZ75Kkn.ruo5FkavOe3B0uM8UDRRm6C8ieQd58dEZrNwQf3zO', '2019-01-05 21:59:12'),
(5, 'yinon', 'yinon@gmail.com', '$2y$10$RQkSz29/363kpPw5lI/vAey9anXMyXE.cK2bSE/TOI1D64UyJOO3q', '2019-01-06 21:13:44'),
(6, 'eli', 'eli@gmail.com', '$2y$10$ib/sC6S7kmJeHxGfw69O2ukHfsQkh.8ykGLF3ZMfgmjTzNY./fXWi', '2019-01-08 15:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `user_id`, `avatar`) VALUES
(1, 1, 'default.jpg'),
(2, 1, '2019.01.04.17.20.35-922809_10152734563340251_758888805_n.jpg'),
(3, 2, 'default.jpg'),
(4, 3, 'default.jpg'),
(5, 4, '2019.01.05.19.59.12-922809_10152734563340251_758888805_n.jpg'),
(6, 5, 'default.jpg'),
(7, 6, '2019.01.08.13.37.23-2018.12.31.21.16.22-492439916_preview_Laptop_Music_Cat.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
